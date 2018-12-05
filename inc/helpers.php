<?php
/**
 * @file custom helpers for Wordpress
 * @author Joshua Tzucker
 * @copyright Joshua Tzucker
 */

class JtzwpHelpers {
    /**
     * Constants
     */
    const PROJECT_TYPES_TAXONOMY_BASE = 'project_types';
    const PROJECTS_POST_TYPE = 'projects';
    const TOOLS_POST_TYPE = 'custom_built_tools';
    const CUSTOM_REDIRECTS_FILENAME = 'jtzwp-custom-redirects.json';

    /**
     * Constructor
     */
    public function __construct(){
        $this->isDebug = $this->getIsDebug();
    }

    /**
     * Get current page URL - wordpress variant
     */
    public function getCurrentWPUrl(){
        global $wp;
        return home_url($wp->request);
    }

    /**
     * Get current page URL - using $_SERVER globals
     * https://cssjockey.com/current-url-in-php-with-or-without-query-string/
     */
    public function getCurrentUrl(){
        $pageURL = (isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on') ? "https://" : "http://";
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        return $pageURL;
    }

    /**
     * Get terms belonging to a taxonomy, either top level or all
     * @param {string} $taxonomyName - the name of the taxonomy to get terms for
     * @param {boolean} [$ignoreHierarchy=false] - whether or not to get ALL ($ignoreHierarchy=true) or just top level terms
     */
    public function getTermsByName($taxonomyName,$ignoreHierarchy = false){
        $finalTerms = array();
        $matchingTaxonomies = get_taxonomies(array(
            'name' => $taxonomyName
        ),'objects');
        if ($matchingTaxonomies){
            foreach ($matchingTaxonomies as $matchingTaxonomy){
                // First, grab just the top level terms (e.g. taxonomy -> Term A, but NOT taxonomy -> term A -> term AB)
                $topLevelTerms = get_terms($taxonomyName,array(
                    'parent' => 0
                ));

                // If we are NOT ignoring hierarchy, then we would want to just grab the immediate child terms
                if (!$ignoreHierarchy){
                    $finalTerms = $topLevelTerms;
                }
                // If we are ignoring hierachy, than we need to iterate through top level terms and grab all children
                else {
                    if (!is_wp_error($topLevelTerms)){
                        foreach ($topLevelTerms as $topLevelTerm){
                            // Push curr top level term to arr
                            array_push($finalTerms,$topLevelTerm);
                            // Get all children, regardless of hierarchy, and push to arr
                            $allChildTerms = get_term_children($topLevelTerm->term_id,$matchingTaxonomy->name);
                            $finalTerms = array_merge($finalTerms,$allChildTerms);
                        }
                    }
                }
            }
        }
        return $finalTerms;
    }

    public function getProjectTypesTerms(){
        return $this->getTermsByName(self::PROJECT_TYPES_TAXONOMY_BASE);
    }

    /**
     * Get a custom post type singular name
     */
    public function getCustomPostTypeSingularName($properCase = true){
        $singularName = '';
        if (get_post_type()){
            $singularName = get_post_type_object(get_post_type())->labels->singular_name;
        }
        if($properCase){
            $singularName = ucwords($singularName);
        }
        return $singularName;
    }

    /**
     * Get an icon URL path or font-awesome class to use, based on hosted code URL
     */
    public function codeHostIconMapper($hostURL = null){
        $finalIconInfo = array(
            'type' => false,
            'value' => false,
            'html' => ''
        );
        $iconFolder = '';
        $codeHostIconMappings = array(
            '/github/' => array(
                'type' => 'font-awesome',
                'value' => 'fa-github'
            ),
            '/codepen/' => array(
                'type' => 'font-awesome',
                'value' => 'fa-codepen'
            ),
            '/jsfiddle/' => array(
                'type' => 'font-awesome',
                'value' => 'fa-jsfiddle'
            ),
            '/bitbucket/' => array(
                'type' => 'font-awesome',
                'value' => 'fa-bitbucket'
            )
        );
        if (isset($hostURL)){
            $foundMatch = false;
            foreach ($codeHostIconMappings as $key => $value) {
                if(preg_match($key,$hostURL)){
                    $foundMatch = true;
                    $finalIconInfo = $value;
                    break;
                }
            }          
        }
        // Generate HTML
        if ($finalIconInfo['type']==='font-awesome'){
            $finalIconInfo['html'] = '<i class="fa ' . $finalIconInfo['value'] . '" aria-hidden="true"></i>';
        }
        else if ($finalIconInfo['type']==='image'){
            $finalIconInfo['html'] = '<img src="' . $iconFolder . $finalIconInfo['value'] . '">';
        }
        return $finalIconInfo;
    }

    public function getHtmlFromRaw($raw){
        $finalHtml = $this->parseHtmlForPostBody($raw);
        return $finalHtml;
    }

    public function getHtmlFromFile($path){
        $fileContents = file_get_contents($path);
        $finalHtml = false;
        if ($fileContents!==false && $fileContents!==''){
            $finalHtml = $this->parseHtmlForPostBody($fileContents);
        }
        return $finalHtml;
    }

    public function parseHtmlForPostBody($html){
        $processedHTML = (object) array(
            'body' => '',
            'head' => '',
            'combo' => ''
        );
        $hasExplicitHead = false;
        $hasExplicityBody = false;
        $headInnerHTML = '';
        $bodyInnerHTML = '';
        // First, determime structure of contents
        $matches = array();
        if (preg_match_all('/<head>(.*)<\/head>/mis',$html,$matches)){
            $hasExplicitHead = true;
            $headInnerHTML = $matches[1][0];
            // Strip <head></head> out
        }
        // Check for explicit body section
        $matches = array();
        if (preg_match('/<body>(([\r\n\.]|.)*)<\/body>/',$html,$matches)){
            $hasExplicityBody = true;
            $bodyInnerHTML = $matches[1];
        }
        else {
            // No explicit <body></body> section defined, so just grab eveything, but avoid <head></head>
            if ($hasExplicitHead){
                // Grab everything from end of head to bottom of page
                $matches = array();
                if(preg_match('/(?:<\/head>){1}(([\r\n]|.)*)$/',$html,$matches)){
                    $bodyInnerHTML = $matches[1];
                }
            }
            else {
                // No <head></head> section, so just grab everything
                $bodyInnerHTML = $html;
            }
        }

        // Configure return info
        $processedHTML->body = $bodyInnerHTML;
        $processedHTML->head = $headInnerHTML;
        $processedHTML->combo = $headInnerHTML . '<br\>' . $bodyInnerHTML;
        return $processedHTML;
    }

    private function getIsDebug(){
        $debug = ($this->getIsDebugDomain()||$this->getIsDebugUser());
        return $debug;
    }

    private function getIsDebugDomain(){
        $hostName = (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : gethostname());
        return preg_match('/\.test$/',$hostName);
    }

    private function getIsDebugUser(){
        $user = wp_get_current_user();
        // Note: This will have to be updated if moved to a multiple role system
        if ($user && $user->roles[0]==='administrator'){
            return true;
        }
        else {
            return false;
        }
    }
    
    private function getCustomRedirectSettingsAll(){
        // Possible file paths
        $highestLevelFilePath = $_SERVER['DOCUMENT_ROOT'] . $this::CUSTOM_REDIRECTS_FILENAME;
        $themeFilePath = $this::CUSTOM_REDIRECTS_FILENAME;
        $fileContentsRaw = '';

        $customRedirectSettings = (object) array();
        
        // Check for highest level file first
        if (file_exists($highestLevelFilePath)){
            $fileContentsRaw = file_get_contents($highestLevelFilePath);
        }
        else if (file_exists($themeFilePath)){
            $fileContentsRaw = file_get_contents($themeFilePath);
        }
        $customRedirectSettings = json_decode($fileContentsRaw,true);

        // Set for future use
        $this->allRedirectSettings = $customRedirectSettings;

        // return all settings
        return $customRedirectSettings;
    }

    private function getCustomRedirectSettingSingle($lookupUrl, $allowRegex = true){
        $matchFound = false;
        $retArr = (object) array(
            'hasCustomSetting' => false,
            'customConfig' => array()
        );

        // Make sure all settings are loaded
        $allRedirectSettings = isset($this->allRedirectSettings) ? $this->allRedirectSettings : $this->getCustomRedirectSettingsAll();

        // If regex matching is allowed, iterate through and test patterns
        if ($allowRegex && !$matchFound){
            foreach($allRedirectSettings as $desiredMatch=>$redirectConfig){
                $regPattern = str_replace('/','\/',$desiredMatch);
                $regPattern = '/' . $regPattern . '/i';
                if (preg_match($regPattern,$lookupUrl)){
                    // match found
                    $matchFound = true;
                    $retArr->customConfig = $redirectConfig;
                    break;
                }
            }
        }

        // Now, try regular lookup
        else if (!$matchFound){
            if (isset($allRedirectSettings[$lookupUrl])){
                $matchFound = true;
                $retArr->customConfig = $allRedirectSettings[$lookupUrl];
            }
        }

        // Return findings
        $retArr->hasCustomSetting = $matchFound;
        return $retArr;
    }

    public function checkForAndHandleCustomRedirect($requestUrl = null, $allowRegex = true){
        $matchFound = false;


        // Will look up redirects in order of most granular to lease
        // Example - redirect specifying query string will trigger before redirect looking for domain
        $requestUrlInfo = $this->getUrlInfo($requestUrl);
        $redirectLookupKeys = array(
            // https://example.com/foobar/hello.html?test=true
            $requestUrlInfo['fullUrl'],
            // https://example.com/foobar/html.com
            $requestUrlInfo['protocol'] . $requestUrlInfo['hostname'] . $requestUrlInfo['path'],
            // example.com/foobar/html.com
            $requestUrlInfo['hostname'] . $requestUrlInfo['path'],
            // /foobar/html.com
            $requestUrlInfo['path']
        );

        // Get info
        $redirectInfo = $this->getCustomRedirectSettingSingle($requestUrl,$allowRegex);
        xdebug_break();
        // If custom redirect...
        if ($redirectInfo->hasCustomSetting && isset($redirectInfo->customConfig)){
            $customConfig = $redirectInfo->customConfig;
            if (!isset($customConfig['disable']) || $customConfig['disable'] == false){
                // Setup defaults
                $redirectCode = isset($customConfig['redirectCode']) ? $customConfig['redirectCode'] : 302;
                $passRef = (isset($customConfig['passRef']) && $customConfig['passRef'] === true) ? true : false;
                // Compose new URL to redirect to

                // Redirect to new URL
                xdebug_break();
                wp_redirect('','');
                exit;
            }
        }
    }

    private function cacheRedirect(){
        // TODO
    }

    /**
     * Get information about a URL (or the current request), broken down into standard sections
     * @param {string} [$fullUrlInput] - the URL you want to get info about. If not provided, defaults to current URL
     * @return {assoc array} - Info about the URL
     */
    public function getUrlInfo($fullUrlInput = null){
        $fromCurrentUrl = !isset($fullUrlInput);
        $finalInfo = array_fill_keys(array('protocol','hostname','path','querystring'),'');
        $fullUrl = isset($fullUrlInput) ? $fullUrlInput : $this->getCurrentUrl();
        $finalInfo['fullUrl'] = $fullUrl;

        // Parse protocol. Default to HTTPS if unknown
        if ($fromCurrentUrl){
            if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT']===443)){
                $finalInfo['protocol'] = 'https://';
            }
            else {
                $finalInfo['protocol'] = 'http://';
            }
        }
        else {
            $matches = array();
            if (preg_match('/^(https{0,1}:\/\/)/i',$fullUrlInput,$matches)){
                $finalInfo['protocol'] = strtolower($matches[1]);
            }
        }

        // Parse domain / hostname
        if ($fromCurrentUrl){
            $hostName = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : gethostname();
            $finalInfo['hostname'] = $hostName;
        }
        else {
            $matches = array();
            if (preg_match('/(?:https{0,1}:\/\/)([^\/]*)/i',$fullUrlInput,$matches)){
                $hostName = $matches[1];
                $hostName = preg_replace('/^www\./i','',$hostName);
                $finalInfo['hostname'] = $hostName;
            }
        }

        // Parse path
        $finalInfo['path'] = '/';
        if ($fromCurrentUrl){
            if (isset($_SERVER['REQUEST_URI'])){
                $finalInfo['path'] = preg_replace('/\?[^\/]*$/i','',$_SERVER['REQUEST_URI']);
            }
            else {
                $finalInfo['path'] = '/' . $GLOBALS['wp']->request . '/';
            }
        }
        else {
            $matches = array();
            if (preg_match('/^(?:https{0,1}\/\/){0,1}[^\/]+\/([^?]+)/i',$fullUrlInput,$matches)){
                $finalInfo['path'] = $matches[1];
            }
        }

        // Parse QueryString
        $matches = array();
        if(preg_match('/\?([^\/]+)$/i',$fullUrl,$matches)){
            $finalInfo['querystring'] = $matches[1];
        }

        // Return info
        return $finalInfo;
    }

