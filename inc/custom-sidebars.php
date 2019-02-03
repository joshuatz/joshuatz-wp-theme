<?php
/**
 * @file contains registration code for custom sidebars
 */

function jtzwp_register_sidebars() {
    $jtzwpAdminWidgetClass = 'jtzwpWidget';
    /* Homepage Sidebar */
    register_sidebar(array(
        'id' => 'homepage',
        'name' => __('Homepage Sidebar'),
        'description' => __('Sidebar to show on homepage only'),
        'class' => $jtzwpAdminWidgetClass,
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>'
    ));
}