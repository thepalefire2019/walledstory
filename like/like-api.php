<?php
add_action('rest_api_init', 'like_api_routes');

function like_api_routes(){
	register_rest_route('ws/v1', 'like', array(
      'methods' => 'POST',
      'callback' => 'ws_like_post_routes'
    ));

    register_rest_route('ws/v1', 'like', array(
      'methods' => 'DELETE ',
      'callback' => 'ws_like_delete_routes'
    ));
}

function ws_like_post_routes( $data ){
	if( is_user_logged_in() ){
		$english_id = sanitize_text_field($data['english_id']);
		 $checklike = new WP_Query( array(
			                'author'        => get_current_user_id(),
			                'post_type'     => 'like',
			                'meta_query'    => array(
			                    array(
			                        'key'       => 'liked_english_id',
			                        'compare'   => '=',
			                        'value'     => $english_id
			                    ))
			                ) );
		if( $checklike->found_posts == 0 AND get_post_type($english_id) == 'ws_english' ){
			$like_id = wp_insert_post(array(
				'post_type' => 'like',
				'post_status' => 'publish',
				'post_title'	=> 'test 2',
				
			));
			update_post_meta( $like_id,"liked_english_id",$english_id );
			return $like_id;
		}else{
			die("You have already liked the Post");
		}
		
	}else{
		die("Please Log in To Like the Post.");
	}
	//$english_id = $_POST['english_id'];
	 
}
function ws_like_delete_routes( $data ){
	$like_id = sanitize_text_field($data['like_id']);
	if( get_current_user_id() == get_post_field( 'post_author', $like_id ) AND get_post_type($like_id) == 'like' ){
		wp_delete_post( $like_id, true );
		return 'Like Deleted';
	}else{
		die('You do not have permiision to delete the Like');
	}
	
}