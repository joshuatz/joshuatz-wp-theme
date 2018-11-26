<?php
/**
 * Enabling and configuring custom theme settings that can show up in WP admin area
 */

/**
 * Custom Menu Page
 */
function jtwzp_add_admin_menu(){
    add_options_page( 'joshuatz-wp', 'joshuatz-wp', 'manage_options', 'joshuatz-wp', 'jtzwp_options_page_html' );
}
// Attach menu init to wp menu init
add_action('admin_menu','jtwzp_add_admin_menu');

/**
 * Initial settings API init - for adding settings fields and registering
 */
function jtzwp_initial_settings_api_init(){
    register_setting('jtzwp_options_page','jtzwp_settings');
    add_settings_section(
		'jtzwp_general_settings_section', 
		__( 'General Settings', 'wordpress' ), 
		'jtzwp_section_description_echo_general_settings', 
		'jtzwp_options_page'
	);

    // Google Analytics GAUID
	add_settings_field(
		'jtzwp_ga_gauid',
		__( 'Google Analytics GA ID', 'wordpress' ),
		'jtzwp_generic_text_field_render',
		'jtzwp_options_page',
        'jtzwp_general_settings_section',
        array(
            'jtzwp_ga_gauid'
        )
    );
    
    // Disqus commenting subdomain
    add_settings_field(
        'jtzwp_disqus_subdomain',
        __( 'Disqus Custom Subdomain','wordpress'),
        'jtzwp_generic_text_field_render',
        'jtzwp_options_page',
        'jtzwp_general_settings_section',
        array(
            'jtzwp_disqus_subdomain'
        )
    );
}
// Attach settings init function to wp settings init
add_action('admin_init','jtzwp_initial_settings_api_init');

/**
 * HTML generator for options page
 */
function jtzwp_options_page_html(){
    ?>
    <form action="options.php" method="post">
        <h2>joshuatz-wp Options</h2>
        <?php
            settings_fields('jtzwp_options_page');
            do_settings_sections('jtzwp_options_page');
            submit_button();
        ?>
    </form>
    <?php
}

/**
 * HTML generation for subfields
 */

/**
 * Re-usable HTML generation for subfield - textbox type
 * When using with add_setting_field(), make sure 6th argument to that function (the args option) is array('YOUR_SETTING_NAME'), because this will get passed as $args here
 */
function jtzwp_generic_text_field_render($args){
    $options = get_option('jtzwp_settings');
    $currOptionName = $args[0];
    $currOptionvalue = $options[$currOptionName];
    echo '<input type="text" id="'. $currOptionName .'" name="jtzwp_settings['. $currOptionName .']" value="' . $currOptionvalue . '" />';
}

/**
 * Callbacks for settings sections - required to echo descriptions
 */
function jtzwp_section_description_echo_general_settings(){
    echo __( 'This section covers general settings of the joshuatz-wp theme', 'wordpress' );
}