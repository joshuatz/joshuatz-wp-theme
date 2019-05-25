<?php
/**
 * The template for displaying under-construction mode
 */

get_header(); ?>

<main id="main" role="main">
    <section class="underConstruction">
        <header class="page-header">
            <h1 class="page-title">Under Construction</h1>
        </header><!-- .page-header -->

        <div class="page-content">
            <div class="row center">
                <div class="iconWrapper jtzwp-lightblue autoCenterSimple">
                    <i class="material-icons" style="font-size:12rem;">build</i>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 halign">
                    <div class="card-panel white flow-text">
                        <span>This site is currently undergoing maintenance, and as such, all pages are temporarily hidden to prevent any confusion while changes are being made. Thank you for your patience and understanding.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- .site-main -->

<?php get_footer(); ?>
