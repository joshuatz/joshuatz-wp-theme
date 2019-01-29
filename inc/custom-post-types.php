<?php
function jtzwp_register_projects_posttype(){
    $labels = array(
		"name" => __( "Projects", "joshuatzwp" ),
		"singular_name" => __( "Project", "joshuatzwp" ),
		"menu_name" => __( "Projects", "joshuatzwp" ),
		"all_items" => __( "All Projects", "joshuatzwp" ),
		"add_new" => __( "Add New", "joshuatzwp" ),
		"add_new_item" => __( "Add New Project", "joshuatzwp" ),
		"edit_item" => __( "Edit Project Details", "joshuatzwp" ),
		"new_item" => __( "New Project", "joshuatzwp" ),
		"view_item" => __( "View Project Page", "joshuatzwp" ),
		"view_items" => __( "View Projects", "joshuatzwp" ),
		"search_items" => __( "Search Projects", "joshuatzwp" ),
		"not_found" => __( "No Projects Found", "joshuatzwp" ),
		"not_found_in_trash" => __( "No Projects are in Trash", "joshuatzwp" ),
		"parent_item_colon" => __( "Parent Project:", "joshuatzwp" ),
		"featured_image" => __( "Feature Image for Project:", "joshuatzwp" ),
		"set_featured_image" => __( "Set Featured Image", "joshuatzwp" ),
		"remove_featured_image" => __( "Remove Featured Image", "joshuatzwp" ),
		"parent_item_colon" => __( "Parent Project:", "joshuatzwp" ),
    );
    
    $args = array(
		"label" => __( "Projects", "joshuatzwp" ),
		"labels" => $labels,
		"description" => "Any post covering something I worked on that was of substantial effort and could be considered a \"project\".",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
        "hierarchical" => true,
		"rewrite" => array(
            "slug" => "projects",
            "with_front" => false
        ),
		// Requires https://wordpress.org/plugins/custom-post-type-permalinks/
		// Avoided using JUST %project_types% as path, since you can't limit a taxonomy to a single selection (not easily), so this is safer and more permanent permalink
        //"cptp_permalink_structure" => "/%year%/proj_%post_id%/%postname%/",
        "cptp_permalink_structure" => "/%project_types%/%postname%/",
		"menu_icon" => "dashicons-portfolio",
		"supports" => array( "title", "editor", "thumbnail", "excerpt", "comments"),
		"taxonomies" => array( "category", "post_tag", "project_types" )
    );
    
    register_post_type( "projects", $args );
}

function jtwp_register_tools_posttype(){
	$labels = array(
		"name" => __( "Custom Developed Tools", "joshuatzwp" ),
		"singular_name" => __( "Custom Built Tool", "joshuatzwp" ),
		"menu_name" => __( "Custom Developed Tools", "joshuatzwp" ),
		"all_items" => __( "All Tools", "joshuatzwp" ),
		"add_new" => __( "Add New Tool", "joshuatzwp" ),
		"add_new_item" => __( "Add New Tool", "joshuatzwp" ),
		"edit_item" => __( "Edit Tool", "joshuatzwp" ),
		"new_item" => __( "New Tool", "joshuatzwp" ),
		"view_item" => __( "View Tool", "joshuatzwp" ),
		"view_items" => __( "View Custom Developed Tools", "joshuatzwp" ),
		"search_items" => __( "Search Tools", "joshuatzwp" ),
		"not_found" => __( "No Custom Developed Tools Found", "joshuatzwp" ),
		"not_found_in_trash" => __( "No CBTs found in Trash", "joshuatzwp" ),
		"parent_item_colon" => __( "Parent Tool", "joshuatzwp" ),
		"featured_image" => __( "Featured Image", "joshuatzwp" ),
		"set_featured_image" => __( "Set Featured Image", "joshuatzwp" ),
		"remove_featured_image" => __( "Remove Featured Image", "joshuatzwp" ),
		"use_featured_image" => __( "Remove Featured Image", "joshuatzwp" ),
		"archives" => __( "Tools Archive", "joshuatzwp" ),
		"parent_item_colon" => __( "Parent Tool", "joshuatzwp" )
	);
	
	$args = array(
		"label" => __( "Custom Developed Tools", "joshuatzwp" ),
		"labels" => $labels,
		"description" => "A place for one-off tools that I have built that are worth sharing (code pens, JSFiddles, little bookmarklets, etc.). If something took less than a day to build but more than an hour or two, that is probably a good sign it should not be a blog post, nor a project - it would fall under a tool.",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "custom_built_tools",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array(
			"slug" => "custom-tools",
			"with_front" => false
		),
		"cptp_permalink_structure" => "/%year%/%postname%/",
		"menu_icon" => "dashicons-hammer",
		"supports" => array( "title", "editor", "thumbnail", "excerpt", "comments", "revisions" ),
		"taxonomies" => array( "category", "post_tag" )
	);

	register_post_type("custom_built_tools", $args );
}

function jtwp_register_all_custom_posttypes(){
	jtzwp_register_projects_posttype();
	jtwp_register_tools_posttype();
    return true;
}

/**
 * Adds support for registered custom post types to show up in queries. Register with add_filter('pre_get_posts');
 */
 function jtzwp_custom_posttypes_archive_support($query){
	if (is_category() || is_tag() && empty($query->query_vars["suppress_filters"])){
		$query->set("post_type", array(
			"post", "nav_menu_item", "projects", "custom_built_tools"
		));
		return $query;
	}
}