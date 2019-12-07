<?php
/**
 * Materialize themed recent posts widget
 */

class JTZWP_RecentPosts_Widget extends WP_Widget {
    public function __construct(){
        $widgetConfig = (object) array(
            'id' => 'jtzwp_recentPosts',
            'name' => 'Recent Posts (JTZWP)',
            'options' => array(
                'classname' => 'jtzwpRecentPosts',
                'description' => 'Displays recent posts.'
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
        $numberOfPosts = !empty($instance['numberOfPosts']) ? abs(intval($instance['numberOfPosts'])) : 5;
        $restrictToBlog = (!empty($instance['restrictToBlog']) && gettype($instance['restrictToBlog'])==='boolean') ? $instance['restrictToBlog'] : false;

        // Get posts and check to make sure there are some
        $queryOptions = array(
            'posts_per_page' => intval($numberOfPosts),
            'post_status' => 'publish',
            'order' => 'DESC',
            'orderby' => 'publish_date',
            'post_type' => $restrictToBlog ? array('post') : array('any'),
            'suppress_filters' => true
        );
        $postsQuery = new WP_Query($queryOptions);

        if (!$postsQuery->have_posts()){
            // return immediately - no posts to show
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
            <div class="widgetBody">
                <ul class="collapsible postsDrawer" tabindex="0">
                <?php $counter = 0; ?>
                <?php foreach($postsQuery->posts as $recentPost): ?>
                    <?php
                        $counter++;
                        $postInfo = $jtzwpHelpers->getBasicPostInfo($recentPost);
                    ?>
                    <li class="<?php echo $counter===1 ? " active" : ""; ?>">
                        <div class="collapsible-header">
                            <div class="postAge jtzwp-aqua"><?php echo $postInfo->date->age->days; ?> Days Old</div>
                            <?php echo $postInfo->title; ?>
                        </div>
                        <div class="collapsible-body">
                            <?php $jtzwpHelpers->includeTemplatePart('partials/generic-item-listing',array(
                                'scopedId' => $postInfo->id,
                                'showTitle' => false
                            )); ?>
                        </div>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
        <?php /* END inner widget content */ ?>
        <?php echo $after_widget;

    }

    public function form($instance){
        // Rendering the options form in the admin interface
        
        // Check for values already set by user
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $numberOfPosts = isset($instance['numberOfPosts']) ? abs(intval($instance['numberOfPosts'])) : 5;
        $restrictToBlog = isset($instance['restrictToBlog']) ? (bool) $instance['restrictToBlog'] : false;
        ?>
        <?php /* Ouptut the actual form HTML */ ?>
            <!-- Title -->
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title : '); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <!-- Show just blogs posts vs all posts -->
            <p>
                <input class="checkbox" type="checkbox"<?php checked($restrictToBlog);?> id="<?php echo $this->get_field_id('restrictToBlog'); ?>" name="<?php echo $this->get_field_name('restrictToBlog'); ?>" />
                <label for="<?php echo $this->get_field_id('restrictToBlog'); ?>"><?php _e('Only show recent BLOG posts?'); ?></label>
            </p>
            <!-- Number of posts to show -->
            <p>
                <label for="<?php echo $this->get_field_id('numberOfPosts'); ?>"><?php _e('Number of Posts to Show : '); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('numberOfPosts'); ?>" name="<?php echo $this->get_field_name('numberOfPosts'); ?>" type="number" step="1" min="1" value="<?php echo $numberOfPosts; ?>" />
            </p>
        <?php
    }

    public function update($newInstance,$oldInstance){
        // When widget data updates
        return $newInstance;
    }
}
add_action('widgets_init',function(){register_widget('JTZWP_RecentPosts_Widget');});