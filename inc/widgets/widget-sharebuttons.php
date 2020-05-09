<?php

/**
 * Materialize themed share buttons widget
 */

class JTZWP_ShareButtons_Widget extends WP_Widget {
    public function __construct(){
        $widgetConfig = (object) array(
            'id' => 'jtzwp_shareButtons',
            'name' => 'Share Buttons (JTZWP)',
            'options' => array(
                'classname' => 'jtzwpShareButtons',
                'description' => 'Displays (native) social share buttons'
            )
        );
        // Construct WP_Widget Instance
        parent::__construct(
            $widgetConfig->id,
            $widgetConfig->name,
            $widgetConfig->options
        );
    }

    public function widget($args,$instance){
        // Outputs content

        global $jtzwpHelpers;

        // Get settings
        extract($args);
        $widgetTitle = apply_filters('widget_title',$instance['title']);
        $useEmail = $this->_retrieveBool('useEmail',$instance,false);
        $useTwitter = $this->_retrieveBool('useTwitter',$instance,false);
        $useLinkedin = $this->_retrieveBool('useLinkedin',$instance,false);
        $usePocket = $this->_retrieveBool('usePocket',$instance,false);
        $useReddit = $this->_retrieveBool('useReddit',$instance,false);
        $twitterHandle = !empty($instance['twitterHandle']) ? $instance['twitterHandle'] : false;
        // @todo ?
        $useFacebook = false;

        // check that at least one share button is enabled
        $shareArr = array($useEmail,$useTwitter,$usePocket,$useReddit);
        $enableWidget = in_array(true,$shareArr,true);
        if ($enableWidget===false){
            // Return immediately - no share buttons to show
            return;
        }

        // Get meta info
        $postInfo = $jtzwpHelpers->getBasicPostInfo(null);

        // Before widget content
        echo $before_widget;

        // Title
        if (!empty($widgetTitle)){
            echo $before_title . $widgetTitle . $after_title;
        }
        ?>
        <?php /* Now output the actual inner widget content */ ?>
            <div class="widgetBody">
                <div class="row center">
                    <?php if ($useEmail): ?>
                        <?php $this->_renderShareButton('mailto:?to=&body='.urlencode($postInfo->permalink).'&subject='.urlencode('Check out this link!'),'Email',null,'email'); ?>
                    <?php endif; ?>
                    <?php if ($useTwitter): ?>
                        <?php
                            $twitterText = $postInfo->title;
                            if ($twitterHandle) {
                                $twitterText = $twitterText . ', by ' . $twitterHandle;
                            }
                            // Twitter will add space before URL
                            $twitterText = $twitterText . ' -';
                        ?>
                        <?php $this->_renderShareButton('https://twitter.com/intent/tweet?url='.urlencode($postInfo->permalink).'&text='.urlencode($twitterText),'Twitter','fa-twitter',null); ?>
                    <?php endif; ?>
                    <?php if ($useLinkedin): ?>
                        <?php
                            $linkedinShareLink = 'https://www.linkedin.com/shareArticle?mini=true&url='.urlencode($postInfo->permalink).'&title='.urlencode($postInfo->title);
                            if ($postInfo->hasExcerpt){
                                $linkedinShareLink = $linkedinShareLink . '&summary=' . urlencode($postInfo->excerpt);
                            }
                        ?>
                        <?php $this->_renderShareButton($linkedinShareLink,'LinkedIn','fa-linkedin-square',null); ?>
                    <?php endif; ?>
                    <?php if ($usePocket): ?>
                        <?php $this->_renderShareButton('https://getpocket.com/edit?url='.urlencode($postInfo->permalink).'&title='.urlencode($postInfo->title),'Pocket','fa-get-pocket',null); ?>
                    <?php endif; ?>
                    <?php if ($useReddit): ?>
                        <?php $this->_renderShareButton('http://www.reddit.com/submit?url='.urlencode($postInfo->permalink).'&title='.urlencode($postInfo->title),'Reddit','fa-reddit',null); ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php /* END inner widget content */ ?>
        <?php echo $after_widget;
    }

