<?php
/**
 * Footer
 */
?>
<a class="waves-effect waves-light btn modal-trigger" href="#businessCardMaterializeModal">Business Card</a>
<div id="businessCardMaterializeModal" class=" businessCardMaterializeModal modal" data-opacity="0.9">
    <div class="modal-content">
        <?php get_template_part('partials/business-card-materialize'); ?>
    </div>
</div>
<?php get_template_part('partials/business-card-materialize'); ?>
<?php wp_footer(); ?>
</body>
</html>