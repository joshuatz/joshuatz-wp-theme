<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<?php if($jtzwpHelpers->isDebug): ?>
			<?php var_dump($wp_query); ?>
		<?php endif; ?>
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'joshuatzwp' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content row">
					<div class="col s12 m6 halign">
						<div class="card-panel white">
							<span>It looks like the page you are trying to reach does not exist, no longer exists, or just doesn't feel like talking to you right now. Maybe you can find it by using the navigation menu above?</span>
						</div>
					</div>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
