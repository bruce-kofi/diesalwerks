<?php
/**
 * Builds our Customizer controls.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'customize_register', 'koromo_set_customizer_helpers', 1 );
/**
 * Set up helpers early so they're always available.
 * Other modules might need access to them at some point.
 *
 */
function koromo_set_customizer_helpers( $wp_customize ) {
	// Load helpers
	require_once trailingslashit( get_template_directory() ) . 'inc/customizer/customizer-helpers.php';
}

if ( ! function_exists( 'koromo_customize_register' ) ) {
	add_action( 'customize_register', 'koromo_customize_register' );
	/**
	 * Add our base options to the Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function koromo_customize_register( $wp_customize ) {
		// Get our default values
		$defaults = koromo_get_defaults();

		// Load helpers
		require_once trailingslashit( get_template_directory() ) . 'inc/customizer/customizer-helpers.php';

		if ( $wp_customize->get_control( 'blogdescription' ) ) {
			$wp_customize->get_control('blogdescription')->priority = 3;
			$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		}

		if ( $wp_customize->get_control( 'blogname' ) ) {
			$wp_customize->get_control('blogname')->priority = 1;
			$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		}

		if ( $wp_customize->get_control( 'custom_logo' ) ) {
			$wp_customize->get_setting( 'custom_logo' )->transport = 'refresh';
		}

		// Add control types so controls can be built using JS
		if ( method_exists( $wp_customize, 'register_control_type' ) ) {
			$wp_customize->register_control_type( 'Koromo_Customize_Misc_Control' );
			$wp_customize->register_control_type( 'Koromo_Range_Slider_Control' );
		}

		// Add upsell section type
		if ( method_exists( $wp_customize, 'register_section_type' ) ) {
			$wp_customize->register_section_type( 'Koromo_Upsell_Section' );
		}

		// Add selective refresh to site title and description
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'blogname', array(
				'selector' => '.main-title a',
				'render_callback' => 'koromo_customize_partial_blogname',
			) );

			$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
				'selector' => '.site-description',
				'render_callback' => 'koromo_customize_partial_blogdescription',
			) );
		}

		// Remove title
		$wp_customize->add_setting(
			'koromo_settings[hide_title]',
			array(
				'default' => $defaults['hide_title'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_checkbox'
			)
		);

		$wp_customize->add_control(
			'koromo_settings[hide_title]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Hide site title', 'koromo' ),
				'section' => 'title_tagline',
				'priority' => 2
			)
		);

		// Remove tagline
		$wp_customize->add_setting(
			'koromo_settings[hide_tagline]',
			array(
				'default' => $defaults['hide_tagline'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_checkbox'
			)
		);

		$wp_customize->add_control(
			'koromo_settings[hide_tagline]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Hide site tagline', 'koromo' ),
				'section' => 'title_tagline',
				'priority' => 4
			)
		);

		$wp_customize->add_setting(
			'koromo_settings[retina_logo]',
			array(
				'type' => 'option',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'koromo_settings[retina_logo]',
				array(
					'label' => __( 'Retina Logo', 'koromo' ),
					'section' => 'title_tagline',
					'settings' => 'koromo_settings[retina_logo]',
					'active_callback' => 'koromo_has_custom_logo_callback'
				)
			)
		);

		$wp_customize->add_setting(
			'koromo_settings[side_inside_color]', array(
				'default' => $defaults['side_inside_color'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'koromo_settings[side_inside_color]',
				array(
					'label' => __( 'Inside padding', 'koromo' ),
					'section' => 'colors',
					'settings' => 'koromo_settings[side_inside_color]',
					'active_callback' => 'koromo_is_side_padding_active',
				)
			)
		);

		$wp_customize->add_setting(
			'koromo_settings[text_color]', array(
				'default' => $defaults['text_color'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'koromo_settings[text_color]',
				array(
					'label' => __( 'Text Color', 'koromo' ),
					'section' => 'colors',
					'settings' => 'koromo_settings[text_color]'
				)
			)
		);

		$wp_customize->add_setting(
			'koromo_settings[link_color]', array(
				'default' => $defaults['link_color'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'koromo_settings[link_color]',
				array(
					'label' => __( 'Link Color', 'koromo' ),
					'section' => 'colors',
					'settings' => 'koromo_settings[link_color]'
				)
			)
		);

		$wp_customize->add_setting(
			'koromo_settings[link_color_hover]', array(
				'default' => $defaults['link_color_hover'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'koromo_settings[link_color_hover]',
				array(
					'label' => __( 'Link Color Hover', 'koromo' ),
					'section' => 'colors',
					'settings' => 'koromo_settings[link_color_hover]'
				)
			)
		);

		$wp_customize->add_setting(
			'koromo_settings[link_color_visited]', array(
				'default' => $defaults['link_color_visited'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_hex_color',
				'transport' => 'refresh',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'koromo_settings[link_color_visited]',
				array(
					'label' => __( 'Link Color Visited', 'koromo' ),
					'section' => 'colors',
					'settings' => 'koromo_settings[link_color_visited]'
				)
			)
		);

		if ( ! function_exists( 'koromo_colors_customize_register' ) && ! defined( 'KOROMO_PREMIUM_VERSION' ) ) {
			$wp_customize->add_control(
				new Koromo_Customize_Misc_Control(
					$wp_customize,
					'colors_get_addon_desc',
					array(
						'section' => 'colors',
						'type' => 'addon',
						'label' => __( 'More info', 'koromo' ),
						'description' => __( 'More colors are available in Koromo premium version. Visit wpkoi.com for more info.', 'koromo' ),
						'url' => esc_url( KOROMO_THEME_URL ),
						'priority' => 30,
						'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname'
					)
				)
			);
		}

		if ( class_exists( 'WP_Customize_Panel' ) ) {
			if ( ! $wp_customize->get_panel( 'koromo_layout_panel' ) ) {
				$wp_customize->add_panel( 'koromo_layout_panel', array(
					'priority' => 25,
					'title' => __( 'Layout', 'koromo' ),
				) );
			}
		}

		// Add Layout section
		$wp_customize->add_section(
			'koromo_layout_container',
			array(
				'title' => __( 'Container', 'koromo' ),
				'priority' => 10,
				'panel' => 'koromo_layout_panel'
			)
		);

		// Container width
		$wp_customize->add_setting(
			'koromo_settings[container_width]',
			array(
				'default' => $defaults['container_width'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_integer',
				'transport' => 'postMessage'
			)
		);

		$wp_customize->add_control(
			new Koromo_Range_Slider_Control(
				$wp_customize,
				'koromo_settings[container_width]',
				array(
					'type' => 'koromo-range-slider',
					'label' => __( 'Container Width', 'koromo' ),
					'section' => 'koromo_layout_container',
					'settings' => array(
						'desktop' => 'koromo_settings[container_width]',
					),
					'choices' => array(
						'desktop' => array(
							'min' => 700,
							'max' => 2000,
							'step' => 5,
							'edit' => true,
							'unit' => 'px',
						),
					),
					'priority' => 0,
				)
			)
		);

		// Add Top Bar section
		$wp_customize->add_section(
			'koromo_top_bar',
			array(
				'title' => __( 'Top Bar', 'koromo' ),
				'priority' => 15,
				'panel' => 'koromo_layout_panel',
			)
		);

		// Add Top Bar width
		$wp_customize->add_setting(
			'koromo_settings[top_bar_width]',
			array(
				'default' => $defaults['top_bar_width'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add Top Bar width control
		$wp_customize->add_control(
			'koromo_settings[top_bar_width]',
			array(
				'type' => 'select',
				'label' => __( 'Top Bar Width', 'koromo' ),
				'section' => 'koromo_top_bar',
				'choices' => array(
					'full' => __( 'Full', 'koromo' ),
					'contained' => __( 'Contained', 'koromo' )
				),
				'settings' => 'koromo_settings[top_bar_width]',
				'priority' => 5,
				'active_callback' => 'koromo_is_top_bar_active',
			)
		);

		// Add Top Bar inner width
		$wp_customize->add_setting(
			'koromo_settings[top_bar_inner_width]',
			array(
				'default' => $defaults['top_bar_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add Top Bar width control
		$wp_customize->add_control(
			'koromo_settings[top_bar_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Top Bar Inner Width', 'koromo' ),
				'section' => 'koromo_top_bar',
				'choices' => array(
					'full' => __( 'Full', 'koromo' ),
					'contained' => __( 'Contained', 'koromo' )
				),
				'settings' => 'koromo_settings[top_bar_inner_width]',
				'priority' => 10,
				'active_callback' => 'koromo_is_top_bar_active',
			)
		);

		// Add top bar alignment
		$wp_customize->add_setting(
			'koromo_settings[top_bar_alignment]',
			array(
				'default' => $defaults['top_bar_alignment'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'koromo_settings[top_bar_alignment]',
			array(
				'type' => 'select',
				'label' => __( 'Top Bar Alignment', 'koromo' ),
				'section' => 'koromo_top_bar',
				'choices' => array(
					'left' => __( 'Left', 'koromo' ),
					'center' => __( 'Center', 'koromo' ),
					'right' => __( 'Right', 'koromo' )
				),
				'settings' => 'koromo_settings[top_bar_alignment]',
				'priority' => 15,
				'active_callback' => 'koromo_is_top_bar_active',
			)
		);

		// Add Header section
		$wp_customize->add_section(
			'koromo_layout_header',
			array(
				'title' => __( 'Header', 'koromo' ),
				'priority' => 20,
				'panel' => 'koromo_layout_panel'
			)
		);

		// Add Header Layout setting
		$wp_customize->add_setting(
			'koromo_settings[header_layout_setting]',
			array(
				'default' => $defaults['header_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add Header Layout control
		$wp_customize->add_control(
			'koromo_settings[header_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Header Width', 'koromo' ),
				'section' => 'koromo_layout_header',
				'choices' => array(
					'fluid-header' => __( 'Full', 'koromo' ),
					'contained-header' => __( 'Contained', 'koromo' )
				),
				'settings' => 'koromo_settings[header_layout_setting]',
				'priority' => 5
			)
		);

		// Add Inside Header Layout setting
		$wp_customize->add_setting(
			'koromo_settings[header_inner_width]',
			array(
				'default' => $defaults['header_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add Header Layout control
		$wp_customize->add_control(
			'koromo_settings[header_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Inner Header Width', 'koromo' ),
				'section' => 'koromo_layout_header',
				'choices' => array(
					'contained' => __( 'Contained', 'koromo' ),
					'full-width' => __( 'Full', 'koromo' )
				),
				'settings' => 'koromo_settings[header_inner_width]',
				'priority' => 6
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'koromo_settings[header_alignment_setting]',
			array(
				'default' => $defaults['header_alignment_setting'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'koromo_settings[header_alignment_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Header Alignment', 'koromo' ),
				'section' => 'koromo_layout_header',
				'choices' => array(
					'left' => __( 'Left', 'koromo' ),
					'center' => __( 'Center', 'koromo' ),
					'right' => __( 'Right', 'koromo' )
				),
				'settings' => 'koromo_settings[header_alignment_setting]',
				'priority' => 10
			)
		);

		$wp_customize->add_section(
			'koromo_layout_navigation',
			array(
				'title' => __( 'Primary Navigation', 'koromo' ),
				'priority' => 30,
				'panel' => 'koromo_layout_panel'
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'koromo_settings[nav_layout_setting]',
			array(
				'default' => $defaults['nav_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'koromo_settings[nav_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Width', 'koromo' ),
				'section' => 'koromo_layout_navigation',
				'choices' => array(
					'fluid-nav' => __( 'Full', 'koromo' ),
					'contained-nav' => __( 'Contained', 'koromo' )
				),
				'settings' => 'koromo_settings[nav_layout_setting]',
				'priority' => 15
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'koromo_settings[nav_inner_width]',
			array(
				'default' => $defaults['nav_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'koromo_settings[nav_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Inner Navigation Width', 'koromo' ),
				'section' => 'koromo_layout_navigation',
				'choices' => array(
					'contained' => __( 'Contained', 'koromo' ),
					'full-width' => __( 'Full', 'koromo' )
				),
				'settings' => 'koromo_settings[nav_inner_width]',
				'priority' => 16
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'koromo_settings[nav_alignment_setting]',
			array(
				'default' => $defaults['nav_alignment_setting'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'koromo_settings[nav_alignment_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Alignment', 'koromo' ),
				'section' => 'koromo_layout_navigation',
				'choices' => array(
					'left' => __( 'Left', 'koromo' ),
					'center' => __( 'Center', 'koromo' ),
					'right' => __( 'Right', 'koromo' )
				),
				'settings' => 'koromo_settings[nav_alignment_setting]',
				'priority' => 20
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'koromo_settings[nav_position_setting]',
			array(
				'default' => $defaults['nav_position_setting'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices',
				'transport' => ( '' !== koromo_get_setting( 'nav_position_setting' ) ) ? 'postMessage' : 'refresh'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'koromo_settings[nav_position_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Location', 'koromo' ),
				'section' => 'koromo_layout_navigation',
				'choices' => array(
					'nav-below-header' => __( 'Below Header', 'koromo' ),
					'nav-above-header' => __( 'Above Header', 'koromo' ),
					'nav-float-right' => __( 'Float Right', 'koromo' ),
					'nav-float-left' => __( 'Float Left', 'koromo' ),
					'nav-left-sidebar' => __( 'Left Sidebar', 'koromo' ),
					'nav-right-sidebar' => __( 'Right Sidebar', 'koromo' ),
					'' => __( 'No Navigation', 'koromo' )
				),
				'settings' => 'koromo_settings[nav_position_setting]',
				'priority' => 22
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'koromo_settings[nav_dropdown_type]',
			array(
				'default' => $defaults['nav_dropdown_type'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'koromo_settings[nav_dropdown_type]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Dropdown', 'koromo' ),
				'section' => 'koromo_layout_navigation',
				'choices' => array(
					'hover' => __( 'Hover', 'koromo' ),
					'click' => __( 'Click - Menu Item', 'koromo' ),
					'click-arrow' => __( 'Click - Arrow', 'koromo' )
				),
				'settings' => 'koromo_settings[nav_dropdown_type]',
				'priority' => 22
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'koromo_settings[nav_search]',
			array(
				'default' => $defaults['nav_search'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'koromo_settings[nav_search]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Search', 'koromo' ),
				'section' => 'koromo_layout_navigation',
				'choices' => array(
					'enable' => __( 'Enable', 'koromo' ),
					'disable' => __( 'Disable', 'koromo' )
				),
				'settings' => 'koromo_settings[nav_search]',
				'priority' => 23
			)
		);

		// Add content setting
		$wp_customize->add_setting(
			'koromo_settings[content_layout_setting]',
			array(
				'default' => $defaults['content_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add content control
		$wp_customize->add_control(
			'koromo_settings[content_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Content Layout', 'koromo' ),
				'section' => 'koromo_layout_container',
				'choices' => array(
					'separate-containers' => __( 'Separate Containers', 'koromo' ),
					'one-container' => __( 'One Container', 'koromo' )
				),
				'settings' => 'koromo_settings[content_layout_setting]',
				'priority' => 25
			)
		);

		$wp_customize->add_section(
			'koromo_layout_sidecontent',
			array(
				'title' => __( 'Fixed Side Content', 'koromo' ),
				'priority' => 39,
				'panel' => 'koromo_layout_panel'
			)
		);
		
		$wp_customize->add_setting(
			'koromo_settings[fixed_side_content]',
			array(
				'default' => $defaults['fixed_side_content'],
				'type' => 'option',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'koromo_settings[fixed_side_content]',
			array(
				'type' 		 => 'textarea',
				'label'      => __( 'Fixed Side Content', 'koromo' ),
				'description'=> __( 'Content that You want to display fixed on the left.', 'koromo' ),
				'section'    => 'koromo_layout_sidecontent',
				'settings'   => 'koromo_settings[fixed_side_content]',
			)
		);

		$wp_customize->add_section(
			'koromo_layout_sidebars',
			array(
				'title' => __( 'Sidebars', 'koromo' ),
				'priority' => 40,
				'panel' => 'koromo_layout_panel'
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'koromo_settings[layout_setting]',
			array(
				'default' => $defaults['layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices'
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'koromo_settings[layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Sidebar Layout', 'koromo' ),
				'section' => 'koromo_layout_sidebars',
				'choices' => array(
					'left-sidebar' => __( 'Sidebar / Content', 'koromo' ),
					'right-sidebar' => __( 'Content / Sidebar', 'koromo' ),
					'no-sidebar' => __( 'Content (no sidebars)', 'koromo' ),
					'both-sidebars' => __( 'Sidebar / Content / Sidebar', 'koromo' ),
					'both-left' => __( 'Sidebar / Sidebar / Content', 'koromo' ),
					'both-right' => __( 'Content / Sidebar / Sidebar', 'koromo' )
				),
				'settings' => 'koromo_settings[layout_setting]',
				'priority' => 30
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'koromo_settings[blog_layout_setting]',
			array(
				'default' => $defaults['blog_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices'
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'koromo_settings[blog_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Blog Sidebar Layout', 'koromo' ),
				'section' => 'koromo_layout_sidebars',
				'choices' => array(
					'left-sidebar' => __( 'Sidebar / Content', 'koromo' ),
					'right-sidebar' => __( 'Content / Sidebar', 'koromo' ),
					'no-sidebar' => __( 'Content (no sidebars)', 'koromo' ),
					'both-sidebars' => __( 'Sidebar / Content / Sidebar', 'koromo' ),
					'both-left' => __( 'Sidebar / Sidebar / Content', 'koromo' ),
					'both-right' => __( 'Content / Sidebar / Sidebar', 'koromo' )
				),
				'settings' => 'koromo_settings[blog_layout_setting]',
				'priority' => 35
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'koromo_settings[single_layout_setting]',
			array(
				'default' => $defaults['single_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices'
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'koromo_settings[single_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Single Post Sidebar Layout', 'koromo' ),
				'section' => 'koromo_layout_sidebars',
				'choices' => array(
					'left-sidebar' => __( 'Sidebar / Content', 'koromo' ),
					'right-sidebar' => __( 'Content / Sidebar', 'koromo' ),
					'no-sidebar' => __( 'Content (no sidebars)', 'koromo' ),
					'both-sidebars' => __( 'Sidebar / Content / Sidebar', 'koromo' ),
					'both-left' => __( 'Sidebar / Sidebar / Content', 'koromo' ),
					'both-right' => __( 'Content / Sidebar / Sidebar', 'koromo' )
				),
				'settings' => 'koromo_settings[single_layout_setting]',
				'priority' => 36
			)
		);

		$wp_customize->add_section(
			'koromo_layout_footer',
			array(
				'title' => __( 'Footer', 'koromo' ),
				'priority' => 50,
				'panel' => 'koromo_layout_panel'
			)
		);

		// Add footer setting
		$wp_customize->add_setting(
			'koromo_settings[footer_layout_setting]',
			array(
				'default' => $defaults['footer_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add content control
		$wp_customize->add_control(
			'koromo_settings[footer_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Footer Width', 'koromo' ),
				'section' => 'koromo_layout_footer',
				'choices' => array(
					'fluid-footer' => __( 'Full', 'koromo' ),
					'contained-footer' => __( 'Contained', 'koromo' )
				),
				'settings' => 'koromo_settings[footer_layout_setting]',
				'priority' => 40
			)
		);

		// Add footer setting
		$wp_customize->add_setting(
			'koromo_settings[footer_widgets_inner_width]',
			array(
				'default' => $defaults['footer_widgets_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices',
			)
		);

		// Add content control
		$wp_customize->add_control(
			'koromo_settings[footer_widgets_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Inner Footer Widgets Width', 'koromo' ),
				'section' => 'koromo_layout_footer',
				'choices' => array(
					'contained' => __( 'Contained', 'koromo' ),
					'full-width' => __( 'Full', 'koromo' )
				),
				'settings' => 'koromo_settings[footer_widgets_inner_width]',
				'priority' => 41
			)
		);

		// Add footer setting
		$wp_customize->add_setting(
			'koromo_settings[footer_inner_width]',
			array(
				'default' => $defaults['footer_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add content control
		$wp_customize->add_control(
			'koromo_settings[footer_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Inner Footer Width', 'koromo' ),
				'section' => 'koromo_layout_footer',
				'choices' => array(
					'contained' => __( 'Contained', 'koromo' ),
					'full-width' => __( 'Full', 'koromo' )
				),
				'settings' => 'koromo_settings[footer_inner_width]',
				'priority' => 41
			)
		);

		// Add footer widget setting
		$wp_customize->add_setting(
			'koromo_settings[footer_widget_setting]',
			array(
				'default' => $defaults['footer_widget_setting'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add footer widget control
		$wp_customize->add_control(
			'koromo_settings[footer_widget_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Footer Widgets', 'koromo' ),
				'section' => 'koromo_layout_footer',
				'choices' => array(
					'0' => '0',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5'
				),
				'settings' => 'koromo_settings[footer_widget_setting]',
				'priority' => 45
			)
		);

		// Copyright
		$wp_customize->add_setting(
			'koromo_settings[footer_copyright]',
			array(
				'default' => $defaults['footer_copyright'],
				'type' => 'option',
				'sanitize_callback' => 'wp_kses_post',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'koromo_settings[footer_copyright]',
			array(
				'type' 		 => 'textarea',
				'label'      => __( 'Copyright', 'koromo' ),
				'section'    => 'koromo_layout_footer',
				'settings'   => 'koromo_settings[footer_copyright]',
				'priority' => 50,
			)
		);

		// Add footer widget setting
		$wp_customize->add_setting(
			'koromo_settings[footer_bar_alignment]',
			array(
				'default' => $defaults['footer_bar_alignment'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add footer widget control
		$wp_customize->add_control(
			'koromo_settings[footer_bar_alignment]',
			array(
				'type' => 'select',
				'label' => __( 'Footer Bar Alignment', 'koromo' ),
				'section' => 'koromo_layout_footer',
				'choices' => array(
					'left' => __( 'Left','koromo' ),
					'center' => __( 'Center','koromo' ),
					'right' => __( 'Right','koromo' )
				),
				'settings' => 'koromo_settings[footer_bar_alignment]',
				'priority' => 47,
				'active_callback' => 'koromo_is_footer_bar_active'
			)
		);

		// Add back to top setting
		$wp_customize->add_setting(
			'koromo_settings[back_to_top]',
			array(
				'default' => $defaults['back_to_top'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_choices'
			)
		);

		// Add content control
		$wp_customize->add_control(
			'koromo_settings[back_to_top]',
			array(
				'type' => 'select',
				'label' => __( 'Back to Top Button', 'koromo' ),
				'section' => 'koromo_layout_footer',
				'choices' => array(
					'enable' => __( 'Enable', 'koromo' ),
					'' => __( 'Disable', 'koromo' )
				),
				'settings' => 'koromo_settings[back_to_top]',
				'priority' => 50
			)
		);

		// Add Layout section
		$wp_customize->add_section(
			'koromo_blog_section',
			array(
				'title' => __( 'Blog', 'koromo' ),
				'priority' => 55,
				'panel' => 'koromo_layout_panel'
			)
		);

		$wp_customize->add_setting(
			'koromo_settings[blog_header_image]',
			array(
				'default' => $defaults['blog_header_image'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'koromo_settings[blog_header_image]',
				array(
					'label' => __( 'Blog Header image', 'koromo' ),
					'section' => 'koromo_blog_section',
					'settings' => 'koromo_settings[blog_header_image]',
				)
			)
		);

		// Blog header texts
		$wp_customize->add_setting(
			'koromo_settings[blog_header_title]',
			array(
				'default' => $defaults['blog_header_title'],
				'type' => 'option',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'koromo_settings[blog_header_title]',
			array(
				'type' 		 => 'textarea',
				'label'      => __( 'Blog Header title', 'koromo' ),
				'section'    => 'koromo_blog_section',
				'settings'   => 'koromo_settings[blog_header_title]',
			)
		);
		
		$wp_customize->add_setting(
			'koromo_settings[blog_header_text]',
			array(
				'default' => $defaults['blog_header_text'],
				'type' => 'option',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'koromo_settings[blog_header_text]',
			array(
				'type' 		 => 'textarea',
				'label'      => __( 'Blog Header text', 'koromo' ),
				'section'    => 'koromo_blog_section',
				'settings'   => 'koromo_settings[blog_header_text]',
			)
		);
		
		$wp_customize->add_setting(
			'koromo_settings[blog_header_button_text]',
			array(
				'default' => $defaults['blog_header_button_text'],
				'type' => 'option',
				'sanitize_callback' => 'esc_html',
			)
		);

		$wp_customize->add_control(
			'koromo_settings[blog_header_button_text]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Blog Header button text', 'koromo' ),
				'section'    => 'koromo_blog_section',
				'settings'   => 'koromo_settings[blog_header_button_text]',
			)
		);
		
		$wp_customize->add_setting(
			'koromo_settings[blog_header_button_url]',
			array(
				'default' => $defaults['blog_header_button_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'koromo_settings[blog_header_button_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Blog Header button url', 'koromo' ),
				'section'    => 'koromo_blog_section',
				'settings'   => 'koromo_settings[blog_header_button_url]',
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'koromo_settings[post_content]',
			array(
				'default' => $defaults['post_content'],
				'type' => 'option',
				'sanitize_callback' => 'koromo_sanitize_blog_excerpt'
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'blog_content_control',
			array(
				'type' => 'select',
				'label' => __( 'Content Type', 'koromo' ),
				'section' => 'koromo_blog_section',
				'choices' => array(
					'full' => __( 'Full', 'koromo' ),
					'excerpt' => __( 'Excerpt', 'koromo' )
				),
				'settings' => 'koromo_settings[post_content]',
				'priority' => 10
			)
		);

		if ( ! function_exists( 'koromo_blog_customize_register' ) && ! defined( 'KOROMO_PREMIUM_VERSION' ) ) {
			$wp_customize->add_control(
				new Koromo_Customize_Misc_Control(
					$wp_customize,
					'blog_get_addon_desc',
					array(
						'section' => 'koromo_blog_section',
						'type' => 'addon',
						'label' => __( 'Learn more', 'koromo' ),
						'description' => __( 'More options are available for this section in our premium version.', 'koromo' ),
						'url' => esc_url( KOROMO_THEME_URL ),
						'priority' => 30,
						'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname'
					)
				)
			);
		}

		// Add Performance section
		$wp_customize->add_section(
			'koromo_general_section',
			array(
				'title' => __( 'General', 'koromo' ),
				'priority' => 99
			)
		);

		if ( ! apply_filters( 'koromo_fontawesome_essentials', false ) ) {
			$wp_customize->add_setting(
				'koromo_settings[font_awesome_essentials]',
				array(
					'default' => $defaults['font_awesome_essentials'],
					'type' => 'option',
					'sanitize_callback' => 'koromo_sanitize_checkbox'
				)
			);

			$wp_customize->add_control(
				'koromo_settings[font_awesome_essentials]',
				array(
					'type' => 'checkbox',
					'label' => __( 'Load essential icons only', 'koromo' ),
					'description' => __( 'Load essential Font Awesome icons instead of the full library.', 'koromo' ),
					'section' => 'koromo_general_section',
					'settings' => 'koromo_settings[font_awesome_essentials]',
				)
			);
		}

		// Add Koromo Premium section
		if ( ! defined( 'KOROMO_PREMIUM_VERSION' ) ) {
			$wp_customize->add_section(
				new Koromo_Upsell_Section( $wp_customize, 'koromo_upsell_section',
					array(
						'pro_text' => __( 'Get Premium for more!', 'koromo' ),
						'pro_url' => esc_url( KOROMO_THEME_URL ),
						'capability' => 'edit_theme_options',
						'priority' => 555,
						'type' => 'koromo-upsell-section',
					)
				)
			);
		}
	}
}

if ( ! function_exists( 'koromo_customizer_live_preview' ) ) {
	add_action( 'customize_preview_init', 'koromo_customizer_live_preview', 100 );
	/**
	 * Add our live preview scripts
	 *
	 */
	function koromo_customizer_live_preview() {
		wp_enqueue_script( 'koromo-themecustomizer', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/controls/js/customizer-live-preview.js', array( 'customize-preview' ), KOROMO_VERSION, true );
	}
}
