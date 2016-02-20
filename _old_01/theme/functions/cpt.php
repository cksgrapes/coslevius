<?php
/*--------------------------------------------------------
  カスタム投稿タイプの追加
--------------------------------------------------------*/
add_action('init','add_information_post_type');
function add_information_post_type() {
    $param = array(
        'labels' => array(
            'name'               => '更新履歴',
            'singular_name'      => '更新履歴',
            'add_new'            => '新規追加',
            'add_new_item'       => '記事を新規追加',
            'edit_item'          => '記事を編集する',
            'new_item'           => '新規追加',
            'all_items'          => '記事一覧',
            'view_item'          => '記事を表示',
            'search_items'       => '検索する',
            'not_found'          => '記事が見つかりませんでした。',
            'not_found_in_trash' => 'ゴミ箱の中に記事が見つかりませんでした。'
        ),
        'public' => true,
        'has_archive' => true,
        'menu_position' => 5,
        'supports' => array('title','editor'),
        // 'rewrite' => true,
        // 'taxonomies' => array('gallery_area','gallery_style','gallery_genre'),
        'rewrite' => array('with_front' => false)
    );
    register_post_type('information',$param);
}
add_action('init','edd_events_post_type');
function edd_events_post_type() {
    $param = array(
        'labels' => array(
            'name'               => 'イベント情報',
            'singular_name'      => 'イベント情報',
            'add_new'            => '新規追加',
            'add_new_item'       => '記事を新規追加',
            'edit_item'          => '記事を編集する',
            'new_item'           => '新規追加',
            'all_items'          => '記事一覧',
            'view_item'          => '記事を表示',
            'search_items'       => '検索する',
            'not_found'          => '記事が見つかりませんでした。',
            'not_found_in_trash' => 'ゴミ箱の中に記事が見つかりませんでした。'
        ),
        'public' => true,
        'has_archive' => true,
        'menu_position' => 5,
        'supports' => array('title','editor'),
        // 'rewrite' => true,
        // 'taxonomies' => array('gallery_area','gallery_style','gallery_genre'),
        'rewrite' => array('with_front' => false)
    );
    register_post_type('events',$param);
}
add_action('init','edd_report_post_type');
function edd_report_post_type() {
    $param = array(
        'labels' => array(
            'name'               => 'イベントレポート',
            'singular_name'      => 'イベントレポート',
            'add_new'            => '新規追加',
            'add_new_item'       => '記事を新規追加',
            'edit_item'          => '記事を編集する',
            'new_item'           => '新規追加',
            'all_items'          => '記事一覧',
            'view_item'          => '記事を表示',
            'search_items'       => '検索する',
            'not_found'          => '記事が見つかりませんでした。',
            'not_found_in_trash' => 'ゴミ箱の中に記事が見つかりませんでした。'
        ),
        'public' => true,
        'has_archive' => true,
        'menu_position' => 5,
        'supports' => array('title','editor','thumbnail'),
        // 'rewrite' => true,
        'taxonomies' => array('report_cat'),
        'rewrite' => array('with_front' => false)
    );
    register_post_type('report',$param);
}
/*--------------------------------------------------------
  カスタムタクソノミーの追加
--------------------------------------------------------*/
add_action('init','create_report_taxonomies');
function create_report_taxonomies() {
    $labels = array(
        'name'                => 'カテゴリ',
        'singular_name'       => 'カテゴリ',
        'search_items'        => 'カテゴリを検索',
        'all_items'           => '全てのカテゴリ',
        'parent_item'         => '親カテゴリ',
        'parent_item_colon'   => '親カテゴリ:',
        'edit_item'           => 'カテゴリを編集',
        'update_item'         => 'カテゴリを更新',
        'add_new_item'        => '新規カテゴリを追加',
        'new_item_name'       => '新規カテゴリ',
        'menu_name'           => 'カテゴリ'
    );
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'rewrite' => array('slug' => 'report-category')
    );
    register_taxonomy( 'report_cat','report', $args );
}
