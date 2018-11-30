<?php
/** Generic Item listing */
?>
<?php
    // per post pre-processing
    global $postSingularNoun, $jtzwpHelpers;
    $postTypeSingular = $jtzwpHelpers->getCustomPostTypeSingularName(false);
    $hasFeaturedImage = has_post_thumbnail();
    $hasExcerpt = has_excerpt();
?>
<div id="<?php echo $postTypeSingular . get_the_ID(); ?>" class="genericPostItem row <?php echo implode(' ',get_post_class()); ?>">

    <!-- Title -->
    <div class="col s12 center">
        <a href="<?php echo the_permalink(); ?>" target="_self"><h3><?php echo get_the_title(); ?></h3></a>
    </div>

    <div class="row">
        <?php if($hasFeaturedImage): ?>
            <div class="col s12 m6">
                <a href="<?php echo the_permalink(); ?>" target="_self" class="featuredImageWrapperLink">
                    <img class="featuredImage" src="<?php echo the_post_thumbnail_url('medium'); ?>" >
                </a>
            </div>
        <?php endif; ?>
            
        <div class="col <?php echo ($hasFeaturedImage ? 's11 offset-s1 m6' : 's11 offset-s1'); ?>">
            <div class="projectExcerptWrapper">
                <?php if($hasExcerpt): ?>
                    <p><?php echo get_the_excerpt(); ?></p>
                <?php else: ?>
                    <p><?php echo wp_trim_excerpt(); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>