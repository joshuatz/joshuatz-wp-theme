<?php
/**
 * same purpose as home.php - show list of regular old plain posts (e.g. blog)
 */
global $jtzwpHelpers;
$pageDescription = 'This section of the site is for "blog" type posts, short asides, and other miscellaneous bits of content that do not qualify as a project or tool.';
$pageTitle = 'Blog / Misc.';
?>
<?php get_header(); ?>

<main id="main" role="main">
    <?php get_sidebar('everypagetop'); ?>
    <?php $jtzwpHelpers->includeTemplatePart('generic-archive-template',array(
        'pageDescription' => $pageDescription,
        'pageTitle' => $pageTitle
    ));?>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>