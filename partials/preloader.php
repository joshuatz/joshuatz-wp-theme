<?php
/**
 * Run of the mill full-page preloader animation
 * Just make sure to put in separate file (CSS) that loads right after necessary stuff, or set via JS on ready, or use WP hooks
 */
?>
<!-- Preloader -->
<div class="preloaderWrapper preloader">
    <div class="preloaderAnimationWrapper autoCenterParent">
        <div class="preloaderAnimation">
            <?php if(get_site_icon_url(512)!==''): ?>
                <img class="rotating responsive-img" style="max-width:500px;" src="<?php echo get_site_icon_url(512); ?>">
            <?php else: ?>
                <i class="rotating material-icons">autorenew</i>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Fatal error fallback -->
<?php global $jtzwpHelpers; ?>

<script>
    (function(){
        var userIsAdmin = (<?php echo $jtzwpHelpers->boolToString($jtzwpHelpers->getIsUserAdmin()); ?>);
        var fallbackTimeout = userIsAdmin ? 200 : 6000;
        setTimeout(function(){
            document.querySelector('.preloaderWrapper').style.display = 'none';
        },fallbackTimeout);
    })();
</script>