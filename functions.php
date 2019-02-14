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
require_once($themeIncPath . '/custom-theme-settings.php');
require_once($themeIncPath . '/custom-sidebars.php');
require_once($themeIncPath . '/helpers.php');
// Widget files
require_once($themeIncPath . '/widgets/widget-recentposts.php');

/**
 * Make sure helpers is loaded globally
 */
global $jtzwpHelpers;
$jtzwpHelpers = (gettype($jtzwpHelpers)==='object' ? $jtzwpHelpers : new JtzwpHelpers());

/**
 * Get cache busting info
 */
$cacheBustStamp = $jtzwpHelpers->getCacheBuster();

/**
 * Special WP flags
 * https://codex.wordpress.org/Option_Reference
 * https://codex.wordpress.org/Theme_Features
 */
// "feature image" support
add_theme_support('post-thumbnails'); 
// Allow excerpts for pages
add_post_type_support('page','excerpt');
// Declare support for title-tags (necessary for Yoast to know it can inject them)
add_theme_support('title-tag');

/**
 * Special WP Cleanup
 */
remove_action( 'wp_head', 'wp_generator' ) ;
remove_action( 'wp_head', 'wlwmanifest_link' ) ;
remove_action( 'wp_head', 'rsd_link' ) ;

/**
 * Reusable loaders
 */

function joshuatzwp_styles() {
    global $themeLibURL, $themeIncPath, $themeIncURL, $themeRootURL, $cacheBustStamp, $jtzwpHelpers;
    // Deque Gutenberg - I'll load this deferred
    wp_dequeue_style('wp-block-library');
    // Load main theme CSS file (style.css)
    wp_enqueue_style('joshuatzwp-style',get_stylesheet_uri(),array(),$cacheBustStamp,'all');
    // Load final <head></head> style
    wp_enqueue_style('style-final-head',$themeRootURL.'/style-final-head.css',array('joshuatzwp-style'),$cacheBustStamp,'all');
}

function joshuatzwp_styles_deferred(){
    global $themeLibURL, $themeIncPath, $themeIncURL, $themeRootURL, $cacheBustStamp, $jtzwpHelpers;
    // Materialize
    if ($jtzwpHelpers->isPageWP()){
        // Materialize CSS
        wp_enqueue_style('materialize-style',$themeLibURL.'/materialize/css/materialize.min.css',array(),false,'all');
        // Materialize Icon Set
        wp_enqueue_style('materialize-icons','https://fonts.googleapis.com/icon?family=Material+Icons',array(),false,'all');
    }
    // Font Awesome - defer OK
    wp_enqueue_style('font-awesome-style','https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css',array(),false,'all');
    // Google Fonts - defer OK
    wp_enqueue_style('google-fonts','https://fonts.googleapis.com/css?family=Lato',array(),false,'all');
    // animate.css - defer OK
    wp_enqueue_style('animate-css','https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css',array(),false,'all');
    // style-deferred.css - defer DESIRED
    wp_enqueue_style('style-deferred',$themeRootURL.'/style-deferred.css',array(),$cacheBustStamp,'all');
    // Fancybox 3 - Defer OK
    // sha256-5yrE3ZX38R20LqA/1Mvh3KHJWG1HJF42qtZlRtGGRgE=
    wp_enqueue_style('fancybox3-style','https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.2/jquery.fancybox.min.css',array(),false,'all');
    // Prism.js syntax highlighter
    // <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/themes/prism.min.css" integrity="sha256-N1K43s+8twRa+tzzoF3V8EgssdDiZ6kd9r8Rfgg8kZU=" crossorigin="anonymous" />
    // <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/themes/prism-okaidia.min.css" integrity="sha256-+8ReLFz1xaTiP3T0xcJVWrHneeFwCnJUJwvcM0L+Ufw=" crossorigin="anonymous" />
    $prismJsCssFilePath = file_exists($jtzwpHelpers->siteRootPath . '/css/prism.css') ? $jtzwpHelpers->siteRootUrl . '/js/prism.js' : 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/themes/prism-okaidia.min.css';
    wp_enqueue_style('prism-js-style',$prismJsCssFilePath,array(),false,'all');
    // Gutenberg block
    wp_enqueue_style('wp-block-library');
}

function joshuatzwp_styles_for_admin(){
    global $themeLibURL, $themeIncPath, $themeIncURL, $themeRootURL, $cacheBustStamp, $jtzwpHelpers;
    wp_enqueue_style('admin-styles', $themeRootURL.'/admin.css',array(),$cacheBustStamp,'all');
}

