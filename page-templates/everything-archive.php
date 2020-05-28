<?php
/**
 * Template Name: Everything Archive (Displays Everything)
 * Template Post Type: page
 */

global $jtzwpHelpers;

// Get info about page itself
$pageInfo = $jtzwpHelpers->getBasicPostInfo(null);

$pageNum = get_query_var('paged') ? get_query_var('paged') : 1;

// Get ALL posts (blog posts, projects, anything else)
$queryOptions = array(
    'posts_per_page' => 10,
    'post_status' => 'publish',
    'order' => 'DESC',
    'orderby' => 'publish_date',
    'post_type' => array('any'),
    'meta_query' => array(
        'relation' => 'OR',
        array(
            'key' => 'suppress_from_results',
            'value' => '',
            'compare' => 'NOT EXISTS'
        ),
        array(
            'key' => 'suppress_from_results',
            'value' => true,
            'compare' => '!='
        ),
    ),
    'suppress_filters' => true,
    'paged' => $pageNum
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