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
            "with_front" => true
        ),
		// Requires https://wordpress.org/plugins/custom-post-type-permalinks/
		// Avoided using %project_types% as path, since you can't limit a taxonomy to a single selection (not easily), so this is safer and more permanent permalink
        "cptp_permalink_structure" => "/%year%/proj_%post_id%/%postname%/",
		"menu_icon" => "dashicons-portfolio",
		"supports" => array( "title", "editor", "thumbnail", "excerpt" ),
		"taxonomies" => array( "category", "post_tag", "project_types" )
    );
    
    register_post_type( "projects", $args );
    return true;
}
function jtwp_register_all_custom_posttypes(){
    jtzwp_register_projects_posttype();
    return true;
}