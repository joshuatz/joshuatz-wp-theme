<?php
/**
 * @file Generic Item Card
 */
?>
<?php
    // per post pre-processing
    /** @var JtzwpHelpers $jtzwpHelpers */
    global $jtzwpHelpers;
    global $post;
    // Allow for passing in ID
    $postId = isset($scopedId) && !empty($scopedId) ? $scopedId : get_the_ID();
    $postInfo = $jtzwpHelpers->getBasicPostInfo($postId);
    $post = $postInfo->postObj;
    setup_postdata($post);
    $showTitle = isset($showTitle) && gettype($showTitle)==='boolean' ? $showTitle : true;
    $linkTarget = $jtzwpHelpers->postOnlyLinksExternally($postId) ? '_blank' : '_self';
    $postTypeStr = $postInfo->org->postTypeSingular;
    $tags = $jtzwpHelpers->getTagsInfoArrs($postId);
?>

<div class="itemCardWrapper">
    <a href="<?php echo get_permalink(); ?>" target="_self" class="">
        <div id="<?php echo the_ID(); ?>" class="itemCard full purpleHoverable jtzwpHoverable">
            <?php if($showTitle): ?>
            <h2 class="itemCardTitle title jtzwpTransitionColor"><?php the_title(); ?></h2>
            <?php endif; ?>

            <!-- Item Link Area -->
            <div class="center">
                <?php if($postInfo->featuredImage->hasFeaturedImage): ?>
                    <?php the_post_thumbnail('medium',array('class'=>'featuredImage')); ?>
                <?php elseif ($postInfo->org->postType === $jtzwpHelpers::PROJECTS_POST_TYPE): ?>
                    <h3 style="padding:10px;">Click for Project Details!</h3>
                <?php else: ?>
                    <div class="btn waves-effect readMore jtzwp-dark">
                        Read More <i class="material-icons right">more_horiz</i>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Item Excerpt Area -->
            <?php if($postInfo->hasExcerpt): ?>
                <div class="itemExcerptWrapper">
                    <p><?php echo $postInfo->excerpt; ?></p>
                </div>
            <?php endif; ?>

            <!-- Item Custom Content For Listing -->
            <?php if(get_field('custom_content_for_listing') && get_field('custom_content_for_listing')!==''): ?>
                <div class="projectCustomContentForListingWrapper">
                    <?php echo get_field('custom_content_for_listing'); ?>
                </div>
            <?php endif; ?>
        </div>
    </a>

    <!-- Item Tag Area (bottom bar) -->
    <?php if($tags->count > 0): ?>
        <div class="tagsWrapper">
        <?php foreach ($tags->summaryArr as $tagSummary): ?>
            <a href="<?php echo $tagSummary->permalink; ?>" target="_self" class="tagLink purpleHoverable jtzwpHoverable">
                <i class="material-icons">bookmark</i>
                <div class="tagText"><?php echo $tagSummary->name; ?></div>
            </a>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php wp_reset_postdata(); ?>