<!DOCTYPE html>
<!--[if IE 8]><html class="lte-ie8 ie8" lang="ja"><![endif]-->
<!--[if gt IE 8]><!--><html lang="ja"><!--<![endif]-->
<head>
<!-- ===== meta ===== -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php wp_title('|',true,'right'); ?> <?php bloginfo('name');?> - 山梨コスプレイベント</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Cos Levius（コスレヴィアス）は、山梨で開催しているコスプレ撮影イベントです！">
<meta name="keywords" content="コスプレ,コスレヴィアス,コス,イベント,レイヤー,山梨">
<meta name="format-detection" content="telephone=no">
<!-- ===== common styleseet ===== -->
<link href="/coslevius/css/genericons.css" rel="stylesheet">
<link href="/coslevius/css/common.css" rel="stylesheet">
<link href="/coslevius/css/style.css" rel="stylesheet">
<?php wp_head(); ?>
</head>
<body>


<!-- #wrapper -->
<div id="wrapper">

<!-- #header -->
<header id="header">
<div id="headerInner">
<?php if ( is_front_page() ) : ?>
<h1 id="logo"><a href="<?php bloginfo('url'); ?>">Cos Levius</a></h1>
<?php else : ?>
<div id="logo"><a href="<?php bloginfo('url'); ?>">Cos Levius</a></div>
<?php endif; ?>
<div id="globalMenu">
<div id="globalMenuOff">
	<span>menu</span>
</div>
<div id="globalMenuOn">
<?php $args = array(
    'theme_location' => 'global-menu',
    'container'      => false,
    'menu_class'     => '',
    'menu_id'        => '',
    'items_wrap'     => '<ul>%3$s</ul>'
);
wp_nav_menu( $args );?>
</div>
</div>
</div>
</header>
<!-- //#header -->
