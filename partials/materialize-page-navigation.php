<?php
/**
 * Partial file for Materialize styled page navigation
 */
?>
<?php
    // Preprocessing
    global $jtzwpHelpers;
    $currentPageNum = (isset($paged) && $paged!==0) ? $paged : 1;
    $totalNumPages = $wp_query->max_num_pages;
    $nextPageLink = $jtzwpHelpers->grabHrefFromATag(get_next_posts_link());
    $hasNextPage = isset($nextPageLink) && $nextPageLink!=='';
    $prevPageLink = $jtzwpHelpers->grabHrefFromATag(get_previous_posts_link());
    $hasPrevPage = isset($prevPageLink) && $prevPageLink!=='';
    $hasPagination = ($hasNextPage || $hasPrevPage);
    $columnCount = count(array_filter(array($hasNextPage,$hasPrevPage))) + 1;
?>
<?php if($hasPagination): ?>
    <div class="largeDividerDashed jtzwp-dark"></div>
    <div class="row">
        <div class="materializePaginationWrapper valign-wrapper center">
            <?php if($hasPrevPage): ?>
                <div class="col s12 <?php echo 'm' . 12/$columnCount; ?> prevPage">
                    <a class="waves-effect btn btn-large jtzwp-lightblue z-depth-4" href="<?php echo $prevPageLink; ?>"><i class="material-icons left">chevron_left</i>Previous Page</a>
                </div>
            <?php endif; ?>
            <div class="col s12 <?php echo 'm' . 12/$columnCount; ?> pageCounter center">
                <div class="card-panel jtzwp-lightblue z-depth-4" style="width:80%; margin:auto;">Page #<?php echo $currentPageNum; ?> / <?php echo $totalNumPages; ?></div>
            </div>
            <?php if($hasNextPage): ?>
                <div class="col s12 <?php echo 'm' . 12/$columnCount; ?> nextPage">
                    <a class="waves-effect btn btn-large jtzwp-lightblue z-depth-4" href="<?php echo $nextPageLink; ?>"><i class="material-icons right">chevron_right</i>Next Page</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>