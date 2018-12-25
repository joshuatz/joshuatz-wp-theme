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
    <script>console.log(<?php echo json_encode($wp_query); ?>);</script>
    <script>
        console.group('URL Info');
            console.log(<?php echo json_encode($jtzwpHelpers->getUrlInfo()); ?>);
        console.groupEnd();
    </script>
<?php endif; ?>

<?
/**
 * Trackers
 * Note: Disabled for logged in WP users
 */
?>
<?php $gauid = jtzwp_validate_gauid_setting(); ?>
<?php if($gauid && $jtzwpHelpers->getIsUserAdmin()===false): ?>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/autotrack/2.4.1/autotrack.js" integrity="sha256-vOtzmT0JTEyCHHVxkhEDvcjAXpCCxPxRPSRDWNU1k9s=" crossorigin="anonymous"></script>
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
    <script>console.log('Invalid or missing GAUID for GA');</script>
<?php endif; ?>