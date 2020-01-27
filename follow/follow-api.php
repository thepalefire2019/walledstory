<?php
add_action('rest_api_init', 'follow_api_routes');

function follow_api_routes(){
	register_rest_route('ws/v1', 'follow', array(
      'methods' => 'POST',
      'callback' => 'ws_follow_post_routes'
    ));

    register_rest_route('ws/v1', 'follow', array(
      'methods' => 'DELETE ',
      'callback' => 'ws_follow_delete_routes'
    ));
}

function ws_follow_post_routes( $data ){
	if( is_user_logged_in() ){
		$author_id = sanitize_text_field($data['author_id']);
		$follower_id = sanitize_text_field($data['follower_id']);

		$checkfollow = checkfollow( $author_id, $follower_id );
		if( $checkfollow == 0 ){
			global $wpdb;
			$table_name = $wpdb->prefix .'ws_follow';
			$addfollow = $wpdb->insert( 
									$table_name, 
									array( 
										'author_id' => $author_id, 
										'follower_id' => $follower_id 
									), 
									array( 
										'%d', 
										'%d' 
									) 
						);
			if( $addfollow ){
				return $wpdb->insert_id;
			}else{
				die($wpdb->print_error());
			}
		}else{
			die( 'Already Follwed' );
		}

		// $checkfollow = new WP_Query( array(
  //                   'author'        => get_current_user_id(),
  //                   'post_type'     => 'follow',
  //                   'meta_query'    => array(
  //                       array(
  //                           'key'       => 'followed_blog_id',
  //                           'compare'   => '=',
  //                           'value'     => $author_id
  //                       ))
  //                   ) );
		// if( $checkfollow->found_posts == 0 ){
		// 	$follow_id = wp_insert_post(array(
		// 		'post_type' => 'follow',
		// 		'post_status' => 'publish',
		// 		'post_title'	=> 'Author#'.get_current_user_id(),
				
		// 	));
		// update_post_meta( $follow_id,"followed_blog_id",$author_id );
		//	}
		//return $follower_id;
		
	}else{
		die( 'Please Log in To Follow' );
	}
}
function ws_follow_delete_routes( $data ){
	$follow_id = sanitize_text_field($data['follow_id']);

	global $wpdb;
	$table_name = $wpdb->prefix .'ws_follow';

	$deletefollow = $wpdb->delete( $table_name, array( 'follow_id' => $follow_id ) );

	if( $deletefollow ){
		return $follow_id.' deleted';
	}else{
		die('Database Error in Delete');
	}
	// if( get_current_user_id() == get_post_field( 'post_author', $follow_id ) AND get_post_type($follow_id) == 'follow' ){
	// 	wp_delete_post( $follow_id, true );
	// 	return 'follow Deleted';
	// }else{
	// 	die('You do not have permiision to delete the follow');
	// }
}