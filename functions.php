<?php
/*
* Reminders:
* wp_enqueue_script($handle, $srcString, $depArray, $version, $inFooter);
* wp_enqueue_style($handle, $srcString, $depArray, $version, $media)
*/

$themeIncPath = (get_template_directory() . '/inc');

/**
 * Load required files
 */
require_once($themeIncPath . '/taxonomies.php');
require_once($themeIncPath . '/custom-post-types.php');
require_once($themeIncPath . '/custom-theme-settings.php');
require_once($themeIncPath . '/custom-sidebars.php');
require_once($themeIncPath . '/helpers.php');
require_once($themeIncPath . '/special-loader.php');
// Widget files
require_once($themeIncPath . '/widgets/widget-recentposts.php');
require_once($themeIncPath . '/widgets/widget-sharebuttons.php');
require_once($themeIncPath . '/widgets/widget-geo-locked-content.php');

/**
 * Make sure helpers is loaded globally
 */
/** @var JtzwpHelpers $jtzwpHelpers */
global $jtzwpHelpers;
$jtzwpHelpers = (gettype($jtzwpHelpers)==='object' ? $jtzwpHelpers : new JtzwpHelpers());
$fullUrl = $jtzwpHelpers->getCurrentUrl();

/**
 * Setup resources
 */
$themeRootURL = wp_make_link_relative(get_template_directory_uri());
$themeLibURL = $themeRootURL . '/lib';
$themeIncURL = $themeRootURL . '/inc';

/**
 * Get cache busting info
 */
$cacheBustStamp = $jtzwpHelpers->getCacheBuster();
if ($jtzwpHelpers->isDebug && preg_match('/\?cb=true/', $fullUrl)) {
    $cacheBustStamp = microtime(true);
}

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
// Remove Emoji stuff
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
// Disabling emojis for right now, since it was breaking Emoji use in code snippets
// Could go back to allowing wp-emojis script, if start using `.wp-exclude-emoji` exclusion class
// @see wp-exclude-emoji
add_action( 'init', 'disable_emojis' );


function joshuatzwp_styles() {
    global $themeLibURL, $themeIncPath, $themeIncURL, $themeRootURL, $cacheBustStamp, $jtzwpHelpers;
    // Deque Gutenberg - I'll load this deferred
    wp_dequeue_style('wp-block-library');
    // Load main theme CSS file (style.css)
    wp_enqueue_style('joshuatzwp-style',wp_make_link_relative(get_stylesheet_uri()),array(),$cacheBustStamp,'all');
    // Google Fonts - body font
    wp_enqueue_style_special('google-fonts','https://fonts.googleapis.com/css2?family=Inter&display=swap',array(),false,'all', 'async');
    ?>
    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <?php
    // Material Icon Set
    wp_enqueue_style('materialize-icons','https://fonts.googleapis.com/icon?family=Material+Icons',array(),false,'all');

}

function joshuatzwp_styles_footer(){
    global $themeLibURL, $themeIncPath, $themeIncURL, $themeRootURL, $cacheBustStamp, $jtzwpHelpers;
    // Materialize
    if ($jtzwpHelpers->isPageWP()){
        // Materialize CSS
        wp_enqueue_style_deferred('materialize-style',$themeLibURL.'/materialize/css/materialize.min.css',array(),false,'all');
    }
    // Vendored css - defer OK
    wp_enqueue_style_deferred('vendor-css',$themeLibURL.'/vendor.min.css',array(),$cacheBustStamp,'all');
    // Font Awesome - defer OK
    wp_enqueue_style_deferred('font-awesome-style','https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css',array(),false,'all');
    // style-deferred.css - defer DESIRED
    wp_enqueue_style_deferred('style-deferred',$themeRootURL.'/style-deferred.css',array(),$cacheBustStamp,'all');
    // Prism.js syntax highlighter
    $prismJsCssFilePath = file_exists($jtzwpHelpers->siteRootPath . '/css/prism.css') ? $jtzwpHelpers->siteRootUrl . '/css/prism.css' : ($themeLibURL . '/prism/prism.css');
    wp_enqueue_style_deferred('prism-js-style',$prismJsCssFilePath,array(),false,'all');
    // Gutenberg block
    //wp_enqueue_style('wp-block-library');
}

function joshuatzwp_styles_for_admin(){
    global $themeLibURL, $themeIncPath, $themeIncURL, $themeRootURL, $cacheBustStamp, $jtzwpHelpers;
    wp_enqueue_style('admin-styles', $themeRootURL.'/admin.css',array(),$cacheBustStamp,'all');
}

