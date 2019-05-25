<?php
/**
 * Template for single page
 * See https://developer.wordpress.org/themes/template-files-section/page-template-files/
 */
?>
<?php get_header(); ?>
<main id="main" role="main">
    <?php get_sidebar('everypagetop'); ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part('content',get_post_format()); ?>
    <?php endwhile; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>