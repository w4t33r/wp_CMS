<?php
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments my-4">

    <?php
    // You can start editing here -- including this comment!
    if ( have_comments() ) :
        ?>
        <h3 class="mb-5">
            <?php
            $gym_comment_count = get_comments_number();
            if ( '1' === $gym_comment_count ) {
                printf(
                /* translators: 1: title. */
                    esc_html__( 'One comment on &ldquo;%1$s&rdquo;', 'gym' ),
                    '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                );
            } else {
                printf(
                /* translators: 1: comment count number, 2: title. */
                    esc_html( _nx( '%1$s comments on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', $gym_comment_count, 'comments title', 'gym' ) ),
                    number_format_i18n( $gym_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                );
            }
            ?>
        </h3><!-- .comments-title -->

        <?php the_comments_navigation(); ?>

        <ol class="comment-list p-0">
            <?php
            wp_list_comments(
                array(
                    'walker'      => new Bootstrap_Walker_Comment(),
                    'max_depth' => '2',
                    'avatar_size' => 120,
                    'style'       => 'ol',
                    'type' => 'all',
                    'reply_text' => __('Reply <i class="fa fa-reply"></i>'),
                    'per_page' => '10',
                    'format' => 'html5',
                    'echo' => true,
                )
            );
            ?>
        </ol><!-- .comment-list -->

        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() ) :
            ?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'gym' ); ?></p>
        <?php
        endif;

    endif; // Check for have_comments().

    $defaults = [
        'fields'               => [
            'author' => '<div class="col-lg-6"">
			<input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="Name" />
		</div>',
            'email'  => '<div class="col-lg-6">
			<input id="email" name="email"  class="form-control"  type="email" value=" ' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="email" size="30" aria-describedby="email-notes" />
		</div>',
            ],
        'comment_field'        => '<div class="comment-form-comment mb-3">
		<textarea id="comment" class="form-control" name="comment" cols="45" rows="8"  aria-required="true" required="required" placeholder="Comment"></textarea>
	</div>',
        'must_log_in'          => '<p class="must-log-in">' .
            sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post->ID ) ) ) ) . '
	 </p>',
        'logged_in_as'         => '<p class="logged-in-as">' .
            sprintf( __( '<a href="%1$s" aria-label="Logged in as %2$s. Edit your profile.">Logged in as %2$s</a>. <a href="%3$s">Log out?</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post->ID ) ) ) ) . '
	 </p>',
        'comment_notes_before' => '<p class="comment-notes">
		<span id="email-notes">' . __( 'Your email address will not be published.' ) . '</span>'.
             '
	</p>',
        'comment_notes_after'  => '',
        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'class_container'      => 'comment-respond',
        'class_form'           => 'comment-form',
        'class_submit'         => 'btn btn-hero btn-circled',
        'name_submit'          => 'submit',
        'title_reply'          => __( 'Leave a Comment' ),
        'title_reply_to'       => __( 'Leave a Reply to %s' ),
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'    => '</h3>',
        'cancel_reply_before'  => ' <small>',
        'cancel_reply_after'   => '</small>',
        'cancel_reply_link'    => __( 'Cancel reply' ),
        'label_submit'         => __( 'Post Comment' ),
        'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s"/>%4$s</button>',
        'submit_field'         => '<p class="form-submit">%1$s %2$s</p>',
        'format'               => 'html5',
    ];

    comment_form( $defaults );
    ?>

</div><!-- #comments -->





    <!--<div class="mt-5 mb-3">
    <h3 class="mt-5 mb-2">Оставьте комментарий</h3>
    <p class="mb-4">Ваш E-mail защищен от спама</p>
    <form action="#" class="row">
        <div class="col-lg-12">
            <div class="form-group mb-3">
                                        <textarea cols="30" rows="6" class="form-control"
                                                  placeholder="Комментарий"></textarea>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group mb-3">
                <input type="text" class="form-control" placeholder="Имя">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group mb-4">
                <input type="email" class="form-control" placeholder="Email">
            </div>
        </div>

        <div class="col-lg-12">
            <a href="#" class="btn btn-hero btn-circled">Оставить комментарий</a>
        </div>
    </form>
</div> -->