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

function getFixedFooter(){
    global $allowReadMoreLink, $footerColumns, $footerColumnsMaterialize, $readMoreLink, $hasExternalCodePage, $hasExternalCodePage, $externalCodePage, $externalProjectPage, $jtzwpHelpers;
    ?>
    <div class="fixed-footer row" data-column="<?php echo $footerColumns; ?>">
        <?php if($allowReadMoreLink): ?>
            <div class="col <?php echo $footerColumnsMaterialize; ?> readMoreLinkWrapper">
                <div class="btn black bounce">
                    <a class="readMoreLink truncate" href="<?php echo $readMoreLink; ?>">Read More</a>
                </div>
            </div>
        <?php endif; ?>
        <?php if($hasExternalCodePage && $jtzwpHelpers->codeHostIconMapper($externalCodePage)['foundMatch']): ?>
            <div class="col <?php echo $footerColumnsMaterialize; ?> externalCodePageLinkWrapper">
                <div class="btn black bounce">
                    <a class="externalCodePageLink" href="<?php echo $externalCodePage; ?>" target="_blank">
                        <span class="externalCodePageLinkName truncate"><?php echo $jtzwpHelpers->codeHostIconMapper($externalCodePage)['name']; ?></span>
                        <span class="externalCodePageLinkIcon"><?php echo $jtzwpHelpers->codeHostIconMapper($externalCodePage)['html']; ?></span>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php
}
?>

<main id="main" role="main">
    <?php get_sidebar('everypagetop'); ?>
    <div class="customToolsListingsWrapper">
        <?php if(have_posts()): ?>
            <h2 class="customToolsListingsTitle mainTitle">Here are some small one-off tools I have developed, either for myself or others.</h2>

            <div id="customToolsListings">
                <div class="row customToolsMasonry">
                    <?php
                    // Loop through matching tools
                    while (have_posts()): the_post();
                    ?>
                    <?php
                        // Per post processing
                        $featuredImageUrl = get_the_post_thumbnail_url(get_the_ID(),'medium');
                        $hasFeaturedImage = has_post_thumbnail() && $featuredImageUrl!==false;
                        $hasExcerpt = has_excerpt();
                        $promoImageSrc = ($hasFeaturedImage===true ? $featuredImageUrl : $fallbackPromoImageSrc);
                        $displayTitle = get_the_title();

                        // External Project Page
                        $hasExternalProjectPage = get_field('externally_hosted_full_page_url')!==null && get_field('externally_hosted_full_page_url')!=='';
                        $externalProjectPage = get_field('externally_hosted_full_page_url');

                        // "Read More" Link
                        // Order of use: WP post page, externally_hosted_full_page_url, null
                        $readMoreLink = null;
                        if (get_field('full_page_is_only_hosted_elsewhere') && $hasExternalProjectPage){
                            $readMoreLink = $externalProjectPage;
                        }
                        else if (!get_field('full_page_is_only_hosted_elsewhere')){
                            $readMoreLink = get_the_permalink();
                        }
                        $allowReadMoreLink = isset($readMoreLink);
                        // External code page
                        $hasExternalCodePage = get_field('externally_hosted_code_url')!==null && get_field('externally_hosted_code_url')!=='';
                        $externalCodePage = get_field('externally_hosted_code_url');
                        // Determine number of columns that will appear in footer
                        $footerColumns = ($allowReadMoreLink && $externalCodePage) ? 2 : 1;
                        $footerColumnsMaterialize = ('s12') . ' ' . ('m' . intval((12 / $footerColumns)));
                        
                    ?>
                    <div class="col s12 m6 l4 xl4 customToolListing" data-id="<?php echo the_ID(); ?>">
                        <div class="card hoverable">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" style="padding:20px;" src="<?php echo $promoImageSrc; ?>">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4"><?php echo $displayTitle; ?><i class="material-icons right">more_vert</i></span>
                                <div class="fixed-footer row">
                                    <div class="col s12 activator">
                                        <div class="btn black activator">
                                            <div class="activator">More Info</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4"><?php echo $displayTitle; ?><i class="material-icons right closeButton">close</i></span>
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
                <?php get_template_part('partials/materialize-page-navigation'); ?>
            </div>
        <?php else: ?>
            <h2>Sorry, nothing here yet...</h2>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>