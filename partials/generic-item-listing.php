<?php
/** Generic Item listing */
?>
<?php
    // per post pre-processing
    global $postSingularNoun, $jtzwpHelpers;
    // Allow for passing in ID
    $postId = isset($scopedId) ? $scopedId : get_the_ID();
    $showTitle = gettype($showTitle)==='boolean' ? $showTitle : true;
    $postInfo = $jtzwpHelpers->getBasicPostInfo($postId);
    $linkTarget = $jtzwpHelpers->postOnlyLinksExternally($postId) ? '_blank' : '_self';
?>
<div id="<?php echo $postInfo->org->postTypeSingular . $postInfo->id; ?>" class="genericPostItem <?php echo implode(' ',get_post_class()); ?>">

    <!-- Title -->
    <?php if($showTitle): ?>
    <div class="row">
        <div class="col s12 center">
            <a href="<?php echo $postInfo->permalink; ?>" target="<?php echo $linkTarget; ?>"><h3><?php echo $postInfo->title; ?></h3></a>
        </div>
    </div>
    <?php endif; ?>

    <!-- Post Excerpt, image, etc. -->
    <div class="row">
        <!-- Featured Image -->
        <?php if($postInfo->featuredImage->hasFeaturedImage): ?>
            <div class="col s12 m6 xl5 center">
                <a href="<?php echo $postInfo->permalink; ?>" target="<?php echo $linkTarget; ?>" class="featuredImageWrapperLink">
                    <img class="featuredImage<?php echo $postInfo->featuredImage->hasShadow ? '' : ' z-depth-3'; ?>" src="<?php echo $jtzwpHelpers->getFeaturedImageSrc($postInfo->id,'large'); ?>" >
                </a>
            </div>
        <?php endif; ?>
            
        <!-- Post Excerpt -->
        <?php if($postInfo->hasExcerpt): ?>
        <div class="col <?php echo ($postInfo->featuredImage->hasFeaturedImage ? 's11 offset-s1 m6 l6 xl7' : 's11 offset-s1'); ?>">
            <div class="postExcerptWrapper">
                <p><?php echo $postInfo->excerpt; ?></p>
            </div>
        </div>
        <?php endif; ?>

         <!-- Read more Links -->
        <div class="col <?php echo ($postInfo->featuredImage->hasFeaturedImage ? 's2 offset-s1' : 's2 offset-s2'); ?>">
            <a class="btn waves-effect readMore jtzwp-dark" href="<?php echo $postInfo->permalink; ?>">
                Read More <i class="material-icons right">more_horiz</i>
            </a>
        </div>
    </div>
</div>