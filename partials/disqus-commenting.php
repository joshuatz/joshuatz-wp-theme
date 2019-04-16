<?php
/**
 * Partial - Disqus commenting section
 */
?>
<?php
/**
 * Preprocessing - check for valid setting
 */
$hasValidDisqus = false;
$hasNoDisqus = false;
$disqusCustomSubdomain = get_option('jtzwp_settings')['jtzwp_disqus_subdomain'];
if (isset($disqusCustomSubdomain) && preg_match('/[^\.]+\.disqus\.com/',$disqusCustomSubdomain)){
    $hasValidDisqus = true;
}
else if (!isset($disqusCustomSubdomain) || $disqusCustomSubdomain===''){
    $hasNoDisqus = true;
}
?>

<div id="disqusCommentWrapper" style="width:90%; margin-left:5%">
    <?php if($hasValidDisqus): ?>
    <div id="disqus_thread"></div>
    <?php elseif(!$hasNoDisqus): ?>
    <!--<div>Invalid Disqus Config</div>-->
    <?php else: ?>
    <!-- No disqus configured -->
    <?php endif; ?>
</div>
<?php if($hasValidDisqus): ?>
<script>
/**
 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables */
/*
var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
    
var disqus_config = function () {
    // this.page.url - should be page's canonical URL
    this.page.url = (document.location.origin + document.location.pathname);
    // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    //this.page.identifier = PAGE_IDENTIFIER; 
};

(function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = '//<?php echo $disqusCustomSubdomain;?>/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript> 
<?php endif; ?>