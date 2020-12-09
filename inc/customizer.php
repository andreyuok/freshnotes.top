<?php

defined( 'ABSPATH' ) || exit;

/**
 * http://codex.wordpress.org/Theme_Customization_API
 *
 * How do I "output" custom theme modification settings? http://codex.wordpress.org/Function_Reference/get_theme_mod
 * echo get_theme_mod( 'copyright_info' );
 * or: echo get_theme_mod( 'copyright_info', 'Default (c) Copyright Info if nothing provided' );
 *
 * "sanitize_callback": http://codex.wordpress.org/Data_Validation
 */

/**
 * Implement Theme Customizer additions and adjustments.
 */
function fnote_customize( $wp_customize ) {

	/**
	 * Initialize sections
	 */
	$wp_customize->add_section( 'theme_header_section', array(
		'title'    => 'Header',
		'priority' => 1000,
	) );

	/**
	 * Section: Page Layout
	 */
	// Header Logo
	$wp_customize->add_setting( 'header_logo', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_logo', array(
		'label'       => __( 'Upload Header Logo', 'fnote' ),
		'description' => __( 'Height: &gt;80px', 'fnote' ),
		'section'     => 'theme_header_section',
		'settings'    => 'header_logo',
		'priority'    => 1,
	) ) );
	
	// Predefined Navbar scheme
	$wp_customize->add_setting( 'navbar_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'navbar_scheme', array(
		'type'     => 'radio',
		'label'    => __( 'Navbar Scheme', 'fnote' ),
		'section'  => 'theme_header_section',
		'choices'  => array(
						'navbar-light bg-light'  => __( 'Default', 'fnote' ),
						'navbar-dark bg-dark'    => __( 'Dark', 'fnote' ),
						'navbar-dark bg-primary' => __( 'Primary', 'fnote' ),
					),
		'settings' => 'navbar_scheme',
		'priority' => 1,
	) );
	
	// Fixed Header?
	$wp_customize->add_setting( 'navbar_position', array(
		'default'           => 'static',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'navbar_position', array(
		'type'     => 'radio',
		'label'    => __( 'Navbar', 'fnote' ),
		'section'  => 'theme_header_section',
		'choices'  => array(
						'static'       => __( 'Static', 'fnote' ),
						'fixed_top'    => __( 'Fixed to top', 'fnote' ),
						'fixed_bottom' => __( 'Fixed to bottom', 'fnote' ),
					),
		'settings' => 'navbar_position',
		'priority' => 2,
	) );
	
	// Search?
	$wp_customize->add_setting( 'search_enabled', array(
		'default'           => '1',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'search_enabled', array(
		'type'     => 'checkbox',
		'label'    => __( 'Show Searchfield?', 'fnote' ),
		'section'  => 'theme_header_section',
		'settings' => 'search_enabled',
		'priority' => 3,
	) );
}
add_action( 'customize_register', 'fnote_customize' );


/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fnote_customize_preview_js() {
	wp_enqueue_script( 'customizer', get_template_directory_uri() . '/inc/customizer.js', array( 'jquery' ), null, true );
}
add_action( 'customize_preview_init', 'fnote_customize_preview_js' );
