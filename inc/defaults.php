<?php
/**
 * Sets all of our theme defaults.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'koromo_get_defaults' ) ) {
	/**
	 * Set default options
	 *
	 */
	function koromo_get_defaults() {
		$koromo_defaults = array(
			'hide_title' => '',
			'hide_tagline' => true,
			'top_bar_width' => 'full',
			'top_bar_inner_width' => 'full',
			'top_bar_alignment' => 'left',
			'container_width' => '1140',
			'header_layout_setting' => 'fluid-header',
			'header_inner_width' => 'contained',
			'nav_alignment_setting' => 'right',
			'header_alignment_setting' => 'left',
			'nav_layout_setting' => 'fluid-nav',
			'nav_inner_width' => 'contained',
			'nav_position_setting' => 'nav-float-right',
			'nav_dropdown_type' => 'hover',
			'nav_search' => 'enable',
			'content_layout_setting' => 'separate-containers',
			'layout_setting' => 'no-sidebar',
			'blog_layout_setting' => 'right-sidebar',
			'single_layout_setting' => 'right-sidebar',
			'fixed_side_content' => '',
			'blog_header_image' => '',
			'blog_header_title' => '',
			'blog_header_text' => '',
			'blog_header_button_text' => '',
			'blog_header_button_url' => '',
			'post_content' => 'excerpt',
			'footer_layout_setting' => 'fluid-footer',
			'footer_widgets_inner_width' => 'contained',
			'footer_inner_width' => 'full-width',
			'footer_widget_setting' => '4',
			'footer_copyright' => __( '&copy; 2018 All rights reserved.', 'koromo' ),
			'footer_bar_alignment' => 'right',
			'back_to_top' => 'enable',
			'side_inside_color' => '#111111',
			'text_color' => '#cccccc',
			'link_color' => '#ffffff',
			'link_color_hover' => '#cccccc',
			'link_color_visited' => '',
			'font_awesome_essentials' => true,
		);

		return apply_filters( 'koromo_option_defaults', $koromo_defaults );
	}
}

if ( ! function_exists( 'koromo_get_color_defaults' ) ) {
	/**
	 * Set default options
	 */
	function koromo_get_color_defaults() {
		$koromo_color_defaults = array(
			'top_bar_background_color' => '#ffffff',
			'top_bar_text_color' => '#111111',
			'top_bar_link_color' => '#111111',
			'top_bar_link_color_hover' => '#888888',
			'header_background_color' => '',
			'header_text_color' => '',
			'header_link_color' => '',
			'header_link_hover_color' => '',
			'site_title_color' => '',
			'site_tagline_color' => '',
			'navigation_background_color' => '#111111',
			'navigation_text_color' => '#ffffff',
			'navigation_background_hover_color' => '',
			'navigation_text_hover_color' => '#cccccc',
			'navigation_background_current_color' => '',
			'navigation_text_current_color' => '#cccccc',
			'subnavigation_background_color' => '#333333',
			'subnavigation_text_color' => '#ffffff',
			'subnavigation_background_hover_color' => '',
			'subnavigation_text_hover_color' => '#cccccc',
			'subnavigation_background_current_color' => '',
			'subnavigation_text_current_color' => '#cccccc',
			'fixed_side_content_background_color' => '',
			'fixed_side_content_text_color' => '#111111',
			'fixed_side_content_link_color' => '#888888',
			'fixed_side_content_link_hover_color' => '#111111',
			'content_background_color' => '',
			'content_text_color' => '',
			'content_link_color' => '',
			'content_link_hover_color' => '',
			'content_title_color' => '',
			'blog_post_title_color' => '',
			'blog_post_title_hover_color' => '',
			'entry_meta_text_color' => '',
			'entry_meta_link_color' => '',
			'entry_meta_link_color_hover' => '',
			'h1_color' => '#ffffff',
			'h2_color' => '#ffffff',
			'h3_color' => '#ffffff',
			'h4_color' => '',
			'h5_color' => '',
			'h6_color' => '',
			'sidebar_widget_background_color' => '#333333',
			'sidebar_widget_text_color' => '',
			'sidebar_widget_link_color' => '',
			'sidebar_widget_link_hover_color' => '',
			'sidebar_widget_title_color' => '',
			'footer_widget_background_color' => '#333333',
			'footer_widget_text_color' => '#ffffff',
			'footer_widget_link_color' => '#cccccc',
			'footer_widget_link_hover_color' => '#ffffff',
			'footer_widget_title_color' => '#ffffff',
			'footer_background_color' => '#ffffff',
			'footer_text_color' => '#111111',
			'footer_link_color' => '#111111',
			'footer_link_hover_color' => '#555555',
			'form_background_color' => '#fafafa',
			'form_text_color' => '#555555',
			'form_background_color_focus' => '#ffffff',
			'form_text_color_focus' => '#555555',
			'form_border_color' => '#cccccc',
			'form_border_color_focus' => '#bfbfbf',
			'form_button_background_color' => '#ffffff',
			'form_button_background_color_hover' => '#cccccc',
			'form_button_text_color' => '#111111',
			'form_button_text_color_hover' => '#111111',
			'back_to_top_background_color' => '#cccccc',
			'back_to_top_background_color_hover' => '#ffffff',
			'back_to_top_text_color' => '#111111',
			'back_to_top_text_color_hover' => '#111111',
		);

		return apply_filters( 'koromo_color_option_defaults', $koromo_color_defaults );
	}
}

