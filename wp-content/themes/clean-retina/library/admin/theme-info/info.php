<?php
	if ( !class_exists('Clean_Retina_Info') ) :

		class Clean_Retina_Info {

			public $tab_sections = array();
			public $theme_name = ''; // For storing Theme Name
			public $theme_version = ''; // For Storing Theme Current Version Information
			public $theme_slug = ''; // For Storing Theme slug

			/*
			 * Constructor the info Screen
			*/
			public function __construct() {
				
				/* Useful Variables */
				$theme = wp_get_theme();

				$this->theme_name = $theme->Name;
				$this->theme_version = $theme->Version;
				$this->theme_slug = $theme->get_template();

				/* Define Tabs Sections */
				$this->tab_sections = array(
					'getting_started' 		=> __('Getting Started', 'clean-retina'),
					'recommended_actions' 	=> __('Recommended Actions', 'clean-retina'),
					'support' 				=> __('Support', 'clean-retina'),
					'free_vs_pro' 			=> __('Free Vs Pro', 'clean-retina'),
				);

				/* Theme Activation Notice */
				add_action( 'admin_notices', array( $this, 'clean_retina_activation_admin_notice' ) );

				/* Create a Theme Details Page */
				add_action( 'admin_menu', array( $this, 'clean_retina_info_register_menu' ) );

				/* Enqueue Styles & Scripts for Theme Details Page */
				add_action( 'admin_enqueue_scripts', array( $this, 'clean_retina_info_styles_and_scripts' ) );
			}

			/* Notification Message on Theme Activation */
			public function clean_retina_activation_admin_notice() {
				global $pagenow;

				if ( is_admin() && ('themes.php' == $pagenow) && (isset($_GET['activated'])) ) { ?>
					<div class="notice notice-info is-dismissible">
						<p><?php echo sprintf( esc_html__( 'Welcome! Thank you for choosing %1$s. Please make sure you visit our %2$stheme details%3$s page to get started with %1$s theme.', 'clean-retina' ), esc_html($this->theme_name), '<a href="' . esc_url( admin_url('/themes.php?page=clean-retina-details') ) . '">', '</a>' ); ?></p>
						<p><a class="button button-primary" href="<?php echo esc_url(admin_url('/themes.php?page=clean-retina-details')) ?>"><?php printf( esc_html__( 'Get started with %1$s', 'clean-retina' ), $this->theme_name ); ?></a></p>
					</div>
					<?php
				}
			}

			/* Register Menu for Theme Details Page */
			public function clean_retina_info_register_menu() {
				add_theme_page( esc_html__( 'About Clean Retina', 'clean-retina' ), esc_html__( 'About Clean Retina', 'clean-retina' ) , 'edit_theme_options', 'clean-retina-details', array( $this, 'clean_retina_info_screen' ));
			}

			/* Theme Details Page */
			public function clean_retina_info_screen() { ?>
				<div class="theme-info-wrapper">
					<a href="<?php echo esc_url('https://www.themehorse.com/'); ?>" target="_blank" class="themehorse-logo"></a>
					<h1><?php printf(
						// WPCS: XSS OK.
						/* translators: 1-theme name*/
						esc_html__( 'Welcome to %1$s', 'clean-retina' ), esc_html($this->theme_name) ); ?><span><?php echo esc_html($this->theme_version); ?></span></h1>
					<div class="about-text">
						<?php printf( esc_html__( '%1$s is now installed and all of it\'s features are now ready to use. Here, we have the following information and helpful links for your better experience with %1$s. %2$sThank you very much for installing and activating our theme! %2$sLet\'s get start setting up your site now... :)', 'clean-retina' ), esc_html($this->theme_name), '<br>' ); ?>
					</div>

					<div class="th-btn-block">
						<a href="<?php echo esc_url('https://www.themehorse.com/themes/clean-retina/'); ?>" class="th-btn" target="_blank"><?php esc_html_e('Theme Details', 'clean-retina'); ?></a><a href="<?php echo esc_url('https://www.themehorse.com/preview/clean-retina/'); ?>" class="th-btn" target="_blank"><?php esc_html_e('View Demo', 'clean-retina'); ?></a><a href="<?php echo esc_url('https://wordpress.org/support/theme/clean-retina/reviews/'); ?>" class="th-btn" target="_blank"><?php esc_html_e('Rate This Theme', 'clean-retina'); ?></a><a href="<?php echo esc_url('https://www.themehorse.com/themes/clean-retina-pro'); ?>" class="th-btn upgrade-button" target="_blank"><?php esc_html_e('Upgrade to Pro', 'clean-retina'); ?></a>
					</div>

					<div class="nav-tab-wrapper clearfix">
						<?php $tabs = $this->tab_sections;
						foreach($tabs as $id => $label) :
							$section = isset($_GET['section']) ? $_GET['section'] : 'getting_started'; // Input var okay.
							$nav_class = 'nav-tab ';
							$nav_class .= $id;
							if ($id == $section) {
								$nav_class .= ' nav-tab-active';
							} ?>
							<a href="<?php echo esc_url(admin_url('themes.php?page=clean-retina-details&section='.$id)); ?>" class="<?php echo esc_attr($nav_class); ?>" >
								<?php echo esc_html( $label ); ?>
							</a>
						<?php endforeach; ?>
				   	</div>

			   		<div class="section-wrapper">
		   				<?php $section = isset($_GET['section']) ? $_GET['section'] : 'getting_started'; // Input var okay. ?>
	   					<div class="<?php echo esc_attr($section); ?> clearfix">
	   						<?php require_once get_template_directory() . '/library/admin/theme-info/sections/'.$section.'.php'; ?>
						</div>
						<?php if ( $section !== 'free_vs_pro' ) { ?>
							<div class="upgrade_content">
								<h2><?php printf( esc_html__( 'Unlock all the Features with %1$s Pro', 'clean-retina' ), esc_html($this->theme_name) ); ?></h2>
								<div class="leftside">
									<ul>
										<li><span class="dashicons dashicons-yes"></span><?php esc_html_e('Site Layout', 'clean-retina'); ?></li>
										<li><span class="dashicons dashicons-yes"></span><?php esc_html_e('30+ Social Profiles', 'clean-retina'); ?></li>
										<li><span class="dashicons dashicons-yes"></span><?php esc_html_e('Image Slider', 'clean-retina'); ?></li>
										<li><span class="dashicons dashicons-yes"></span><?php esc_html_e('Menu Position Options', 'clean-retina'); ?></li>
										<li><span class="dashicons dashicons-yes"></span><?php esc_html_e('Additional Page Template', 'clean-retina'); ?></li>
										<li><span class="dashicons dashicons-yes"></span><?php esc_html_e('Advance Corporate Template', 'clean-retina'); ?></li>
										<li><span class="dashicons dashicons-yes"></span><?php esc_html_e('Font Family', 'clean-retina'); ?></li>
										<li><span class="dashicons dashicons-yes"></span><?php esc_html_e('Font Size', 'clean-retina'); ?></li>
										<li><span class="dashicons dashicons-yes"></span><?php esc_html_e('Font Color', 'clean-retina'); ?></li>
										<li><span class="dashicons dashicons-yes"></span><?php esc_html_e('Color Options', 'clean-retina'); ?></li>
										<li><span class="dashicons dashicons-yes"></span><?php esc_html_e('Color Scheme', 'clean-retina'); ?></li>
										<li><span class="dashicons dashicons-yes"></span><?php esc_html_e('Color Elements', 'clean-retina'); ?></li>
										<li><span class="dashicons dashicons-yes"></span><?php esc_html_e('Custom Widgets', 'clean-retina'); ?></li>
										<li><span class="dashicons dashicons-yes"></span><?php esc_html_e('Footer Editor', 'clean-retina'); ?></li>
									</ul>
								</div>
								<div class="rightside">
									<div class="section-upgrade">
										<h2><?php esc_html_e('Upgrade to Pro', 'clean-retina'); ?></h2>
										<div class="price">45</div>
										<a class="th-btn" target="_blank" href="<?php echo esc_url('https://www.themehorse.com/themes/clean-retina-pro'); ?>"><?php esc_html_e('Upgrade to Pro', 'clean-retina'); ?></a>
									</div>
								</div>
							</div>
						<?php } ?>
				   	</div>
			   	</div>
				<?php
			}

			/* Enqueue Styles for the Theme Details Page */
			public function clean_retina_info_styles_and_scripts( $hook ) {
				if ( $hook == 'appearance_page_' . $this->theme_slug . '-details' ) {
					wp_enqueue_style( 'clean_retina-details-screen', get_template_directory_uri() . '/library/admin/theme-info/css/theme-info.css' );
				}
			}

		}

		new Clean_Retina_Info();

	endif;
