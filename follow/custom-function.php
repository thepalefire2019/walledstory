<?php 


//check follow
function checkfollow( $author_id, $follower_id ){
	global $wpdb;
	$table_name = $wpdb->prefix .'ws_follow';
	$results = $wpdb->get_results( "SELECT * FROM $table_name WHERE author_id = $author_id AND follower_id = $follower_id", OBJECT );
	if( $results ){
		$follow_id = $results[0]->follow_id;
		return $follow_id;
	}else{
		return 0;
	}
}


// no of author followed
function followingcount( $author_id ){
	global $wpdb;
	$table_name = $wpdb->prefix .'ws_follow';
	$results = $wpdb->get_results( "SELECT * FROM $table_name WHERE  follower_id = $author_id", OBJECT );
	$count = $wpdb->num_rows;
	if( $results ){
		return $count;
	}else{
		return 0;
	}
}

// no of follweres
function followerscount( $author_id ){
	global $wpdb;
	$table_name = $wpdb->prefix .'ws_follow';
	$results = $wpdb->get_results( "SELECT * FROM $table_name WHERE  author_id = $author_id", OBJECT );
	$count = $wpdb->num_rows;
	if( $results ){
		return $count;
	}else{
		return 0;
	}
}