    /**
     * Get basic post info
     */
    public function getBasicPostInfo($post){
        $id = $post->ID;
        return (object) array (
            'postObj' => $post,
            'id' => $id,
            'permalink' => get_permalink($id),
            'title' => get_the_title($id),
            'hasFeaturedImage' => has_post_thumbnail($id),
            'featuredImageSrc' => (has_post_thumbnail($id)) ? get_the_post_thumbnail_url($id) : ''
        );
    }

    /**
     * Check if the current page is ANY kind of WP page
     * This is a little confusing. Both 404s and non-wp have unique wp_query props in common:
     *       - wp_query->post_count = 0
     *       - wp_query->post = undefined
     *       - wp_query->query->page = ''
     *       - wp_query->posts = array(0)
     * HOWEVER, there is one key difference, which is counter-intuitive. The 404 will have:
     *      wp_query->is_page = false
     * Even though it is a WP page, and the non-existant WP page will actually return wp_query->is_page = true!
     */
    public function isPageWP($assumeTrue = true){
        global $wp_query;
        if ($assumeTrue === false){
            $isWP = false;
            // Check for default singulars, or archive
            $isWP = (is_single() || is_singular() || is_front_page() || is_archive());
            // If a page, make sure that not non-wp (non-wp will have no matching posts (post_count=0), and undefined post, but is_page will be true)
            $isWP = ($isWP || (!is_page() && $wp_query->post_count===0 && !isset($wp_query->post)));
            return $isWP;
        }
        else if ($assumeTrue === true) {
            $isWP = true;
            // Check for very specific scenario for non-wp
            if (is_page() && $wp_query->post_count===0 && !isset($wp_query->post)){
                $isWP = false;
            }
            return $isWP;
        }
    }
}