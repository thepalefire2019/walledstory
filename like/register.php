<?php


//  ======================================= Register English post type===============================
add_action( 'init', 'like_post_type' );

function like_post_type(){
	$labels = array(
    'name'                => _x( 'Like', 'post type general name', 'your-plugin-textdomain'),
    'singular_name'       => _x( 'Like', 'post type singular name', 'your-plugin-textdomain' ), 
    'add_new_item'        => __( 'Add New Like', 'your-plugin-textdomain' ),
    'edit_item'           => __( 'Edit Like', 'your-plugin-textdomain' ),
    'all_items'           => __( 'All Like', 'your-plugin-textdomain' ),
    
  ); 

  $args = array(
    'labels'              => $labels,
    'public'              => false,
    'show_ui'             => true,
    'supports'            => array( 'title'),    
    'menu_icon'           => 'dashicons-heart'
 
);

	register_post_type( 'like', $args );
}

//  ======================================= Register Bengali post type===============================


require get_template_directory(). '/like/metabox.php';
require get_template_directory(). '/like/save-metabox.php';
require get_template_directory(). '/like/like-api.php';