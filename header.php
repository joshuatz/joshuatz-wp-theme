<?php
/**
 * Header
 */
?>
<!DOCTYPE html>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        global $themeIncPath;
    ?>
    <?php include_once($themeIncPath . '/everypage-execute.php'); ?>
    <?php wp_head(); ?>
</head>
<body>
    <?php include 'nav.php'; ?>