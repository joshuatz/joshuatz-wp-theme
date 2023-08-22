<?php
 /*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>
<div id="wordpress-comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
                $comments_number = get_comments_number();
                if ('1' === $comments_number ) {
                    /* translators: %s: post title */
                    printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'twentysixteen' ), get_the_title() );
                } else {
                    printf(
                        /* translators: 1: number of comments, 2: post title */
                        _nx(
                            '%1$s thought on &ldquo;%2$s&rdquo;',
                            '%1$s thoughts on &ldquo;%2$s&rdquo;',
                            $comments_number,
                            'comments title',
                            'twentysixteen'
                        ),
                        number_format_i18n( $comments_number ),
                        get_the_title()
                    );
                }
            ?>
        </h2>

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
                wp_list_comments( array(
                    'style' => 'ol',
                    'short_ping' => true,
                    'avatar_size' => 42,
                ) );
            ?>
        </ol>

        <?php the_comments_navigation(); ?>

    <?php endif; // Check for have_comments(). ?>

    <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="no-comments"><?php _e( 'Comments are closed.', 'twentysixteen' ); ?></p>
    <?php endif; ?>

    <?php
        $spamField = '<input type="hidden" value="' . wp_create_nonce('comment_nonce') . '" name="nonce" />';
        // ^ If this ends up not being enough, could add a simple captcha (e.g., "what is 5 + 2") and/or JS with timer that sets
        // a hidden field, so web scrapers that don't execute JS (or don't sit on page long enough before submitting)
        // would get snared by trap

        // See https://developer.wordpress.org/reference/functions/comment_form/
        $customCommentingArgs = array(
            'comment_field' => '<div class="row"><div class="input-field col s12"><textarea id="wordpressCommentTextInput" name="comment" class="materialize-textarea"></textarea><label for="wordpressCommentTextInput">Comment...</label></div></div>' . $spamField,
            'logged_in_as' => '<div class="col s12"><div class="card-panel blue lighten-5"><p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p></div></div>',
            'class_submit' => 'submit btn waves-effect waves-light light-green lighten-2'
        );
        comment_form($customCommentingArgs);
    ?>
</div>