function joshuatzwp_scripts() {
    global $themeLibURL, $themeIncPath, $themeIncURL, $themeRootURL, $cacheBustStamp, $jtzwpHelpers;
    wp_enqueue_script('jquery-3','https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js',array(),false,false);
    // Helpers
    wp_enqueue_script('helpers-js',$themeIncURL.'/helpers.js',array('jquery-3'),false,false);
}

function joshuatzwp_scripts_deferred(){
    global $themeLibURL, $themeIncPath, $themeIncURL, $themeRootURL, $cacheBustStamp, $jtzwpHelpers;
    // Materialize JS
    wp_enqueue_script('materialize-js',$themeLibURL.'/materialize/js/materialize.min.js',array('jquery-3'),false,true);
    // Main JS
    wp_enqueue_script('main-js',$themeRootURL.'/main.js',array('jquery-3','materialize-js','j-prism-toolbar'),$cacheBustStamp,true);
    // Fancybox 3
    // integrity="sha256-ULR2qlEu6WigJY4xQsDsJeW76e9tEE2EWjnKEQ+0L8Q="
    wp_enqueue_script('fancybox3-js','https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.2/jquery.fancybox.min.js',array('jquery-3'),false,true);
    // ClipboardJS
    wp_enqueue_script('clipboard-js',$themeLibURL . '/clipboardjs/clipboard.min.js',array(),false,true);
    $prismJsFilePath = file_exists($jtzwpHelpers->siteRootPath . '/js/prism.js') ? $jtzwpHelpers->siteRootUrl . '/js/prism.js' : 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/prism.min.js';
    wp_enqueue_script('prism-js',$prismJsFilePath,array(),false,true);
    // Prism.js custom toolbar
    wp_enqueue_script('j-prism-toolbar',$themeLibURL . '/j-prism-toolbar/jPrismToolbar.js',array(),false,true);
    // wow.js
    wp_enqueue_script('wow-js','https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js',array(),false,true);
}

function joshuatzwp_scripts_admin(){
    global $themeLibURL, $themeIncPath, $themeIncURL, $themeRootURL, $cacheBustStamp, $jtzwpHelpers;
    // admin.js
    wp_enqueue_script('admin-script',$themeRootURL.'/admin.js',array('jquery'),$cacheBustStamp,true);
}

function joshuatzwp_enqueue_loader_head() {
    // Load styles
    joshuatzwp_styles();
    // Load scripts
    joshuatzwp_scripts();
}

function joshuatzwp_enqueue_loader_deferred(){
    // Load styles
    joshuatzwp_styles_deferred();
    // Load scripts
    joshuatzwp_scripts_deferred();
}

function joshuatzwp_enqueue_loader_admin(){
    // Load styles
    joshuatzwp_styles_for_admin();
    // Load scripts
    joshuatzwp_scripts_admin();
}

/**
 * Actual loader section
 */
// Load scripts and styles
add_action('wp_enqueue_scripts','joshuatzwp_enqueue_loader_head');
// Load scripts and styles - DEFERRED
add_action('wp_footer','joshuatzwp_enqueue_loader_deferred');
// Load scripts and styles - admin area
add_action('admin_enqueue_scripts','joshuatzwp_enqueue_loader_admin');

// Load custom post types
add_action('init','jtwp_register_all_custom_posttypes');

// Add support for custom post types showing up in queries
add_filter('pre_get_posts','jtzwp_custom_posttypes_archive_support');

// Load custom taxonomies
add_action('init','jtwp_register_all_custom_taxonomies');

// Load / register custom sidebars / widgets
add_action('widgets_init','jtzwp_register_sidebars');

/**
 * Hook into wp_head for anything that needs to run first - useful for global includes
 */
function jtzwp_head_hook(){
    //
}
add_action('wp_head','jtzwp_head_hook');

/**
 * Hook into template_redirect for anything that needs to happen after query, but BEFORE headers are sent - e.g. redirects
 */
function jtwzp_template_redirect_hook(){
    global $jtzwpHelpers,$post;
    $currentUrl = $jtzwpHelpers->getCurrentUrl();
    // Make sure to not cause endless loop - check to make sure page is NOT areadly /under-construction/ before sending user there
    if ($jtzwpHelpers->getIsUnderConstruction()===true && !preg_match('/\/under-construction\//',$currentUrl) && !$jtzwpHelpers->getIsUserAdmin()){
        wp_redirect('/under-construction/',302);
    }
    else {
        if (is_singular()){
            if ($jtzwpHelpers->postOnlyLinksExternally($post)){
                wp_redirect($jtzwpHelpers->getPostPermalink($post));
                exit;
            }
        }
        // If path not found...
        else if (is_404()){
            $jtzwpHelpers->checkForAndHandleCustomRedirect($currentUrl);
        }
    }
}
add_action('template_redirect','jtwzp_template_redirect_hook');

