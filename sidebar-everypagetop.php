<?php
/**
 * @file - Widget area / sidebar for every page - top bar callouts
 */
?>

<?php if (is_active_sidebar('everypagetop')): ?>
    <div class="everypageTopWidgetArea sidebar">
        <?php dynamic_sidebar('everypagetop'); ?>
    </div>
<?php endif; ?>