<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<?php
/**
 * Disable auto <p></p> wrapping
 */
remove_filter('the_content','wpautop');
?>
<?php
/**
 * Pre-processing - Determine layout based on sidebar usage
 */
$articleCssClass = '';
$sidebarCssClass = '';
if (is_active_sidebar('innercontentmain')){
    $articleCssClass = 'col s12 xl8 ';
    $sidebarCssClass = 'col s12 xl4';
}
else {
    $articleCssClass = 'col s12 xl10 offset-xl1';
    $sidebarCssClass = 'hide';
}
?>
<div class="row">
    <div class="articleWrapper <?php echo $articleCssClass; ?>">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header class="entry-header">
                <?php
                    the_title( '<h1 class="entry-title mainTitle">', '</h1>' );
                ?>
            </header><!-- .entry-header -->

            <!-- partials/post-metainfo-box -->
            <?php get_template_part('partials/post-metainfo-box'); ?>

            <div class="entry-content">
                <?php
                    /* translators: %s: Name of current post */
                    the_content( sprintf(
                        __( 'Continue reading %s', 'twentyfifteen' ),
                        the_title( '<span class="screen-reader-text">', '</span>', false )
                    ) );
                    ?>

                    <?php get_template_part('partials/post-customhtml-echo'); ?>

                    <?php
                    wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'joshuatzwp' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                        'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'joshuatzwp' ) . ' </span>%',
                        'separator'   => '<span class="screen-reader-text">, </span>',
                    ) );
                ?>
            </div><!-- .entry-content -->

            <?php
                // Author bio.
                if ( is_single() && get_the_author_meta( 'description' ) ) :
                    get_template_part( 'author-bio' );
                endif;
            ?>

            <footer class="entry-footer">
                <?php edit_post_link( __( 'Edit', 'joshuatzwp' ), '<span class="edit-link">', '</span>' ); ?>
            </footer>

        </article><!-- #post-## -->
    </div>
    <div class="stickySidebarWrapper <?php echo $sidebarCssClass; ?>">
        <div class="pushpinSticky" data-extratopoffset="20" data-extrabottomoffset="20" style="bottom:inherit;" data-target=".stickySidebarWrapper">
            <?php get_sidebar('innercontentmain'); ?>
        </div>
    </div>
</div>