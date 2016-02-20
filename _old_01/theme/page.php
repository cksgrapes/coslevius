<?php get_header(); ?>

<!-- #contents -->
<div id="contents">

    <?php while ( have_posts() ) : the_post();
    get_template_part( 'content', 'page' );
    endwhile; ?>

</div>
<!-- //#contents -->

<?php get_footer(); ?>
