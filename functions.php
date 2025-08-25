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
 * Register widget area
 */
function theme1_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'theme1'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here.', 'theme1'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    // Page widgets area
    register_sidebar(array(
        'name'          => __('Page Sidebar', 'theme1'),
        'id'            => 'page-sidebar',
        'description'   => __('Widget area for pages.', 'theme1'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    // Post widgets area
    register_sidebar(array(
        'name'          => __('Post Sidebar', 'theme1'),
        'id'            => 'post-sidebar',
        'description'   => __('Widget area for posts.', 'theme1'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    // Footer widgets
    register_sidebar(array(
        'name'          => __('Footer Widgets', 'theme1'),
        'id'            => 'footer-widgets',
        'description'   => __('Widget area for footer section.', 'theme1'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'theme1_widgets_init');

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
        'label'    => __('Hero Background Image 1', 'theme1'),
        'section'  => 'hero_image_section',
        'settings' => 'hero_background_image',
    )));
    
    // Hero Image 2
    $wp_customize->add_setting('hero_background_image_2', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_background_image_2', array(
        'label'    => __('Hero Background Image 2', 'theme1'),
        'section'  => 'hero_image_section',
        'settings' => 'hero_background_image_2',
    )));
    
    // Hero Image 3
    $wp_customize->add_setting('hero_background_image_3', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_background_image_3', array(
        'label'    => __('Hero Background Image 3', 'theme1'),
        'section'  => 'hero_image_section',
        'settings' => 'hero_background_image_3',
    )));
    
    // Slideshow Settings
    $wp_customize->add_section('hero_slideshow_section', array(
        'title'       => __('Hero Slideshow Settings', 'theme1'),
        'panel'       => 'hero_panel',
        'priority'    => 15,
    ));
    
    // Enable slideshow
    $wp_customize->add_setting('hero_slideshow_enable', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    
    $wp_customize->add_control('hero_slideshow_enable', array(
        'label'    => __('Enable Slideshow', 'theme1'),
        'section'  => 'hero_slideshow_section',
        'type'     => 'checkbox',
    ));
    
    // Slideshow transition time
    $wp_customize->add_setting('hero_slideshow_speed', array(
        'default'           => 5000,
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('hero_slideshow_speed', array(
        'label'       => __('Slideshow Speed (milliseconds)', 'theme1'),
        'section'     => 'hero_slideshow_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1000,
            'max'  => 10000,
            'step' => 500,
        ),
    ));
    
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
    
    // About Section Panel
    $wp_customize->add_panel('about_panel', array(
        'title'       => __('About Section', 'theme1'),
        'description' => __('Customize the About Us section of your homepage', 'theme1'),
        'priority'    => 40,
    ));
    
    // About Content Section
    $wp_customize->add_section('about_content_section', array(
        'title'       => __('About Content', 'theme1'),
        'panel'       => 'about_panel',
        'priority'    => 10,
    ));
    
    // About Title
    $wp_customize->add_setting('about_title', array(
        'default'           => __('About Us', 'theme1'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('about_title', array(
        'label'    => __('About Section Title', 'theme1'),
        'section'  => 'about_content_section',
        'type'     => 'text',
    ));
    
    // About Content
    $wp_customize->add_setting('about_content', array(
        'default'           => __('We are inspired by the timeless beauty and simplicity of Japanese design. Our approach emphasizes clean lines, thoughtful spacing, and a harmonious balance between tradition and modernity.<br><br>Through careful attention to detail and respect for minimalist principles, we create experiences that resonate with tranquility and elegance.', 'theme1'),
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control('about_content', array(
        'label'    => __('About Content', 'theme1'),
        'section'  => 'about_content_section',
        'type'     => 'textarea',
    ));
    
    // About Image
    $wp_customize->add_setting('about_image', array(
        'default'           => get_template_directory_uri() . '/assets/images/placeholder-about.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_image', array(
        'label'    => __('About Image', 'theme1'),
        'section'  => 'about_content_section',
        'settings' => 'about_image',
    )));
    
    // About Image Alt Text
    $wp_customize->add_setting('about_image_alt', array(
        'default'           => __('About us image', 'theme1'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('about_image_alt', array(
        'label'    => __('About Image Alt Text', 'theme1'),
        'section'  => 'about_content_section',
        'type'     => 'text',
    ));
    
    // Contact Section Panel
    $wp_customize->add_panel('contact_panel', array(
        'title'       => __('Contact & Access Section', 'theme1'),
        'description' => __('Customize the Contact & Access section of your homepage', 'theme1'),
        'priority'    => 50,
    ));
    
    // Contact Content Section
    $wp_customize->add_section('contact_content_section', array(
        'title'       => __('Contact Content', 'theme1'),
        'panel'       => 'contact_panel',
        'priority'    => 10,
    ));
    
    // Contact Title
    $wp_customize->add_setting('contact_title', array(
        'default'           => __('Contact & Access', 'theme1'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('contact_title', array(
        'label'    => __('Contact Section Title', 'theme1'),
        'section'  => 'contact_content_section',
        'type'     => 'text',
    ));
    
    // Contact Subtitle
    $wp_customize->add_setting('contact_subtitle', array(
        'default'           => __('Get in touch with us or visit our location', 'theme1'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('contact_subtitle', array(
        'label'    => __('Contact Section Subtitle', 'theme1'),
        'section'  => 'contact_content_section',
        'type'     => 'text',
    ));
    
    // Contact Address
    $wp_customize->add_setting('contact_address', array(
        'default'           => __('123 Japanese Street<br>Design District<br>Tokyo, Japan 100-0001', 'theme1'),
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control('contact_address', array(
        'label'    => __('Address', 'theme1'),
        'section'  => 'contact_content_section',
        'type'     => 'textarea',
    ));
    
    // Contact Phone
    $wp_customize->add_setting('contact_phone', array(
        'default'           => __('+81-3-1234-5678', 'theme1'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('contact_phone', array(
        'label'    => __('Phone Number', 'theme1'),
        'section'  => 'contact_content_section',
        'type'     => 'text',
    ));
    
    // Contact Email
    $wp_customize->add_setting('contact_email', array(
        'default'           => __('info@theme1.com', 'theme1'),
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('contact_email', array(
        'label'    => __('Email Address', 'theme1'),
        'section'  => 'contact_content_section',
        'type'     => 'email',
    ));
    
    // Contact Hours
    $wp_customize->add_setting('contact_hours', array(
        'default'           => __('9:00 AM - 6:00 PM', 'theme1'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('contact_hours', array(
        'label'    => __('Business Hours', 'theme1'),
        'section'  => 'contact_content_section',
        'type'     => 'text',
    ));
    
    // Contact Access Info
    $wp_customize->add_setting('contact_access_info', array(
        'default'           => __('5 minutes walk from Station A<br>3 minutes walk from Station B<br>Parking available nearby', 'theme1'),
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control('contact_access_info', array(
        'label'    => __('Access Information', 'theme1'),
        'section'  => 'contact_content_section',
        'type'     => 'textarea',
    ));
}
add_action('customize_register', 'theme1_customize_register');

/**
 * Get hero section data
 */
function theme1_get_hero_data() {
    $images = array();
    
    // Collect all hero images
    for ($i = 1; $i <= 3; $i++) {
        $image_key = $i === 1 ? 'hero_background_image' : 'hero_background_image_' . $i;
        $image_url = get_theme_mod($image_key, '');
        if (!empty($image_url)) {
            $images[] = $image_url;
        }
    }
    
    return array(
        'background_image'   => get_theme_mod('hero_background_image', ''),
        'background_images'  => $images,
        'slideshow_enable'   => get_theme_mod('hero_slideshow_enable', false),
        'slideshow_speed'    => get_theme_mod('hero_slideshow_speed', 5000),
        'title'              => get_theme_mod('hero_title', __('Welcome to Our Site', 'theme1')),
        'subtitle'           => get_theme_mod('hero_subtitle', __('Discover the beauty of Japanese design and culture', 'theme1')),
        'cta_text'           => get_theme_mod('hero_cta_text', __('Learn More', 'theme1')),
        'cta_url'            => get_theme_mod('hero_cta_url', '#about'),
    );
}

/**
 * Get about section data
 */
function theme1_get_about_data() {
    return array(
        'title'     => get_theme_mod('about_title', __('About Us', 'theme1')),
        'content'   => get_theme_mod('about_content', __('We are inspired by the timeless beauty and simplicity of Japanese design. Our approach emphasizes clean lines, thoughtful spacing, and a harmonious balance between tradition and modernity.<br><br>Through careful attention to detail and respect for minimalist principles, we create experiences that resonate with tranquility and elegance.', 'theme1')),
        'image'     => get_theme_mod('about_image', get_template_directory_uri() . '/assets/images/placeholder-about.jpg'),
        'image_alt' => get_theme_mod('about_image_alt', __('About us image', 'theme1')),
    );
}

/**
 * Get contact section data
 */
function theme1_get_contact_data() {
    return array(
        'title'       => get_theme_mod('contact_title', __('Contact & Access', 'theme1')),
        'subtitle'    => get_theme_mod('contact_subtitle', __('Get in touch with us or visit our location', 'theme1')),
        'address'     => get_theme_mod('contact_address', __('123 Japanese Street<br>Design District<br>Tokyo, Japan 100-0001', 'theme1')),
        'phone'       => get_theme_mod('contact_phone', __('+81-3-1234-5678', 'theme1')),
        'email'       => get_theme_mod('contact_email', __('info@theme1.com', 'theme1')),
        'hours'       => get_theme_mod('contact_hours', __('9:00 AM - 6:00 PM', 'theme1')),
        'access_info' => get_theme_mod('contact_access_info', __('5 minutes walk from Station A<br>3 minutes walk from Station B<br>Parking available nearby', 'theme1')),
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