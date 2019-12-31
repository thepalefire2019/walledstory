<?php


//  ======================================= Register English post type===============================
add_action( 'init', 'follow_post_type' );

function follow_post_type(){
	$labels = array(
    'name'                => _x( 'Follow', 'post type general name', 'your-plugin-textdomain'),
    'singular_name'       => _x( 'Follow', 'post type singular name', 'your-plugin-textdomain' ), 
    'add_new_item'        => __( 'Add New Follow', 'your-plugin-textdomain' ),
    'edit_item'           => __( 'Edit Follow', 'your-plugin-textdomain' ),
    'all_items'           => __( 'All Follow', 'your-plugin-textdomain' ),
    
  ); 

  $args = array(
    'labels'              => $labels,
    'public'              => false,
    'show_ui'             => true,
    'supports'            => array( 'title'),    
    'menu_icon'           => 'dashicons-nametag'
 
);

	register_post_type( 'follow', $args );
}

//  ======================================= Register Bengali post type===============================


require get_template_directory(). '/follow/metabox.php';
require get_template_directory(). '/follow/save-metabox.php';
require get_template_directory(). '/follow/follow-api.php';


//  ======================================= Ajax Methods===============================