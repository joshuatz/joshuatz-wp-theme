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
 */
?>
<?php $gauid = jtzwp_validate_gauid_setting(); ?>
<?php if($gauid): ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $gauid; ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo $gauid; ?>');
    </script>
<?php else: ?>
    <script>console.log('Invalid or missing GAUID for GA');</script>
<?php endif; ?>