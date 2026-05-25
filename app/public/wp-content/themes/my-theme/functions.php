<?php
// 1. Theme setup
function mytheme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
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

// 3. 詢問表單 Custom Post Type
add_action( 'init', function() {
    register_post_type( 'inquiry', [
        'labels' => [
            'name'          => '詢問表單',
            'singular_name' => '詢問紀錄',
            'menu_name'     => '詢問表單',
            'all_items'     => '所有詢問',
            'view_item'     => '查看詢問',
            'search_items'  => '搜尋詢問',
            'not_found'     => '找不到詢問紀錄',
        ],
        'public'          => false,
        'show_ui'         => true,
        'show_in_menu'    => true,
        'menu_icon'       => 'dashicons-email-alt',
        'supports'        => [ 'title' ],
        'capability_type' => 'post',
        'map_meta_cap'    => true,
    ]);
});

// 4. 後台列表欄位（所有欄位）
add_filter( 'manage_inquiry_posts_columns', function( $cols ) {
    unset( $cols['date'] );
    return [
        'cb'           => $cols['cb'],
        'title'        => '送出時間',
        'inq_name'     => '姓名',
        'inq_phone'    => '手機',
        'inq_email'    => 'Email',
        'inq_industry' => '產業',
        'inq_channel'  => '得知管道',
        'inq_session'  => '預約場次',
        'inq_city'     => '城市',
        'inq_budget'   => '預算',
        'inq_timeline' => '時程',
    ];
});

add_action( 'manage_inquiry_posts_custom_column', function( $col, $post_id ) {
    $map = [
        'inq_name'     => '姓名',
        'inq_phone'    => '手機',
        'inq_email'    => 'Email',
        'inq_industry' => '產業',
        'inq_channel'  => '得知管道',
        'inq_session'  => '預約場次',
        'inq_city'     => '有興趣城市',
        'inq_budget'   => '預算（美金）',
        'inq_timeline' => '購買時程',
    ];
    if ( isset( $map[$col] ) ) {
        echo esc_html( get_post_meta( $post_id, $map[$col], true ) );
    }
}, 10, 2 );