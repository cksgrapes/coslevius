<?php $page = get_post( get_the_ID() ); ?>
<div id="pageMainCol">
<div id="pageMainColInner">
<h1 id="pageMainTitle"><?php the_title(); ?></h1>
<?php
    switch( $page->post_name ) {
        case 'comments' :
             comments_template();
            break;
        default :
            the_content();
            break;
    }
?>
</div>
</div>
<div id="pageSideMenu">
<?php
    switch( $page->post_name ) {
        case 'comments' :
            comment_form();
            break;
        default :
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
    }
?>
</div>



