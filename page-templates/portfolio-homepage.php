<?php
/**
 * Template Name: Portfolio Homepage
 * Template Post Type: page
 * @file - Homepage design that is more portfolio focused
 * - If you manually create a homepage to use this template, you can customize the content!
 */
?>

<?php
/**
 * CONFIGURATION
 */
$HOW_MANY_PROMOTED_TO_SHOW = 3;
?>

<?php
// Pre-processing
/** @var JtzwpHelpers $jtzwpHelpers */
global $jtzwpHelpers;
$pageInfo = $jtzwpHelpers->getBasicPostInfo(null);
$aboutMeBlurb = null;
$aboutMeBlurbSetting = $jtzwpHelpers->getThemeUserSetting('jtzwp_about_me_short_blurb');
if ($pageInfo->hasExcerpt) {
    $aboutMeBlurb = $pageInfo->excerpt;
} else if ($aboutMeBlurbSetting->isValid) {
    $aboutMeBlurb = $aboutMeBlurbSetting->val;
}
$displayName = $jtzwpHelpers->getThemeUserSetting('jtzwp_about_me_displayed_name');
$rawContent = get_the_content(null, false, $pageInfo->ID);

/**
 * Get the *PROMOTED* posts and projects to use
 * - If there are not enough promoted objects to use, fallback gracefully
 */
/**
 * @param int $count How many to pull
 * @param string[] $itemType What type of item to pull
 * @return array
 */
function getBaseQueryOptions($count = 10, $itemType = array('any')) {
    return array(
        'posts_per_page' => $count,
        'post_status' => 'publish',
        'orderby' => 'rand',
        'post_type' => $itemType,
        'suppress_filters' => true
    );
}

function getPromotedQueryOptions($isPromoted = true) {
    if ($isPromoted) {
        return array(
            array(
                'key' => 'promote_as_featured',
                'value' => true,
                'compare' => '='
            ) 
        );
    } else {
        return array(
            'relation' => 'OR',
            array(
                'key' => 'promote_as_featured',
                'value' => '',
                'compare' => 'NOT EXISTS'
            ),
            array(
                'key' => 'promote_as_featured',
                'value' => true,
                'compare' => '!='
            ),
        );
    }
}


function getPostsByType($itemType = array('any')) {
    $postArr = array();
    global $HOW_MANY_PROMOTED_TO_SHOW;

    // First, try to fill with only promoted
    $queryArgs = getBaseQueryOptions($HOW_MANY_PROMOTED_TO_SHOW, $itemType);
    $queryArgs['meta_query'] = getPromotedQueryOptions(true);
    $wpQuery = new WP_Query($queryArgs);
    $postArr = $wpQuery->posts;

    if (count($postArr) < $HOW_MANY_PROMOTED_TO_SHOW) {
        // Back fill with non-promoted
        $backfillNum = $HOW_MANY_PROMOTED_TO_SHOW - count($postArr);
        $queryArgs['posts_per_page'] = $backfillNum;
        $queryArgs['meta_query'] = getPromotedQueryOptions(false);
        $backfillQuery = new WP_Query($queryArgs);
        foreach ($backfillQuery->posts as $backfillPost) {
            array_push($postArr, $backfillPost);
        }
    }

    return $postArr;
}

$promotedProjects = getPostsByType(array($jtzwpHelpers::PROJECTS_POST_TYPE));
$promotedPosts = getPostsByType(array($jtzwpHelpers::BASE_POST_TYPE));

?>

<?php get_header(); ?>

<main id="main" role="main" class="portfolioHomepage">

<!-- About Me -->
<div class="row">
    <div class="col s10 offset-s1">
        <?php if (!empty($rawContent)): ?>
            <?php echo $rawContent; ?>
        <?php else: ?>
            <?php if ($displayName->isValid): ?>
                <h2 class="">Hello <span aria-hidden="true">👋<span>,</h2>
                <h3 class="">My name is <?php echo $displayName->val; ?>.</h3>
            <?php endif; ?>
            <?php if (!empty($aboutMeBlurb)): ?>
                <p class="flow-text"><?php echo $aboutMeBlurb; ?></p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Highlighted Projects -->
<?php if (count($promotedProjects)): ?>
<div class="portfolioSection altLight">
    <h2 class="full textCenter">Featured Projects</h2>
    <div class="flex itemCardRow">
        <?php foreach($promotedProjects as $project): ?>
            <?php $jtzwpHelpers->includeTemplatePart('partials/generic-item-card',array(
                'scopedId' => $project->ID,
                'wrapperClasses' => array('s12', 'm6', 'l4')
            )); ?>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<!-- Highlighted Posts -->
<?php if (count($promotedPosts)): ?>
<div class="portfolioSection altDark">
    <h2 class="full textCenter">Featured Posts</h2>
    <div class="flex itemCardRow">
        <?php foreach($promotedPosts as $promotedPost): ?>
            <?php $jtzwpHelpers->includeTemplatePart('partials/generic-item-card',array(
                'scopedId' => $promotedPost->ID,
                'wrapperClasses' => array('s12', 'm6', 'l4')
            )); ?>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<!-- Contact Info / Social Links -->
<div class="portfolioSection full altLight" style=>
    <h2 class="full textCenter">Contact Info</h2>
    <div class="flex" style="justify-content: space-around;">
        <div class="autoCenterParent s12 m4" style="min-height: 100px;">
            <p class="flow-text full" style="padding:10px;">Want to get in touch? Find me elsewhere on the internet? Look no further than my virtual business card!</p>
        </div>
        <div class="s11 m7" style="min-width: 300px;">
            <?php get_template_part('partials/business-card-materialize'); ?>
        </div>
    </div>
</div>

</main>

<?php get_footer(); ?>