<?php

function checklike( $blog_id, $user_id ){
	global $wpdb;
	$table_name = $wpdb->prefix .'ws_like';
	$results = $wpdb->get_results( "SELECT * FROM $table_name WHERE user_id = $user_id AND blog_id = $blog_id", OBJECT );
	if( $results ){
		$like_id = $results[0]->like_id;
		return $like_id;
	}else{
		return 0;
	}
}

function likecount( $blog_id ){
	global $wpdb;
	$table_name = $wpdb->prefix .'ws_like';
	$results = $wpdb->get_results( "SELECT * FROM $table_name WHERE  blog_id = $blog_id", OBJECT );
	$count = $wpdb->num_rows;
	if( $results ){
		return $count;
	}else{
		return 0;
	}
}
