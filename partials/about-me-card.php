<?php
/**
 * About me section card
 */
?>
<?php
/**
 * Preprocessing
 */
global $jtzwpHelpers;
$aboutMeBlurb = $jtzwpHelpers->getThemeUserSetting('jtzwp_about_me_short_blurb');
?>
<?php if($aboutMeBlurb->isValid): ?>
<div class="aboutMeCard card-panel z-depth-4 hoverable">
    <div class="aboutMeTitle title">About Me:</div>
    <p><?php echo $aboutMeBlurb->val; ?></p>
</div>
<?php endif; ?>