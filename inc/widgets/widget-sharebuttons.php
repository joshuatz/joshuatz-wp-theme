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
        $usePocket = $this->_retrieveBool('usePocket',$instance,false);
        $useReddit = $this->_retrieveBool('useReddit',$instance,false);

        // Get meta info

        // Before widget content
        echo $before_widget;

        // Title
        if (!empty($widgetTitle)){
            echo $before_title . $widgetTitle . $after_title;
        }
        ?>
        <?php /* Now output the actual inner widget content */ ?>
            <div class="widgetBody">
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
        $usePocket = isset($instance['usePocket']) ? (bool) $instance['usePocket'] : false;
        $useReddit = isset($instance['useReddit']) ? (bool) $instance['useReddit'] : false;
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
            <?php $this->_generateCheckbox('usePocket',$usePocket,'Pocket'); ?>
            <?php $this->_generateCheckbox('useReddit',$useReddit,'Reddit'); ?>
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
            <input class="checkbox" type="checkbox"<?php checked($fieldId);?> id="<?php echo $this->get_field_id($fieldId); ?>" name="<?php echo $this->get_field_name($fieldId); ?>" />
            <label for="<?php echo $this->get_field_id($fieldId); ?>"><?php _e($stringName.' Button'); ?></label>
        </p>
        <?php
    }

    private function _retrieveBool($fieldId,$instance,$default){
        $default = gettype($default)==='boolean' ? $default : false;
        return (!empty($instance[$fieldId]) && gettype($instance[$fieldId])==='boolean') ? $instance[$fieldId] : $default;
    }
 }
 add_action('widgets_init',function(){register_widget('JTZWP_ShareButtons_Widget');});