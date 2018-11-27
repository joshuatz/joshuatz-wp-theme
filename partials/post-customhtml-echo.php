<?php
/**
 * Partial - parse custom HTML and echo it back into view to user
 */
?>
<?php
    global $jtzwpHelpers;
?>
<div class="customHTMLSectionWrapper">
    <!-- Raw Custom HTML Code -->
    <?php if (get_field('raw_custom_html_code')): ?>
        <?php echo $jtzwpHelpers->getHtmlFromRaw(get_field('raw_custom_html_code'))->combo; ?>
    <?php endif; ?>
    <!-- Uploaded Custom HTML File Path -->
    <?php if (get_field('uploaded_custom_html_file_path')): ?>
        <?php echo $jtzwpHelpers->getHtmlFromFile(get_field('uploaded_custom_html_file_path')); ?>
    <?php endif; ?>
</div>