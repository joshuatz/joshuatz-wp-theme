<?php
/**
 * @file Partial - block that displays "meta" information about the post (last updated, author, etc.)
 * Current design uses Materialize cards
 */
?>
<div class="card expandablePostDetailsCard">
    <!--<div class="card-image waves-effect waves-block waves-light">
        <img class="activator" src="REPLACEME">
    </div>-->
    <div class="card-content">
        <span class="card-title activator grey-text text-darken-4">Click for Post Details<i class="material-icons right">more_vert</i></span>
        <!--<p><a href="#">This is a link</a></p>-->
    </div>
    <div class="card-reveal">
        <span class="card-title grey-text text-darken-4">Full Post Details<i class="material-icons right">close</i></span>
        <div class="fullPostDetailsWrapper">
            <div class="row">
                <div class="col s4 offset-s2">Date Posted:</div>
                <div class="col s6"><?php echo strftime('%b. %d, %Y',strtotime(get_the_date())); ?></div>
            </div>
            <div class="row">
                <div class="col s4 offset-s2">Last Updated:</div>
                <div class="col s6"><?php echo strftime('%b. %d, %Y',strtotime(get_the_modified_date())); ?></div>
            </div>
        </div>

        <p>Here is some more information about this product that is only revealed once clicked on.</p>
    </div>
</div>
