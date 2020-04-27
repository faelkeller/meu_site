<?php 
/**
 * @package Theme Horse
 * @subpackage Clean_Retina
 * @since Clean Retina 3.0
 */
if ( ! class_exists( 'WP_Customize_Section' ) ) {
	return null;
}
function cleanretina_textarea_register($wp_customize){
	class Cleanretina_Customize_cleanretina_upgrade extends WP_Customize_Control {
		public function render_content() { ?>
		<div class="theme-info">
			<a title="<?php esc_attr_e( 'Review Clean Retina', 'clean-retina' ); ?>" href="<?php echo esc_url( 'http://wordpress.org/support/view/theme-reviews/clean-retina' ); ?>" target="_blank">
			<?php _e( 'Rate Clean Retina', 'clean-retina' ); ?>
			</a>
			<a href="<?php echo esc_url( 'http://themehorse.com/theme-instruction/clean-retina/' ); ?>" title="<?php esc_attr_e( 'Clean Retina Theme Instructions', 'clean-retina' ); ?>" target="_blank">
			<?php _e( 'Theme Instructions', 'clean-retina' ); ?>
			</a>
			<a href="<?php echo esc_url( 'http://themehorse.com/support-forum/' ); ?>" title="<?php esc_attr_e( 'Support Forum', 'clean-retina' ); ?>" target="_blank">
			<?php _e( 'Support Forum', 'clean-retina' ); ?>
			</a>
			<a href="<?php echo esc_url( 'http://themehorse.com/preview/clean-retina/' ); ?>" title="<?php esc_attr_e( 'Clean Retina Demo', 'clean-retina' ); ?>" target="_blank">
			<?php _e( 'View Demo', 'clean-retina' ); ?>
			</a>
		</div>
		<?php
		}
	}
	class Cleanretina_Customize_Category_Control extends WP_Customize_Control {
		/**
		* The type of customize control being rendered.
		*/
		public $type = 'multiple-select';
		/**
		* Displays the multiple select on the customize screen.
		*/
		public function render_content() {
		global $options, $array_of_default_settings;
		$options = wp_parse_args(  get_option( 'cleanretina_theme_options', array() ),  cleanretina_get_option_defaults());
		$categories = get_categories(); ?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
				<option value="0" <?php if ( empty( $options['front_page_category'] ) ) { selected( true, true ); } ?>><?php _e( '--Disabled--', 'clean-retina' ); ?></option>
				<?php
					foreach ( $categories as $category) :?>
						<option value="<?php echo $category->cat_ID; ?>" <?php if ( in_array( $category->cat_ID, $options['front_page_category']) ) { echo 'selected="selected"';}?>><?php echo $category->cat_name; ?></option>
					<?php endforeach; ?>
				?>
				</select>
			</label>
		<?php 
		}
	}
}


/**
 * Upsell customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class Cleanretina_Customize_Section_Upsell extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'upsell';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="upgrade-to-pro" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}


function cleanretina_customize_register($wp_customize){
	$wp_customize->add_panel( 'cleanretina_design_options_panel', array(
	'priority'       => 200,
	'capability'     => 'edit_theme_options',
	'title'          => __('Design Options', 'clean-retina')
	));

	$wp_customize->add_panel( 'cleanretina_advanced_options_panel', array(
	'priority'       => 300,
	'capability'     => 'edit_theme_options',
	'title'          => __('Advanced Options', 'clean-retina')
	));

	$wp_customize->add_panel( 'cleanretina_featured_post_page_panel', array(
	'priority'       => 400,
	'capability'     => 'edit_theme_options',
	'title'          => __('Featured Post/ Page Slider', 'clean-retina')
	));
	global $options, $array_of_default_settings;
	$options = wp_parse_args(  get_option( 'cleanretina_theme_options', array() ), cleanretina_get_option_defaults());
/********************Clean Retina Upgrade ******************************************/
	$wp_customize->add_section('cleanretina_upgrade', array(
		'title'					=> __('Clean Retina Support', 'clean-retina'),
		'priority'				=> 1,
	));
	$wp_customize->add_setting( 'cleanretina_theme_options[cleanretina_upgrade]', array(
		'default'				=> false,
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
	));
	$wp_customize->add_control(
		new Cleanretina_Customize_cleanretina_upgrade(
		$wp_customize,
		'cleanretina_upgrade',
			array(
				'label'					=> __('Clean Retina Upgrade','clean-retina'),
				'section'				=> 'cleanretina_upgrade',
				'settings'				=> 'cleanretina_theme_options[cleanretina_upgrade]',
			)
		)
	);
