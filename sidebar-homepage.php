<?php
/**
 * @file - Sidebar for homepage only
 */
?>

<?php if (is_active_sidebar('homepage')): ?>
    <?php dynamic_sidebar('homepage'); ?>
<?php endif; ?>