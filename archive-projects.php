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

<main id="main" role="main">
    <?php get_sidebar('everypagetop'); ?>
    <div class="projectListing">
        <?php if(have_posts()): ?>
            <h1 class="projectListingTitle mainTitle"><?php echo $projectListingTitle; ?></h1>
            <div id="mainmenu" class="flex row">
                <?php 
                // Loop through matching posts
                while (have_posts()): the_post();
                ?>
                    <?php
                        // per post pre-processing
                        $hasFeaturedImage = has_post_thumbnail();
                        $hasExcerpt = has_excerpt();
                        $projectPermalink = $jtzwpHelpers->getPostPermalink($post->ID);
                        $tags = $jtzwpHelpers->getTagsInfoArrs();
                    ?>
                    <div class="col <?php echo $projectCountOnPage >=5 ? 's12 m6' : 's12 m12'; ?>">
                        <div class="projectItemWrapper">
                            <a href="<?php echo the_permalink(); ?>" target="_self" class="">
                                <div id="<?php echo the_ID(); ?>" class="projectItem full purpleHoverable jtzwpHoverable">
                                    <h2 class="projectItemTitle title jtzwpTransitionColor"><?php echo the_title(); ?></h2>
                                    <!-- Project Link Area -->
                                    <div>
                                        <?php if($hasFeaturedImage): ?>
                                            <?php the_post_thumbnail('medium',array('class'=>'projectFeaturedImage')); ?>
                                        <?php else: ?>
                                            <h3 style="padding:10px;">Click for Project Details!</h3>
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
                            </a>
                            <!-- Project Tag Area -->
                            <?php if($tags->count > 0): ?>
                                <div class="tagsWrapper">
                                <?php foreach ($tags->summaryArr as $tagSummary): ?>
                                    <a href="<?php echo $tagSummary->permalink; ?>" target="_self" class="tagLink purpleHoverable jtzwpHoverable">
                                        <i class="material-icons">bookmark</i>
                                        <div class="tagText"><?php echo $tagSummary->name; ?></div>
                                    </a>
                                <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
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
</main>

<?php get_footer(); ?>
