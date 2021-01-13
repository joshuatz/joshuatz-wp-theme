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
            <div class="flex row textCenter">
                <?php 
                // Loop through matching posts
                while (have_posts()): the_post();
                ?>
                    <div class="col <?php echo $projectCountOnPage >=5 ? 's12 m6' : 's12 m12'; ?>">
                        <?php $jtzwpHelpers->includeTemplatePart('partials/generic-item-card',array(
                            'scopedId' => $post->ID
                        )); ?>
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
