<?php
/**
 * Reusable loaders
 */
$specialLoadHnds = (object) array(
    'scripts' => (object) array(
        'async' => array(),
        'defer' => array()
    ),
    'styles' => (object) array(
        'async' => array(),
        'asyncPreload' => array()
    )
);
// Same signature as wp_enqueue_style, + $loadMethod as last arg
function wp_enqueue_style_special($handle, $srcString, $depArray, $version, $media, $loadMethod){
    global $specialLoadHnds;
    array_push($specialLoadHnds->styles->{$loadMethod},$handle);
    wp_enqueue_style($handle, $srcString, $depArray, $version, $media);
}
// Same signature as wp_enqueue_script, + $loadMethod as last arg
// Reminder - $inFooter should probably be false for both async and defer
function wp_enqueue_script_special($handle, $srcString, $depArray, $version, $inFooter, $loadMethod){
    global $specialLoadHnds;
    array_push($specialLoadHnds->scripts->{$loadMethod},$handle);
    wp_enqueue_script($handle, $srcString, $depArray, $version, $inFooter);
}
// Identical signature to wp_enqueue_style
function wp_enqueue_style_deferred($handle, $srcString, $depArray, $version, $media){
    wp_enqueue_style_special($handle, $srcString, $depArray, $version, $media, 'async');
}

/**
 * Custom Script and Style Enqueued stuff
 */
/**
 * Callback for WP to hit before echoing out an enqueued resource
 * @param {string} $tag - Will be the full string of the tag (`<link>` or `<script>`)
 * @param {string} $handle - The handle that was specified for the resource when enqueuing it
 * @param {string} $src - the URI of the resource
 * @param {string|null} $media - if resources is style, should be the target media, else null
 * @param {boolean} $isStyle - If the resource is a stylesheet
 */
function scriptAndStyleTagCallback($tag, $handle, $src, $media, $isStyle){
    global $specialLoadHnds;
    $finalTag = $tag;
    if ($isStyle){
        // Async loading via invalid mediaquery switching
        if (in_array($handle, $specialLoadHnds->styles->async, true)){
            // Do not touch if already modified
            if (!preg_match('/\sonload=|\smedia=["\']none["\']/',$tag)){
                // Lazy load with JS, but also but noscript in case no JS
                $noScriptStr = '<noscript>' . $tag . '</noscript>';
                // Add onload and media="none" attr, and put together with noscript
                $matches = array();
                preg_match('/(<link[^>]+)>/',$tag,$matches);
                $finalTag = preg_replace('/\/$/','',$matches[1],1) . ' media="none" onload="if(media!=\'all\')media=\'all\'"' . ' />' . $noScriptStr;
            }
        }
        // Async loading via preload and loadCSS - https://github.com/filamentgroup/loadCSS/
        else if (in_array($handle, $specialLoadHnds->styles->asyncPreload, true)){
            // Do not touch if already modified
            if (!preg_match('/\srel=["\']preload|\sonload=["\']/',$tag)){
                // Lazy load with JS, but also but noscript in case no JS
                $noScriptStr = '<noscript>' . $tag . '</noscript>';
                // Strip rel="" & as="" portion, if exist
                $tag = preg_replace('/\srel=["\'][^"\']*["\']|\sas=["\'][^"\']*["\']/', '', $tag, -1);
                // Add onload, rel="preload", as="style", and put together with noscript
                $matches = array();
                preg_match('/(<link[^>]+)>/',$tag,$matches);
                $finalTag = preg_replace('/\/$/','',$matches[1],1) . ' rel="preload" as="style" onload="this.onload=null;this.rel=\'stylesheet\'"' . ' />' . $noScriptStr;
            }
        }
    }
    else {
        // Async
        if (in_array($handle, $specialLoadHnds->scripts->async, true)){
            // Do not touch if already modified, or missing src attr
            if (!preg_match('/\sasync/', $tag) && preg_match('/src=/', $tag)){
                // Add async attr
                $matches = array();
                preg_match('/(<script[^>]+)>/',$tag,$matches);
                $finalTag = $matches[1] . ' async="true"' . '></script>';
            }
        }
        // Defer
        else if (in_array($handle, $specialLoadHnds->scripts->defer, true)){
            // Do not touch if already modified, or missing src attr
            if (!preg_match('/\sdefer/', $tag) && preg_match('/src=/', $tag)){
                // Add defer attr
                $matches = array();
                preg_match('/(<script[^>]+)>/',$tag,$matches);
                $finalTag = $matches[1] . ' defer' . '></script>';
            }
        }
    }
    return $finalTag;
}
// BE CAREFUL OF PRIORITY
add_filter('script_loader_tag',function($tag, $handle, $src){
    return scriptAndStyleTagCallback($tag, $handle, $src, null, false);
},10,4);
add_filter('style_loader_tag',function($tag, $handle, $src, $media){
    return scriptAndStyleTagCallback($tag, $handle, $src, $media, true);
},10,4);


