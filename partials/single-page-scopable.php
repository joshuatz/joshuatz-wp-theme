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
<div id="main">
    <?php echo $content; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>