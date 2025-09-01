<?php
// 1. Theme setup
function mytheme_setup() {
    // title tag, thumbnails, etc.
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );

    // enable Excerpt field on Pages
    add_post_type_support( 'page', 'excerpt' );
}
add_action( 'after_setup_theme', 'mytheme_setup' );

// 2. Enqueue styles
function mytheme_enqueue_assets() {
    wp_enqueue_style( 'mytheme-style', get_stylesheet_uri() );
    wp_enqueue_style( 'mytheme-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [], '1.0'
    );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_assets' );
