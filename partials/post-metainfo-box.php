<?php
/**
 * @file Partial - block that displays "meta" information about the post (last updated, author, etc.)
 * Current design uses Materialize cards
 */
?>
<div class="expandablePostDetailsSection">
    <ul class="collapsible">
        <li>
            <div class="collapsible-header">
                <i class="material-icons">info</i>
                <div class="whenExpanded">Full <?php echo ucwords(get_post_type()); ?> Details</div>
                <div class="whenCollapsed">Click for Full <?php echo ucwords(get_post_type()); ?> Details</div>
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