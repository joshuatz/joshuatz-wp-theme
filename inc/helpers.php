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

    /**
     * Constructor
     */
    public function __construct(){
        $this->isDebug = $this->getIsDebug();
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
    public function getCustomPostTypeSingularName(){
        $singularName = '';
        if (get_post_type()){
            $singularName = get_post_type_object(get_post_type())->labels->singular_name;
        }
        $singularName = ucwords($singularName);
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

    private function getIsDebug(){
        $debug = false;

        // TODO
        $debug = true;

        return $debug;
    }
    
}