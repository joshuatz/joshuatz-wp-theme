<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>
<main id="main" role="main">
    <?php get_sidebar('everypagetop'); ?>
    <?php
    // Start the loop.
    while ( have_posts() ) : the_post();

        /*
        * Include the post format-specific template for the content. If you want to
        * use this in a child theme, then include a file called content-___.php
        * (where ___ is the post format) and that will be used instead.
        */
        get_template_part( 'content', get_post_format() );
        
        // under post widget area
        get_sidebar('underpost');

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

        // Previous/next post navigation.
        get_template_part('partials/materialize-post-navigation');

    // End the loop.
    endwhile;
    ?>
</main>
<?php get_footer(); ?>
