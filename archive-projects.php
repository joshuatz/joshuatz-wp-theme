<?php
/**
 * The template for displaying projects archive - basically the index of projects
 *
 */

get_header(); ?>

<?php
    $projectListingTitle = 'Here are some projects where I have used my ' . strtolower(single_cat_title('',false)) . ' skills';
    if (term_description()!==''){
        // Note: strip_tags necessary because term_description returns <p></p> wrapped text
        $projectListingTitle = strip_tags(term_description());
    }
?>

<div id="main">
    <div class="projectListing">
        <?php if(have_posts()): ?>
            <h2 class="projectListingTitle"><?php echo $projectListingTitle; ?></h2>
            <div id="mainmenu">
                <?php 
                // Loop through matching posts
                while (have_posts()): the_post();
                ?>
                    <?php
                        // per post pre-processing
                        $hasFeaturedImage = has_post_thumbnail();
                        $hasExcerpt = has_excerpt();
                    ?>
                    <div id="<?php echo the_ID(); ?>" class="projectItem">
                        <h2><?php echo the_title(); ?></h2>
                        <!-- Project Link Area -->
                        <div>
                            <?php if($hasFeaturedImage): ?>
                                <a href="<?php echo the_permalink(); ?>" target="_self" class="projectLinkWrapper">
                                    <div class="projectLinkClickPrefix">Click here or the image below for the full project page!</div>
                                </a>
                                <a href="<?php echo the_permalink(); ?>" target="_self" class="projectLinkWrapper">
                                    <img class="projectLinkClickArea" src="<?php echo the_post_thumbnail_url('medium'); ?>" >
                                </a>
                            <?php else: ?>
                                <div class="projectLinkClickArea">
                                    <a href="<?php echo the_permalink(); ?>" target="_self" class="projectLinkWrapper">
                                        <h3 style="padding:10px;">Click for Project Details!</h3>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- Project Excerpt Area -->
                        <?php if($hasExcerpt): ?>
                            <div class="projectExcerptWrapper">
                                <p><?php echo get_the_excerpt(); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php
                // End loop
                endwhile;

                // Previous/next page navigation.
                the_posts_pagination(array(
                    'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
                    'next_text'          => __( 'Next page', 'twentyfifteen' ),
                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
                ));
                ?>
            </div>
        <?php else: ?>
            <h1>No matching projects found :(</h1>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
