<?php
/**
 * Generic sidbear
 */
?>

<?php if (is_active_sidebar('innercontentmain')): ?>
    <div class="innerContentMainSidebar sidebar">
        <?php dynamic_sidebar('innercontentmain'); ?>
    </div>
<?php endif; ?>