/******************** Design Options ******************************************/
/******************** Custom Header ******************************************/
	$wp_customize->add_section('custom_header_setting', array(
		'title'					=> __('Custom Header', 'clean-retina'),
		'priority'				=> 200,
		'panel'					=>'cleanretina_design_options_panel'
	));
	$wp_customize->add_setting( 'cleanretina_theme_options[hide_header_searchform]', array(
		'default'				=> 0,
		'sanitize_callback'	=> 'prefix_sanitize_integer',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	));
	$wp_customize->add_control( 'custom_header_setting', array(
		'label'					=> __('Hide Searchform from Header', 'clean-retina'),
		'section'				=> 'custom_header_setting',
		'settings'				=> 'cleanretina_theme_options[hide_header_searchform]',
		'type'					=> 'checkbox',
	));
	/********************Default Layout options ******************************************/
	$wp_customize->add_section('cleanretina_default_layout', array(
		'title'					=> __('Default Layout Options', 'clean-retina'),
		'priority'				=> 230,
		'panel'					=>'cleanretina_design_options_panel'
	));
	$wp_customize->add_setting('cleanretina_theme_options[default_layout]', array(
		'default'				=> 'right-sidebar',
		'sanitize_callback'	=> 'prefix_sanitize_integer',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	));
	$wp_customize->add_control('cleanretina_default_layout', array(
		'section'				=> 'cleanretina_default_layout',
		'settings'				=> 'cleanretina_theme_options[default_layout]',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'no-sidebar'				=> __('No Sidebar','clean-retina'),
			'no-sidebar-full-width'	=> __('No Sidebar, Full Width','clean-retina'),
			'no-sidebar-one-column'	=> __('No Sidebar, One Column','clean-retina'),
			'left-sidebar'				=> __('Left Sidebar','clean-retina'),
			'right-sidebar'			=> __('Right Sidebar','clean-retina'),
		),
	));
	/********************Home Page Layout Options******************************************/
	$wp_customize->add_section('cleanretina_homepage_layout', array(
		'title'					=> __('Home Page Layout Options', 'clean-retina'),
		'priority'				=> 240,
		'panel'					=>'cleanretina_design_options_panel'
	));
	$wp_customize->add_setting('cleanretina_theme_options[home_page_layout]', array(
		'default'				=> 'right-sidebar',
		'sanitize_callback'	=> 'prefix_sanitize_integer',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	));
	$wp_customize->add_control('cleanretina_homepage_layout', array(
		'label'					=> __('Layout Display Type on Home Page','clean-retina'),
		'description'					=>__('To select one of these layouts, Latest Posts should be checked in Reading sub-menu of Settings menu. Go to Settings->Reading->Check on Your Latest Posts','clean-retina') .'<br><br>' . __('If you chose the corporate layout then you will have to add corporate layout content from Home Corporate Layout option under Advanced Options Tab.' ,'clean-retina'),
		'priority'				=>10,
		'section'				=> 'cleanretina_homepage_layout',
		'settings'				=> 'cleanretina_theme_options[home_page_layout]',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'no-sidebar'				=> __('No Sidebar','clean-retina'),
			'no-sidebar-full-width'	=> __('No Sidebar, Full Width','clean-retina'),
			'no-sidebar-one-column'	=> __('No Sidebar, One Column','clean-retina'),
			'left-sidebar'				=> __('Left Sidebar','clean-retina'),
			'right-sidebar'			=> __('Right Sidebar','clean-retina'),
			'corporate-layout'		=> __('Corporate Layout','clean-retina'),
		),
	));

	$wp_customize->add_setting('cleanretina_theme_options[blog_display_type]', array(
		'default'				=> 'excerpt_display_one',
		'sanitize_callback'	=> 'prefix_sanitize_integer',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	));
	$wp_customize->add_control('cleanretina_blogdisplay_layout', array(
		'label'					=>__('Blog Display Type on Home Page','clean-retina'),
		'priority'				=>20,
		'section'				=> 'cleanretina_homepage_layout',
		'settings'				=> 'cleanretina_theme_options[blog_display_type]',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'excerpt_display_one'				=> __('Blog Image Large','clean-retina'),
			'excerpt_display_two'	=> __('Blog Image Medium','clean-retina'),
			'content_display'	=> __('Blog Full Content','clean-retina'),
		),
	));
	/********************Custom Css ******************************************/
	$wp_customize->add_section( 'cleanretina_custom_css', array(
		'title'					=> __('Custom CSS', 'clean-retina'),
		'description'			=> __('This CSS will overwrite the CSS of style.css file.','clean-retina'),
		'priority'				=> 250,
		'panel'					=>'cleanretina_design_options_panel'
	));
	$wp_customize->add_setting( 'cleanretina_theme_options[custom_css]', array(
		'default'				=> '',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses'
	));
	$wp_customize->add_control( 'custom_css', array(
		'section'				=> 'cleanretina_custom_css',
				'settings'				=> 'cleanretina_theme_options[custom_css]',
				'type'					=> 'textarea'
	));
	/******************** Advanced Options ******************************************/
	/******************** Home Slogan Options ******************************************/
	$wp_customize->add_section('home_slogan_options', array(
		'title'					=> __('Home Slogan Options', 'clean-retina'),
		'priority'				=> 300,
		'panel'					=>'cleanretina_advanced_options_panel'
	));
	$wp_customize->add_setting( 'cleanretina_theme_options[disable_slogan]', array(
		'default'				=> 0,
		'sanitize_callback'	=> 'prefix_sanitize_integer',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	));
	$wp_customize->add_control( 'home_slogan_options', array(
		'label'					=> __('Disable Slogan Part', 'clean-retina'),
		'section'				=> 'home_slogan_options',
		'settings'				=> 'cleanretina_theme_options[disable_slogan]',
		'type'					=> 'checkbox',
	));
	$wp_customize->add_setting('cleanretina_theme_options[slogan_position]', array(
		'default'				=> 'above-slider',
		'sanitize_callback'	=> 'prefix_sanitize_integer',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options'
	));
	$wp_customize->add_control('cleanretina_design_layout', array(
		'label'					=> __('Slogan Position', 'clean-retina'),
		'section'				=> 'home_slogan_options',
		'settings'				=> 'cleanretina_theme_options[slogan_position]',
		'type'					=> 'radio',
		'checked'				=> 'checked',
		'choices'				=> array(
			'above-slider'					=> __('Above Slider','clean-retina'),
			'below-slider'					=> __('Below Slider','clean-retina'),
		),
	));
	$wp_customize->add_setting( 'cleanretina_theme_options[home_slogan1]', array(
		'default'				=> '',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options',
		'sanitize_callback'	=> 'esc_textarea'
	));
	$wp_customize->add_control( 'home_slogan1', array(
		'label'					=> __('Home Page Slogan1', 'clean-retina'),
		'description'			=> __('The appropriate length of the slogan is around 10 words.','clean-retina'),
		'section'				=> 'home_slogan_options',
		'settings'				=> 'cleanretina_theme_options[home_slogan1]',
		'type'					=> 'textarea'
	));
	$wp_customize->add_setting( 'cleanretina_theme_options[home_slogan2]', array(
		'default'				=> '',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options',
		'sanitize_callback'	=> 'esc_textarea'
	));
	$wp_customize->add_control( 'home_slogan2', array(
		'label'					=> __('Home Page Slogan2', 'clean-retina'),
		'description'			=> __('The appropriate length of the slogan is around 10 words.','clean-retina'),
		'section'				=> 'home_slogan_options',
		'settings'				=> 'cleanretina_theme_options[home_slogan2]',
		'type'					=> 'textarea'
	));
	/******************** Home's Corporate Type Layout Options *********************/
	$wp_customize->add_section('home_corporate_layout_options', array(
		'title'					=> __('Homes Corporate Type Layout Options', 'clean-retina'),
		'priority'				=> 310,
		'panel'					=>'cleanretina_advanced_options_panel'
	));
	$wp_customize->add_setting( 'cleanretina_theme_options[corporate_content_title]', array(
		'default'				=> '',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control( 'corporate_content_title', array(
		'priority'				=>10,
		'label'					=> __('Corporate Content Title', 'clean-retina'),
		'section'				=> 'home_corporate_layout_options',
		'settings'				=> 'cleanretina_theme_options[corporate_content_title]',
		'type'					=> 'text'
	));
	// Featured Box
		for ( $i=1; $i <= 3; $i++ ) {
			$wp_customize->add_setting('cleanretina_theme_options[featured_home_box_image]['. $i.']', array(
				'default'					=>'',
				'sanitize_callback'		=>'esc_url_raw',
				'type' 						=> 'option',
				'capability' 				=> 'manage_options'
			));
			$wp_customize->add_control(
				new WP_Customize_Image_Control(
				$wp_customize,
					'featured_home_box_image'. $i,
					array(
					'priority'					=> 1 . $i,
					'label'				=> __('Featured Box #','clean-retina') . $i,
					'description'		=> __('Upload Icon Image','clean-retina'),
					'section'			=> 'home_corporate_layout_options',
					'settings'			=> 'cleanretina_theme_options[featured_home_box_image]'.'['. $i .']',
					)
				)
			);
			$wp_customize->add_setting('cleanretina_theme_options[featured_home_box_link]'.'['. $i .']', array(
				'default'					=>'',
				'sanitize_callback'		=>'esc_url_raw',
				'type' 						=> 'option',
				'capability' 				=> 'manage_options'
			));
			$wp_customize->add_control( 'featured_home_box_link'. $i .'', array(
				'priority'					=> 1 . $i,
				'description'						=> __('Redirect Link', 'clean-retina'),
				'section'					=> 'home_corporate_layout_options',
				'settings'					=> 'cleanretina_theme_options[featured_home_box_link]'.'['. $i .']',
				'type'						=> 'text',
			));
			$wp_customize->add_setting('cleanretina_theme_options[featured_home_box_title]'.'['. $i .']', array(
				'default'					=>'',
				'sanitize_callback'		=>'sanitize_text_field',
				'type' 						=> 'option',
				'capability' 				=> 'manage_options'
			));
			$wp_customize->add_control( 'featured_home_box_title'. $i .'', array(
				'priority'					=> 1 . $i,
				'description'						=> __('Title', 'clean-retina'),
				'section'					=> 'home_corporate_layout_options',
				'settings'					=> 'cleanretina_theme_options[featured_home_box_title]'.'['. $i .']',
				'type'						=> 'text',
			));
			$wp_customize->add_setting('cleanretina_theme_options[featured_home_box_description]'.'['. $i .']', array(
				'default'					=>'',
				'sanitize_callback'		=>'esc_textarea',
				'type' 						=> 'option',
				'capability' 				=> 'manage_options'
			));
			$wp_customize->add_control( 'featured_home_box_description'. $i .'', array(
				'priority'					=> 1 . $i,
				'description'						=> __('Description', 'clean-retina'),
				'section'					=> 'home_corporate_layout_options',
				'settings'					=> 'cleanretina_theme_options[featured_home_box_description]'.'['. $i .']',
				'type'						=> 'textarea',
			));
		}
	/******************** Corporate Page Template Options *********************/
	$wp_customize->add_section('corporate_page_template_options', array(
		'title'					=> __('Corporate Page Template Options', 'clean-retina'),
		'description'			=> '<i>' . __('Settings used on pages that use the "Corporate Template" page template. This template must be assigned to a page before its settings take effect.','clean-retina'). '</i>',
		'priority'				=> 320,
		'panel'					=>'cleanretina_advanced_options_panel'
	));
		// Featured Box
		for ( $i=1; $i <= 3; $i++ ) {
			$wp_customize->add_setting('cleanretina_theme_options[corporate_template_pages]'.'['. $i .']', array(
					'default'					=>'',
					'sanitize_callback'		=>'cleanretina_sanitize_dropdown_pages',
					'type' 						=> 'option',
					'capability' 				=> 'manage_options'
			));
			$wp_customize->add_control( 'cleanretina_theme_options[corporate_template_pages]'.'['. $i .']', array(
				'priority'					=> 1 . $i,
				'label'						=> __('Page #', 'clean-retina') . $i,
				'section'					=> 'corporate_page_template_options',
				'settings'					=> 'cleanretina_theme_options[corporate_template_pages]'.'['. $i .']',
				'type'						=> 'dropdown-pages',
			));
		}
	/******************** Excerpt Options *********************************************/
	$wp_customize->add_section( 'cleanretina_excerpt_section', array(
		'title' 						=> __('Excerpt Options','clean-retina'),
		'priority'					=> 330,
		'panel'						=>'cleanretina_advanced_options_panel'
	));
	$wp_customize->add_setting('cleanretina_theme_options[excerpt_length]', array(
		'default'					=> '30',
		'sanitize_callback'		=> 'cleanretina_sanatize_excerpt_length',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('excerpt_length', array(
		'label'						=> __('Excerpt Length', 'clean-retina'),
		'description'				=> __('Default value for excerpt length is 30 words.','clean-retina'),
		'section'					=> 'cleanretina_excerpt_section',
		'type'						=> 'text',
		'settings'					=> 'cleanretina_theme_options[excerpt_length]'
	) );
	/******************** Feed Redirect *********************************************/
	$wp_customize->add_section( 'cleanretina_feed_redirect_section', array(
		'title' 						=> __('Feed Redirect','clean-retina'),
		'priority'					=> 340,
		'panel'						=>'cleanretina_advanced_options_panel'
	));
	$wp_customize->add_setting('cleanretina_theme_options[feed_url]', array(
		'default'					=> '',
		'sanitize_callback'		=> 'esc_url_raw',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('feed_url', array(
		'label'						=> __('Feed Redirect URL', 'clean-retina'),
		'section'					=> 'cleanretina_feed_redirect_section',
		'type'						=> 'text',
		'settings'					=> 'cleanretina_theme_options[feed_url]'
	) );
	/******************** Homepage / Frontpage Category Setting *********************/
	$wp_customize->add_section(
		'cleanretina_category_section', array(
		'title' 						=> __('Homepage / Frontpage Category Setting','clean-retina'),
		'description'				=> __('Only posts that belong to the categories selected here will be displayed on the front page. ( You may select multiple categories by holding down the CTRL key. ) ','clean-retina'),
		'priority'					=> 350,
		'panel'					=>'cleanretina_advanced_options_panel'
	));
	$wp_customize->add_setting( 'cleanretina_theme_options[front_page_category]', array(
		'default'					=>array(),
		'sanitize_callback'		=> 'prefix_sanitize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control(
		new Cleanretina_Customize_Category_Control(
		$wp_customize,
			'cleanretina_theme_options[front_page_category]',
			array(
			'label'					=> __('Front page posts categories','clean-retina'),
			'section'				=> 'cleanretina_category_section',
			'settings'				=> 'cleanretina_theme_options[front_page_category]',
			'type'					=> 'multiple-select',
			)
		)
	);

	/******************** Slider Options ******************************************************/
	/********************Featured Post/ Page Slider******************************************/
	$wp_customize->add_section( 'cleanretina_featured_content_setting', array(
		'title'					=> __('Featured Post/ Page Slider', 'clean-retina'),
		'priority'				=> 400,
		'panel'					=>'cleanretina_featured_post_page_panel'
	));
	$wp_customize->add_setting( 'cleanretina_theme_options[disable_slider]', array(
		'default'					=> 0,
		'sanitize_callback'		=> 'prefix_sanitize_integer',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control( 'cleanretina_disable_slider', array(
		'priority'					=>410,
		'label'						=> __('Disable Slider', 'clean-retina'),
		'section'					=> 'cleanretina_featured_content_setting',
		'settings'					=> 'cleanretina_theme_options[disable_slider]',
		'type'						=> 'checkbox',
	));
	$wp_customize->add_setting('cleanretina_theme_options[slider_quantity]', array(
		'default'					=> '4',
		'sanitize_callback'		=> 'cleanretina_sanitize_delay_transition',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('slider_quantity', array(
		'priority'					=>420,
		'label'						=> __('Number of Slides', 'clean-retina'),
		'description'				=> __('Please refresh the page to display effect on Slider Quantity','clean-retina'),
		'section'					=> 'cleanretina_featured_content_setting',
		'settings'					=> 'cleanretina_theme_options[slider_quantity]',
		'type'						=> 'text',
	) );
	$wp_customize->add_setting('cleanretina_theme_options[transition_effect]', array(
		'default'					=> 'fade',
		'sanitize_callback'		=> 'cleanretina_sanitize_effect',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('transition_effect', array(
		'priority'					=>430,
		'label'						=> __('Transition Effect', 'clean-retina'),
		'section'					=> 'cleanretina_featured_content_setting',
		'settings'					=> 'cleanretina_theme_options[transition_effect]',
		'type'						=> 'select',
		'choices'					=> array(
			'fade'					=> __('Fade','clean-retina'),
			'wipe'					=> __('Wipe','clean-retina'),
			'scrollUp'				=> __('Scroll Up','clean-retina' ),
			'scrollDown'			=> __('Scroll Down','clean-retina' ),
			'scrollLeft'			=> __('Scroll Left','clean-retina' ),
			'scrollRight'			=> __('Scroll Right','clean-retina' ),
			'blindX'					=> __('Blind X','clean-retina' ),
			'blindY'					=> __('Blind Y','clean-retina' ),
			'blindZ'					=> __('Blind Z','clean-retina' ),
			'cover'					=> __('Cover','clean-retina' ),
			'shuffle'				=> __('Shuffle','clean-retina' ),
		),
	));
	$wp_customize->add_setting('cleanretina_theme_options[transition_delay]', array(
		'default'					=> '4',
		'sanitize_callback'		=> 'cleanretina_sanitize_delay_transition',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('transition_delay', array(
		'priority'					=>440,
		'label'						=> __('Transition Delay', 'clean-retina'),
		'section'					=> 'cleanretina_featured_content_setting',
		'settings'					=> 'cleanretina_theme_options[transition_delay]',
		'type'						=> 'text',
	) );
	$wp_customize->add_setting('cleanretina_theme_options[transition_duration]', array(
		'default'					=> '1',
		'sanitize_callback'		=> 'cleanretina_sanitize_delay_transition',
		'type' 						=> 'option',
		'capability' 				=> 'manage_options'
	));
	$wp_customize->add_control('transition_duration', array(
		'priority'					=>450,
		'label'						=> __('Transition Length', 'clean-retina'),
		'section'					=> 'cleanretina_featured_content_setting',
		'settings'					=> 'cleanretina_theme_options[transition_duration]',
		'type'						=> 'text',
	) );
	/******************** Featured Post/ Page Slider Options  ************/
		$wp_customize->add_section( 'cleanretina_page_post_options', array(
			'title' 						=> __('Featured Post/ Page Slider Options','clean-retina'),
			'priority'					=> 460,
			'panel'					=>'cleanretina_featured_post_page_panel'
		));
		$wp_customize->add_setting('cleanretina_theme_options[exclude_slider_post]', array(
			'default'					=>0,
			'sanitize_callback'		=>'prefix_sanitize_integer',
			'type' 						=> 'option',
			'capability' 				=> 'manage_options'
		));
		$wp_customize->add_control( 'exclude_slider_post', array(
			'priority'					=>470,
			'label'						=> __('Exclude Slider post from Homepage posts?', 'clean-retina'),
			'section'					=> 'cleanretina_page_post_options',
			'settings'					=> 'cleanretina_theme_options[exclude_slider_post]',
			'type'						=> 'checkbox',
		));
		// featured post/page
		for ( $i=1; $i <= $options['slider_quantity'] ; $i++ ) {
			$wp_customize->add_setting('cleanretina_theme_options[featured_post_slider]['. $i.']', array(
				'default'					=>'',
				'sanitize_callback'		=>'prefix_sanitize_integer',
				'type' 						=> 'option',
				'capability' 				=> 'manage_options'
			));
			$wp_customize->add_control( 'featured_post_slider]['. $i .']', array(
				'priority'					=> 480 . $i,
				'label'						=> __(' Featured Slider Post/Page #', 'clean-retina') . ' ' . $i ,
				'section'					=> 'cleanretina_page_post_options',
				'settings'					=> 'cleanretina_theme_options[featured_post_slider]['. $i .']',
				'type'						=> 'text',
			));
		}
	/******************** Social Links *****************************************/
	$wp_customize->add_section(
		'cleanretina_sociallinks_section', array(
		'title' 						=> __('Social Links','clean-retina'),
		'priority'					=> 500,
	));
	$social_links = array(); 
		$social_links_name = array();
		$social_links_name = array( __( 'Facebook', 'clean-retina' ),
									__( 'Twitter', 'clean-retina' ),
									__( 'Google Plus', 'clean-retina' ),
									__( 'Pinterest', 'clean-retina' ),
									__( 'Youtube', 'clean-retina' ),
									__( 'Vimeo', 'clean-retina' ),
									__( 'LinkedIn', 'clean-retina' ),
									__( 'Flickr', 'clean-retina' ),
									__( 'Tumblr', 'clean-retina' ),
									__( 'Myspace', 'clean-retina' ),
									__( 'RSS', 'clean-retina' )
									);
		$social_links = array( 	'Facebook' 		=> 'social_facebook',
										'Twitter' 		=> 'social_twitter',
										'Google-Plus'	=> 'social_googleplus',
										'Pinterest' 	=> 'social_pinterest',
										'You-tube'		=> 'social_youtube',
										'Vimeo'			=> 'social_vimeo',
										'Linked'			=> 'social_linkedin',
										'Flickr'			=> 'social_flickr',
										'Tumblr'			=> 'social_tumblr',
										'My-Space'		=> 'social_myspace',
										'RSS'				=> 'social_rss' 
									);
		$i = 0;
		foreach( $social_links as $key => $value ) {
			$wp_customize->add_setting( 'cleanretina_theme_options['. $value. ']', array(
				'default'					=>'',
				'sanitize_callback'		=> 'esc_url',
				'type' 						=> 'option',
				'capability' 				=> 'manage_options'
			));
			$wp_customize->add_control( $value, array(
					'label'					=> $social_links_name[ $i ],
					'section'				=> 'cleanretina_sociallinks_section',
					'settings'				=> 'cleanretina_theme_options['. $value. ']',
					'type'					=> 'text',
					)
			);
			$i++;
		}
	/********************************************************************************/
	/******************** Webmaster Tools ******************************************/
	$wp_customize->add_section('webmaster_analytics_tools', array(
		'title'					=> __('Webmaster Tools', 'clean-retina'),
		'priority'				=> 600,
	));
	$wp_customize->add_setting( 'cleanretina_theme_options[analytic_header]', array(
		'default'				=> '',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options',
		'sanitize_callback'	=> 'wp_kses_stripslashes'
	));
	$wp_customize->add_control( 'analytic_header', array(
		'label'					=> __('Code to display on Header','clean-retina'),
		'description'			=> __('Note: Enter your custom header script.','clean-retina'),
		'section'				=> 'webmaster_analytics_tools',
		'settings'				=> 'cleanretina_theme_options[analytic_header]',
		'type'					=> 'textarea'
	));
	$wp_customize->add_setting( 'cleanretina_theme_options[analytic_footer]', array(
		'default'				=> '',
		'type' 					=> 'option',
		'capability' 			=> 'manage_options',
		'sanitize_callback'	=> 'wp_kses_stripslashes'
	));
	$wp_customize->add_control( 'analytic_footer', array(
		'label'					=> __('Code to display on Footer','clean-retina'),
		'description'			=> __('Note: Enter your custom footer script.','clean-retina'),
		'section'				=> 'webmaster_analytics_tools',
		'settings'				=> 'cleanretina_theme_options[analytic_footer]',
		'type'					=> 'textarea'
	));

}
/********************Sanitize the values ******************************************/
function cleanretina_sanitize_dropdown_pages( $page_id, $setting ) {
	// Ensure $input is an absolute integer.
	$page_id = absint( $page_id );
	
	// If $page_id is an ID of a published page, return it; otherwise, return the default.
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}
function cleanretina_sanatize_excerpt_length( $input ) {
	if(is_numeric($input)){
	return $input;
	}
}
function prefix_sanitize_integer( $input ) {
	return $input;
}
function cleanretina_sanitize_effect( $input ) {
	if ( ! in_array( $input, array( 'fade', 'wipe', 'scrollUp', 'scrollDown', 'scrollLeft', 'scrollRight', 'blindX', 'blindY', 'blindZ', 'cover', 'shuffle' ) ) ) {
		$input = 'fade';
	}
	return $input;
}
function cleanretina_sanitize_delay_transition( $input ) {
	if(is_numeric($input)){
	return $input;
	}
}


function cleanretina_customizer_control_scripts() {

	wp_enqueue_script(
		'cleanretina-customize-controls',
		get_template_directory_uri() . '/library/js/cleanretina_customizer.js',
		array(), '3.0',
		true
	);

	wp_enqueue_style( 'cleanretina-customize-controls',
	 get_template_directory_uri() . '/library/css/customize-controls.css' );

}

add_action( 'customize_controls_enqueue_scripts', 'cleanretina_customizer_control_scripts', 0 );


function cleanretina_customize_custom_sections( $wp_customize ) {

	// Register custom section types.
	$wp_customize->register_section_type( 'Cleanretina_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Cleanretina_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Clean Retina Pro', 'clean-retina' ),
				'pro_text' => esc_html__( 'Upgrade to Pro', 'clean-retina' ),
				'pro_url'  => 'http://themehorse.com/themes/clean-retina-pro',
				'priority' => 1,
			)
		)
	);

}

add_action( 'customize_register', 'cleanretina_customize_custom_sections');
add_action('customize_register', 'cleanretina_textarea_register');
add_action('customize_register', 'cleanretina_customize_register');
?>