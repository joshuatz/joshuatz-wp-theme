<?php
/**
 * Call this file from a non WP php page to load wp stuff
 */
?>
<?php
/**
 * Example - using all of WP stuff (except for footer):
 *      <?php require('../../wp-content/themes/joshuatzwp/inc/wp-loader-for-non-wp.php'); ?>
 *      <!doctype html>
 *          <html>
 *          <head>
 *              <title>My Custom Non WP Page</title>
 *              <?php getWpHeadStuff(); ?>
 *          </head>
 *          <body>
 *              <?php getWpBodyStuff(); ?>
 *              <div id="myCustomPageStuff"></div>
 *          </body>
 *          </html>
 */
?>
<?php
/**
 * Example 2 - just using menu
 *      <?php require('../../wp-content/themes/joshuatzwp/inc/wp-loader-for-non-wp.php'); ?>
 *      <!doctype html>
 *          <html>
 *          <head>
 *              <title>My Custom Non WP Page</title>
 *          </head>
 *          <body>
 *              <?php getWpMenuOnly(); ?>
 *              <div id="myCustomPageStuff"></div>
 *          </body>
 *          </html>
 */
?>
<?php
$pathCurrent = __DIR__;
$pathCurrent = str_replace('\\','/',$pathCurrent);
require($pathCurrent . '/../../../../wp-config.php');
$wp->init();
$wp->parse_request();
$wp->query_posts();
$wp->register_globals();

function getWpHeadStuff(){
    global $pathCurrent, $themeIncPath;
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php include_once($themeIncPath . '/everypage-execute.php'); ?>
    <?php wp_head(); ?>
    <?php
}

function getWpBodyStuff(){
    global $pathCurrent;
    ?>
    <?php include $pathCurrent . '/../nav.php'; ?>
    <?php wp_footer(); ?>
    <?php
}

function getWpMenuOnly($includeJQuery = true){
    global $pathCurrent;
    ?>
    <?php if($includeJQuery): ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
    <?php endif; ?>
    <link href="<?php echo get_stylesheet_uri(); ?>" rel="stylesheet" type="text/css">
    <?php include $pathCurrent . '/../nav.php'; ?>
    <?php wp_footer(); ?>
    <?php
}