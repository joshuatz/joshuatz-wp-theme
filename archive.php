<?php
/**
 * Generic Archive file - this should get pulled into use for anything that does not have a specific archive template file built - for example: tags, authors, and dates
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