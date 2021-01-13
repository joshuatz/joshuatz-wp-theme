<?php
/**
 * Header
 */
?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php
        global $themeIncPath;
    ?>
    <?php wp_head(); ?>
    <?php include_once($themeIncPath . '/everypage-execute.php'); ?>
    <style>.hide,.hidden {display:none;}</style>
</head>
<body>
    <?php require_once dirname(__FILE__) . '../partials/nav.php'; ?>
    <?php if ($jtzwpHelpers->getIsUserAdmin()): ?>
        <?php get_template_part('partials/dev-bar'); ?>
    <?php endif; ?>
    <?php get_template_part('partials/preloader'); ?>