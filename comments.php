<?php
/**
 * The template for displaying comments
 */
?>
<?php if(get_field('disable_comments')===true): ?>
    <div id="comments" class="comments-area">
        Comments have been disabled for this post.
    </div>
<?php else: ?>
    <div id="comments" class="comments-area">
        <div id="wordpress-commenting-wrapper-wrapper">
            <?php include('partials/wordpress-commenting.php'); ?>
        </div>
        <div id="disqus-commenting-wrapper-wrapper">
            <?php include('partials/disqus-commenting.php'); ?>
        </div>
    </div>
<?php endif; ?>