/**
 * Hook into template_include for changing which template file gets used for rendering, or otherwise interrupting the normal WP pattern for including template files
 * REMINDER: Even if locate_template succeeds, and you can return a valid template file, if the URL/slug being requested results in a query that does not map, the headers will have 404, regardless of template load success. Looks like only work around is to manually override the global wp_query object and set a status header of 200
 */
function jtzwp_template_include_hook($template){
    global $jtzwpHelpers,$wp_query;
    $currentUrl = $jtzwpHelpers->getCurrentUrl();
    $currentUrlInfo = $jtzwpHelpers->getUrlInfo($currentUrl);
    // Generated optout page
    $generatedOptOutPath = $jtzwpHelpers->getUsersGlobalOptOutPath();
    // Under construction page
    if (preg_match('/\/under-construction\//',$currentUrl) && $jtzwpHelpers->getIsUnderConstruction()===true){
        $underConstructionTemplate = locate_template(array('page-under-construction.php'));
        if ($underConstructionTemplate!==''){
            // Make sure to modify 404 first
            $wp_query->is_404 = false;
            status_header('200');
            return $underConstructionTemplate;
            exit();
        }
        else {
            return $template;
        }
    }
    // Post-deployment webhook
    else if ($currentUrlInfo['path']==='/deployment-hook/'){
        // Prevent 404
        $wp_query->is_404 = false;
        
        // JSON template
        $postDeployActionsResults = (object) array(
            'success' => false,
            'msg' => ''
        );
        // Check to make sure that key matches
        if ($jtzwpHelpers->getQueryVal('deploymentkey','')===$jtzwpHelpers->getUsersWebhookKey()){
            $postDeployActionsResults->success = true;
            status_header('200');
            // Go ahead and update the cache bust string
            $newCacheBustStamp = $jtzwpHelpers->updateCacheBuster();
            $postDeployActionsResults->msg = 'Success! Updated cache bust to ' . $newCacheBustStamp;
        }
        else {
            // Unauthorized!
            status_header('401');
            $postDeployActionsResults->msg = 'Unauthorized! Please check your special key value!';
        }
        echo json_encode($postDeployActionsResults);
        exit();
    }
    else if ($currentUrlInfo['path']==='/'.$generatedOptOutPath.'/' || $currentUrlInfo['path']==='/'.$generatedOptOutPath){
        // Prevent 404
        $wp_query->is_404 = false;
        status_header('301');
        ?>
            <?php
            $optoutPageHtml = '
            <script>
            helpers.setCookie("jtzwpGlobalOptOut","true",365);
            setTimeout(function(){
                window.location.href = "' . $jtzwpHelpers->siteRootUrl . '";
            },6000);
            </script>
            <div class="card-panel">
                <p>You have been opted out of tracking. Redirecting you back to the homepage in a few seconds...</p>
            </div>';
            $jtzwpHelpers->includeTemplatePart('partials/single-page-scopable',array(
                'scopedContent' => $optoutPageHtml
            ));
            ?>
        <?php
        exit();
    }
    else {
        // Do nothing
        return $template;
    }
}
add_action('template_include','jtzwp_template_include_hook');

/**
 * Check whether or not the stored GAUID string is valid (at least based on pattern)
 */
function jtzwp_validate_gauid_setting(){
    $gauid = get_option('jtzwp_settings')['jtzwp_ga_gauid'];
    if ($gauid && preg_match('/UA-\d{8}-\d{1}/',$gauid)){
        return $gauid;
    }
    else {
        return false;
    }   
}

function jtzwp_get_disclaimer(){
    global $jtzwpHelpers;
    $disclaimer = false;
    $singularName = $jtzwpHelpers->getCustomPostTypeSingularName();
    $yearsOld = $jtzwpHelpers->getDateDiffByUnit($jtzwpHelpers->getPublishedDateDiff(get_post()),'years');
    $yearsOldDisclaimer = 'This ' . $singularName . ' is over a year old (first published about ' . $yearsOld . ' years ago). As such, please keep in mind that some of the information may no longer be accurate, best practice, or a reflection of how I would approach the same thing today.';
    if (get_field('show_disclaimer')===true){
        $customDisclaimer = get_field('custom_disclaimer');
        if (strlen($customDisclaimer)>1){
            $disclaimer = $customDisclaimer;
        }
        else if ($yearsOld > 1){
            $disclaimer = $yearsOldDisclaimer;
        }
    }
    else if ($yearsOld > 2){
        $disclaimer = $yearsOldDisclaimer;
    }
    return $disclaimer;
}

/**
 * Special Yoast SEO plugin settings
 */
