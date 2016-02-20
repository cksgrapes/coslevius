<?php get_header(); ?>
<?php $today = getdate(); ?>

<!-- #contents -->
<div id="contents">

<div id="pageMainCol">
<div id="pageMainColInner">
<h1 id="pageMainTitle"><?php
    switch(get_post_type()) {
        case 'information' :
            if(is_date()) echo get_query_var('year') . '年' . get_query_var('monthnum') . '月の';
            echo '更新履歴';
            break;
        case 'events' :
            echo 'イベント情報';
            break;
        case 'report' :
            echo 'イベントレポート';
            break;
        case 'post' :
            echo '主催ブログ';
            break;
        default :
            echo wp_title('',false,'');
            break;
    }
?></h1>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
get_template_part( 'content', 'loop' );
// the_posts_pagination();
endwhile; else :
get_template_part( 'content', 'none' );
endif; ?>
</div>
</div>
<div id="pageSideMenu">
<?php
    switch(get_post_type()) {
        case 'information' :
            echo '<select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">';
            echo '<option value="">月を選んでください</option>';
            echo '<option value="/coslevius/information/">ALL</option>';
            wp_get_archives(array(
                'type' => 'monthly',
                'format' => 'option',
                'post_type' => 'information'
            ));
            echo '</select>';
            $args = array(
                'theme_location' => 'about-menu',
                'container'      => 'div',
                'container_id'   => 'pageSideMenu',
                'menu_class'     => '',
                'menu_id'        => '',
                'items_wrap'     => '<ul>%3$s</ul>'
            );
            wp_nav_menu( $args );
            break;
        case 'events' :
            $args = array(
                'theme_location' => 'about-menu',
                'container'      => 'div',
                'container_id'   => 'pageSideMenu',
                'menu_class'     => '',
                'menu_id'        => '',
                'items_wrap'     => '<ul>%3$s</ul>'
            );
            wp_nav_menu( $args );
            break;
        case 'report' :
            $args = array(
                'theme_location' => 'about-menu',
                'container'      => 'div',
                'container_id'   => 'pageSideMenu',
                'menu_class'     => '',
                'menu_id'        => '',
                'items_wrap'     => '<ul>%3$s</ul>'
            );
            wp_nav_menu( $args );
            break;
        default :
            echo '<select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">';
            echo '<option value="">月を選んでください</option>';
            echo '<option value="/coslevius/blog/">ALL</option>';
            wp_get_archives(array(
                'type' => 'monthly',
                'format' => 'option'
            ));
            echo '</select>';
            break;
    }
?>
</div>

</div>
<!-- //#contents -->

<?php get_footer(); ?>
