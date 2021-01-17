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
    const BASE_POST_TYPE = 'post';
    const PROJECTS_POST_TYPE = 'projects';
    const TOOLS_POST_TYPE = 'custom_built_tools';
    const CUSTOM_REDIRECTS_FILENAME = 'jtzwp-custom-redirects.json';
    const USER_SETTINGS_REG_NAME = 'jtzwp_settings';

    /**
     * Constructor
     */
    public function __construct(){
        $this->isDebug = $this->getIsDebug();
        $this->resetPaths();
        $this->themeUserSettingsValidations = array(
            'jtzwp_cachebust_stamp' => "/.+/",
            'jtzwp_ga_gauid' => "/UA-\d{8}-\d{1}/i",
            'jtzwp_disqus_subdomain' => "/[^\.]+\.disqus\.com/i",
            'jtzwp_about_me_email' => ",[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?,i",
            'jtzwp_about_me_birthdate' => "/\d{2}\/\d{2}\/\d{4}/i",
            'jtzwp_about_me_profile_picture_filepath' => "/jpg|jpeg|webm|png|gif|bmp/i",
            'jtzwp_ipinfo_token' => "/[a-z0-9]{10,}/"
        );
        // Make sure webhook key is set
        $this->getUsersWebhookKey();
    }

    /**
     * Get Paths
     */
    public function resetPaths(){
        $this->themeRootURL = (get_template_directory_uri());
        $this->themeRootPath = (get_theme_root(get_template()) . '/' . get_template());
        $this->themeLibURL = (get_template_directory_uri().'/lib');
        $this->themeIncURL = (get_template_directory_uri().'/inc');
        $this->themeIncPath = (get_template_directory() . '/inc');
        $this->siteRootPath = preg_replace('#\/$#','',isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : dirname(dirname(__FILE__)));
        $this->siteRootUrl = $this->getUrlInfo()['homepage'];
        $this->siteRootUrlBasedOnWp = $this->getUrlInfo(get_template_directory_uri())['homepage'];
        $this->homepage = $this->getUrlInfo()['homepage'];
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
     * @return {array} Returns an array of WP terms that belong to the input taxonomy
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

    /**
     * Get the "project type terms" - e.g. "Web Stuff, Electronics" - that belong to the project types taxonomy
     */
    public function getProjectTypesTerms(){
        return $this->getTermsByName(self::PROJECT_TYPES_TAXONOMY_BASE);
    }

    /**
     * Get whether or not a post is of a custom post type versus a WP built-in post type ('post','page', etc.)
     */
    public function getIsPostCustomType($post=null){
        $customPostTypesArr = array(self::PROJECTS_POST_TYPE,self::TOOLS_POST_TYPE);
        return in_array(get_post_type($post),$customPostTypesArr);
    }

    /**
     * Get a custom post type singular name
     * @param {boolean} [$properCase = true] - whether or not you want the singular name to be in "sentence case" - e.g. "Electronics Project" vs "electronics project".
     * @return {string} the singular name
     */
    public function getCustomPostTypeSingularName($properCase = true,$post=null){
        $singularName = '';
        if (get_post_type()){
            $singularName = get_post_type_object(get_post_type($post))->labels->singular_name;
        }
        if($properCase){
            $singularName = ucwords($singularName);
        }
        return $singularName;
    }

    /**
     * Get an icon URL path or font-awesome class to use, based on hosted code URL
     * @param {string} $hostURL - URL of the hosted code - e.g. Github gist, codemirror demo, etc.
     * @return {assoc array} details about the icon to use, and the actual HTML you can echo out
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
                'value' => 'fa-github',
                'name' => 'GitHub'
            ),
            '/codepen/' => array(
                'type' => 'font-awesome',
                'value' => 'fa-codepen',
                'name' => 'Codepen'
            ),
            '/jsfiddle/' => array(
                'type' => 'font-awesome',
                'value' => 'fa-jsfiddle',
                'name' => 'JSFiddle'
            ),
            '/bitbucket/' => array(
                'type' => 'font-awesome',
                'value' => 'fa-bitbucket',
                'name' => 'Bitbucket'
            ),
            '/gitlab/' => array(
                'type' => 'font-awesome',
                'value' => 'fa-gitlab',
                'name' => 'GitLab'
            ),
            // Fallback for any unknown URL
            '`[(http(s)?):\/\/(www\.)?a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)`' => array(
                'type' => 'font-awesome',
                'value' => 'fa-external-link',
                'name' => 'External Link'
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
            $finalIconInfo['foundMatch'] = $foundMatch;
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

    /**
     * Parse raw HTML text (for example from file_get_contents($htmlDocFile)) into sections for WP
     * @param {string} $html - raw html text
     * @return {object} body, head, both combined without wrappers
     */
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

    /**
     * Check if page should load in debug mode or not, based on set criteria
     */
    private function getIsDebug(){
        $debug = (($this->getIsDebugDomain()||$this->getIsDebugUser()) && !$this->getIsDebugForcedOff());
        return $debug;
    }

    /**
     * Check if the current domain matches a dev domain for debugging (based on TLD)
     */
    private function getIsDebugDomain(){
        $hostName = (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : gethostname());
        return preg_match('/\.test$|\.ngrok.io$/',$hostName);
    }

    /**
     * Check if the currently logged in WP should get debug mode ON based on admin level
     */
    private function getIsDebugUser(){
        $user = wp_get_current_user();
        // Note: This will have to be updated if moved to a multiple role system
        if ($this->getIsUserAdmin()){
            return true;
        }
        else {
            return false;
        }
    }

    private function getIsDebugForcedOff(){
        return preg_match('/debug=off/i',$_SERVER["REQUEST_URI"]);
    }

    public function getIsUserAdmin(){
        $user = wp_get_current_user();
        if ($user){
            if (isset($user->roles)){
                $roles = $user->roles;
                foreach ($roles as $role){
                    if ($role==='administrator'){
                        return true;
                    }
                }
            }
        }
        return false;
    }
    
    /**
     * Load up the entire custom redirect settings file and parse
     */
    private function getCustomRedirectSettingsAll(){
        // Possible file paths
        $highestLevelFilePath = $_SERVER['DOCUMENT_ROOT'] . $this::CUSTOM_REDIRECTS_FILENAME;
        $themeFilePath = $this::CUSTOM_REDIRECTS_FILENAME;
        $fileContentsRaw = false;

        $customRedirectSettings = (object) array();
        
        // Check for highest level file first - this will take precedent over local file path
        if (file_exists($highestLevelFilePath)){
            $fileContentsRaw = file_get_contents($highestLevelFilePath);
        }
        else if (file_exists($themeFilePath)){
            $fileContentsRaw = file_get_contents($themeFilePath);
        }
        if ($fileContentsRaw){
            $customRedirectSettings = json_decode($fileContentsRaw,true);
        }

        // Set for future use
        $this->allRedirectSettings = $customRedirectSettings;

        // return all settings
        return $customRedirectSettings;
    }

    /**
     * Lookup a single URL to see if someone has configured a custom redirect that matches the URL
     * @param {string} $lookupUrl - the original URL to check if needs to be redirected
     * @param {boolean} [$allowRegex=true] - Allow for the custom defined rule to match based on Regex, vs requiring exact match
     * @return {object} contains results, showing whether or not the URL should be redirected, and if so, with what specifications. Does not actually do any redirecting itself.
     */
    private function getCustomRedirectSettingSingle($lookupUrl, $allowRegex = true){
        $matchFound = false;
        $retArr = (object) array(
            'originalURL' => $lookupUrl,
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
                // TODO - above needs to be optimized to check against non reg vs reg strings
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

    /**
     * This handles the whole end to end process of checking an incoming URL for configured redirects, trying variant matching of the pattern, and handling any redirects that are necessary
     * Essentially a very slim custom routing configuration to supplement the built in routing handled by WP
     * @param {string} [$requestUrl] - the incoming URL to check for a redirect. If left as null, will default to current URL
     * @param {boolean} $allowRegex - whether or not to allow regex pattern matching on custom rule set
     */
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
        // If custom VALID redirect...
        if ($redirectInfo->hasCustomSetting && isset($redirectInfo->customConfig)){
            $customConfig = $redirectInfo->customConfig;
            if (!isset($customConfig['disable']) || $customConfig['disable'] == false){
                // Setup defaults
                $redirectCode = isset($customConfig['redirectCode']) ? $customConfig['redirectCode'] : 302;
                $passRef = (isset($customConfig['passRef']) && $customConfig['passRef'] === true) ? true : false;
                $preserveQuery = (isset($customConfig['preserveQuery']) && $customConfig['preserveQuery'] === true) ? true : false;
                $newUrl = isset($redirectInfo->customConfig['redirectTo']) && $redirectInfo->customConfig['redirectTo']!=='' ? $redirectInfo->customConfig['redirectTo'] : $requestUrlInfo['homepage'];
                $newUrlInfo = $this->getUrlInfo($newUrl);

                // Make sure new URL has protocol, since that will break wp_redirect if missing
                if ($newUrlInfo['protocol']===''){
                    $newUrl = 'https://' . $newUrl;
                    $newUrlInfo = $this->getUrlInfo($newUrl);
                }

                // Compose new URL to redirect to
                if ($preserveQuery){
                    $newUrl = $this->modQueryStringBulk($newUrl,$requestUrlInfo['querystring']);
                }
                if ($passRef){
                    $newUrl = $this->modQueryStringSingle($newUrl,'redirectedFrom',$requestUrl);
                }

                // Redirect to new URL
                wp_redirect($newUrl,intval($redirectCode,10));
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
        $finalInfo = array_fill_keys(array('protocol','hostname','path','querystring','homepage'),'');
        $fullUrl = isset($fullUrlInput) ? $fullUrlInput : $this->getCurrentUrl();
        $finalInfo['fullUrl'] = $fullUrl;
        $finalInfo['queryKeyPairs'] = array();

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
        $finalInfo['path'] = '';
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
            if (preg_match('/^(?:https{0,1}:\/\/){0,1}[^\/]+(\/[^?]+)/',$fullUrlInput,$matches)){
                $finalInfo['path'] = $matches[1];
            }
        }

        // Parse QueryString
        $matches = array();
        if(preg_match('/\?([^\/]+)$/i',$fullUrl,$matches)){
            $finalInfo['querystring'] = $matches[1];
            $queryString = $matches[1];
            $queryString = preg_replace('/^\?/','',$queryString);
            // Break apart querystring by &
            $keyPairs = explode('&',$queryString);
            foreach ($keyPairs as $index => $keyPair) {
                // Break apart keypair by =
                $arr = explode('=',$keyPair);
                $key = $arr[0];
                $val = null;
                if (count($arr) === 2) {
                    $val = $arr[1];
                }
                // Save down to assoc array
                $finalInfo['queryKeyPairs'][$key] = $val;
            }

        }

        /**
         * Put collected info together for some combination values
         */
        $finalInfo['homepage'] = $finalInfo['protocol'] . $finalInfo['hostname'];

        // Return info
        return $finalInfo;
    }

    public function getQueryVal($key,$OPT_DefaultValue = null,$OPT_URL = null){
        $queryKeyPairs = $this->getUrlInfo($OPT_URL)['queryKeyPairs'];
        return isset($queryKeyPairs[$key]) ? urldecode($queryKeyPairs[$key]) : $OPT_DefaultValue;
    }

    /**
     * Bulk modify the query string of a URL by simply passing a string
     * @param {string} $url - the URL to modify the QS of
     * @param {string} $queryString - the querystring to set on the url. Can include or exclude leading ?.
     *   - Example: $queryString = '?keyparam=keyval&paramtwo=123'
     * @return {string} New URL modified with the new query string
     */
    public function modQueryStringBulk($url,$queryString){
        // Strip leading ?
        $queryString = preg_replace('/^\?/','',$queryString);
        // Break apart querystring by &
        $keyPairs = explode('&',$queryString);
        foreach ($keyPairs as $index => $keyPair) {
            // Break apart keypair by =
            $arr = explode('=',$keyPair);
            $key = $arr[0];
            $val = $arr[1];
            // Pass to ModQueryStringSingle
            $url = $this->modQueryStringSingle($url,$key,$val);
        }
        return $url;
    }

    /**
     * Modify the query string of a URL - adding a single param and value
     * TODO: Check to see if param already is in QS before appending - replace vs append
     */
    public function modQueryStringSingle($url,$param,$val){
        $urlInfo = $this->getUrlInfo($url);
        $origQueryString = $urlInfo['querystring'];
        // If no existing query string, make sure URL ends with slash if homepage
        if ($urlInfo['path']==='' || $url === $urlInfo['homepage']){
            $finalChar = mb_substr($url,-1);
            $url = $finalChar!=='/' ? $url.'/' : $url;
        }
        // If no existing query string, start it with ?, otherwise append with &
        $url = $url . ($origQueryString==='' ? '?' : '&');
        $url = $url . urlencode($param) . '=' . urlencode($val);
        return $url;
    }

    /**
     * If you are unsure if passed arg was postID or post obj, pass it through this function to make sure you are getting post obj
     *  - Can also be used to get current post / page / etc.
     */
    public function getPostByMixed($postOrPostId = null){
        global $post;
        if (gettype($postOrPostId)==='integer'){
            return get_post($postOrPostId);
        }
        else if (!(isset($postOrPostId))){
            // Try to retrive global post object
            if (is_single() && isset($post)) {
                return $post;
            } else {
                $itemObj = get_queried_object();
                return $itemObj;
            }
        }

        return $postOrPostId;
    }

    /**
     * Get basic post info
     * @return BasicPostInfo postInfo
     */
    public function getBasicPostInfo($postOrPostId){
        $postObj = $this->getPostByMixed($postOrPostId);
        $id = isset($postObj) && property_exists($postObj, 'ID') ? $postObj->ID : null;
        $publishedDateDiff = $this->getPublishedDateDiff($postObj);
        $postInfo = (object) array (
            'postObj' => $postObj,
            'id' => $id,
            'ID' => $id,
            'permalink' => $this->getPostPermalink($id),
            'permalinkIsExternal' => $this->postOnlyLinksExternally($id),
            'title' => get_the_title($id),
            'excerpt' => $this->getPostExcerpt($postObj),
            'hasExcerpt' => $this->hasExcerpt($postObj),
            'featuredImage' => (object) array(
                'hasFeaturedImage' => has_post_thumbnail($id),
                'hasShadow' => $this->featuredImageHasShadow($id)
            ),
            'templateSlug' => get_page_template_slug($id),
            'date' => (object) array(
                'published' => $this->wpDateToDateTime(get_the_date('',$postObj)),
                'age' => (object) array(
                    'days' => $this->getDateDiffByUnit($publishedDateDiff,'days'),
                    'months' => $this->getDateDiffByUnit($publishedDateDiff,'months'),
                    'years' => $this->getDateDiffByUnit($publishedDateDiff,'days')
                )
            ),
            'org' => (object) array(
                'isCustomPostType' => $this->getIsPostCustomType($postObj),
                'postType' => get_post_type($postObj),
                'postTypeSingular' => $this->getCustomPostTypeSingularName(false,$postObj)
            )
        );
        return $postInfo;
    }

    public function getFeaturedImageSrc($postObj,$size=null){
        $size = isset($size) ? $size : 'full';
        $imageUrl = false;
        if (has_post_thumbnail($postObj)) {
            $imageUrl = get_the_post_thumbnail_url($postObj, $size);
        }

        // Ensure that thumbnail size matches - glitchy
        if (in_array($size, array('thumbnail', 'post-thumbnail'))){
            if ($imageUrl === get_the_post_thumbnail_url($postObj, 'full')){
                // Something went wrong. Fall back to medium size (usually 300x300)
                $imageUrl = get_the_post_thumbnail_url($postObj, 'medium');
            }
        }

        if ($imageUrl === '' || strval($imageUrl) === 'unknown') {
            return false;
        }

        return $imageUrl;
    }

    public function featuredImageHasShadow($postId){
        $hasShadow = false;
        if (has_post_thumbnail($postId)){
            if (preg_match('/_DS\.[Pp][Nn][Gg]$/',get_the_post_thumbnail_url($postId,'full'))){
                $hasShadow = true;
            }
        }
        return $hasShadow;
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

    public function scriptLog($msg){
        ?>
        <script>console.log(<?php echo $msg; ?>);</script>
        <?php
    }

    /**
     * Convert a WP style date (e.g. result of get_the_date()) - to a regular PHP datetime object
     */
    public function wpDateToDateTime($wpDate){
        $finalDateTime = new DateTime();
        $wpStamp = strtotime($wpDate);
        $finalDateTime->setTimestamp($wpStamp);
        return $finalDateTime;
    }

    /**
     * Get the difference between the date a post was published and today
     */
    public function getPublishedDateDiff($post){
        $publishedDate = $this->wpDateToDateTime(get_the_date('',$post));
        $todayDate = new DateTime('now');
        $diffInterval = date_diff($publishedDate,$todayDate,true);
        return $diffInterval;
    }

    public function getDateDiffByUnit($diffInterval,$unit){
        $formattedDiff = null;
        if ($unit){
            if ($unit === 'years' || $unit==='year'){
                $formattedDiff = $diffInterval->format('%y');
            }
            else if ($unit === 'months' || $unit === 'month'){
                $formattedDiff = $diffInterval->format('%m');
            }
            else if ($unit === 'days' || $unit === 'day'){
                // http://php.net/manual/en/dateinterval.format.php
                $formattedDiff = $diffInterval->format('%a');
            }
        }
        if (isset($formattedDiff)){
            $formattedDiff = floatval($formattedDiff);
        }
        else {
            $formattedDiff = $diffInterval;
        }
        return $formattedDiff;
    }

    public function getTagsInfoArrs($postOrPostId = null){
        $post = $this->getPostByMixed($postOrPostId);
        $tagsInfo = (object) array(
            'tagNames' => array(),
            'tagIds' => array(),
            'commaSep' => '',
            'raw' => array(),
            'summaryArr' => array(),
            'baseUrl' => $this->getTagBaseUrl(),
            'count' => 0
        );
        $tags = get_the_tags($post);
        if ($tags){
            $counter = 0;
            foreach ($tags as $tag) {
                $tagId = $tag->term_id;
                $tagName = $tag->name;
                array_push($tagsInfo->tagNames,$tagName);
                array_push($tagsInfo->tagIds,$tagId);
                if ($counter>0){
                    $tagsInfo->commaSep .= ',';
                }
                $tagsInfo->commaSep .= $tag->name;
                array_push($tagsInfo->summaryArr,(object) array(
                    'id' => $tagId,
                    'name' => $tagName,
                    'permalink' => get_tag_link($tagId),
                    'raw' => $tag
                ));
                $counter++;
            }
            $tagsInfo->raw = $tags;
            $tagsInfo->count = $counter;
        }
        return $tagsInfo;
    }

    public function getTagBaseUrl(){
        return home_url() . '/' . get_option('tag_base');
    }

    public function getPostContentByRef($postRef){
        $postContent = '';
        $postObj = false;

        if (gettype($postRef)==='integer'){
            $postObj = get_post($postRef);
        }
        else if (gettype($postRef)==='object'){
            $postObj = $postRef;
        }
        if ($postObj){
            $postContent = $postObj->post_content;
        }
        return $postContent;
    }

    public function getPostPermalink($postId){
        $permalink = get_permalink($postId);
        // If post type = (project|tool) && (project|tool) is just externally hosted (e.g. no writeup stored)
        if ((get_post_type($postId)===$this::PROJECTS_POST_TYPE || get_post_type($postId)===$this::TOOLS_POST_TYPE) && get_field('full_page_is_only_hosted_elsewhere',$postId)){
            if (get_field('externally_hosted_full_page_url',$postId)){
                $permalink = get_field('externally_hosted_full_page_url',$postId);
            }
            else if (get_field('externally_hosted_code_url',$postId)){
                $permalink = get_field('externally_hosted_code_url',$postId);
            }
        }
        return $permalink;
    }

    /**
     * Determines whether a post only links externally (off-site) or not
     * Works because get_permalink is a WP function and should *ALWAYS* return a permalink to this domain, whereas getPostPermalink can point elsewhere for the same post
     */
    public function postOnlyLinksExternally($postId){
        return get_permalink($postId)!==$this->getPostPermalink($postId);
    }

    public function hasExcerpt($post = null){
        $excerpt = $this->getPostExcerpt($post);
        if (!empty($excerpt)){
            return true;
        }
        return false;
    }

    public function getPostExcerpt($post = null){
        $excerpt = false;
        $post = $this->getPostByMixed($post);
        // Note - most excerpt related WP functions can only be used inside the loop
        if (has_excerpt($post)){
            $excerpt = get_the_excerpt($post);
        }
        else {
            $excerpt =  wp_trim_excerpt('', $post);
        }
        return $excerpt;
    }

    public function isFrontPageByRef($postId){
        if (is_front_page()){
            return true;
        }
        else {
            $frontPageId = (int) get_option('page_on_front');
            return ($postId==$frontPageId);
        }
    }

    public function isHomeByRef($postId){
        if (is_home()){
            return true;
        }
        else {
            $homeId = (int) get_option('page_for_posts');
            return ($postId==$homeId);
        }
    }

    /**
     * Checks whether or not a given post/page/etc should have be indexed - vs having the noindex flag applied
     *  - NoIndex tells search engines not to index the given page, which prevents being penalized for having "thin content" or other less favorable content
     * This is based on my criteria - will be false either if page only links externally (redirects immediately) or fails sanity check of simple word count
     * Note: Remember that since this is usually called from a callback after a post is edited, the global $post object no longer refers to the post that was edited and you can't rely on functions like is_home()
     * @return {boolean} true/false - if should be indexed. Default is true
     */
    public function shouldPostBeIndexed($postId){
        global $jtzwpHelpers;
        $postShouldIndex = true;
        // Always set index=true for homepage, blog page, front, etc.
        if ($jtzwpHelpers->isHomeByRef($postId)===true || $jtzwpHelpers->isFrontPageByRef($postId)===true){
            $postShouldIndex = true;
        }
        else {
            $postUsesStaticHTMLFile = (get_field('uploaded_custom_html_file_path',$postId)!==null && strlen(get_field('uploaded_custom_html_file_path',$postId))>0);

            if ($this->postOnlyLinksExternally($postId)!==false){
                $postShouldIndex = false;
            }
            // If post content is less than 5 characters long
            else if (strlen($this->getPostContentByRef($postId))<5 && strlen(get_field('raw_custom_html_code',$postId))<5 && !$postUsesStaticHTMLFile){
                $postShouldIndex = false;
                if ($this->isDebug){
                    $this->log('Post #' . $postId . ' is set to publish internally, but is failing content length requirements to index!');
                }
            }
        }
        return $postShouldIndex;
    }

    /**
     * Log a text string to the theme log file
     */
    public function log($msg,$OPT_special = false){
        if ($this->isDebug){
            $logFilePath = $this->themeRootPath . '/config/log.txt';
            $stamp = new DateTime('now');
            if(file_exists($logFilePath) && is_writable($logFilePath)){
                $logFile = fopen($logFilePath,'a') or die();
                if ($OPT_special==='clearLog'){
                    fwrite($logFile,'');
                    fclose($logFile);
                }
                else {
                    // Turn array into string
                    if (is_array($msg) || is_object($msg)){
                        $msg = json_encode($msg);
                    } else if (gettype($msg) !== 'string') {
                        $msg = serialize($msg);
                    }
                    // make sure final char is new line, otherwise add
                    $msg = preg_match('/[\r\n]+[\s]{0,1}$/',$msg) ? $msg : $msg . "\n";
                    // Add timestamp to beginning of msg
                    $msg = $stamp->getTimestamp() . ' --- ' . $msg;
                    // write out the msg to file
                    fwrite($logFile,$msg);
                    // close file
                    fclose($logFile);
                }
            }
        }
    }

    /**
     * Clear the log file
     */
    public function clearLog(){
        $this->log('','clearLog');
    }

    /**
     * Dang PHP casting
     */
    public function boolToString($myBool){
        return $myBool ? 'true' : 'false';
    }

    /**
     * Validates a given setting value to see if it passes the rule (regexp) for the setting it is assigned to
     * @param {string} $key - The the key with which the setting is stored
     * @param {string} $value - The value to check if valid for the setting
     */
    public function validateThemeUserSetting($key,$val){
        if (!isset($val)) {
            return false;
        }
        if ($val!==''){
            if (isset($this->themeUserSettingsValidations[$key])){
                return preg_match($this->themeUserSettingsValidations[$key],$val);
            }
            else {
                return true;
            }
        }
        else {
            return false;
        }
    }

    /**
     * @param {string} $key - the key with which the setting is stored. Usually long and very unique to the theme.
     * @return {object} - object with members for the actual value of the setting, as well as if it is valid (based on having non-empty value and/or passing a custom validation rule)
     */
    public function getThemeUserSetting($key){
        $retVal = (object) array(
            'isSet' => false,
            'isValid' => false,
            'val' => ''
        );
        $themeUserSettings = get_option($this::USER_SETTINGS_REG_NAME,array());
        if (isset($themeUserSettings[$key])){
            $val = $themeUserSettings[$key];
            if ($val!==''){
                $retVal->isSet = true;
                $retVal->val = $val;
                // Check against regex validators
                $retVal->isValid = $this->validateThemeUserSetting($key,$val);
            }
        }
        return $retVal;
    }

    public function setThemeUserSetting($key,$val){
        $success = false;
        $settings = get_option($this::USER_SETTINGS_REG_NAME,false);
        if (!$settings){
            $settings = array(
                $key => $val
            );
        }
        $settings[$key] = $val;
        // This will also create the option if it doesn already exist
        $success = update_option($this::USER_SETTINGS_REG_NAME,$settings);
        return $success;
    }
    
    public function grabHrefFromATag($aTag){
        $matches = array();
        preg_match('/href="([^"]*)"/i',$aTag,$matches);
        $href = count($matches)>0 ? $matches[1] : '';
        return $href;
    }

    public function getIsUnderConstruction(){
        if (defined('UNDER_CONSTRUCTION') && UNDER_CONSTRUCTION===true){
            return true;
        }
        return false;
    }

    public function getShouldUserSeeUnderConstruction(){
        if ($this->getIsUnderConstruction()===true && !$this->getIsUserAdmin()){
            return true;
        }
        return false;
    }

    public function updateCacheBuster(){
        $now = new DateTime();
        $stamp = $now->getTimestamp();
        $this->setThemeUserSetting('jtzwp_cachebust_stamp',$stamp);
        return $stamp;
    }

    public function getCacheBuster($retry = true){
        $cacheBuster = $this->getThemeUserSetting('jtzwp_cachebust_stamp');
        if ($cacheBuster->isValid){
            return $cacheBuster->val;
        }
        else if ($retry) {
            $this->updateCacheBuster();
            // Try one more time
            $this->getCacheBuster(false);
        }
        else {
            return 0;
        }
    }

    public function getUsersWebhookKey(){
        $configuredKey = $this->getThemeUserSetting('jtzwp_webhook_key');
        if ($configuredKey->isValid){
            return $configuredKey->val;
        }
        else {
            // use wp password gen to create a random key, and save the value
            $newKey = wp_generate_password(18,false,false);
            $this->setThemeUserSetting('jtzwp_webhook_key',$newKey);
            return $newKey;
        }
    }

    public function getUsersGlobalOptOutPath(){
        $configuredPage = $this->getThemeUserSetting('jtzwp_global_optout_path');
        if ($configuredPage->isSet){
            // Remove leading slash if user left it in
            $configuredPagePath = preg_replace('/^\//','',$configuredPage->val);
            // Remove trailing slash
            $configuredPagePath = preg_replace('/\/$/','',$configuredPagePath);
            return $configuredPagePath;
        }
        else {
            // return a path that should never match
            return '\/\/\/\?donotmatchme\?\/\/\/';
        }
    }

    /**
     * Replacement for get_template_part() which keeps variable scope by using include
     */
    public function includeTemplatePart($name,$scopedArgs=null){
        $args = gettype($scopedArgs)==='array' ? $scopedArgs : array();
        foreach($args as $argKey=>$argVal){
            $$argKey = $argVal;
        }
        $filename = $name . (preg_match('/\.php/i',$name) ? '' : '.php');
        include(locate_template($filename));
    }

    public function getCurrentThemeFile(){
        global $template;
        $templateFile = $template;
        $outputString = '';
        if (isset($templateFile)){
            $outputString = basename($templateFile);
        }
        else if (isset($GLOBALS['jtzwp_wp_selected_template'])){
            $outputString = $GLOBALS['jtzwp_wp_selected_template'];
        }
        return $outputString;
    }

    /**
     * Similar to wp_make_link_relative, but will have no effect on external links
     */
    public function makeInternalLinkRelative($link){
        $link = str_replace($this->getUrlInfo()['homepage'],'',$link);
        $link = str_replace(get_option('siteurl'),'',$link);
        $link = str_replace($this->siteRootUrlBasedOnWp,'',$link);
        return $link;
    }

    /**
     * Get Client's IP Info
     * Uses https://ipinfo.io
     * @param {string} $OPT_ip - IP address to get info for. If omitted, defaults to client, not server
     * @param {boolean} $OPT_useToken - Whether or not try to use auth token stored in settings, versus anonymous use
     */
    public function getIpInfo($OPT_ip = null,$OPT_useToken = true){
        $retInfo = (object) array(
            'success' => false,
            'failMsg' => '',
            'info' => null,
        );
        $ipToUse = $_SERVER['REMOTE_ADDR'];
        if (isset($OPT_ip) && $OPT_ip!==''){
            $ipToUse = $OPT_ip;
        }
        $STORAGE_KEY = 'IPINFO_' . $ipToUse;
        // Check for cached data
        if (isset($_SESSION[$STORAGE_KEY]) && !$this->isDebug){
            $retInfo->success = true;
            $retInfo->info = json_decode($_SESSION[$STORAGE_KEY],true);
            return $retInfo;
        }
        // Mock for dev
        if ($ipToUse==='127.0.0.1'){
            $ipToUse = '8.8.8.8';
        }
        // Check that cURL is even available
        if (!function_exists('curl_version')){
            $retInfo->failMsg = 'cURL is not installed';
            return $retInfo;
        }
        // Start building cURL request
        $reqHeaders = array(
            "Accept: application/json"
        );
        // Check if user has saved an IpInfo token in settings
        $tokenSetting = $this->getThemeUserSetting('jtzwp_ipinfo_token');
        if ($tokenSetting->isValid && $OPT_useToken){
            $token = $tokenSetting->val;
            array_push($reqHeaders, ("Authorization: Bearer " . $token));
        }
        $reqUrl = 'https://ipinfo.io' . '/' . $ipToUse;
        // Actually make request
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $reqUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 4,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => $reqHeaders
        ));
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl,CURLINFO_HTTP_CODE);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err){
            $retInfo->failMsg = 'cURL Error #' . $err;
        }
        else {
            if ($httpCode===200){
                $retInfo->success = true;
                $retInfo->info = json_decode($response,true);
                $_SESSION[$STORAGE_KEY] = $response;
            }
            else {
                $retInfo->failMsg = 'Response HTTP Status = ' . $httpCode;
            }
        }
        return $retInfo;
    }

    /**
     * Simple "does string contain other string" search, but case insensitive
     */
    public function strContainsCaseIns($haystack,$needle){
        return strpos(strtolower($haystack),strtolower($needle))!==false;
    }

    /**
     * More advanced string matcher - test can be either string or regex pattern as string
     * @param {string} $tester - The string to test *against*. Can be plain string or "/.+/" style regex string
     * @param {string} $input - the string to use as the input to run against tester
     * @param {boolean} $OPT_caseIns - Whether to use case-insensitive matching for simple string comparison
     */
    public function autoStrMatchTest($tester,$input,$OPT_caseIns=false){
        $looksLikeReg = preg_match('/^\/.*\/[igmuy]{0,5}$/',$tester);
        if ($looksLikeReg){
            // Check for regex input
            try {
                return preg_match($tester, $input);
            }
            catch (Exception $e){
                // pattern failed
            }
        }
        if ($OPT_caseIns){
            return $this->strContainsCaseIns($tester,$input);
        }
        else {
            return strpos($tester,$input)!==false;
        }
    }

    /**
     * Dump a php var to the browser console as JSON encoded
     * @param {any} $var
     */
    public function dumpAsJsonEncoded($var){
        if ($this->isDebug){
            ?>
            <script>
                console.log(<?php echo json_encode($var); ?>);
            </script>
            <?php
        }
    }
}