function jtzwp_yoast_save_meta_val($postId,$metaKey,$metaVal){
    if (function_exists('wpseo_set_value')){
        add_action('wpseo_saved_postdata',function() use ($metaKey,$metaVal,$postId){
            update_post_meta($postId,$metaKey,$metaVal);
        },11);
    }
}
function jtzwp_yoast_var_replacement__jtzwp_description($varName){
    global $jtzwpHelpers;
    // Lower
    $metaDescription = '';
    if (is_single() && get_field('custom_seo_meta_description') && get_field('custom_seo_meta_description')!==''){
        $metaDescription = get_field('custom_seo_meta_description');
    }
    else if (!is_single() && term_description() && term_description()!==''){
        $metaDescription = strip_tags(term_description());
    }
    else if (!is_single() && get_post_type()===$jtzwpHelpers::PROJECTS_POST_TYPE){
        $customName = $jtzwpHelpers->getThemeUserSetting('jtzwp_about_me_displayed_name');
        $name = $customName->isValid===true ? $customName->val : "this site's creator";
        $metaDescription = 'Projects using the ' . strtolower(single_cat_title('',false)) . ' skills of ' . $name;
    }
    else {
        $metaDescription = get_the_excerpt();
    }
    return $metaDescription;
}
function jtzwp_yoast_var_replacement__jtzwp_keywords($varName){
    global $jtzwpHelpers,$post;
    $keywordsCommaSep = '';
    if (get_field('custom_seo_keywords') && get_field('custom_seo_keywords')!==''){
        $keywordsCommaSep = get_field('custom_seo_keywords');
    }
    else if ($jtzwpHelpers->getTagsInfoArrs()->count > 0) {
        $keywordsCommaSep = $jtzwpHelpers->getTagsInfoArrs()->commaSep;
    }
    else if (strlen(WPSEO_Meta::get_value('focuskw',$post->ID)>0)){
        $keywordsCommaSep = WPSEO_Meta::get_value('focuskw',$post->ID);
    }
    return $keywordsCommaSep;
}
function jtzwp_register_yoast_extra_vars(){
    wpseo_register_var_replacement('%%jtzwp_description%%','jtzwp_yoast_var_replacement__jtzwp_description','advanced','Generated description based on ACF');
    wpseo_register_var_replacement('%%jtzwp_keywords%%','jtzwp_yoast_var_replacement__jtzwp_keywords','advanced','Generated keywords based on ACF and post');
}
add_action('wpseo_register_extra_replacements','jtzwp_register_yoast_extra_vars');

/**
 * Hooks on saving a post
 */
function jtzwp_after_post_edit($postId){
    global $jtzwpHelpers;
    // Immediately unhook this function to avoid infinite loops
    remove_action('save_post','jtzwp_after_post_edit');

    // Make sure ID is of real post and not revision
    $postId = (!wp_is_post_revision($postId)) ? $postId : $postId->post_parent;

    // Check to see if "NoIndex" flag should be applied since post is "thin content"
    /**
     * !!!-NOTE-!!! - Yoast no longer uses binary setting with _yoast_wpseo_meta-robots-noindex
     *       - If you want to turn off indexing (noindex) - the value should be '1'
     *       - When you turn indexing back ON (default setting) there are a few ways to do this
     *           - You can set the value to '2' - which equates to 'yes'
     *              OR - and this is what Yoast does if you change the setting yourself in the GUI back to default -
     *           - You can DELETE the meta value for the post, which tells Yoast that the post INHERITS the noindex setting from the post-type group. For example, if you delete the meta value for a custom post type, that post will inherit the indexing setting applied for that specific custom post type group.
     *              - Deleting the meta key seems the safest route, so that way you can easily toggle the default setting and still affect all the posts you want to.
     */

    // You need to wrap any code that touches the Yoast meta key value pairs in add_action() callback for 'wpseo_saved_postdata' - since that fires after Yoast updates the meta values, and if you touch the values BEFORE it fires, Yoast will simply overwrite what you changed!
    add_action('wpseo_saved_postdata',function() use ($metaKey,$metaVal,$postId,$jtzwpHelpers){
        update_post_meta($postId,$metaKey,$metaVal);
        if ($jtzwpHelpers->shouldPostBeIndexed($postId) === false){
            // Note, this also removes the post from the XML sitemap generated by Yoast
            update_post_meta($postId,'_yoast_wpseo_meta-robots-noindex','1');
        }
        else {
            // See note above about special Yoast noindex meta values
            //update_post_meta($postId,'_yoast_wpseo_meta-robots-noindex','2');
            delete_post_meta($postId,'_yoast_wpseo_meta-robots-noindex');
        }
    },11);
    $jtzwpHelpers->log('gettype($postId) = ' . gettype($postId));

    add_action('save_post','jtzwp_after_post_edit');

}
add_action('save_post','jtzwp_after_post_edit');

/**
 * 
 */