<?php
/**
 * Tag Archives - this will trigger across all posts types as the generic tag archive template file
 */
get_header(); ?>

<?php
    global $jtzwpHelpers;
?>
<div id="main">
    <?php get_template_part('generic-archive-template'); ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>