<?php
/**
 * same purpose as home.php - show list of regular old plain posts (e.g. blog)
 */
?>
<?php get_header(); ?>

<div id="main">
    <div class="pageHeaderSection">
        <div class="pageTitle">Blog / Misc.</div>
        <div class="pageDescription">This section of the site is for "blog" type posts, short asides, and other miscellaneous bits of content that do not qualify as a project or tool.</div>
    </div>
    <div class="jtzwp-seethrough">
        <div class="row">
            <h2>Blog</h2>
        </div>

        <?php if(have_posts()): ?>
            <?php while (have_posts()): the_post(); ?>
                <?php get_template_part('partials/generic-item-listing'); ?>
            <?php endwhile; ?>
        <?php else: ?>
            <h3>Sorry, nothing here yet :(</h3>
        <?php endif; ?>
    </div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>