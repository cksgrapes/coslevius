<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>

        <ol class="comment-list">
            <?php
                wp_list_comments( array(
                    'style'       => 'ul',
                    'callback' => 'mytheme_comment',
                ) );
            ?>
        </ol><!-- .comment-list -->

        <?php
            // Are there comments to navigate through?
            if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
        <nav class="navigation comment-navigation" role="navigation">
            <div class="nav-previous"><?php previous_comments_link(); ?></div>
            <div class="nav-next"><?php next_comments_link(); ?></div>
        </nav><!-- .comment-navigation -->
        <?php endif; // Check for comment navigation ?>

        <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="no-comments"><?php _e( 'Comments are closed.' , 'twentythirteen' ); ?></p>
        <?php endif; ?>

    <?php endif; // have_comments() ?>

</div><!-- #comments -->