if ( ! function_exists( 'koromo_get_default_fonts' ) ) {
	/**
	 * Set default options.
	 *
	 *
	 * @param bool $filter Whether to return the filtered values or original values.
	 * @return array Option defaults.
	 */
	function koromo_get_default_fonts( $filter = true ) {
		$koromo_font_defaults = array(
			'font_body' => 'Oswald',
			'font_body_category' => '',
			'font_body_variants' => '300,regular,500,700',
			'body_font_weight' => 'normal',
			'body_font_transform' => 'none',
			'body_font_size' => '19',
			'body_line_height' => '1.5', // no unit
			'paragraph_margin' => '1.5', // em
			'font_top_bar' => 'Fjalla One',
			'font_top_bar_category' => '',
			'font_top_bar_variants' => 'regular',
			'top_bar_font_weight' => 'normal',
			'top_bar_font_transform' => 'none',
			'top_bar_font_size' => '19',
			'font_site_title' => 'Fjalla One',
			'font_site_title_category' => '',
			'font_site_title_variants' => 'regular',
			'site_title_font_weight' => '700',
			'site_title_font_transform' => 'none',
			'site_title_font_size' => '50',
			'mobile_site_title_font_size' => '25',
			'font_site_tagline' => 'inherit',
			'font_site_tagline_category' => '',
			'font_site_tagline_variants' => '',
			'site_tagline_font_weight' => 'normal',
			'site_tagline_font_transform' => 'none',
			'site_tagline_font_size' => '15',
			'font_navigation' => 'inherit',
			'font_navigation_category' => '',
			'font_navigation_variants' => '',
			'navigation_font_weight' => 'normal',
			'navigation_font_transform' => 'none',
			'navigation_font_size' => '21',
			'font_widget_title' => 'Fjalla One',
			'font_widget_title_category' => '',
			'font_widget_title_variants' => 'regular',
			'widget_title_font_weight' => 'normal',
			'widget_title_font_transform' => 'none',
			'widget_title_font_size' => '25',
			'widget_title_separator' => '18',
			'widget_content_font_size' => '19',
			'font_buttons' => 'Fjalla One',
			'font_buttons_category' => '',
			'font_buttons_variants' => 'regular',
			'buttons_font_weight' => 'normal',
			'buttons_font_transform' => 'none',
			'buttons_font_size' => '19',
			'font_heading_1' => 'Fjalla One',
			'font_heading_1_category' => '',
			'font_heading_1_variants' => 'regular',
			'heading_1_weight' => 'normal',
			'heading_1_transform' => 'none',
			'heading_1_font_size' => '80',
			'heading_1_line_height' => '1.2', // em
			'mobile_heading_1_font_size' => '30',
			'font_heading_2' => 'Fjalla One',
			'font_heading_2_category' => '',
			'font_heading_2_variants' => 'regular',
			'heading_2_weight' => 'normal',
			'heading_2_transform' => 'none',
			'heading_2_font_size' => '42',
			'heading_2_line_height' => '1.2', // em
			'mobile_heading_2_font_size' => '25',
			'font_heading_3' => 'Fjalla One',
			'font_heading_3_category' => '',
			'font_heading_3_variants' => 'regular',
			'heading_3_weight' => 'normal',
			'heading_3_transform' => 'none',
			'heading_3_font_size' => '25',
			'heading_3_line_height' => '1.2', // em
			'font_heading_4' => 'inherit',
			'font_heading_4_category' => '',
			'font_heading_4_variants' => '',
			'heading_4_weight' => 'normal',
			'heading_4_transform' => 'none',
			'heading_4_font_size' => '',
			'heading_4_line_height' => '', // em
			'font_heading_5' => 'inherit',
			'font_heading_5_category' => '',
			'font_heading_5_variants' => '',
			'heading_5_weight' => 'normal',
			'heading_5_transform' => 'none',
			'heading_5_font_size' => '',
			'heading_5_line_height' => '', // em
			'font_heading_6' => 'inherit',
			'font_heading_6_category' => '',
			'font_heading_6_variants' => '',
			'heading_6_weight' => 'normal',
			'heading_6_transform' => 'none',
			'heading_6_font_size' => '',
			'heading_6_line_height' => '', // em
			'font_footer' => 'Fjalla One',
			'font_footer_category' => '',
			'font_footer_variants' => 'regular',
			'footer_weight' => 'normal',
			'footer_transform' => 'none',
			'footer_font_size' => '18',
			'font_fixed_side' => 'Fjalla One',
			'font_fixed_side_category' => '',
			'font_fixed_side_variants' => 'regular',
			'fixed_side_font_weight' => 'normal',
			'fixed_side_font_transform' => 'none',
			'fixed_side_font_size' => '20',
		);

		if ( $filter ) {
			return apply_filters( 'koromo_font_option_defaults', $koromo_font_defaults );
		}

		return $koromo_font_defaults;
	}
}

