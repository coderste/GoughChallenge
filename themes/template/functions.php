<?php
/**
 * Sets up Theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Template Theme 1.0
 */

function theme_setup() {
    // Register the Navbar for this Theme
    register_nav_menus(
        array(
            'primary' => 'Primary Navbar',
            'footer' => 'Footer Navbar',
        )
    );

    // Add featured image support
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'theme_setup');

/**
 * Enqueues scripts and styles
 */
function theme_scripts() {
    // Main Stylesheet
    wp_enqueue_style( 'style', get_stylesheet_uri() );

    // Register Custom JavaScripts
    wp_register_script('app-js', get_theme_file_uri( '/assets/js/app.js' ), array( 'jquery' ), '', true);

    // Enqueue Custom JavaScripts
    wp_enqueue_script('app-js');
}
add_action('wp_enqueue_scripts', 'theme_scripts');

?>