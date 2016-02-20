<?php
/*--------------------------------------------------------
 機能サポート
--------------------------------------------------------*/
// add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );
register_nav_menus( array(
    'global-menu' => 'グローバルメニュー',
    'about-menu' => 'コスレヴィアスとは？'
));
/*--------------------------------------------------------
 ヘッダの不要タグを削除
--------------------------------------------------------*/
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
/*--------------------------------------------------------
  管理バーを非表示
--------------------------------------------------------*/
function my_function_admin_bar(){
return false;
}
add_filter( 'show_admin_bar' , 'my_function_admin_bar');
/*--------------------------------------------------------
  ヘルプを非表示
--------------------------------------------------------*/
function disable_help_link() {
    echo '<style type="text/css">
            #contextual-help-link-wrap {display: none !important;}
          </style>';
}
add_action('admin_head', 'disable_help_link');
