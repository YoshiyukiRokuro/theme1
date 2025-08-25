<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <header id="masthead" class="site-header">
        <div class="container">
            <div class="header-content">
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) {
                        echo '<div class="site-logo">';
                        the_custom_logo();
                        echo '</div>';
                    } else {
                        echo '<h1 class="site-title"><a href="' . esc_url(home_url('/')) . '" rel="home">' . get_bloginfo('name') . '</a></h1>';
                    }
                    ?>
                </div>
                
                <nav id="site-navigation" class="main-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'fallback_cb'    => 'theme1_fallback_menu',
                    ));
                    ?>
                </nav>
            </div>
        </div>
    </header>

    <div id="content" class="site-content">
    
<?php
/**
 * Fallback menu if no menu is assigned
 */
function theme1_fallback_menu() {
    echo '<ul id="primary-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . __('Home', 'theme1') . '</a></li>';
    echo '<li><a href="#about">' . __('About', 'theme1') . '</a></li>';
    echo '<li><a href="#news">' . __('News', 'theme1') . '</a></li>';
    echo '<li><a href="#contact">' . __('Contact', 'theme1') . '</a></li>';
    echo '</ul>';
}
?>