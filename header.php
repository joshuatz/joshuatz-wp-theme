<?php
/**
 * Header
 */
?>
<!DOCTYPE html>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php
        global $themeIncPath;
    ?>
    <?php wp_head(); ?>
    <?php include_once($themeIncPath . '/everypage-execute.php'); ?>
</head>
<body>
    <?php include 'nav.php'; ?>
    <?php if ($jtzwpHelpers->getIsUserAdmin()): ?>
        <?php get_template_part('partials/dev-bar'); ?>
    <?php endif; ?>
    <?php get_template_part('partials/preloader'); ?>