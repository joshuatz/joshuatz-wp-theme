<?php
/**
 * @file - Sidebar for under all posts
 */
?>

<?php if (is_active_sidebar('underpost')): ?>
    <div class="underpostWidgetArea sidebar">
        <?php dynamic_sidebar('underpost'); ?>
    </div>
<?php endif; ?>