if ( ! function_exists( 'koromo_spacing_get_defaults' ) ) {
	/**
	 * Set the default options.
	 *
	 *
	 * @param bool $filter Whether to return the filtered values or original values.
	 * @return array Option defaults.
	 */
	function koromo_spacing_get_defaults( $filter = true ) {
		$koromo_spacing_defaults = array(
			'top_bar_top' => '8',
			'top_bar_right' => '0',
			'top_bar_bottom' => '5',
			'top_bar_left' => '0',
			'header_top' => '25',
			'header_right' => '30',
			'header_bottom' => '10',
			'header_left' => '30',
			'fixed_side_top' => '0',
			'fixed_side_right' => '0',
			'fixed_side_bottom' => '0',
			'fixed_side_left' => '100',
			'menu_item' => '5',
			'menu_item_height' => '65',
			'sub_menu_item_height' => '10',
			'content_top' => '15',
			'content_right' => '15',
			'content_bottom' => '15',
			'content_left' => '15',
			'mobile_content_top' => '15',
			'mobile_content_right' => '15',
			'mobile_content_bottom' => '15',
			'mobile_content_left' => '15',
			'side_top' => '0',
			'side_right' => '30',
			'side_bottom' => '0',
			'side_left' => '30',
			'mobile_side_top' => '10',
			'mobile_side_right' => '10',
			'mobile_side_bottom' => '10',
			'mobile_side_left' => '10',
			'separator' => '15',
			'left_sidebar_width' => '25',
			'right_sidebar_width' => '25',
			'widget_top' => '30',
			'widget_right' => '10',
			'widget_bottom' => '10',
			'widget_left' => '10',
			'footer_widget_container_top' => '60',
			'footer_widget_container_right' => '30',
			'footer_widget_container_bottom' => '40',
			'footer_widget_container_left' => '30',
			'footer_widget_separator' => '30',
			'footer_top' => '8',
			'footer_right' => '0',
			'footer_bottom' => '5',
			'footer_left' => '0',
		);

		if ( $filter ) {
			return apply_filters( 'koromo_spacing_option_defaults', $koromo_spacing_defaults );
		}

		return $koromo_spacing_defaults;
	}
}

if ( ! function_exists( 'koromo_get_default_color_palettes' ) ) {
	/**
	 * Set up our colors for the color picker palettes and filter them so you can change them.
	 *
	 */
	function koromo_get_default_color_palettes() {
		$palettes = array(
			'#ffffff',
			'#111111',
			'#cccccc',
			'#555555',
			'#888888',
			'#0b9444'
		);

		return apply_filters( 'koromo_default_color_palettes', $palettes );
	}
}

if ( ! function_exists( 'koromo_typography_default_fonts' ) ) {
	/**
	 * Set the default system fonts.
	 *
	 */
	function koromo_typography_default_fonts() {
		$fonts = array(
			'inherit',
			'System Stack',
			'Arial, Helvetica, sans-serif',
			'Courier New',
			'Georgia, Times New Roman, Times, serif',
			'Trebuchet MS, Helvetica, sans-serif',
			'Verdana, Geneva, sans-serif',
			'Fjalla One',
			'Oswald'
		);

		return apply_filters( 'koromo_typography_default_fonts', $fonts );
	}
}

define('KOROMO_DEFAULT_FONTS','//fonts.googleapis.com/css?family=Fjalla+One:regular|Oswald:300,regular,500,700');
