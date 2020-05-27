<?php
/**
 * Template Name: Everything Archive (Displays Everything)
 * Template Post Type: page
 */

global $jtzwpHelpers;

// Get info about page itself
$pageInfo = $jtzwpHelpers->getBasicPostInfo(null);

// Get ALL posts (blog posts, projects, anything else)
$queryOptions = array(
    'posts_per_page' => 10,
    'post_status' => 'publish',
    'order' => 'DESC',
    'orderby' => 'publish_date',
    'post_type' => array('any'),
    'suppress_filters' => true
);
// Set global query variable
query_posts($queryOptions);

get_header();
?>

<main id="main" role="main">
    <?php get_sidebar('everypagetop'); ?>
    <?php $jtzwpHelpers->includeTemplatePart('partials/generic-archive-template',array(
        'pageDescription' => $pageInfo->excerpt,
        'pageTitle' => $pageTitle->title
    ));?>
</main>

<?php get_footer(); ?>