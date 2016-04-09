<?php

//========================================
//
// 絵文字対応用記述削除
//
//========================================

function disable_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'disable_emojis' );

//========================================
//
// サムネイルサイズ定義
//
//========================================

add_image_size( 'slider_pc', 960, 340, true );
add_image_size( 'slider_sp', 640, 340, true );
add_image_size( 'event_report_thumb', 80, 80, true );
add_image_size( 'event_report_big', 500, 500, false );


//========================================
//
// カスタム投稿タイプ：イベント情報
//
//========================================

function events_custom_post_type(){
  $labels = array(
    'name' => 'イベント情報',
    'singular_name' => 'イベント情報'
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'menu_position' => 5,
    'has_archive' => true,
    'rewrite' => array(
      'with_front' => false
    ),
    'supports' => array('title')
  );
  register_post_type('events',$args);
}
add_action('init', 'events_custom_post_type');

//========================================
//
// カスタム投稿タイプ：更新履歴
//
//========================================
function news_custom_post_type(){
  $labels = array(
    'name' => '更新履歴',
    'singular_name' => '更新履歴'
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'menu_position' => 5,
    'has_archive' => true,
    'rewrite' => array(
      'with_front' => false
    ),
    'supports' => array('title','editor')
  );
  register_post_type('news',$args);
}
add_action('init', 'news_custom_post_type');



//========================================
//
// 管理画面のカラム修正
//
//========================================
function manage_posts_columns($columns) {
    $columns['events_count'] = "章番号";
    // $columns['events_date'] = "開催日";
    return $columns;
}
function add_column($column_name, $post_id) {
    if( $column_name == 'events_count' ) {
        $stitle = get_post_meta($post_id, 'events_count', true);
    }
    if ( isset($stitle) && $stitle ) {
        echo esc_attr($stitle);
    } else {
        echo __('None');
    }
}
add_filter( 'manage_events_posts_columns', 'manage_posts_columns' );
add_action( 'manage_events_posts_custom_column', 'add_column', 10, 2 );


//========================================
//
// Pre Get Posts
//
//========================================

function myPreGetPosts( $query ) {
    if ( is_admin() || ! $query->is_main_query() ){
        return;
    }
    if ( $query->is_post_type_archive( 'events' ) ) {
        $query->set('posts_per_page', 1);
        $query->set('order', 'asc');
    }
}
add_action('pre_get_posts','myPreGetPosts');


//========================================
//
// リスト系表示フック
//
//========================================

add_filter( 'wp_list_categories', 'my_categories_link' );
function my_categories_link( $output ) {
  $output = str_replace('\'', '"', $output);
  $output = preg_replace('/(<a.+?>)/', '$1<span>', $output);
  $output = preg_replace('/<\/a>\s*\((\d+)\)/',' ($1)</span></a>',$output);
  return $output;
}

add_filter( 'get_archives_link', 'my_archives_link' );
function my_archives_link( $output ) {
  $output = str_replace('\'', '"', $output);
  $output = preg_replace('/(<a.+?>)/', '$1<span>', $output);
  $output = preg_replace('/<\/a>\s*(&nbsp;)\((\d+)\)/',' ($2)</span></a>',$output);
  return $output;
}

//========================================
//
// コメント系表示フック
//
//========================================

add_filter('comment_form_default_fields', 'custom_comment_form_fields');
function custom_comment_form_fields($fields) {
  $commenter = wp_get_current_commenter();
  $req      = get_option( 'require_name_email' );
  $aria_req = ( $req ? " aria-required='true'" : '' );
  $html_req = ( $req ? " required='required'" : '' );
  $html5 = true;
  $fields   =  array(
    'class_form' => '',
    'author' => '<input type="text" id="author" name="author" placeholder="名前を入力してください（必須）" class="comments__form__input comments__form__name" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . $html_req . '> ',
    'email' => '<input id="email" name="email" type="email" placeholder="メールアドレスを入力してください（任意）" class="comments__form__input comments__form__email" aria-describedby="email-notes" value="' . esc_attr( $commenter['comment_author_email'] ) . '"' . $aria_req . $html_req . '> ',
    'url'    => '',
  );
  return $fields;
}

add_filter('comment_form_defaults', 'custom_comment_form');
function custom_comment_form($args) {
  $args = array(
    'class_form'           => 'comments__form',
    'comment_notes_before' =>'',
    'label_submit'         => 'コメントを投稿する',
    'comment_field'        => '<textarea id="comment" name="comment" cols="30" rows="10" placeholder="コメントをどうぞ。" class="comments__form__textarea"></textarea>',
    'submit_button'        => '<div class="action-btn comments__form__submit"><button name="submit" type="submit" id="submit" class="action-btn__item action-btn__item--mini"><span>コメントを投稿する</span></button></div>',
    'submit_field'         => '%1$s %2$s',
    'title_reply'          => '',
  );
  return $args;
}

