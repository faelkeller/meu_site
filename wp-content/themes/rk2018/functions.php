<?php

// This function enqueues the Normalize.css for use. The first parameter is a name for the stylesheet, the second is the URL. Here we
// use an online version of the css file.
function add_normalize_CSS() {
    wp_enqueue_style('normalize-styles', "https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css");
}

// Register a new navigation menu
function add_Main_Nav() {
    register_nav_menu('header-menu', __('Header Menu'));
}

// Hook to the init action hook, run our navigation menu function
add_action('init', 'add_Main_Nav');

// Register a new sidebar simply named 'sidebar'
function add_widget_Support() {
    register_sidebar(array(
        'name' => 'Sidebar',
        'id' => 'sidebar',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
}

// Hook the widget initiation and run our function
add_action('widgets_init', 'add_Widget_Support');

function rk2018_enqueue_style() {
    wp_deregister_script('jquery');
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.css' );
    wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css' );
    wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css' );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js' );
    wp_enqueue_script( 'SmoothScroll', get_template_directory_uri() . '/js/SmoothScroll.js' );
    wp_enqueue_script( 'easypiechart', get_template_directory_uri() . '/js/easypiechart.js' );
    wp_enqueue_script( 'jquery.prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js' );
    wp_enqueue_script( 'jquery.isotope', get_template_directory_uri() . '/js/jquery.isotope.js' );
    wp_enqueue_script( 'jquery.counterup', get_template_directory_uri() . '/js/jquery.counterup.js' );
    wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/js/waypoints.js' );
    wp_enqueue_script( 'jqBootstrapValidation', get_template_directory_uri() . '/js/jqBootstrapValidation.js' );
    wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js' );

}

add_action( 'wp_enqueue_scripts', 'rk2018_enqueue_style' );

// Our custom post type function
function create_post_portfolio() {

    register_post_type( 'portfolios',
        array(
            'labels' => array(
                'name' => __( 'Portfólios' ),
                'singular_name' => __( 'Portfólio' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'portfolios'),
            'show_in_rest' => true,
            'supports' => array('title','editor','thumbnail')
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_post_portfolio' );


add_action("admin_init", "admin_init");

add_theme_support( 'post-thumbnails', array( 'portfolios' ) );

function admin_init(){
    add_meta_box("year_completed-meta", "Year Completed", "year_completed", "portfolios", "normal", "low");
}

function year_completed(){
    global $post;
    $custom = get_post_custom($post->ID);
    $year_completed = $custom["year_completed"][0];
    ?>
    <label>Year:</label>
    <input name="year_completed" value="<?php echo $year_completed; ?>" />
    <?php
}

