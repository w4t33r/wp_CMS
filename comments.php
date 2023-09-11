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

    comment_form();
    ?>

</div><!-- #comments -->





<div class="comments my-4">
    <h3 class="mb-5">Комментарии:</h3>

    <div class="media mb-4">
        <img src="images/blog/2.jpg" alt="" class="img-fluid d-flex mr-4 rounded">
        <div class="media-body">
            <h5>Антон Колесников</h5>
            <span class="text-muted">20 января 2020</span>
            <p class="mt-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi
                laborum dolores quidem ea optio fuga nesciunt tempora, in tenetur iusto!</p>

            <a href="#" class="reply">Ответить <i class="fa fa-reply"></i></a>

            <div class="media mt-5">
                <img src="images/blog/2.jpg" alt="" class="img-fluid d-flex mr-4 rounded">
                <div class="media-body">
                    <h5>Егор Савицкий</h5>
                    <span class="text-muted">20 января 2020</span>
                    <p class="mt-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                        Nisi laborum dolores quidem ea optio fuga nesciunt tempora, in tenetur
                        iusto!</p>

                    <a href="#" class="reply">Ответить <i class="fa fa-reply"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="media mb-4">
        <img src="images/blog/2.jpg" alt="" class="img-fluid d-flex mr-4 rounded">
        <div class="media-body">
            <h5>Валентин Крашков</h5>
            <span class="text-muted">14 февраля 2020</span>
            <p class="mt-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi
                laborum dolores quidem ea optio fuga nesciunt tempora, in tenetur iusto!</p>

            <a href="#" class="reply">Ответить <i class="fa fa-reply"></i></a>
        </div>
    </div>
</div>
<div class="mt-5 mb-3">
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
</div>