<?php
/**
 * Clean Retina functions and definitions
 *
 * This file contains all the functions and it's defination that particularly can't be
 * in other files.
 * 
 * @package Theme Horse
 * @subpackage Clean_Retina
 * @since Clean Retina 1.0
 */

/****************************************************************************************/

add_action( 'wp_enqueue_scripts', 'cleanretina_scripts_styles_method' );
/**
 * Register jquery scripts
 */
function cleanretina_scripts_styles_method() {

	global $options, $array_of_default_settings;
	$options = wp_parse_args(  get_option( 'cleanretina_theme_options', array() ),  cleanretina_get_option_defaults());

   /**
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'cleanretina_style', get_stylesheet_uri() );
	wp_enqueue_style('cleanretina-font-awesome', get_template_directory_uri().'/font-awesome/css/font-awesome.css');
	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_template_directory_uri() . '/library/js/html5.min.js', array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/**
	 * Register JQuery cycle js file for slider.
	 * Register Jquery fancybox js and css file for fancybox effect.
	 */
	wp_register_script( 'jquery_cycle', CLEANRETINA_JS_URL . '/jquery.cycle.all.js', array( 'jquery' ), '3.0.3', true );

   wp_register_style( 'google_font_genttium_basic', '//fonts.googleapis.com/css?family=Gentium+Basic:400,400italic,700,700italic' );
    
	
	/**
	 * Enqueue Slider setup js file.
	 * Enqueue Fancy Box setup js and css file.	 
	 */	
	if( ( is_home() || is_front_page() ) && 0 == $options[ 'disable_slider' ] ) {
		wp_enqueue_script( 'cleanretina_slider', CLEANRETINA_JS_URL . '/cleanretina-slider-setting.js', array( 'jquery_cycle' ), false, true );
	}
   wp_enqueue_script( 'cleanretina-scripts', CLEANRETINA_JS_URL . '/scripts.js', array( 'jquery' ) );
   wp_enqueue_script( 'backtotop', CLEANRETINA_JS_URL. '/backtotop.js', array( 'jquery' ) );

   wp_enqueue_style( 'google_font_genttium_basic' );

} 

/****************************************************************************************/

function cleanretina_add_editor_styles() {
	$font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Gentium+Basic:400,400italic,700,700italic' );
	add_editor_style( $font_url );
}
add_action( 'after_setup_theme', 'cleanretina_add_editor_styles' );

/****************************************************************************************/

add_filter( 'wp_page_menu', 'cleanretina_wp_page_menu' );
/**
 * Remove div from wp_page_menu() and replace with ul.
 * @uses wp_page_menu filter
 */