    public function form($instance){
        // Rendering the options form in the admin interface

        // Check for values already set by user
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $useEmail = isset($instance['useEmail']) ? (bool) $instance['useEmail'] : false;
        $useTwitter = isset($instance['useTwitter']) ? (bool) $instance['useTwitter'] : false;
        $useLinkedin = isset($instance['useLinkedin']) ? (bool) $instance['useLinkedin'] : false;
        $usePocket = isset($instance['usePocket']) ? (bool) $instance['usePocket'] : false;
        $useReddit = isset($instance['useReddit']) ? (bool) $instance['useReddit'] : false;
        // Vendor specific settings
        $twitterHandle = isset($instance['twitterHandle']) ? esc_attr($instance['twitterHandle']) : '';
        ?>
        <?php /* Output the actual form HTML */ ?>
            <!-- Title -->
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title : '); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <!-- Checkboxes: disable or enable social buttons -->
            <p>Use the checkboxes below to enable/disable specific share buttons:</p>
            <?php $this->_generateCheckbox('useEmail',$useEmail,'Email'); ?>
            <?php $this->_generateCheckbox('useTwitter',$useTwitter,'Twitter'); ?>
            <?php $this->_generateCheckbox('useLinkedin',$useLinkedin,'LinkedIn'); ?>
            <?php $this->_generateCheckbox('usePocket',$usePocket,'Pocket'); ?>
            <?php $this->_generateCheckbox('useReddit',$useReddit,'Reddit'); ?>
            <p>Vendor Specific Settings:</p>
            <p>
                <label for="<?php echo $this->get_field_id('twitterHandle'); ?>"><?php _e('Twitter Handle : '); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('cityFilter'); ?>" name="<?php echo $this->get_field_name('twitterHandle'); ?>" type="text" value="<?php echo $twitterHandle; ?>" />
            </p>
        <?php /* End form */ ?>
        <?php
    }

    public function update($newInstance,$oldInstance){
        // When widget data updates
        return $newInstance;
    }

    private function _generateCheckbox($fieldId,$var,$stringName){
        ?>
        <p>
            <input class="checkbox" type="checkbox"<?php checked($var);?> id="<?php echo $this->get_field_id($fieldId); ?>" name="<?php echo $this->get_field_name($fieldId); ?>" />
            <label for="<?php echo $this->get_field_id($fieldId); ?>"><?php _e($stringName.' Button'); ?></label>
        </p>
        <?php
    }

    private function _retrieveBool($fieldId,$instance,$default){
        $default = gettype($default)==='boolean' ? $default : false;
        return (!empty($instance[$fieldId])) ? (bool) $instance[$fieldId] : $default;
    }

    /**
     * @param {string} $url URL to link the share button to
     */
    private function _renderShareButton($url,$stringName,$faIcon,$materialIcon){
        $hasMaterialIcon = gettype($materialIcon)==='string';
        $hasFaIcon = gettype($faIcon)==='string';
        ?>
            <div class="col s6 m4 l3 jtzwpShareButtonWrapper">
                <a class="jtzwpShareButton customBtn z-depth-2 hoverable autoCenterParent jtzwp-dark" href="<?php echo $url; ?>" target="_blank" title="<?php echo $stringName; ?>">
                    <div class="autoCenterChild">
                        <div class="icon" style="display:inline-block;">
                            <?php if($hasMaterialIcon): ?>
                            <i class="material-icons left"><?php echo $materialIcon; ?></i>
                            <?php elseif($hasFaIcon): ?>
                            <i class="fa <?php echo $faIcon; ?> iconsSolidBackground" aria-hidden="true"></i>
                            <?php endif; ?>
                        </div>
                        <div class="buttonText"><?php echo $stringName; ?></div>
                    </div>
                </a>
            </div>
        <?php
    }
}

add_action('widgets_init',function(){register_widget('JTZWP_ShareButtons_Widget');});