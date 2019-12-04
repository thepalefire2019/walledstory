<?php

function tg_load_scripts(){
	wp_enqueue_style('bootstrap',get_template_directory_uri().'/css/bootstrap.min.css',array(),'4.3.1','all');
	wp_enqueue_style('style',get_stylesheet_uri(),'all',microtime());
	wp_enqueue_style('responsive',get_template_directory_uri().'/css/responsive.css',array(),microtime(),'all');
	wp_enqueue_media();
	wp_deregister_script('jquery');
	wp_register_script('jquery',get_template_directory_uri().'/js/jquery.min.js',false,'3.4.1',false);
	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrap',get_template_directory_uri().'/js/bootstrap.min.js',array('jquery'),'4.3.1',true);
	wp_enqueue_script('ws',get_template_directory_uri().'/js/ws.js',array('jquery'),microtime(),true);
	wp_localize_script( 'ws', 'wsdata', array( 
		'root_url'=>get_site_url(), 
		'nonce' => wp_create_nonce( 'wp_rest' ) 
	) );
	
} 
add_action('wp_enqueue_scripts','tg_load_scripts');

/*------------- Admin Enqueue Functions -------------*/

function ws_load_admin_scripts( $hook ){
	wp_enqueue_media();
	wp_register_script('tg-admin-script',get_template_directory_uri().'/js/ws.admin.js',array('jquery'),'0.0.1', true);
	wp_enqueue_script('tg-admin-script');
}

add_action('admin_enqueue_scripts','ws_load_admin_scripts');

?>