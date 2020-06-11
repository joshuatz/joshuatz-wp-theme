<?php
/**
 * Footer
 */
?>
<?php wp_footer(); ?>
<div class="footer">
    <?php if(!is_home() && !is_front_page() && !is_archive()): ?>
        <?php get_template_part('partials/copyright-notice'); ?>
    <?php endif; ?>
</div>
</body>
</html>