<?php
/**
 * Functions file contains all the website functions including:
 * - Navbar Functionality
 * - Advanced Custom Fields ~ Global Options
 *
 * This file is pretty much the same for all our websites.
 */

if ( ! function_exists( 'theme_setup' ) ):

    function theme_setup()
    {

        # Register our Navbar Menus
        register_nav_menus(
            [
                'primary'   => 'Main Navbar',
                'footer'    => 'Footer Navbar',
            ]
        );

        // Theme Support
        add_theme_support( 'post-thumbnails' );

        // Add Title Support - helps with Yoast-SEO
        add_theme_support( 'title-tag' );
    }
    add_action( 'after_setup_theme', 'theme_setup' );

endif;

if ( ! function_exists( 'theme_resources' ) ):

    function theme_resources()
    {
        // Main Framework CSS
        wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css' );

        // Other CSS Files before Main Stylesheet
        // wp_enqueue_style( 'css-file-name', get_theme_file_uri( '/assets/css' ) );

        // Main Stylesheet
        wp_enqueue_style( 'main-css', get_stylesheet_uri() );

        // Main Framework JS
        wp_enqueue_script( 'bootstrap-js', get_theme_file_uri( '/assets/js/bootstrap.js' ), array( 'jquery' ), false, true );

        // Other JS Files (Mainly 3rd Party Sliders etc.)
        wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBvws2fKizxVlhPvpsYITqHr0TmQhwFsIw', '', false, true );

        // Custom JavaScript (Custom Made)
        wp_enqueue_script( 'main-js', get_theme_file_uri( '/assets/js/main.js' ), array( 'jquery' ), false, true );

        // Admin Ajax Localize
        wp_localize_script( 'form-js', 'formAjax',
            array(
                'ajaxurl'   => admin_url( 'admin-ajax.php' ),
            )
        );
    }
    add_action( 'wp_enqueue_scripts', 'theme_resources' );

endif;

/**
 * Functions below are there for security reasons
 * [Do not remove!]
 */

/**
 * Remove ?ver from the end of enqueued files
 * for security reasons
 */
if ( ! function_exists( 'remove_theme_ver' ) ):

    function remove_theme_ver( $url )
    {
        return remove_query_arg( 'ver', $url );
    }
    add_filter( 'style_loader_src', 'remove_theme_ver' );
    add_filter( 'script_loader_src', 'remove_theme_ver' );

endif;

/**
 * Remove the WordPress Generator meta tag
 * from source code for security reasons
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Remove WordPress Emoji's this then removes
 * unnesscary JS files and speeds up the site
 */
if ( ! function_exists( 'disable_emojis' ) ):

    function disable_emojis()
    {
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    }
    add_action( 'init', 'disable_emojis' );
    add_filter( 'emoji_svg_url', '__return_false' );

endif;

/**
 * Advanced Custom Fields
 *
 * Anything below here should be linked to Advanced Custom Fields
 * only
 */