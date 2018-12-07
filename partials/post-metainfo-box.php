<?php
/**
 * @file Partial - block that displays "meta" information about the post (last updated, author, etc.)
 * Current design uses Materialize cards
 */
?>
<?php
    global $jtzwpHelpers;
?>
<?php if(get_field('show_meta_info_box')!==false): ?>
<div class="expandablePostDetailsSection">
    <ul class="collapsible">
        <?php if(jtzwp_get_disclaimer()): ?>
            <!-- Disclaimers -->
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
                    <div class="row">
                        <div class="col s4 offset-s2">Date Posted:</div>
                        <div class="col s6"><?php echo strftime('%b. %d, %Y',strtotime(get_the_date())); ?></div>
                    </div>
                    <div class="row">
                        <div class="col s4 offset-s2">Last Updated:</div>
                        <div class="col s6"><?php echo strftime('%b. %d, %Y',strtotime(get_the_modified_date())); ?></div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
<?php endif; ?>