function wp34731_move_comment_field_to_bottom( $fields ) {
  $comment_field = $fields['comment'];
  unset( $fields['comment'] );
  $fields['comment'] = $comment_field;
  return $fields;
}
add_filter( 'comment_form_fields', 'wp34731_move_comment_field_to_bottom' );

function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
      <div id="comment-<?php comment_ID(); ?>" class="comments__post">
        <ul class="comments__post__data">
          <li class="comments__post__name"><?php echo get_comment_author_link(); ?></li>
          <li class="comments__post__date"><?php comment_date('Y/m/d H:i'); ?></li>
        </ul>
        <div class="comments__post__body">
          <?php comment_text() ?>
        </div>
      </div>
<?php
        }

//========================================
//
// 概要表示フック
//
//========================================

function custom_excerpt_length( $length ) {
     return 70;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more($more) {
  return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

//========================================
//
// メールフォームカスタマイズ
//
//========================================

function add_products( $children, $atts ) {
    global $events;
    $events_data = [];
    $i = 0;
    // var_dump($atts);
    if ( $atts['name'] == 'events_date' ) {
        $products = get_posts( array(
            'post_type' => 'events',
            'posts_per_page' => -1,
            'order'    => 'asc'
        ) );
        foreach ( $products as $post ) {
            setup_postdata( $post ); the_levi_events($post);
            $maintitle = preg_replace("/(.*?）)(.*)/is","$1", $events['maintitle']);
            $children[$post->post_title] = $maintitle;

            $i++;
        }
        $i = 0; wp_reset_postdata();
    }
    return $children;
}
add_filter( 'mwform_choices_mw-wp-form-93', 'add_products', 10, 2 );

function add_products_2( $children, $atts ) {
    global $events;
    $events_data = [];
    $i = 0;
    // var_dump($atts);
    if ( $atts['name'] == 'events_date' ) {
        $products = get_posts( array(
            'post_type' => 'events',
            'posts_per_page' => -1,
            'order'    => 'asc'
        ) );
        foreach ( $products as $post ) {
            setup_postdata( $post ); the_levi_events($post);
            $maintitle = preg_replace("/(.*?）)(.*)/is","$1", $events['maintitle']);
            $children[$post->post_title] = $maintitle;

            $i++;
        }
        $i = 0; wp_reset_postdata();
    }
    return $children;
}
add_filter( 'mwform_choices_mw-wp-form-582', 'add_products_2', 10, 2 );

function my_mail_auto( $Mail_raw, $values, $Data ) {
    // to, cc, bcc では {キー} は使用できません。
    // $Data->get( 'hoge' ) で送信されたデータが取得できます。

$str = <<<EOD
∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽
こちらは自動返信メールです。
このアドレスにご返信されても回答できかねますので、
予めご了承ください。
∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽∽

ご登録ありがとうございます☆
CosLevius主催、妖籠刹那です・ω・)∩"

以下の内容でイベント参加登録が完了いたしました。

□■□■□■□■□■□■□■□■□■□■□■□■□■□■□■□■□■□

申請したい日付：{events_date}
メールアドレス：{events_email}
EOD;

    for ($i=1; $i < 11 ; $i++) {
      $j = sprintf('%02d', $i);
      if (!empty($Data->get("events_cosname_{$j}"))) {
$str .= <<<EOD


参加者{$j}：
（コスネーム）{events_cosname_{$j}}

EOD;
      }
      if (!empty($Data->get("events_joinplans_{$j}"))) {
        $str .= "（参加予定）{events_joinplans_{$j}}\n";
      }
      if (!empty($Data->get("events_sankawaku_{$j}"))) {
        $str .= "（参加枠）{events_sankawaku_{$j}}\n";
      }
      if (!empty($Data->get("events_cosplan_{$j}"))) {
        $str .= "（予定コス）{events_cosplan_{$j}}\n";
      }
      if (!empty($Data->get("events_sankawaku_ippan_{$j}"))) {
        $str .= "（一般(詳細)）{events_sankawaku_ippan_{$j}}\n";
      }
      if (!empty($Data->get("events_sankawaku_sonota_{$j}"))) {
        $str .= "（その他(詳細)）{events_sankawaku_sonota_{$j}}\n";
      }
    }
$str .= <<<EOD

□■□■□■□■□■□■□■□■□■□■□■□■□■□■□■□■□■□

今回のイベントの概要は、次の通りです。

□■□■□■□■□■□■□■□■□■□■□■□■□■□■□■□■□■□

会場：青少年センター別館

入場料：1000円

入場時間：10時

小道具・武器の持ち込みに関しましては、基本規制はございませんが、サイトの注意事項にてご確認いただき、問い合わせが必要なものでしたらサイトの問い合わせフォームより、ご連絡ください。

お問い合わせ
http://coslevius.setunasan.net/contacts/

□■□■□■□■□■□■□■□■□■□■□■□■□■□■□■□■□■□

また、キャンセルの場合は下記のURLより、キャンセルメールをお送りください。
http://coslevius.setunasan.net/about/cancel/form/

では 当日、ご来場いただけることを
スタッフ一同 心よりお待ちいたしております♪
EOD;
    $Mail_raw->body = $str; // 本文を変更
    return $Mail_raw;
}
add_filter( 'mwform_auto_mail_raw_mw-wp-form-93', 'my_mail_auto', 10, 3 );

function my_mail_admin( $Mail_raw, $values, $Data ) {
    // to, cc, bcc では {キー} は使用できません。
    // $Data->get( 'hoge' ) で送信されたデータが取得できます。
$str = <<<EOD
Cos Leviusに参加申請が届きました。

==========
申請したい日付：{events_date}
メールアドレス：{events_email}
EOD;

    for ($i=1; $i < 11 ; $i++) {
      $j = sprintf('%02d', $i);
      if (!empty($Data->get("events_cosname_{$j}"))) {
$str .= <<<EOD


参加者{$j}：
（コスネーム）{events_cosname_{$j}}

EOD;
      }
      if (!empty($Data->get("events_joinplans_{$j}"))) {
        $str .= "（参加予定）{events_joinplans_{$j}}\n";
      }
      if (!empty($Data->get("events_sankawaku_{$j}"))) {
        $str .= "（参加枠）{events_sankawaku_{$j}}\n";
      }
      if (!empty($Data->get("events_cosplan_{$j}"))) {
        $str .= "（予定コス）{events_cosplan_{$j}}\n";
      }
      if (!empty($Data->get("events_sankawaku_ippan_{$j}"))) {
        $str .= "（一般(詳細)）{events_sankawaku_ippan_{$j}}\n";
      }
      if (!empty($Data->get("events_sankawaku_sonota_{$j}"))) {
        $str .= "（その他(詳細)）{events_sankawaku_sonota_{$j}}\n";
      }
    }
    $Mail_raw->body = $str; // 本文を変更
    return $Mail_raw;
}
add_filter( 'mwform_admin_mail_raw_mw-wp-form-93', 'my_mail_admin', 10, 3 );


//========================================
//
// 独自関数
//
//========================================

function is_float_time($time) {
  if (strpos($time,'.5') !== false ) {
    settype($time,"float");
  }
  if (is_float($time)) {
    $time = floor($time);
    $time = $time . ':30';
  } else {
    $time = $time . ':00';
  }
  return $time;
}

function the_levi_events($post) {
  global $events;
  $events = [];
  $events['count']      = get_field('events_count', $post->ID);
  $events['date']       = get_field('events_date', $post->ID);
  $events['location']   = get_field('events_location', $post->ID);
  $events['subtitle']   = get_field('events_subtitle', $post->ID);
  $events['starttime']  = get_field('events_start_time', $post->ID);
  $events['endtime']    = get_field('events_end_time', $post->ID);
  $events['per']        = get_field('events_per', $post->ID);
  $events['lockerroom'] = get_field('events_lockerroom', $post->ID);
  $events['largeones']  = get_field('events_largeones', $post->ID);
  $events['space']      = get_field('events_space', $post->ID);
  $events['spaceother'] = get_field('events_space_other', $post->ID);
  $events['planning']   = get_field('events_planning', $post->ID);
  $events['notes']      = get_field('events_notes', $post->ID);

  //hidden用にオリジナル日時を保存
  $events['dateoriginal'] = $events['date'];

  //備考をリストタグに変換
  if (!empty($events['notes'])) {
    $arr = explode("\n", $events['notes']);
    $str = '';
    foreach ($arr as $events_note) {
      $str .= '<li>' . $events_note . "</li>\n";
    }
    $events['notes'] = "<ul class=\"table__list\">\n" . $str . "</ul>\n";
  }

  //$events_dateから曜日を取得
  if (!empty($events['date'])) {
    $event_yymmdd = preg_split("/[年月日\/]+/",$events['date']);
    $weekjp = array(
      '日', //0
      '月', //1
      '火', //2
      '水', //3
      '木', //4
      '金', //5
      '土'  //6
    );
    $year       = $event_yymmdd[0];
    $month      = $event_yymmdd[1];
    $day        = $event_yymmdd[2];
    $timestamp  = mktime(0, 0, 0, $month, $day, $year);
    $weekno     = date('w', $timestamp);
    $events['week'] = '（' . $weekjp[$weekno] . '）';
    $events['date'] = $events['date'] . $events['week'];
    $events['numdate'] = $year . $month . $day;
  }

  //$events_start_time / $events_end_time を時間に変換
  if(!empty($events['starttime']) || empty($events['endtime'])) {
    if (!empty($events['starttime'])) {
      $events['starttime'] = is_float_time($events['starttime']);
    }
    if (!empty($events['endtime'])) {
      $events['endtime'] = is_float_time($events['endtime']);
    }
    $events['time'] = $events['starttime'] . ' 〜 ' . $events['endtime'];
  }

  //表示用整形
  $events['maintitle'] = '第' . $events['count'] . '章　';
  $events['maintitle'] .= $events['date'] . '　' . $events['location'];
  if (!empty($events['subtitle'])) {
    $events['maintitle'] .= '<span>' . $events['subtitle'] . '</span>';
  }

  return false;
}
