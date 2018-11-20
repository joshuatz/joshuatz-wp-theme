<?php
/**
 * Template for displaying custom_built_tools custom post type archive - basically index of custom tools
 */

get_header(); ?>

<div id="main">
    <div class="customToolsListingsWrapper">
        <?php if(have_posts()): ?>
            <h2 class="customToolsListingsTitle">Here are some tools I have built, either for myself or others.</h2>
            <div id="customToolsListings">
                <div class="row">
                    <?php
                    // Loop through matching tools
                    while (have_posts()): the_post();
                    ?>
                    <div class="col s4 customToolListing">
                        <div class="card">
                            
                        </div>
                    </div>
                    <?php
                    // End post loop
                    endwhile;
                    ?>
                </div>
                <?php the_posts_pagination(); ?>
            </div>
        <?php else: ?>
            <h2>Sorry, nothing here yet...</h2>
        <?php endif; ?>
    </div>
</div>