<?php
/**
 * Template for single page - scopable
 */
?>
<?php
    // check for scoped content
    global $jtzwpHelpers;
    $content = isset($scopedContent) ? $scopedContent : '';
?>
<?php get_header(); ?>
<main id="main" role="main">
    <?php get_sidebar('everypagetop'); ?>
    <?php echo $content; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>