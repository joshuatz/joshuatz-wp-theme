<?php
/**
 * Geo Locked Content
 */

class JTZWP_GeoLockedContent_Widget extends WP_Widget {
    public function __construct(){
        $widgetConfig = (object) array(
            'id' => 'jtzwp_geoLockedContent',
            'name' => 'Geo Locked Content (JTZWP)',
            'options' => array(
                'classname' => 'jtzwpGeoLockedContent',
                'description' => 'Displays content to users matching a certain Geographic area'
            )
        );
        // construct WP_Widget instance
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
        $useJavascript = !empty($instance['useJavascript']) ? $instance['useJavascript'] : false;
        $countryFilter = !empty($instance['countryFilter']) ? $instance['countryFilter'] : false;
        $regionFilter = !empty($instance['regionFilter']) ? $instance['regionFilter'] : false;
        $cityFilter = !empty($instance['cityFilter']) ? $instance['cityFilter'] : false;
        $actualContent = !empty($instance['actualContent']) ? $instance['actualContent'] : false;
        $hasFilter = ($countryFilter || $regionFilter || $cityFilter);

        // Flag if using backend fails in some way
        $backendFailed = false;
        // Flag if filters fail to match
        $matchBlocked = false;

        if (!$actualContent){
            // return immediately - nothing to show
            return;
        }

        if (!$useJavascript){
            $ipInfoResponse = $jtzwpHelpers->getIpInfo();
            if ($ipInfoResponse->success){
                // Go ahead and test for match
                $jtzwpHelpers->log($ipInfoResponse->info);
                $filters = array(
                    array(
                        'infoKey' => 'country',
                        'filterVal' => $countryFilter
                    ),
                    array(
                        'infoKey' => 'region',
                        'filterVal' => $regionFilter
                    ),
                    array(
                        'infoKey' => 'city',
                        'filterVal' => $cityFilter
                    )
                );
                foreach($filters as $filter){
                    if ($filter['filterVal']){
                        $ipInfoVal = $ipInfoResponse->info[$filter['infoKey']];
                        if ($jtzwpHelpers->autoStrMatchTest($filter['filterVal'],$ipInfoVal)===false){
                            $matchBlocked = true;
                            $jtzwpHelpers->log('blocked by ' . $filter['infoKey'] . ' - "' . $filter['filterVal'] . '" [not match] ' . $ipInfoVal);
                            break;
                        }
                    }
                }
            }
            else {
                $jtzwpHelpers->log($ipInfoResponse->failMsg);
                // Try to switch over to JS
                $backendFailed = true;
                $useJavascript = true;
            }
        }
        
        // If match blocked, return
        if ($matchBlocked){
            return;
        }

        // Before widget content
        echo $before_widget;

        // Title
        if (!empty($widgetTitle)){
            echo $before_title . $widgetTitle . $after_title;
        }
        ?>
        <?php /* Now output the actual inner widget content */ ?>
            <div class="widgetBody <?php echo $hasFilter && $useJavascript ? 'hide' : ''?>">
                <?php echo $actualContent; ?>
                <?php if($hasFilter && $useJavascript): ?>
                    <script>
                        // Need to implement logic
                    </script>
                <?php endif; ?>
            </div>
        <?php /* END inner widget content */ ?>
        <?php echo $after_widget;

    }

    public function form($instance){
        // Rendering the options form in the admin interface
        
        // Check for values already set by user
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $useJavascript = isset($instance['useJavascript']) ? (bool) $instance['useJavascript'] : false;
        $countryFilter = isset($instance['countryFilter']) ? esc_attr($instance['countryFilter']) : '';
        $regionFilter = isset($instance['regionFilter']) ? esc_attr($instance['regionFilter']) : '';
        $cityFilter = isset($instance['cityFilter']) ? esc_attr($instance['cityFilter']) : '';
        $actualContent = isset($instance['actualContent']) ? esc_attr($instance['actualContent']) : '';
        ?>
        <?php /* Ouptut the actual form HTML */ ?>
            <!-- Title -->
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title : '); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <!-- Use JavaScript Checkbox -->
            <p>
                <input class="checkbox" type="checkbox"<?php checked($useJavascript);?> id="<?php echo $this->get_field_id('useJavascript'); ?>" name="<?php echo $this->get_field_name('useJavascript'); ?>" />
                <label for="<?php echo $this->get_field_id('useJavascript'); ?>"><?php _e('Use Javascript to hide content instead of backend'); ?></label>
            </p>
            <!-- Country Filter -->
            <p>
                <label for="<?php echo $this->get_field_id('countryFilter'); ?>"><?php _e('Country to filter to : '); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('countryFilter'); ?>" name="<?php echo $this->get_field_name('countryFilter'); ?>" type="text" value="<?php echo $countryFilter; ?>" />
            </p>
            <!-- Region Filter -->
            <p>
                <label for="<?php echo $this->get_field_id('regionFilter'); ?>"><?php _e('Region to filter to : '); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('regionFilter'); ?>" name="<?php echo $this->get_field_name('regionFilter'); ?>" type="text" value="<?php echo $regionFilter; ?>" />
            </p>
            <!-- City Filter -->
            <p></p>
                <label for="<?php echo $this->get_field_id('cityFilter'); ?>"><?php _e('City to filter to : '); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('cityFilter'); ?>" name="<?php echo $this->get_field_name('cityFilter'); ?>" type="text" value="<?php echo $cityFilter; ?>" />
            </p>
            <!-- The Actual Content -->
            <p>
                <label for="<?php echo $this->get_field_id('actualContent'); ?>"><?php _e('Actual HTML Content : '); ?></label>
                <textarea class="widefat code" rows="16" cols="20" id="<?php echo $this->get_field_id('actualContent'); ?>" name="<?php echo $this->get_field_name('actualContent'); ?>"><?php echo esc_textarea($instance['actualContent']); ?></textarea>
            </p>
        <?php
    }

    public function update($newInstance,$oldInstance){
        // When widget data updates
        return $newInstance;
    }
}
add_action('widgets_init',function(){register_widget('JTZWP_GeoLockedContent_Widget');});
