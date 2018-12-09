<?php
function jtzwp_register_project_types_taxonomy(){
    $labels = array(
		"name" => __( "Project Types", "joshuatzwp" ),
		"singular_name" => __( "Project Type", "joshuatzwp" ),
    );
    $args = array(
		"label" => __( "Project Types", "joshuatzwp" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
        // "rewrite" => false,
        "rewrite" => array(
            "slug" => "projects",
            "with_front" => false
        ),
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "project_types",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
    );
    register_taxonomy( "project_types", array( "projects" ), $args );
    return true;
}

function jtwp_register_all_custom_taxonomies(){
    jtzwp_register_project_types_taxonomy();
    return true;
}