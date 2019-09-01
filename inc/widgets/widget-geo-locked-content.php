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
        $countryFilter = !empty($instance['countryFilter']) ? $instance['countryFilter'] : false;
        $regionFilter = !empty($instance['regionFilter']) ? $instance['regionFilter'] : false;
        $cityFilter = !empty($instance['cityFilter']) ? $instance['cityFilter'] : false;
        $actualContent = !empty($instance['actualContent']) ? $instance['actualContent'] : false;
        $hasFilter = ($countryFilter || $regionFilter || $cityFilter);

        if (!$actualContent){
            // return immediately - nothing to show
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
            <div class="widgetBody <?php echo $hasFilter ? 'hide' : ''?>">
                <?php echo $actualContent; ?>
                <?php if($hasFilter): ?>
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

