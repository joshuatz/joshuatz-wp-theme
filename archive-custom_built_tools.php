<?php
/**
 * Template for displaying custom_built_tools custom post type archive - basically index of custom tools
 */

get_header(); ?>

<?php
/**
 * Custom tools settings
 */
// Fallback image if no featured image set for tool
$fallbackPromoImageSrc = get_template_directory_uri() . '/images/computer-tools-resize.png';
?>

<div id="main">
    <div class="customToolsListingsWrapper">
        <?php if(have_posts()): ?>
            <h2 class="customToolsListingsTitle">Here are some software tools I have developed, either for myself or others.</h2>

            <div id="customToolsListings">
                <div class="row">
                    <?php
                    // Loop through matching tools
                    while (have_posts()): the_post();
                    ?>
                    <?php
                        // Per post processing
                        $hasFeaturedImage = has_post_thumbnail();
                        $hasExcerpt = has_excerpt();
                        $promoImageSrc = ($hasFeaturedImage===true ? the_post_thumbnail_url('medium') : $fallbackPromoImageSrc);
                        $displayTitle = get_the_title();
                        $allowReadMoreLink = !get_field('full_page_is_only_hosted_elsewhere');
                        $readMoreLink = $allowReadMoreLink ? get_the_permalink() : '#';
                        $hasExternalCodePage = get_field('externally_hosted_code_url')!==null;
                        $externalCodePage = get_field('externally_hosted_code_url');
                        $hasExternalProjectPage = get_field('externally_hosted_full_page_url')!==null;
                        $externalProjectPage = get_field('externally_hosted_full_page_url')!==null ? get_field('externally_hosted_full_page_url') : $readMoreLink;
                        $footerColumns = ($allowReadMoreLink && !$hasExternalProjectPage || !$allowReadMoreLink && $hasExternalProjectPage) ? 1 : 2;
                        $footerColumnsMaterialize = 's' . intval((12 / $footerColumns));

                        function getFixedFooter(){
                            global $allowReadMoreLink, $footerColumns, $footerColumnsMaterialize, $readMoreLink, $hasExternalProjectPage, $externalProjectPage, $jtzwpHelpers;
                            ?>
                            <div class="fixed-footer row" data-column="<?php echo $footerColumns; ?>">
                                <?php if($allowReadMoreLink): ?>
                                    <div class="col <?php echo $footerColumnsMaterialize; ?> readMoreLinkWrapper">
                                        <div class="btn black">
                                            <a class="readMoreLink" href="<?php echo $readMoreLink; ?>">Read More</a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($hasExternalProjectPage): ?>
                                    <div class="col <?php echo $footerColumnsMaterialize; ?> externalProjectPageLinkWrapper">
                                        <div class="btn black">
                                            <a class="externalProjectPageLink" href="<?php echo $externalProjectPage; ?>">
                                                <?php echo $jtzwpHelpers->codeHostIconMapper($externalProjectPage)['html']; ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="col s12 m6 customToolListing" data-id="<?php echo the_ID(); ?>">
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" style="padding:20px;" src="<?php echo $promoImageSrc; ?>">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4"><?php echo $displayTitle; ?><i class="material-icons right">more_vert</i></span>
                                <?php getFixedFooter(); ?>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4"><?php echo $displayTitle; ?><i class="material-icons right">close</i></span>
                                <?php if(has_excerpt()): ?>
                                    <?php the_excerpt(); ?>
                                <?php else: ?>
                                    <p>Use the links below to find out more about this tool!</p>
                                <?php endif; ?>

                                <?php getFixedFooter(); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    // End post loop
                    endwhile;
                    ?>
                </div>
                <?php the_posts_pagination(); ?>
            </div>
        <?php else: ?>
            <h2>Sorry, nothing here yet...</h2>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>