<?php
/**
 * Builds our admin page.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'koromo_create_menu' ) ) {
	add_action( 'admin_menu', 'koromo_create_menu' );
	/**
	 * Adds our "Koromo" dashboard menu item
	 *
	 */
	function koromo_create_menu() {
		$koromo_page = add_theme_page( 'Koromo', 'Koromo', apply_filters( 'koromo_dashboard_page_capability', 'edit_theme_options' ), 'koromo-options', 'koromo_settings_page' );
		add_action( "admin_print_styles-$koromo_page", 'koromo_options_styles' );
	}
}

if ( ! function_exists( 'koromo_options_styles' ) ) {
	/**
	 * Adds any necessary scripts to the Koromo dashboard page
	 *
	 */
	function koromo_options_styles() {
		wp_enqueue_style( 'koromo-options', get_template_directory_uri() . '/css/admin/admin-style.css', array(), KOROMO_VERSION );
	}
}

if ( ! function_exists( 'koromo_settings_page' ) ) {
	/**
	 * Builds the content of our Koromo dashboard page
	 *
	 */
	function koromo_settings_page() {
		?>
		<div class="wrap">
			<div class="metabox-holder">
				<div class="koromo-masthead clearfix">
					<div class="koromo-container">
						<div class="koromo-title">
							<a href="<?php echo esc_url(KOROMO_THEME_URL); ?>" target="_blank"><?php esc_html_e( 'Koromo', 'koromo' ); ?></a> <span class="koromo-version"><?php echo KOROMO_VERSION; ?></span>
						</div>
						<div class="koromo-masthead-links">
							<?php if ( ! defined( 'KOROMO_PREMIUM_VERSION' ) ) : ?>
								<a class="koromo-masthead-links-bold" href="<?php echo esc_url(KOROMO_THEME_URL); ?>" target="_blank"><?php esc_html_e( 'Premium', 'koromo' );?></a>
							<?php endif; ?>
							<a href="<?php echo esc_url(KOROMO_WPKOI_AUTHOR_URL); ?>" target="_blank"><?php esc_html_e( 'WPKoi', 'koromo' ); ?></a>
                            <a href="<?php echo esc_url(KOROMO_DOCUMENTATION); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'koromo' ); ?></a>
						</div>
					</div>
				</div>

				<?php
				/**
				 * koromo_dashboard_after_header hook.
				 *
				 */
				 do_action( 'koromo_dashboard_after_header' );
				 ?>

				<div class="koromo-container">
					<div class="postbox-container clearfix" style="float: none;">
						<div class="grid-container grid-parent">

							<?php
							/**
							 * koromo_dashboard_inside_container hook.
							 *
							 */
							 do_action( 'koromo_dashboard_inside_container' );
							 ?>

							<div class="form-metabox grid-70" style="padding-left: 0;">
								<h2 style="height:0;margin:0;"><!-- admin notices below this element --></h2>
								<form method="post" action="options.php">
									<?php settings_fields( 'koromo-settings-group' ); ?>
									<?php do_settings_sections( 'koromo-settings-group' ); ?>
									<div class="customize-button hide-on-desktop">
										<?php
										printf( '<a id="koromo_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
											esc_url( admin_url( 'customize.php' ) ),
											esc_html__( 'Customize', 'koromo' )
										);
										?>
									</div>

									<?php
									/**
									 * koromo_inside_options_form hook.
									 *
									 */
									 do_action( 'koromo_inside_options_form' );
									 ?>
								</form>

								<?php
								$modules = array(
									'Backgrounds' => array(
											'url' => KOROMO_THEME_URL,
									),
									'Blog' => array(
											'url' => KOROMO_THEME_URL,
									),
									'Colors' => array(
											'url' => KOROMO_THEME_URL,
									),
									'Disable Elements' => array(
											'url' => KOROMO_THEME_URL,
									),
									'Demo Import' => array(
											'url' => KOROMO_THEME_URL,
									),
									'Hooks' => array(
											'url' => KOROMO_THEME_URL,
									),
									'Import / Export' => array(
											'url' => KOROMO_THEME_URL,
									),
									'Menu Plus' => array(
											'url' => KOROMO_THEME_URL,
									),
									'Page Header' => array(
											'url' => KOROMO_THEME_URL,
									),
									'Secondary Nav' => array(
											'url' => KOROMO_THEME_URL,
									),
									'Spacing' => array(
											'url' => KOROMO_THEME_URL,
									),
									'Typography' => array(
											'url' => KOROMO_THEME_URL,
									),
									'Elementor Addon' => array(
											'url' => KOROMO_THEME_URL,
									)
								);

								if ( ! defined( 'KOROMO_PREMIUM_VERSION' ) ) : ?>
									<div class="postbox koromo-metabox">
										<h3 class="hndle"><?php esc_html_e( 'Premium Modules', 'koromo' ); ?></h3>
										<div class="inside" style="margin:0;padding:0;">
											<div class="premium-addons">
												<?php foreach( $modules as $module => $info ) { ?>
												<div class="add-on activated koromo-clear addon-container grid-parent">
													<div class="addon-name column-addon-name" style="">
														<a href="<?php echo esc_url( $info[ 'url' ] ); ?>" target="_blank"><?php echo esc_html( $module ); ?></a>
													</div>
													<div class="addon-action addon-addon-action" style="text-align:right;">
														<a href="<?php echo esc_url( $info[ 'url' ] ); ?>" target="_blank"><?php esc_html_e( 'Learn more', 'koromo' ); ?></a>
													</div>
												</div>
												<div class="koromo-clear"></div>
												<?php } ?>
											</div>
										</div>
									</div>
								<?php
								endif;

								/**
								 * koromo_options_items hook.
								 *
								 */
								do_action( 'koromo_options_items' );
								?>
							</div>

							<div class="koromo-right-sidebar grid-30" style="padding-right: 0;">
								<div class="customize-button hide-on-mobile">
									<?php
									printf( '<a id="koromo_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
										esc_url( admin_url( 'customize.php' ) ),
										esc_html__( 'Customize', 'koromo' )
									);
									?>
								</div>

								<?php
								/**
								 * koromo_admin_right_panel hook.
								 *
								 */
								 do_action( 'koromo_admin_right_panel' );

								  ?>
                                
                                <div class="wpkoi-doc">
                                	<h3><?php esc_html_e( 'Koromo documentation', 'koromo' ); ?></h3>
                                	<p><?php esc_html_e( 'If You`ve stuck, the documentation may help on WPKoi.com', 'koromo' ); ?></p>
                                    <a href="<?php echo esc_url(KOROMO_DOCUMENTATION); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Koromo documentation', 'koromo' ); ?></a>
                                </div>
                                
                                <div class="wpkoi-social">
                                	<h3><?php esc_html_e( 'WPKoi on Facebook', 'koromo' ); ?></h3>
                                	<p><?php esc_html_e( 'If You want to get useful info about WordPress and the theme, follow WPKoi on Facebook.', 'koromo' ); ?></p>
                                    <a href="<?php echo esc_url(KOROMO_WPKOI_SOCIAL_URL); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Go to Facebook', 'koromo' ); ?></a>
                                </div>
                                
                                <div class="wpkoi-review">
                                	<h3><?php esc_html_e( 'Help with You review', 'koromo' ); ?></h3>
                                	<p><?php esc_html_e( 'If You like Koromo theme, show it to the world with Your review. Your feedback helps a lot.', 'koromo' ); ?></p>
                                    <a href="<?php echo esc_url(KOROMO_WORDPRESS_REVIEW); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Add my review', 'koromo' ); ?></a>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'koromo_admin_errors' ) ) {
	add_action( 'admin_notices', 'koromo_admin_errors' );
	/**
	 * Add our admin notices
	 *
	 */
	function koromo_admin_errors() {
		$screen = get_current_screen();

		if ( 'appearance_page_koromo-options' !== $screen->base ) {
			return;
		}

		if ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) {
			 add_settings_error( 'koromo-notices', 'true', esc_html__( 'Settings saved.', 'koromo' ), 'updated' );
		}

		if ( isset( $_GET['status'] ) && 'imported' == $_GET['status'] ) {
			 add_settings_error( 'koromo-notices', 'imported', esc_html__( 'Import successful.', 'koromo' ), 'updated' );
		}

		if ( isset( $_GET['status'] ) && 'reset' == $_GET['status'] ) {
			 add_settings_error( 'koromo-notices', 'reset', esc_html__( 'Settings removed.', 'koromo' ), 'updated' );
		}

		settings_errors( 'koromo-notices' );
	}
}