/**
 * @author Joshua Tzucker
 * @license MIT
 * @see https://joshuatz.com/posts/2020/adding-extra-attributes-to-style-and-script-tags-in-wordpress/
 */

/**
 * These should stay global, so you can access them wherever
 * you need to hack on an extra attribute
 * 
 * @example
 * ```php
 * global $ARB_ATTRIB_PREFIX;
 * wp_script_add_data($yourHandle,  $ARB_ATTRIB_PREFIX . 'your_key', 'your_val');
 * ```
 * 
 * You can customize this prefix, but be careful about avoiding collisions, and escape any characters that will break building the regex pattern
 */
$ARB_ATTRIB_PREFIX = 'arb_att_&#';
$ARB_ATTRIB_PATTERN = '/' . $ARB_ATTRIB_PREFIX . '(.+)/';

/**
 * Callback for WP to hit before echoing out an enqueued resource. This callback specifically checks for any key-value pairs that have been added through `add_data()` and are prefixed with a special value to indicate they should be injected into the final HTML
 * @param {string} $tag - Will be the full string of the tag (`<link>` or `<script>`)
 * @param {string} $handle - The handle that was specified for the resource when enqueuing it
 * @param {string} $src - the URI of the resource
 * @param {string|null} $media - if resources is style, should be the target media, else null
 * @param {boolean} $isStyle - If the resource is a stylesheet
 */
function scriptAndStyleTagAttributeAdder($tag, $handle, $src, $media, $isStyle){
    global $ARB_ATTRIB_PATTERN;
    $extraAttrs = array();
    $nodeName = '';

    // Get the WP_Dependency instance for this handle, and grab any extra fields
    if ($isStyle) {
        $nodeName = 'link';
        $extraAttrs = wp_styles()->registered[$handle]->extra;
        
    } else {
        $nodeName = 'script';
        $extraAttrs = wp_scripts()->registered[$handle]->extra;
    }

    // Check stored properties on WP resource instance against our pattern
    $attribsToAdd = array();
    foreach ($extraAttrs as $fullAttrKey => $attrVal) {
        $matches = array();
        preg_match($ARB_ATTRIB_PATTERN, $fullAttrKey, $matches);
        if (count($matches) > 1) {
            $attrKey = $matches[1];
            $attribsToAdd[$attrKey] = $attrVal;
        }
    }

    // Actually do the work of adding attributes to $tag
    if (count($attribsToAdd)) {
        $dom = new DOMDocument();
        @$dom->loadHTML($tag);
        /** @var {DOMElement[]} */
        $resourceTags = $dom->getElementsByTagName($nodeName);
        foreach ($resourceTags as $resourceTagNode) {
            foreach ($attribsToAdd as $attrKey => $attrVal) {
                $resourceTagNode->setAttribute($attrKey, $attrVal);
            }
        }
        $headStr = $dom->saveHTML($dom->getElementsByTagName('head')[0]);
        // Capture content between <head></head>. Kind of hackish, but should be faster than preg_match
        $content = substr($headStr, 7, (strlen($headStr) - 15));
        return $content;
    }

    return $tag;
}
add_filter('script_loader_tag',function($tag, $handle, $src){
    return scriptAndStyleTagAttributeAdder($tag, $handle, $src, null, false);
},10,4);
add_filter('style_loader_tag',function($tag, $handle, $src, $media){
    return scriptAndStyleTagAttributeAdder($tag, $handle, $src, $media, true);
},10,4);

/**
 * Including and using this is optional; a wrapper function around the add_data calls, so you don't have to remember to prefix with the special string
 * @param {string} $handle
 * @param {string} $attrKey
 * @param {string} $attrVal
 * @param {boolean} [$isScript = false]
 */
function add_attribute($handle, $key, $val, $isScript = false) {
    global $ARB_ATTRIB_PREFIX;
    $attrKey = $ARB_ATTRIB_PREFIX . $key;
    if ($isScript) {
        wp_script_add_data($handle, $attrKey, $val);
    } else {
        wp_style_add_data($handle, $attrKey, $val);
    }
}