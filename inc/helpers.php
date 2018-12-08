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
        $this->resetPaths();
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
     * Get a custom post type singular name
     * @param {boolean} [$properCase = true] - whether or not you want the singular name to be in "sentence case" - e.g. "Electronics Project" vs "electronics project".
     * @return {string} the singular name
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
        $debug = ($this->getIsDebugDomain()||$this->getIsDebugUser());
        return $debug;
    }

    /**
     * Check if the current domain matches a dev domain for debugging (based on TLD)
     */
    private function getIsDebugDomain(){
        $hostName = (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : gethostname());
        return preg_match('/\.test$/',$hostName);
    }

    /**
     * Check if the currently logged in WP should get debug mode ON based on admin level
     */
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
    
    /**
     * Load up the entire custom redirect settings file and parse
     */
    private function getCustomRedirectSettingsAll(){
        // Possible file paths
        $highestLevelFilePath = $_SERVER['DOCUMENT_ROOT'] . $this::CUSTOM_REDIRECTS_FILENAME;
        $themeFilePath = $this::CUSTOM_REDIRECTS_FILENAME;
        $fileContentsRaw = '';

        $customRedirectSettings = (object) array();
        
        // Check for highest level file first - this will take precedent over local file path
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

                xdebug_break();
                // Compose new URL to redirect to
                if ($preserveQuery){
                    $newUrl = $this->modQueryStringBulk($newUrl,$requestUrlInfo['querystring']);
                }
                if ($passRef){
                    $newUrl = $this->modQueryStringSingle($newUrl,'redirectedFrom',$requestUrl);
                }
                xdebug_break();

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
            if (preg_match('/^(?:https{0,1}\/\/){0,1}[^\/]+\/([^?]+)/i',$fullUrlInput,$matches)){
                $finalInfo['path'] = $matches[1];
            }
        }

        // Parse QueryString
        $matches = array();
        if(preg_match('/\?([^\/]+)$/i',$fullUrl,$matches)){
            $finalInfo['querystring'] = $matches[1];
        }

        /**
         * Put collected info together for some combination values
         */
        $finalInfo['homepage'] = $finalInfo['protocol'] . $finalInfo['hostname'];

        // Return info
        return $finalInfo;
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
        }
        if (isset($formattedDiff)){
            $formattedDiff = floatval($formattedDiff);
        }
        else {
            $formattedDiff = $diffInterval;
        }
        return $formattedDiff;
    }

    public function getCurrPost(){
        $currPost = isset($post) ? $post : get_post();
        return $currPost;
    }

    public function getTagsInfoArrs(){
        $tagsInfo = (object) array(
            'tagNames' => array(),
            'tagIds' => array(),
            'commaSep' => '',
            'raw' => array(),
            'count' => 0
        );
        $commaSepTags = '';
        $tags = get_the_tags();
        if ($tags){
            $counter = 0;
            foreach ($tags as $tag) {
                array_push($tagsInfo->tagNames,$tag->name);
                array_push($tagsInfo->tagIds,$tag->term_id);
                if ($counter>0){
                    $tagsInfo->commaSep .= ',';
                }
                $tagsInfo->commaSep .= $tag->name;
                $counter++;
            }
            $tagsInfo->raw = $tags;
            $tagsInfo->count = $counter;
        }
        return $tagsInfo;
    }

    public function postOnlyLinksExternally($postId){
        $postExternalLink = false;
        $currentUrl = $this->getCurrentUrl();
        // If post type = (project|tool) && (project|tool) is just externally hosted (e.g. no writeup stored)
        if ((get_post_type($postId)===$this::PROJECTS_POST_TYPE || get_post_type($postId)===$this::TOOLS_POST_TYPE) && get_field('full_page_is_only_hosted_elsewhere',$postId)){
            if (get_field('externally_hosted_full_page_url',$postId)){
                $postExternalLink = get_field('externally_hosted_full_page_url',$postId);
            }
            else if (get_field('externally_hosted_code_url',$postId)){
                $postExternalLink = get_field('externally_hosted_code_url',$postId);
            }
        }
        return $postExternalLink;
    }

    /**
     * Checks whether or not a given post/page/etc should have be indexed - vs having the noindex flag applied
     *  - NoIndex tells search engines not to index the given page, which prevents being penalized for having "thin content" or other less favorable content
     * This is based on my criteria - will be false either if page only links externally (redirects immediately) or fails sanity check of simple word count
     * @return {boolean} true/false - if should be indexed. Default is true
     */
    public function shouldPostBeIndexed($postId){
        $postShouldIndex = true;

        if ($this->postOnlyLinksExternally($postId)!==false){
            $postShouldIndex = false;
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
            xdebug_break();
            if(file_exists($logFilePath) && is_writable($logFilePath)){
                $logFile = fopen($logFilePath,'a') or die();
                if ($OPT_special==='clearLog'){
                    fwrite($logFile,'');
                    fclose($logFile);
                }
                else {
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
}