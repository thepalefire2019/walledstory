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
		$checkfollow = new WP_Query( array(
                    'author'        => get_current_user_id(),
                    'post_type'     => 'follow',
                    'meta_query'    => array(
                        array(
                            'key'       => 'followed_blog_id',
                            'compare'   => '=',
                            'value'     => $author_id
                        ))
                    ) );
		if( $checkfollow->found_posts == 0 ){
			$follow_id = wp_insert_post(array(
				'post_type' => 'follow',
				'post_status' => 'publish',
				'post_title'	=> 'Author#'.get_current_user_id(),
				
			));
		update_post_meta( $follow_id,"followed_blog_id",$author_id );
		return $follow_id;
		}
	}else{
		echo 'Please Log in To Follow';
	}
}
function ws_follow_delete_routes( $data ){
	$follow_id = sanitize_text_field($data['follow_id']);
	if( get_current_user_id() == get_post_field( 'post_author', $follow_id ) AND get_post_type($follow_id) == 'follow' ){
		wp_delete_post( $follow_id, true );
		return 'follow Deleted';
	}else{
		die('You do not have permiision to delete the follow');
	}
}