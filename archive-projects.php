<?php
/**
 * The template for displaying projects archive - basically the index of projects
 *
 */

get_header(); ?>

<?php
    global $jtzwpHelpers;
    $projectListingTitle = 'Here are some projects where I have used my ' . strtolower(single_cat_title('',false)) . ' skills';
    if (term_description()!==''){
        // Note: strip_tags necessary because term_description returns <p></p> wrapped text
        $projectListingTitle = strip_tags(term_description());
    }
    $projectCountOnPage = $wp_query->post_count;
    $totalNumPages = $wp_query->max_num_pages;
    $currentPageNum = isset($paged) ? $paged : 1;
?>

<div id="main">
    <div class="projectListing">
        <?php if(have_posts()): ?>
            <h1 class="projectListingTitle mainTitle"><?php echo $projectListingTitle; ?></h1>
            <div id="mainmenu" class="flex">
                <?php 
                // Loop through matching posts
                while (have_posts()): the_post();
                ?>
                    <?php
                        // per post pre-processing
                        $hasFeaturedImage = has_post_thumbnail();
                        $hasExcerpt = has_excerpt();
                        $projectOnlyLinksExternally = $jtzwpHelpers->postOnlyLinksExternally($post->ID);
                        $projectPermalink = ($projectOnlyLinksExternally===false) ? get_the_permalink() : $projectOnlyLinksExternally;
                    ?>
                    <div id="<?php echo the_ID(); ?>" class="projectItem <?php echo $projectCountOnPage >=5 ? 'half' : 'full'; ?>">
                        <h2 class="projectItemTitle title"><a href="<?php echo the_permalink(); ?>" target="_self" class="hoverLinkOutlineThin"><?php echo the_title(); ?></a></h2>
                        <!-- Project Link Area -->
                        <div>
                            <?php if($hasFeaturedImage): ?>
                                <a href="<?php echo $projectPermalink; ?>" target="_self" class="projectLinkWrapper">
                                    <div class="projectLinkClickPrefix">Click here or the image below for the full project page!</div>
                                </a>
                                <a href="<?php echo $projectPermalink; ?>" target="_self" class="projectLinkWrapper">
                                    <?php the_post_thumbnail('medium',array('class'=>'projectLinkClickArea')); ?>
                                </a>
                            <?php else: ?>
                                <div class="projectLinkClickArea">
                                    <a href="<?php echo $projectPermalink; ?>" target="_self" class="projectLinkWrapper">
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
                        <!-- Project Custom Content For Listing -->
                        <?php if(get_field('custom_content_for_listing') && get_field('custom_content_for_listing')!==''): ?>
                            <div class="projectCustomContentForListingWrapper">
                                <?php echo get_field('custom_content_for_listing'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php
                // End loop
                endwhile;
                ?>
            </div>
            <?php get_template_part('partials/materialize-page-navigation'); ?>
        <?php else: ?>
            <h1 class="mainTitle">No matching projects found :(</h1>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
