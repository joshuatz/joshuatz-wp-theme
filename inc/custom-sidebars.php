<?php
/**
 * @file contains registration code for custom sidebars
 */

$jtzwpCustomSidebars = ['homepage','underpost'];

function jtzwp_register_sidebars() {
    $jtzwpAdminWidgetClass = 'jtzwpWidget';
    /* Homepage Sidebar */
    register_sidebar(array(
        'id' => 'homepage',
        'name' => __('Homepage Sidebar'),
        'description' => __('Sidebar to show on homepage only'),
        'class' => $jtzwpAdminWidgetClass,
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>'
    ));
    /* Under Post Area */
    register_sidebar(array(
        'id' => 'underpost',
        'name' => __('Under Post Sidebar'),
        'description' => __('Widget area that will show up under all posts (projects, blog posts, etc.)'),
        'class' => $jtzwpAdminWidgetClass,
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>'
    ));
}