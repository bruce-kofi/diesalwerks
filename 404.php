<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div id="primary" <?php koromo_content_class(); ?>>
		<main id="main" <?php koromo_main_class(); ?>>
			<?php
			/**
			 * koromo_before_main_content hook.
			 *
			 */
			do_action( 'koromo_before_main_content' );
			?>

			<div class="inside-article">

				<?php
				/**
				 * koromo_before_content hook.
				 *
				 *
				 * @hooked koromo_featured_page_header_inside_single - 10
				 */
				do_action( 'koromo_before_content' );
				?>

				<header class="entry-header">
					<h1 class="entry-title" itemprop="headline"><?php echo apply_filters( 'koromo_404_title', __( 'Oops! That page can&rsquo;t be found.', 'koromo' ) ); // WPCS: XSS OK. ?></h1>
				</header><!-- .entry-header -->

				<?php
				/**
				 * koromo_after_entry_header hook.
				 *
				 *
				 * @hooked koromo_post_image - 10
				 */
				do_action( 'koromo_after_entry_header' );
				?>

				<div class="entry-content" itemprop="text">
					<?php
					echo '<p>' . apply_filters( 'koromo_404_text', __( 'It looks like nothing was found at this location. Maybe try searching?', 'koromo' ) ) . '</p>'; // WPCS: XSS OK.

					get_search_form();
					?>
				</div><!-- .entry-content -->

				<?php
				/**
				 * koromo_after_content hook.
				 *
				 */
				do_action( 'koromo_after_content' );
				?>

			</div><!-- .inside-article -->

			<?php
			/**
			 * koromo_after_main_content hook.
			 *
			 */
			do_action( 'koromo_after_main_content' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	/**
	 * koromo_after_primary_content_area hook.
	 *
	 */
	 do_action( 'koromo_after_primary_content_area' );

	 koromo_construct_sidebars();

get_footer();
