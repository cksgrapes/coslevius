<?php
/*--------------------------------------------------------
 現在のページが使用しているテンプレート名を返す
--------------------------------------------------------*/
function currentTemplate() {
    global $template;
    $template_name = basename($template, '.php');
    return $template_name;
}
/*--------------------------------------------------------
  コメントコールバック
--------------------------------------------------------*/
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class('box'); ?> id="li-comment-<?php comment_ID(); ?>">
    <?php if ($comment->comment_approved == '0') : ?>
        <em>このコメントは管理者の承認待ちです。</em>
        <br />
    <?php endif; ?>
    <div id="comment-<?php comment_ID(); ?>">
    <em><?php comment_author(); ?></em>：<?php comment_text() ?><span>（<?php comment_date('Y/m/d H:i') ?>）</span>
    </div>
<?php
        }
