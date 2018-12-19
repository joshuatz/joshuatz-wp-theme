<?php
/** Generic Item listing */
?>
<?php
    // per post pre-processing
    global $postSingularNoun, $jtzwpHelpers;
    $postTypeSingular = $jtzwpHelpers->getCustomPostTypeSingularName(false);
    $hasFeaturedImage = has_post_thumbnail();
    $featuredImageHasShadow = ($hasFeaturedImage && preg_match('/_DS\.[Pp][Nn][Gg]$/',get_the_post_thumbnail_url(get_the_ID(),'full')));
    $hasExcerpt = has_excerpt();
?>
<div id="<?php echo $postTypeSingular . get_the_ID(); ?>" class="genericPostItem <?php echo implode(' ',get_post_class()); ?>">

    <!-- Title -->
    <div class="row">
        <div class="col s12 center">
            <a href="<?php echo the_permalink(); ?>" target="_self"><h3><?php echo get_the_title(); ?></h3></a>
        </div>
    </div>

    <!-- Post Excerpt, image, etc. -->
    <div class="row">
        <!-- Featured Image -->
        <?php if($hasFeaturedImage): ?>
            <div class="col s12 m6 xl5 center">
                <a href="<?php echo the_permalink(); ?>" target="_self" class="featuredImageWrapperLink">
                    <img class="featuredImage<?php echo $featuredImageHasShadow ? '' : ' z-depth-3'; ?>" src="<?php echo the_post_thumbnail_url('large'); ?>" >
                </a>
            </div>
        <?php endif; ?>
            
        <!-- Post Excerpt -->
        <div class="col <?php echo ($hasFeaturedImage ? 's11 offset-s1 m6 l6 xl7' : 's11 offset-s1'); ?>">
            <div class="postExcerptWrapper">
                <?php if($hasExcerpt): ?>
                    <p><?php echo get_the_excerpt(); ?></p>
                <?php else: ?>
                    <p><?php echo wp_trim_excerpt(); ?></p>
                <?php endif; ?>
            </div>
        </div>

         <!-- Read more Links -->
        <div class="col <?php echo ($hasFeaturedImage ? 's2 offset-s1' : 's2 offset-s2'); ?>">
            <a class="btn waves-effect readMore jtzwp-dark" href="<?php echo the_permalink(); ?>">
                Read More <i class="material-icons right">more_horiz</i>
            </a>
        </div>
    </div>
</div>