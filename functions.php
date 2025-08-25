<?php
/**
 * Theme1 Functions and Definitions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Theme setup
 */
function theme1_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 50,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Register navigation menu
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'theme1'),
    ));
    
    // Add support for HTML5 markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'theme1_setup');

/**
 * Enqueue scripts and styles
 */
function theme1_scripts() {
    wp_enqueue_style('theme1-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_script('theme1-script', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'theme1_scripts');

/**
 * Customizer additions
 */
function theme1_customize_register($wp_customize) {
    // Hero Section Panel
    $wp_customize->add_panel('hero_panel', array(
        'title'       => __('Hero Section', 'theme1'),
        'description' => __('Customize the hero section of your homepage', 'theme1'),
        'priority'    => 30,
    ));
    
    // Hero Image Section
    $wp_customize->add_section('hero_image_section', array(
        'title'       => __('Hero Image', 'theme1'),
        'panel'       => 'hero_panel',
        'priority'    => 10,
    ));
    
    $wp_customize->add_setting('hero_background_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_background_image', array(
        'label'    => __('Hero Background Image', 'theme1'),
        'section'  => 'hero_image_section',
        'settings' => 'hero_background_image',
    )));
    
    // Hero Content Section
    $wp_customize->add_section('hero_content_section', array(
        'title'       => __('Hero Content', 'theme1'),
        'panel'       => 'hero_panel',
        'priority'    => 20,
    ));
    
    // Hero Title
    $wp_customize->add_setting('hero_title', array(
        'default'           => __('Welcome to Our Site', 'theme1'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label'    => __('Hero Title', 'theme1'),
        'section'  => 'hero_content_section',
        'type'     => 'text',
    ));
    
    // Hero Subtitle
    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => __('Discover the beauty of Japanese design and culture', 'theme1'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label'    => __('Hero Subtitle', 'theme1'),
        'section'  => 'hero_content_section',
        'type'     => 'textarea',
    ));
    
    // Hero CTA Button Text
    $wp_customize->add_setting('hero_cta_text', array(
        'default'           => __('Learn More', 'theme1'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_cta_text', array(
        'label'    => __('CTA Button Text', 'theme1'),
        'section'  => 'hero_content_section',
        'type'     => 'text',
    ));
    
    // Hero CTA Button URL
    $wp_customize->add_setting('hero_cta_url', array(
        'default'           => '#about',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('hero_cta_url', array(
        'label'    => __('CTA Button URL', 'theme1'),
        'section'  => 'hero_content_section',
        'type'     => 'url',
    ));
}
add_action('customize_register', 'theme1_customize_register');

/**
 * Get hero section data
 */
function theme1_get_hero_data() {
    return array(
        'background_image' => get_theme_mod('hero_background_image', ''),
        'title'            => get_theme_mod('hero_title', __('Welcome to Our Site', 'theme1')),
        'subtitle'         => get_theme_mod('hero_subtitle', __('Discover the beauty of Japanese design and culture', 'theme1')),
        'cta_text'         => get_theme_mod('hero_cta_text', __('Learn More', 'theme1')),
        'cta_url'          => get_theme_mod('hero_cta_url', '#about'),
    );
}

/**
 * Custom excerpt length
 */
function theme1_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'theme1_excerpt_length');

/**
 * Custom excerpt more
 */
function theme1_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'theme1_excerpt_more');

/**
 * Add custom body classes
 */
function theme1_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'front-page';
    }
    return $classes;
}
add_filter('body_class', 'theme1_body_classes');