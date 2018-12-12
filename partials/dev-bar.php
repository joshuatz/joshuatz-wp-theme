<?php
/**
 * sticky top bar meant for devs
 */
?>
<?php
global $jtzwpHelpers;
?>
<div class="devBar">
    <?php if ($jtzwpHelpers->getIsUnderConstruction()): ?>
        <div class="underConstructionWarning center">
            <div class="card-panel jtzwp-red">
                <span>WARNING: Site is set to "under-construction" mode, which means non-wp users are being redirect to /under-construction/ for every single page. Please update the UNDER_CONSTRUCTION constant if you want to change this.</span>
            </div>
        </div>
    <?php endif; ?>
</div>