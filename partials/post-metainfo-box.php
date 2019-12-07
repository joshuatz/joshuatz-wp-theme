<?php
/**
 * @file Partial - block that displays "meta" information about the post (last updated, author, etc.)
 * Current design uses Materialize cards
 */
?>
<?php
    global $jtzwpHelpers;
    $tagsInfo = $jtzwpHelpers->getTagsInfoArrs();
?>
<?php if(get_field('show_meta_info_box')!==false): ?>
<div class="expandablePostDetailsSection postDetailsSection">
    <ul class="collapsible" tabindex="0" aria-label="Click to expand post meta info section">
        <!-- Disclaimers -->
        <?php if(jtzwp_get_disclaimer()): ?>
            <li class="active">
                <div class="collapsible-header">
                    <i class="material-icons">report</i>
                    <div class="whenExpanded">Disclaimer</div>
                    <div class="whenCollapsed">Click for Disclaimer</div>
                </div>
                <div class="collapsible-body">
                    <div class="card-panel jtzwp-error">
                        <?php echo jtzwp_get_disclaimer(); ?>
                    </div>
                </div>
            </li>
        <?php endif; ?>
        <!-- Post Date Stamps Meta Info -->
        <li>
            <div class="collapsible-header">
                <div class="whenExpanded"><i class="material-icons">info</i>Full <?php echo $jtzwpHelpers->getCustomPostTypeSingularName(); ?> Details</div>
                <div class="whenCollapsed"><i class="material-icons">info_outline</i>Click for Full <?php echo $jtzwpHelpers->getCustomPostTypeSingularName(); ?> Details</div>
            </div>
            <div class="collapsible-body">
                <div class="fullPostDetailsWrapper">
                    <?php if(get_field('show_datetime_published')!==false): ?>
                        <div class="row">
                            <div class="col s4 offset-s2">Date Posted:</div>
                            <div class="col s6"><?php echo strftime('%b. %d, %Y',strtotime(get_the_date())); ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if(get_field('show_datetime_updated')!==false): ?>
                        <div class="row">
                            <div class="col s4 offset-s2">Last Updated:</div>
                            <div class="col s6"><?php echo strftime('%b. %d, %Y',strtotime(get_the_modified_date())); ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </li>
        <!-- Tags -->
        <?php if(get_the_tag_list()): ?>
            <li>
                <div class="collapsible-header">
                    <div class="whenExpanded"><i class="material-icons">class</i>Tags</div>
                    <div class="whenCollapsed"><i class="material-icons">class</i>Click for Tags</div>
                </div>
                <div class="collapsible-body">
                    <div class="tagsTitle">Tags: </div>
                    <div class="tagsWrapper">
                        <?php foreach($tagsInfo->summaryArr as $tagDets): ?>
                            <a class="tag jtzwp-dark" rel="tag" href="<?php echo $tagDets->permalink; ?>"><?php echo $tagDets->name; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </li>
        <?php endif; ?>
    </ul>
</div>
<?php endif; ?>