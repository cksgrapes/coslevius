<?php
/*--------------------------------------------------------
  標準の投稿のラベルを変更
--------------------------------------------------------*/
function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'ブログ';
    $submenu['edit.php'][5][0] = '記事一覧';
    $submenu['edit.php'][10][0] = '新規追加';
    $submenu['edit.php'][16][0] = 'タグ';
    //echo ”;
}
function change_post_object_label() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'ブログ';
    $labels->singular_name = 'ブログ';
    $labels->add_new = _x('新規追加', '記事');
    $labels->add_new_item = '記事を新規追加';
    $labels->edit_item = '記事を編集する';
    $labels->new_item = '新規追加';
    $labels->view_item = '記事を表示';
    $labels->search_items = '検索する';
    $labels->not_found = '記事が見つかりませんでした。';
    $labels->not_found_in_trash = 'ゴミ箱の中に記事が見つかりませんでした。';
}
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );
/*--------------------------------------------------------
  表示オプションとヘルプを非表示
--------------------------------------------------------*/
function my_admin_head(){
  if (!current_user_can('administrator')) {
    echo '<style type="text/css">#contextual-help-link-wrap{display:none;}</style>';
    echo '<style type="text/css">#screen-options-link-wrap{display:none;}</style>';
  }
}add_action('admin_head', 'my_admin_head');
/*--------------------------------------------------------
  サイドバーの項目を適宜非表示
--------------------------------------------------------*/
function remove_menus () {
   if (current_user_can('editor') || current_user_can('contributor')) {
      global $menu;
      remove_menu_page('wpcf7');
      $restricted = array(__('プロフィール')); //ココに削除したい項目の表示名をそのまま記述
      end ($menu);
      while (prev($menu)){
         $value = explode(' ',$menu[key($menu)][0]);
         if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
      }
   }
}
add_action('admin_menu', 'remove_menus');
/*--------------------------------------------------------
 アップグレード情報を非表示
--------------------------------------------------------*/
if (!current_user_can('administrator')) {
  add_filter('pre_site_transient_update_core', create_function('$a', "return null;"));
}
/*--------------------------------------------------------
  ビジュアルエディタを非表示
--------------------------------------------------------*/
function disable_visual_editor_in_page(){
  add_filter('user_can_richedit', 'disable_visual_editor_filter');
}
function disable_visual_editor_filter(){
  return false;
}
add_action( 'load-post.php', 'disable_visual_editor_in_page' );
add_action( 'load-post-new.php', 'disable_visual_editor_in_page' );
/*--------------------------------------------------------
  テキストエディタのタグのツールバーを非表示
--------------------------------------------------------*/
function et_print_styles() {
    echo '<style TYPE="text/css">
    #qt_content_em,#qt_content_block,#qt_content_ins,#qt_content_img,#qt_content_ul,#qt_content_ol,#qt_content_li,#qt_content_code,#qt_content_more,#qt_content_dfw,#qt_content_close
    {display:none !important;}
    </style>';
}
add_action('admin_print_styles', 'et_print_styles', 21);
/*--------------------------------------------------------
  カテゴリのチェックボックスをラジオボタンに変更
--------------------------------------------------------*/
function my_print_footer_scripts() {
echo '<script type="text/javascript">
  //<![CDATA[
  jQuery(document).ready(function($){
    $(".categorychecklist input[type=\"checkbox\"]").each(function(){
      $check = $(this);
      var checked = $check.attr("checked") ? \' checked="checked"\' : \'\';
      $(\'<input type="radio" id="\' + $check.attr("id")
        + \'" name="\' + $check.attr("name") + \'"\'
    + checked
  + \' value="\' + $check.val()
  + \'"/>\'
      ).insertBefore($check);
      $check.remove();
    });
  });
  //]]>
  </script>';
}
add_action('admin_print_footer_scripts', 'my_print_footer_scripts', 21);
/*--------------------------------------------------------
  ダッシュボードのウィジェットを削除
--------------------------------------------------------*/
function remove_dashboard_widgets() {
  global $wp_meta_boxes;
  unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] ); //概要
  unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] ); //アクティビティ
  unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] ); //クイックドラフト
  unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] ); //wordpressニュース
}
add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );
/*--------------------------------------------------------
  pre_get_posts
--------------------------------------------------------*/
function myPreGetPosts( $query ) {
    if ( is_admin() || ! $query->is_main_query() ){
        return;
    }
    if ( $query->is_post_type_archive( 'report' ) && (!is_date()) ) {
        $today = getdate();
        $query->set('year', $today["year"]);
    }
    if ( $query->is_post_type_archive( 'events' )) {
        $query->set('order', 'ASC');
        $query->set('showposts', '-1');
    }
}
add_action('pre_get_posts','myPreGetPosts');
