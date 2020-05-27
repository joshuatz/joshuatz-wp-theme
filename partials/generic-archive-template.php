<?php
global $jtzwpHelpers;
?>

<div class="archiveContent">
    <?php if(have_posts()): ?>
        <div class="pageHeaderSection">
            <div class="pageTitle"><h1 class="mainTitle"><?php echo isset($pageTitle) ? $pageTitle :  get_the_archive_title(); ?></h1></div>
            <?php if(isset($pageDescription)): ?>
                <div class="pageDescription"><?php echo $pageDescription; ?></div>
            <?php elseif(is_archive() && get_the_archive_description()!==''): ?>
                <div class="pageDescription wp"><?php echo get_the_archive_description(); ?></div>
            <?php endif; ?>
        </div>
        <?php while (have_posts()): the_post(); ?>
            <?php get_template_part('partials/generic-item-listing'); ?>
        <?php endwhile; ?>
        <?php get_template_part('partials/materialize-page-navigation'); ?>
    <?php else: ?>
        <h1 class="mainTitle">No matching posts found :(</h1>
    <?php endif; ?>
</div>