function cleanretina_wp_page_menu ( $page_markup ) {
	preg_match('/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $matches);
	$divclass = $matches[1];
	$replace = array('<div class="'.$divclass.'">', '</div>');
	$new_markup = str_replace($replace, '', $page_markup);
	$new_markup = preg_replace('/^<ul>/i', '<ul class="'.$divclass.'">', $new_markup);
	return $new_markup; 
}

/****************************************************************************************/

if ( ! function_exists( 'cleanretina_pass_cycle_parameters' ) ) :
/**
 * Function to pass the slider effectr parameters from php file to js file.
 */
function cleanretina_pass_cycle_parameters() {
    
    global $options, $array_of_default_settings;
	 $options = wp_parse_args(  get_option( 'cleanretina_theme_options', array() ),  cleanretina_get_option_defaults());

    $transition_effect = $options[ 'transition_effect' ];
    $transition_delay = $options[ 'transition_delay' ] * 1000;
    $transition_duration = $options[ 'transition_duration' ] * 1000;
    wp_localize_script( 
        'cleanretina_slider',
        'cleanretina_slider_value',
        array(
            'transition_effect' => $transition_effect,
            'transition_delay' => $transition_delay,
            'transition_duration' => $transition_duration
        )
    );
    
}
endif;

/****************************************************************************************/

add_filter( 'excerpt_length', 'cleanretina_excerpt_length' );
/**
 * Sets the post excerpt length to 30 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function cleanretina_excerpt_length( $length ) {
	global $options, $array_of_default_settings;
	$options = wp_parse_args(  get_option( 'cleanretina_theme_options', array() ),  cleanretina_get_option_defaults());

	return $options[ 'excerpt_length' ];
}

add_filter( 'excerpt_more', 'cleanretina_continue_reading' );
/**
 * Returns a "Continue Reading" link for excerpts
 */
function cleanretina_continue_reading() {
	return '&hellip; ';
}

/****************************************************************************************/

add_filter( 'body_class', 'cleanretina_body_class' );
/**
 * Filter the body_class
 *
 * Throwing different body class for the different layouts in the body tag
 */
function cleanretina_body_class( $classes ) {
	global $post;	
	global $options, $array_of_default_settings;
	$options = wp_parse_args(  get_option( 'cleanretina_theme_options', array() ),  cleanretina_get_option_defaults());

	if( $post ) {
		$layout = get_post_meta( $post->ID,'cleanretina_sidebarlayout', true ); 
	}
	if( ( empty( $layout ) || is_archive() || is_author() || is_search() ) && !is_home() ) {
		$layout = 'default';
	}
	elseif( is_home() ) {
		$layout = 'for_home';
	}
	if( 'default' == $layout ) {

		$themeoption_layout = $options[ 'default_layout' ];

		if( 'left-sidebar' == $themeoption_layout ) {
			$classes[] = 'left-sidebar-template';
		}
		elseif( 'right-sidebar' == $themeoption_layout  ) {
			$classes[] = '';
		}
		elseif( 'no-sidebar-full-width' == $themeoption_layout ) {
			$classes[] = 'full-width-template';
		}
		elseif( 'no-sidebar-one-column' == $themeoption_layout ) {
			$classes[] = 'one-column-template';
		}		
		elseif( 'no-sidebar' == $themeoption_layout ) {
			$classes[] = 'no-sidebar-template';
		}
	}	
   elseif( 'for_home' == $layout ) {
		$homepage_layout = $options[ 'home_page_layout' ];
		$blog_layout = $options[ 'blog_display_type' ];

		if( 'left-sidebar' == $homepage_layout ) {
			$classes[] = 'left-sidebar-template';
		}
		elseif( 'right-sidebar' == $homepage_layout ) {
			$classes[] = '';
		}
		elseif( 'no-sidebar-full-width' == $homepage_layout ) {
			$classes[] = '';
		}
		elseif( 'no-sidebar-one-column' == $homepage_layout ) {
			$classes[] = 'one-column-template';
		}
		elseif( 'no-sidebar' == $homepage_layout ) {
			$classes[] = 'no-sidebar-template';
		}
		elseif( 'corporate-layout' == $homepage_layout ) {
			$classes[] = '';
		}
		if( 'excerpt_display_two' == $blog_layout ) {
			$classes[] = 'blog-medium';
		}
   }
	elseif( 'left-sidebar' == $layout && !is_page_template( 'page-template-corporate.php' ) ) {
      $classes[] = 'left-sidebar-template';
   }
   elseif( 'right-sidebar' == $layout ) {
		$classes[] = '';
	}
	elseif( 'no-sidebar-full-width' == $layout ) {
		$classes[] = '';
	}
	elseif( 'no-sidebar-one-column' == $layout && !is_page_template( 'page-template-corporate.php' ) ) {
		$classes[] = 'one-column-template';
	}
	elseif( 'no-sidebar' == $layout && !is_page_template( 'page-template-corporate.php' ) ) {
		$classes[] = 'no-sidebar-template';
	}
   	

	return $classes;
}

/****************************************************************************************/

add_action( 'cleanretina_main_container', 'cleanretina_content', 10 );
/**
 * Function to display the content for the single post, single page, archive page, index page etc.
 */
function cleanretina_content() {
	global $post;	
	global $options, $array_of_default_settings;
	$options = wp_parse_args(  get_option( 'cleanretina_theme_options', array() ),  cleanretina_get_option_defaults());
	if( $post ) {
		$layout = get_post_meta( $post->ID,'cleanretina_sidebarlayout', true );
	}
	if( ( empty( $layout ) || is_archive() || is_author() || is_search() ) && !is_home() ) {
		$layout = 'default';
	}
	elseif( is_home() ) {
		$layout = 'for_home';
	}
   if( 'default' == $layout ) {
		$themeoption_layout = $options[ 'default_layout' ];

		if( 'left-sidebar' == $themeoption_layout ) {
			get_template_part( 'content','leftsidebar' );
		}
		elseif( 'right-sidebar' == $themeoption_layout ) {
			get_template_part( 'content','rightsidebar' );
		}
		else {
			get_template_part( 'content','nosidebar' );
		}
   }
   elseif( 'for_home' == $layout ) {
		$homepage_layout = $options[ 'home_page_layout' ];

		if( 'left-sidebar' == $homepage_layout ) {
			get_template_part( 'content','leftsidebar' );
		}
		elseif( 'right-sidebar' == $homepage_layout ) {
			get_template_part( 'content','rightsidebar' );
		}
		elseif( 'corporate-layout' == $homepage_layout ) {
			get_template_part( 'content','corporate' );
		}
		else {
			get_template_part( 'content','nosidebar' );
		}
   }
   elseif( 'left-sidebar' == $layout ) {
      get_template_part( 'content','leftsidebar' );
   }
   elseif( 'right-sidebar' == $layout ) {
      get_template_part( 'content','rightsidebar' );
   }
   else {
      get_template_part( 'content','nosidebar' );
   }

}

/****************************************************************************************/

add_action( 'cleanretina_before_loop_content', 'cleanretina_loop_before', 10 );
/**
 * Contains the opening div
 */
function cleanretina_loop_before() {
	echo '<div id="content">';
}

add_action( 'cleanretina_loop_content', 'cleanretina_theloop', 10 );
/**
 * Shows the loop content
 */
function cleanretina_theloop() {
	global $post;
	global $options, $array_of_default_settings;
	$options = wp_parse_args(  get_option( 'cleanretina_theme_options', array() ),  cleanretina_get_option_defaults());

	if( have_posts() ) {
		while( have_posts() ) {
			the_post();

	do_action( 'cleanretina_before_post' );

	if( !is_page() ) {
	?>
   	<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   		<article class="clearfix">
   <?php 
	}
	?>
        		<?php do_action( 'cleanretina_before_post_header' ); ?>

        		<header class="entry-header">
        			<?php if(is_home() || is_archive() || is_search() ){ ?>
        				<h2 class="entry-title">
	            		<?php if( is_page() || is_single() ){
	            			the_title();
	            		} else { ?>
	            			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
	            		<?php } ?>
	            	</h2 >
        			<?php } else{ ?>
						<h1 class="entry-title">
	            		<?php if( is_page() || is_single() ){
			            			the_title();
			            		} else { ?>
			            			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
			            <?php } ?>
		            </h1>
		        	<?php	} ?>
        			<?php 
        			if( ( is_single() || is_archive() || is_home() ) ) {
        				if((get_the_author() !='') && (get_the_time( get_option( 'date_format' ) ) !='')){
        			?>                        
            	<div class="entry-meta">
						<span class="by-author vcard author"><span class="fn"><?php _e( 'By', 'clean-retina' ); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span></span>
                	<span class="date updated"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_time() ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span>
                	<?php if( has_category() ) { ?>
                		<span class="category"><?php the_category(', '); ?></span> 
                	<?php } ?>
                	<?php if ( comments_open() ) { ?>
                		<span class="comments"><?php comments_popup_link( __( 'No Comments', 'clean-retina' ), __( '1 Comment', 'clean-retina' ), __( '% Comments', 'clean-retina' ), '', __( 'Comments Off', 'clean-retina' ) ); ?></span>
                	<?php } ?>
            	</div><!-- .entry-meta -->
        			<?php

						}
        			}
        			?>
        		</header>

        		<?php do_action( 'cleanretina_after_post_header' ); ?>
        		<?php do_action( 'cleanretina_before_post_content' ); ?>

        		<?php
        		if( has_post_thumbnail() && ( is_archive() || is_home() ) ) {
        			$image = '';        			
        			$title_attribute = the_title_attribute( array( 'echo' => false ) );
        			if( 'excerpt_display_two' == $options[ 'blog_display_type' ] && is_home() ) {
	        			$image .= '<figure class="post-featured-image">';
	        			$image .= '<a href="' . get_permalink() . '" title="'.__( 'Permalink to ', 'clean-retina' ).the_title( '', '', false ).'">';
	        			$image .= get_the_post_thumbnail( $post->ID, 'featured-medium', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
	        			$image .= '</figure>';
        			}
        			elseif( ( 'excerpt_display_one' == $options[ 'blog_display_type' ] && is_home() ) || is_archive() ) {
        				$image .= '<figure class="post-featured-image">';
	        			$image .= '<a href="' . get_permalink() . '" title="'.__( 'Permalink to ', 'clean-retina' ).the_title( '', '', false ).'">';
	        			$image .= get_the_post_thumbnail( $post->ID, 'featured', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
	        			$image .= '</figure>';
        			}

        			echo $image;
        		}
        		?>        		
       
       		<?php if( 'excerpt_display_two' != $options[ 'blog_display_type' ] && is_home() ) { ?>
        		<div class="entry-content clearfix">
        		<?php } ?>
            <?php
            if( is_archive() || is_home() || is_search() ) {

            	if( is_home() && 'content_display' == $options[ 'blog_display_type' ] )	{ 
            		the_content( 'Read more' );
            	}
            	else {
            	 if(has_category() !=''){
               	the_excerpt();
	               echo '<a class="readmore" href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">'.__( 'Read more', 'clean-retina' ).'</a>';
	               } else
	               {
	               the_content();

	               }
	            }
            }
            else {
               the_content();

               if( is_single() ) {
						$tag_list = get_the_tag_list( '', __( ', ', 'clean-retina' ) );

						if( !empty( $tag_list ) ) {
							?>
							<div class="tags">
								<?php
								_e( 'Tagged on: ', 'clean-retina' ); echo $tag_list;
								?>
							</div>
							<?php
						}
					}

               wp_link_pages( array( 
						'before'            => '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'clean-retina' ),
						'after'             => '</div>',
						'link_before'       => '<span>',
						'link_after'        => '</span>',
						'pagelink'          => '%',
						'echo'              => 1 
               ) ); 
            }
            ?>
            <?php if( 'excerpt_display_two' != $options[ 'blog_display_type' ] && is_home() ) { ?>
        		</div><!-- .entry-content -->  
        		<?php	} ?>

        	<?php
				if(get_the_time( get_option( 'date_format' ) )) {
        		do_action( 'cleanretina_after_post_content' );
        	}

            do_action( 'cleanretina_before_comments_template' ); 

            comments_template(); 

            do_action ( 'cleanretina_after_comments_template' );

	if( !is_page() ) { 
	?>
		  	</article>
		</section>
		<hr/>
	<?php
	}

   do_action( 'cleanretina_after_post' );

		}
	}
	else {
		?>
		<h1 class="entry-title"><?php _e( 'No Posts Found.', 'clean-retina' ); ?></h1>
      <p><?php _e( 'Try a new search.', 'clean-retina' ); ?></p>
      <?php
   }
}

add_action( 'cleanretina_after_loop_content', 'cleanretina_next_previous', 5 );
/**
 * Shows the next or previous posts
 */
function cleanretina_next_previous() {
	if( is_archive() || is_author() || is_home() || is_search() ) {
		/**
		 * Checking WP-PageNaviplugin exist
		 */
		if ( function_exists('wp_pagenavi' ) ) : 
			wp_pagenavi();

		else: 
			global $wp_query;
			if ( $wp_query->max_num_pages > 1 ) : 
			?>
			<ul class="default-wp-page clearfix">
				<li class="previous"><?php next_posts_link( __( '&laquo; Previous', 'clean-retina' ) ); ?></li>
				<li class="next"><?php previous_posts_link( __( 'Next &raquo;', 'clean-retina' ) ); ?></li>
			</ul>
			<?php
			endif;
		endif;
	}
}

add_action( 'cleanretina_after_post_content', 'cleanretina_next_previous_post_link', 10 );
/**
 * Shows the next or previous posts link with respective names.
 */
function cleanretina_next_previous_post_link() {
	if ( is_single() ) {
		if( is_attachment() ) {
		?>
			<ul class="default-wp-page clearfix">
				<li class="previous"><?php previous_image_link( false, __( '&larr; Previous', 'clean-retina' ) ); ?></li>
				<li class="next"><?php next_image_link( false, __( 'Next &rarr;', 'clean-retina' ) ); ?></li>
			</ul>
		<?php
		}
		else {
		?>
			<ul class="default-wp-page clearfix">
				<li class="previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'clean-retina' ) . '</span> %title' ); ?></li>
				<li class="next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'clean-retina' ) . '</span>' ); ?></li>
			</ul>
		<?php
		}
	}
}

add_action( 'cleanretina_after_loop_content', 'cleanretina_loop_after', 10 );
/**
 * Contains the closing div
 */
function cleanretina_loop_after() {
	echo '</div><!-- #content -->';
}

/****************************************************************************************/

add_action('wp_head', 'cleanretina_internal_css');
/**
 * Hooks the Custom Internal CSS to head section
 */
function cleanretina_internal_css() { 

		global $options, $array_of_default_settings;
		$options = wp_parse_args(  get_option( 'cleanretina_theme_options', array() ),  cleanretina_get_option_defaults());
		$cleanretina_internal_css='';
		if( !empty( $options[ 'custom_css' ] ) ) {
			$cleanretina_internal_css = '<!-- '.get_bloginfo('name').' Custom CSS Styles -->' . "\n";
			$cleanretina_internal_css .= '<style type="text/css" media="screen">' . "\n";
			$cleanretina_internal_css .=  $options['custom_css'] . "\n";
			$cleanretina_internal_css .= '</style>' . "\n";
		}
	echo $cleanretina_internal_css;
}

/****************************************************************************************/

add_action('wp_head', 'cleanretina_verification');
/**
 * Header Analytic Tools
 *
 * If user sets the code we're going to display meta verification
 */ 
function cleanretina_verification() {;

		global $options, $array_of_default_settings;
		$options = wp_parse_args(  get_option( 'cleanretina_theme_options', array() ),  cleanretina_get_option_defaults());

		$cleanretina_verification = '';

		// site stats, analytics header code
		if ( !empty( $options['analytic_header'] ) ) {
		$cleanretina_verification .=  $options[ 'analytic_header' ] ;
		}
	echo $cleanretina_verification;
}

/****************************************************************************************/

add_action('wp_footer', 'cleanretina_footercode');
/**
 * Footer Analytics Code
 */
function cleanretina_footercode() { 
    
   $cleanretina_footercode = '';

		global $options, $array_of_default_settings;
		$options = wp_parse_args(  get_option( 'cleanretina_theme_options', array() ),  cleanretina_get_option_defaults());

		// site stats, analytics footer code
		if ( !empty( $options['analytic_footer'] ) ) {  
		$cleanretina_footercode .=  $options[ 'analytic_footer' ] ;
		}
	echo $cleanretina_footercode;
}

/****************************************************************************************/

add_action( 'cleanretina_home_corporate_content', 'cleanretina_display_home_corporate_content', 10 );
/**
 * Function to display the content for home page corporate type layout
 */
function cleanretina_display_home_corporate_content() {
	global $options, $array_of_default_settings;
	$options = wp_parse_args(  get_option( 'cleanretina_theme_options', array() ),  cleanretina_get_option_defaults());
?>
	<div id="content">
		<?php
    	
    	$cleanretina_display_home_corporate_content = '';		
			if( !empty( $options[ 'corporate_content_title' ] ) ) {
				$cleanretina_display_home_corporate_content .= '<h1 class="entry-title">' . $options[ 'corporate_content_title' ] . '</h1>';
			}
			if( !empty( $options[ 'featured_home_box_image' ] ) || !empty( $options[ 'featured_home_box_title' ] ) || !empty( $options[ 'featured_home_box_description' ] ) ) {
				$cleanretina_display_home_corporate_content .= 
				'<div class="services clearfix">';

					for( $i = 1; $i <= 3; $i++ ) {
						if( !empty( $options[ 'featured_home_box_image' ][ $i ] ) || !empty( $options[ 'featured_home_box_title' ][ $i ] ) || !empty( $options[ 'featured_home_box_description' ][ $i ] ) ) {
							$cleanretina_display_home_corporate_content .= 
							'<div class="services-item">';
								if( !empty( $options[ 'featured_home_box_link' ][ $i ] ) ) {
									$cleanretina_display_home_corporate_content .= '<a href="'. esc_url( $options[ 'featured_home_box_link' ][ $i ] ) . '" title="' . esc_attr( $options[ 'featured_home_box_title' ][ $i ] ) . '">';
								}
								else {
									$cleanretina_display_home_corporate_content .= '<a href="#" title="' . esc_attr( $options[ 'featured_home_box_title' ][ $i ] ) . '">';
								}
								if( !empty( $options[ 'featured_home_box_image' ][ $i ] ) ) {								
									$cleanretina_display_home_corporate_content .= 
										'<span class="service-icon">
										<img src="' . esc_url( $options[ 'featured_home_box_image' ][ $i ] ) . '" alt="' .esc_attr( $options[ 'featured_home_box_title' ][ $i ] ) . '">
										</span>';
								}
								if( !empty( $options[ 'featured_home_box_title' ][ $i ] ) ) {
									$cleanretina_display_home_corporate_content .= '<h1 class="service-title">' . $options[ 'featured_home_box_title' ][ $i ] . '</h1>';
								}
								if( !empty( $options[ 'featured_home_box_description' ][ $i ] ) ) {
									$cleanretina_display_home_corporate_content .= '<p>' . $options[ 'featured_home_box_description' ][ $i ] . '</p>';
								}
									
								$cleanretina_display_home_corporate_content .= '</a>';
								
							$cleanretina_display_home_corporate_content .= 
							'</div>';
						}
					}	
				$cleanretina_display_home_corporate_content .= 			
				'</div>';
			}
		echo $cleanretina_display_home_corporate_content;
		?>
	</div><!-- #content -->
<?php
}

/****************************************************************************************/

add_action('template_redirect', 'cleanretina_feed_redirect');
/**
 * Redirect WordPress Feeds To FeedBurner
 */
function cleanretina_feed_redirect() {
	global $options, $array_of_default_settings;
	$options = wp_parse_args(  get_option( 'cleanretina_theme_options', array() ),  cleanretina_get_option_defaults());

	if ( !empty( $options['feed_url'] ) ) {
		$url = 'Location: '.$options['feed_url'];
		if ( is_feed() && !preg_match('/feedburner|feedvalidator/i', $_SERVER['HTTP_USER_AGENT'])) {
			header($url);
			header('HTTP/1.1 302 Temporary Redirect');
		}
	}
}

/****************************************************************************************/

if ( ! function_exists( 'cleanretina_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own cleanretina_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Clean Retina 1.0
 */
function cleanretina_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'clean-retina' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'clean-retina' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'clean-retina' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'clean-retina' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'clean-retina' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'clean-retina' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'clean-retina' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

/****************************************************************************************/

add_action( 'cleanretina_404_content', 'cleanretina_display_404_page_content', 10 );
/**
 * Function to show the content for 404 page.
 */
function cleanretina_display_404_page_content() {
?>
	<div id="content">
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Error 404-Page NOT Found', 'clean-retina' ); ?></a></h1>
		</header>
		<div class="entry-content clearfix" >
			<p><?php _e( 'It seems we can\'t find what you\'re looking for.', 'clean-retina' ); ?></p>
			<h3><?php _e( 'This might be because:', 'clean-retina' ); ?></h3>
			<p><?php _e( 'You have typed the web address incorrectly, or the page you were looking for may have been moved, updated or deleted.', 'clean-retina' ); ?></p>
			<h3><?php _e( 'Please try the following instead:', 'clean-retina' ); ?></h3>
			<p><?php _e( 'Check for a mis-typed URL error, then press the refresh button on your browser.', 'clean-retina' ); ?></p> 
		</div><!-- .entry-content -->
	</div><!-- #content -->
<?php
}

/****************************************************************************************/

add_action( 'pre_get_posts','cleanretina_alter_home' );
/**
 * Alter the query for the main loop in home page
 *
 * @uses pre_get_posts hook
 */
function cleanretina_alter_home( $query ){
	global $options, $array_of_default_settings;
	$options = wp_parse_args(  get_option( 'cleanretina_theme_options', array() ),  cleanretina_get_option_defaults());
	$cats = $options[ 'front_page_category' ];

	if ( $options[ 'exclude_slider_post'] != 0 && !empty( $options[ 'featured_post_slider' ] ) ) {
		if( $query->is_main_query() && $query->is_home() ) {
			$query->query_vars['post__not_in'] = $options[ 'featured_post_slider' ];
		}
	}

	if ( !in_array( '0', $cats ) ) {
		if( $query->is_main_query() && $query->is_home() ) {
			$query->query_vars['category__in'] = $options[ 'front_page_category' ];
		}
	}
}

/****************************************************************************************/

add_filter('wp_page_menu', 'cleanretina_wp_page_menu_filter');
/**
 * @uses wp_page_menu filter hook
 */
if ( !function_exists('cleanretina_wp_page_menu_filter') ) {
	function cleanretina_wp_page_menu_filter( $text ) {
		$replace = array(
			'current_page_item'     => 'current-menu-item'
	 	);

	  $text = str_replace(array_keys($replace), $replace, $text);
	  return $text;
	}
}

/**************************************************************************************/

?>