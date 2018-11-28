<?php
/**
 * @file code to load on every page. Should be loaded before anything else. PHP / JS / HTML
 */
?>
<?php
    global $jtzwpHelpers;
?>
<?php if($jtzwpHelpers->isDebug): ?>
    <script>console.log(<?php echo json_encode($wp_query); ?>);</script>
    <script>
        console.group('URL Info');
            console.log(<?php echo json_encode($jtzwpHelpers->getUrlInfo()); ?>);
        console.groupEnd();
    </script>
<?php endif; ?>