function joshuatzwp_scripts() {
    global $themeLibURL, $themeIncPath, $themeIncURL, $themeRootURL, $cacheBustStamp, $jtzwpHelpers;
}

function joshuatzwp_scripts_footer(){
    global $themeLibURL, $themeRootURL, $cacheBustStamp, $jtzwpHelpers;
    // Vendored JS (materializeCSS, prismToolbar)
    wp_enqueue_script('vendor-js',$themeLibURL.'/vendor.min.js',array(),$cacheBustStamp,true);
    // Main JS
    wp_enqueue_script('main-js',$themeRootURL.'/inc/main.js',array('vendor-js'),$cacheBustStamp,true);
    // Geo JS - defer def OK
    wp_enqueue_script('geo-js', $themeRootURL.'/inc/geo.js', array(), $cacheBustStamp, true);
    add_attribute('geo-js', 'defer', 'true', true);
    // Prism JS
    $prismJsFilePath = file_exists($jtzwpHelpers->siteRootPath . '/js/prism.js') ? $jtzwpHelpers->siteRootUrl . '/js/prism.js' : ($themeLibURL . '/prism/prism.js');
    wp_enqueue_script_special('prism-js',$prismJsFilePath,array(),false,false,'async');
}

function joshuatzwp_scripts_admin(){
    global $themeLibURL, $themeIncPath, $themeIncURL, $themeRootURL, $cacheBustStamp, $jtzwpHelpers;
    // admin.js
    wp_enqueue_script('admin-script',$themeRootURL.'/admin.js',array(),$cacheBustStamp,true);
}

function joshuatzwp_enqueue_loader_head() {
    // Load styles
    joshuatzwp_styles();
    // Load scripts
    joshuatzwp_scripts();
}

