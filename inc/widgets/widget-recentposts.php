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
            // return immediately
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
            <ul class="collapsible postsDrawer">
            <?php $counter = 0; ?>
            <?php foreach($postsQuery->posts as $recentPost): ?>
                <?php
                    $counter++;
                    $postInfo = $jtzwpHelpers->getBasicPostInfo($recentPost);
                    xdebug_break();
                ?>
                <li class="<?php echo $counter===1 ? " active" : ""; ?>">
                    <div class="collapsible-header">
                        <div class="postAge"><?php echo $postInfo->date->age->days; ?> Days Old</div>
                        <?php echo $postInfo->title; ?>
                    </div>
                    <div class="collapsible-body">
                        <div class="row">
                            <?php if($postInfo->featuredImage->hasFeaturedImage): ?>
                                <div class="col s6">
                                    <a class="featuedImageWrapperLink">
                                        <img class="featuredImage" src="<?php echo $postInfo->featuredImage->getThumbnailSrc(); ?>" />
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="col s<?php echo $postInfo->featuredImage->hasFeaturedImage ? 's6' : 's12'; ?> postExcerptWrapper">
                                <p><?php echo $postInfo->excerpt; ?></p>
                            </div>
                            <div class="col s2 offset-s2">
                                <a class="btn waves-effect readMore jtzwp-dark" href="<?php echo $postInfo->permalink; ?>">
                                    Read More <i class="material-icons right">more_horiz</i>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
            </ul>
        <?php /* END inner widget content */ ?>
        <?php echo $after_widget;

    }

    public function form($instance){
        // Rendering the options form in the admin interface
        
        // Check for values that already set by user
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