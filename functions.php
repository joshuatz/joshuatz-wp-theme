<?php
/**
 * Setup resources
 */
$debug = true;
$themeRootURL = get_template_directory_uri();
$themeLibURL = (get_template_directory_uri().'/lib');
$themeIncURL = (get_template_directory_uri().'/inc');
$themeIncPath = (get_template_directory() . '/inc');

/**
 * Load required files
 */
require_once($themeIncPath . '/taxonomies.php');
require_once($themeIncPath . '/custom-post-types.php');
require_once($themeIncPath . '/helpers.php');

/**
 * Make sure helpers is loaded globally
 */
global $jtzwpHelpers;
$jtzwpHelpers = (gettype($jtzwpHelpers)==='object' ? $jtzwpHelpers : new JtzwpHelpers());

/**
 * Special WP flags
 */
// "feature image" support
add_theme_support( 'post-thumbnails' ); 

/**
 * Reusable loaders
 */

function joshuatzwp_styles() {
    global $themeLibURL;
    // Materialize CSS
    wp_enqueue_style('materialize-style',$themeLibURL.'/materialize/css/materialize.min.css',array(),false,'all');
    // Materialize Icon Set
    wp_enqueue_style('materialize-icons','https://fonts.googleapis.com/icon?family=Material+Icons',array(),false,'all');
    // Load main theme CSS file (style.css)
    wp_enqueue_style('joshuatzwp-style',get_stylesheet_uri(),array('materialize-style'),false,'all');
}

function joshuatzwp_scripts() {
    global $themeLibURL;
    global $themeIncPath;
    global $themeRootURL;
    wp_enqueue_script('jquery-3','https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js',array(),false,false);
    // Materialize JS
    wp_enqueue_script('materialize-js',$themeLibURL.'/materialize/js/materialize.min.js',array('jquery-3'),false,false);
    // Main JS
    wp_enqueue_script('main-js',$themeRootURL.'/main.js',array('jquery-3','materialize-js'),false,true);
}

function joshuatzwp_enqueue_loader() {
    // Load styles
    joshuatzwp_styles();
    // Load scripts
    joshuatzwp_scripts();
}

/**
 * Actual loader section
 */
// Load scripts and styles
add_action('wp_enqueue_scripts','joshuatzwp_enqueue_loader');

// Load custom post types
add_action('init','jtzwp_register_projects_posttype');

// Load custom taxonomies
add_action('init','jtwp_register_all_custom_taxonomies');
if ($debug){
    // REMOVE ME
    flush_rewrite_rules(false);
}

/**
 * Hook into wp_head for anything that needs to run first - useful for global includes
 */
function jtzwp_head_hook(){
    //
}
add_action('wp_head','jtzwp_head_hook');