function joshuatzwp_enqueue_loader_footer(){
    // Load styles
    joshuatzwp_styles_footer();
    // Load scripts
    joshuatzwp_scripts_footer();
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
add_action('wp_footer','joshuatzwp_enqueue_loader_footer');
// Load scripts and styles - admin area
add_action('admin_enqueue_scripts','joshuatzwp_enqueue_loader_admin');

// Add support for custom post types showing up in queries
add_filter('pre_get_posts','jtzwp_custom_posttypes_archive_support');

// Load custom post types and taxonomies
// Order matters!
add_action('init', function() {
    jtwp_register_all_custom_posttypes();
    jtwp_register_all_custom_taxonomies();
}, 10);

add_filter('request', function($arg) {
    $request = $arg;
    // This is really strange edge-case with CPT + taxonomy archives
    // Triggers on CPT archive pagination URLs that also use nested taxonomy slugs, like /projects/web-stuff/page/2/
    // ^ /{CPT}/{TAXONOMY}/page/2
    // The query it is creating results in a 404, if not modified as I am below
    if (isset($request['projects']) && $request['projects'] === 'page' && isset($request['post_type']) && $request['post_type'] === 'projects' && isset($request['page'])) {
        // Remap `page` to `paged`, and remove all other params that will cause 404-inducing `AND (wp_posts.ID = '0')` to be emitted in SQL
        $request['paged'] = $request['page'];
        unset($request['name']);
        unset($request['projects']);
        unset($request['page']);
    }
    return $request;
}, 10);

// Load / register custom sidebars / widgets
add_action('widgets_init','jtzwp_register_sidebars');

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
    /** @var JtzwpHelpers $jtzwpHelpers */
    global $jtzwpHelpers,$wp_query;
    $currentUrl = $jtzwpHelpers->getCurrentUrl();
    $currentUrlInfo = $jtzwpHelpers->getUrlInfo($currentUrl);
    // Store selected template as global so other functions can use it
    $GLOBALS['jtzwp_wp_selected_template'] = basename($template);
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
    // Opt out URL
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
 * Check whether or not the stored GAUID string confirms to a known GA ID pattern,
 * and if so, which type.
 *
 * Examples:
 *  - `UA-12345678-9`: Universal Analytics
 *  - `G-A1B2C34567`: GA4 or generic gtag (gtag.js)
 */
function jtzwp_get_gauid_setting(){
    $gauid = get_option('jtzwp_settings')['jtzwp_ga_gauid'];
    $gauidInfo = array('valid' => false, 'analyticsVersion' => 'unknown', 'gauid' => $gauid);
    if (!$gauid) {
        return $gauidInfo;
    }
    if (preg_match('/UA-\d{8}-\d{1}/', $gauid)) {
        $gauidInfo['valid'] = true;
        $gauidInfo['analyticsVersion'] = 'analytics.js';
    } else if (preg_match('/G-[A-Z0-9]{10}/', $gauid)) {
        $gauidInfo['valid'] = true;
        $gauidInfo['analyticsVersion'] = 'gtag.js';
    }
    return $gauidInfo;
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
function jtzwp_yoast_var_replacement__jtzwp_description($varName){
    /** @var JtzwpHelpers $jtzwpHelpers */
    global $jtzwpHelpers;
    $item = $jtzwpHelpers->getPostByMixed();
    // Lower
    $metaDescription = '';
    if (!empty($item) && !empty($item->ID) && get_field('custom_seo_meta_description', $item->ID)){
        $metaDescription = get_field('custom_seo_meta_description', $item->ID);
    }
    else if (!is_single() && term_description()){
        $metaDescription = strip_tags(term_description());
    }
    else if (!is_single() && get_post_type()===$jtzwpHelpers::PROJECTS_POST_TYPE){
        $customName = $jtzwpHelpers->getThemeUserSetting('jtzwp_about_me_displayed_name');
        $name = $customName->isValid===true ? $customName->val : "this site's creator";
        $metaDescription = 'Projects using the ' . strtolower(single_cat_title('',false)) . ' skills of ' . $name;
    }
    else {
        $metaDescription = $jtzwpHelpers->getPostExcerpt($item);
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
/**
 * To have the functions kick in, make sure you go to the Yoast settings page, and use the variables by pasting / typing in the macro - e.g. `%%jtzwp_description%%` - into the box where you want to use it
 */
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
    add_action('wpseo_saved_postdata',function() use ($postId, $jtzwpHelpers){
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

    add_action('save_post','jtzwp_after_post_edit');

}
add_action('save_post','jtzwp_after_post_edit');

/**
 * Hooks on BEFORE saving a post - this is called before post is inserted into DB
 *  - Issue: both $data and $postArr appear to always be slash escaped, despite misleading docs.
 *      - Workaround: wp_unslash the incoming data before checking if it matches the previous post revision
 * @param {array} $data - this will be the post data, slashed (escaped), and as an associative arr.
 * @param {array} $postArr - similar to $data, an associate array of props, but only sanitzed, not fully slashed / escaped.
 * @returns {array} $finalPostData - Make sure to return this, as whatever you return will be used to insert into DB / save post
 */
function jtzwp_before_post_save($data,$postArr){
    global $jtzwpHelpers;
    $FILTER_FORMAT = 'db';
    $finalPostData = $data;
    $hasPostContentBeenChanged = true;
    $isRevision = false;
    $postId = $postArr['ID'];
    // $postArr['ID'] will be un-set if this is a new post being saved, as it won't have an ID until it is actually saved to DB
    if (isset($postId)){
        $oldPost = get_post($postId, 'OBJECT', $FILTER_FORMAT);
        if (!empty($oldPost)){
            $isRevision = true;
            if (($oldPost->post_content === $finalPostData['post_content']) || ($oldPost->post_content === wp_unslash($finalPostData['post_content'])) || ($oldPost->post_content === $postArr['post_content'])){
                $hasPostContentBeenChanged = false;
            }
            // If post_content (this is the actual content of the post, not meta stuff like tags, categories, etc.) has NOT been modified, keep last modified stamps the same
            if ($hasPostContentBeenChanged===false){
                $finalPostData['post_modified'] = $oldPost->post_modified;
                $finalPostData['post_modified_gmt'] = $oldPost->post_modified_gmt;
                // $jtzwpHelpers->log('Post modified date suppressed!');
            }
            else {
                // $jtzwpHelpers->log('post has changed');
            }
        }
    }
    return $finalPostData;
}
add_filter('wp_insert_post_data','jtzwp_before_post_save',10,2);

function jtzwp_comment_filtering($commentData) {
    global $jtzwpHelpers;

    // Check for missing required fields / easy spam trap
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'comment_nonce')) {
        // Nice try
        wp_redirect($jtzwpHelpers->getUrlInfo(get_permalink($commentData['comment_post_ID']))['withoutQueryString'] . '?unapproved=999&moderation-hash=haha#comment-999');
        exit;
    }

    return $commentData;
}
add_filter('preprocess_comment', 'jtzwp_comment_filtering');