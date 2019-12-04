<?php 

function get_like_num( $post_id ){
	global $wpdb;

	$table_name = 'wp_ws_like';
  	$results = $wpdb->get_results( "SELECT * FROM wp_ws_like WHERE post_id = {$post_id}", OBJECT );
  	$count = 0;
  	if( $results != NULL ){
  		$count = $wpdb->num_rows;
  		return $count;
  	}else{
  		return $count ;
  	}
}

function check_user_like( $user_id, $post_id ){
	global $wpdb; 

	$table_name = 'wp_ws_like';
	$results = $wpdb->get_results( "SELECT * FROM wp_ws_like WHERE post_id = {$post_id} AND user_id = {$user_id}", OBJECT );
	if( $wpdb->num_rows > 0 ){
		return TRUE;
	}else{
		return FALSE;
	}
}