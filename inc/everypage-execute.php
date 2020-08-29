<?php
/**
 * @file code to load on every page. Should be loaded before anything else. PHP / JS / HTML
 */
?>
<?php
    global $jtzwpHelpers;
?>

<?php
/**
 * Debug stuff
 */
?>
<?php if($jtzwpHelpers->isDebug): ?>
    <script>window.isDebug = true;</script>
    <script>
        const $wp_query = <?php echo json_encode($wp_query); ?>;
        const postInfo = <?php echo json_encode($jtzwpHelpers->getBasicPostInfo(null)); ?>;
        const currentThemeFile = '<?php echo $jtzwpHelpers->getCurrentThemeFile(); ?>';
        console.log('WordPress Info', {
            $wp_query,
            postInfo,
            currentThemeFile
        });
    </script>
    <script>
        console.log('URL Info', <?php echo json_encode($jtzwpHelpers->getUrlInfo()); ?>);
    </script>
<?php endif; ?>

<?
/**
 * Trackers
 * Note: Disabled for logged in WP users and debug
 */
?>
<?php $gauid = jtzwp_validate_gauid_setting(); ?>
<?php if($gauid): ?>
    <?php if ($jtzwpHelpers->getIsUserAdmin()===false && $jtzwpHelpers->isDebug===false && $_COOKIE['jtzwpKnownUser']!=='true' && $_COOKIE['jtzwpGlobalOptOut']!=='true'): ?>
        <?php $analyticsVersion = 'analytics.js'; ?>

        <?php if ($analyticsVersion==='gtag.js'): ?>
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $gauid; ?>"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', '<?php echo $gauid; ?>');
            </script>
        <?php elseif($analyticsVersion==='analytics.js'): ?>
            <!-- Analytics.js - Google Analytics -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/autotrack/2.4.1/autotrack.js" integrity="sha256-vOtzmT0JTEyCHHVxkhEDvcjAXpCCxPxRPSRDWNU1k9s=" crossorigin="anonymous" async></script>
            <script>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

                ga('create', '<?php echo $gauid; ?>', 'auto');

                ga('require', 'outboundLinkTracker', {
                    events: ['click', 'auxclick', 'contextmenu']
                });
                ga('require', 'eventTracker', {
                    events: ['click', 'auxclick', 'contextmenu'],
                    hitFilter: function(model, element, event) {
                        model.set('eventAction', event.type, true);
                    }
                });

                ga('send', 'pageview');
            </script>
        <?php endif; ?>
    <?php else: ?>
        <?php if($jtzwpHelpers->isDebug): ?>
        <script>console.log('Analytics tracking disabled for known user');</script>
        <?php endif; ?>
    <?php endif; ?>
<?php else: ?>
    <script>console.warn('Invalid or missing GAUID for GA');</script>
<?php endif; ?>

<?php
/**
 * Logged in user check
 */
?>
<?php if ($jtzwpHelpers->getIsUserAdmin() || $jtzwpHelpers->isDebug): ?>
    <?php // This cookie will not be used for security ?>
    <script>
        (function($){
            $(document).ready(function(){
                helpers.setCookie('jtzwpKnownUser','true',365,'Lax');
            });
        })(jQuery)
    </script>
<?php endif; ?>