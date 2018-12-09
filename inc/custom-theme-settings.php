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
    // Add "general settings" group / section
    add_settings_section(
		'jtzwp_general_settings_section', 
		__( 'General Settings', 'wordpress' ), 
		'jtzwp_section_description_echo_general_settings', 
		'jtzwp_options_page'
    );
    // Add "About Me" settings group / section
    add_settings_section(
        'jtzwp_about_me_settings_section',
        __('About Me','wordpress'),
        'jtzwp_sections_description_echo_about_me_settings',
        'jtzwp_options_page'
    );

    // General Settings - Google Analytics GAUID
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
    
    // General Settings - Disqus commenting subdomain
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

    // About Me - Email Address
    add_settings_field(
        'jtzwp_about_me_email',
        __( 'Email Address for Contact','wordpress'),
        'jtzwp_generic_text_field_render',
        'jtzwp_options_page',
        'jtzwp_about_me_settings_section',
        array(
            'jtzwp_about_me_email'
        )
    );

    // About Me - LinkedIn URL
    add_settings_field(
        'jtzwp_about_me_linkedin_url',
        __( 'LinkedIn URL','wordpress'),
        'jtzwp_generic_text_field_render',
        'jtzwp_options_page',
        'jtzwp_about_me_settings_section',
        array(
            'jtzwp_about_me_linkedin_url'
        )
    );

    // About Me - Public Coder Profile URL
    add_settings_field(
        'jtzwp_about_me_coding_profile_url',
        __( 'Coding Profile URL (Github, BitBucket, Etc.)','wordpress'),
        'jtzwp_generic_text_field_render',
        'jtzwp_options_page',
        'jtzwp_about_me_settings_section',
        array(
            'jtzwp_about_me_coding_profile_url'
        )
    );

    // About Me - Birthday
    add_settings_field(
        'jtzwp_about_me_birthdate',
        __( 'Birthdate - used to display age. Please use MM/DD/YYYY format','wordpress'),
        'jtzwp_generic_text_field_render',
        'jtzwp_options_page',
        'jtzwp_about_me_settings_section',
        array(
            'jtzwp_about_me_birthdate'
        )
    );

    // About Me - Profile Picture Path
    add_settings_field(
        'jtzwp_about_me_profile_picture_filepath',
        __( 'URL to uploaded profile picture. If left blank, will default to site icon or silhouette.','wordpress'),
        'jtzwp_generic_text_field_render',
        'jtzwp_options_page',
        'jtzwp_about_me_settings_section',
        array(
            'jtzwp_about_me_profile_picture_filepath'
        )
    );

    // About Me - Displayed Name
    add_settings_field(
        'jtzwp_about_me_displayed_name',
        __( 'The name to display around the site','wordpress'),
        'jtzwp_generic_text_field_render',
        'jtzwp_options_page',
        'jtzwp_about_me_settings_section',
        array(
            'jtzwp_about_me_displayed_name'
        )
    );

    // About Me - Geo Description
    add_settings_field(
        'jtzwp_about_me_geo_description',
        __( 'How you want to describe your geography. Something like "Greater Seattle Area"','wordpress'),
        'jtzwp_generic_text_field_render',
        'jtzwp_options_page',
        'jtzwp_about_me_settings_section',
        array(
            'jtzwp_about_me_geo_description'
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
    <form action="options.php" method="post" class="jtzwp_options_page_form">
        <h2>joshuatz-wp Options</h2>
        <div class="divider"></div>
        <div class="settingsWrapper">
            <div class="offset-s1">
                <?php
                    settings_fields('jtzwp_options_page');
                    do_settings_sections('jtzwp_options_page');
                    submit_button();
                ?>
            </div>
        </div>
        
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
    global $jtzwpHelpers;
    $options = get_option('jtzwp_settings');
    $currOptionName = $args[0];
    $currOptionvalue = $options[$currOptionName];
    $currOptionValidity = $jtzwpHelpers->validateThemeUserSetting($currOptionName,$currOptionvalue);
    $classString = isset($ars[1]) ? $ars[1] : '';
    echo '<input type="text" class="' . $classString . '" id="'. $currOptionName .'" name="jtzwp_settings['. $currOptionName .']" value="' . $currOptionvalue . '" invalid="' . $jtzwpHelpers->boolToString(!$currOptionValidity) . '" />';
}

/**
 * Callbacks for settings sections - required to echo descriptions
 */
function jtzwp_section_description_echo_general_settings(){
    echo __( 'This section covers general settings of the joshuatz-wp theme', 'wordpress' );
}
function jtzwp_sections_description_echo_about_me_settings(){
    echo __('This section is for putting your personal details that will be used to populate the contact areas of the site.');
}