<?php
/**
 * Plugin Name: Demo Presentation
 * Plugin URI:  http://huge-it.com
 * Description: Demo presentation plugin [demo-presentation src=""]
 * Author:      Matt Hayrapetyan
 * Author URI:  http://huge-it.com
 * Version:     1.0.0
 * Text Domain: demopresent
 * License:     GPLv2 or later (license.txt)
 */

function demopresent_shortcode($atts = []){
    // normalize attribute keys, lowercase
    $atts = array_change_key_case((array)$atts, CASE_LOWER);

    // override default attributes with user attributes
    $atts = shortcode_atts([
        'src' => '',
    ], $atts);

    do_action( 'demopresent_before_shortcode' );

    ob_start();

    $template_path = untrailingslashit( plugin_dir_path( __FILE__ ) ).'/templates/';
    require $template_path.'frontend/demo-head.php';

    require $template_path.'frontend/demo-content.php';

    // return output
    return ob_get_clean();
}

function demopresent_shortcodes_init(){
    add_shortcode('demo-presentation', 'demopresent_shortcode');
}

add_action('init', 'demopresent_shortcodes_init');

add_action( 'demopresent_before_shortcode', 'demopresent_frontend_scripts' );

function demopresent_frontend_scripts(){
    wp_enqueue_script( 'demopresent_frontend', plugins_url('/assets/js/frontend.js',__FILE__ ), array('jquery'), false, true );
    wp_enqueue_style( 'demopresent_frontend', plugins_url('/assets/css/frontend.css',__FILE__ ) );
}