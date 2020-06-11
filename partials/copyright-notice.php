<?php
/**
 * @file copyright notice
 */
global $jtzwpHelpers;
$name = $jtzwpHelpers->getThemeUserSetting('jtzwp_about_me_displayed_name');
$year = date('Y');
?>

<?php if ($name->isValid): ?>
<div class="copyrightNotice card-panel autoCenterSimple jtzwp-dark" style="width:80%">
    © <?php echo $name->val; ?>. Code snippets are covered under <a href="https://opensource.org/licenses/MIT" rel="noopener" target="_blank">MIT License</a>.
</div>
<?php endif; ?>