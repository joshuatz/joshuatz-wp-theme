<?php
/**
 * Materialize styled substitute for the_post_navigation
 */
?>
<?php
/** @var JtzwpHelpers $jtzwpHelpers */
global $jtzwpHelpers;
$currPost = get_post();

$prevPost = get_previous_post();
$hasPrevPost = isset($prevPost) && $prevPost !=='' && $prevPost!==$currPost;
$prevPostFeatImg = $hasPrevPost ? $jtzwpHelpers->getFeaturedImageSrc($prevPost, 'medium') : false;

$nextPost = get_next_post();
$hasNextPost = isset($nextPost) && $nextPost !== '' && $nextPost!==$currPost;
$nextPostFeatImg = $hasNextPost ? $jtzwpHelpers->getFeaturedImageSrc($nextPost, 'medium') : false;

?>
<div class="row postNavigation">
    <!-- Previous Post -->
    <?php if ($hasPrevPost): ?>
        <div class="col s12 m6 l3 prevPost">
            <div class="card">
                <?php if ($prevPostFeatImg): ?>
                <div class="card-image">
                    <img loading="lazy" src="<?php echo $prevPostFeatImg ?>">
                    <a href="<?php echo get_permalink($prevPost); ?>"><span class="card-title">Previous Post</span></a>
                </div>
                <?php endif; ?>

                <div class="card-content">
                    <?php if(!$prevPostFeatImg):?><span class="card-title">Previous Post</span><?php endif; ?>
                    <p><?php echo wp_trim_words(get_the_excerpt($prevPost),20); ?></p>
                </div>
                <div class="card-action">
                    <a href="<?php echo get_permalink($prevPost); ?>">Visit Previous Post</a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Next Post -->
    <?php if ($hasNextPost): ?>
        <div class="col s12 m6 l3 nextPost <?php echo $hasPrevPost ? '' : 'offset-m6 offset-l9'; ?>">
            <div class="card">
                <?php if ($nextPostFeatImg): ?>
                <div class="card-image">
                    <img loading="lazy" src="<?php echo $nextPostFeatImg; ?>">
                    <a href="<?php echo get_permalink($nextPost); ?>"><span class="card-title">Next Post</span></a>
                </div>
                <?php endif; ?>

                <div class="card-content">
                    <?php if(!$nextPostFeatImg):?><span class="card-title">Next Post</span><?php endif; ?>
                    <p><?php echo wp_trim_words(get_the_excerpt($nextPost),20); ?></p>
                </div>
                <div class="card-action">
                    <a href="<?php echo get_permalink($nextPost); ?>">Visit Next Post</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
.postNavigation span.card-title {
    background-color: rgba(0, 0, 0, 0.75);
    border: 1px dashed white;
}
.postNavigation .prevPost span.card-title {
    left: 10px;
    bottom: 10px;
}
.postNavigation .nextPost span.card-title {
    left: unset;
    right: 10px;
    bottom: 10px;
}
.postNavigation .card-image {
    width: 100%;
    min-height: 150px;
}
.postNavigation img {
    width: 100%;
    height: auto;
}
</style>