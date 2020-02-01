<?php 

add_action('rest_api_init', 'ws_api_post');

function ws_api_post(){
  register_rest_route('ws/v1', 'blogs', array(
      'methods' => 'POST',
      'callback' => 'ws_api_blog_result'
    ));

  register_rest_route('ws/v1', 'users', array(
      'methods' => 'POST',
      'callback' => 'ws_api_users'
    ));
  register_rest_route('ws/v1', 'login', array(
      'methods' => 'POST',
      'callback' => 'ws_api_login'
    ));
  register_rest_route('ws/v1', 'register', array(
      'methods' => 'POST',
      'callback' => 'ws_api_register'
    ));
  register_rest_route('ws/v1', 'like-android', array(
      'methods' => 'POST',
      'callback' => 'ws_api_likeandroid'
    ));
}





function ws_api_blog_result( $data ){
	$apicredential = array(
			'apiuser' 	=> 'sarasij94',
			'apipass'	=> '123' 
	);
	$all_data_json = file_get_contents('php://input');
	//{"apicredential":{"apiuser":"", "apipass": ""}, "user_id":"" }
	$all_data = ( isset( $all_data_json ) && $all_data_json != "" )? json_decode( $all_data_json ) : "";
	$author_id_check = $all_data->user_id;
	//check if this user id has liked the post and return boolean;

	if( $all_data->apicredential->apiuser == $apicredential['apiuser'] AND $all_data->apicredential->apipass == $apicredential['apipass']){

		$args = array(
	      'posts_per_page'      => -1,
	      'post_type'           => 'ws_blog',
	      );
		$mainQuery =  new WP_Query( $args);
		$data = array();
		$count = 0;
		while( $mainQuery->have_posts() ){
			$mainQuery->the_post();

		  	$post_id = get_the_ID();
		    $post_title = get_the_title();
		    $date = get_the_time('Y-m-d H:i:s');
		    $gmt = get_gmt_from_date($date,get_option('date_format').', '.get_option('time_format'));
		    global $post;
		    $post_slug = $post->post_name;
		    $permalink = get_the_permalink();
		    $content = get_the_content();
		    $excerpt = wp_strip_all_tags( get_the_excerpt());

		    //post category
		    $categories= get_the_terms($post_id, 'blog_category');
		    $post_category = array();
		    foreach( $categories as $category ){
		      $post_category = array(
		        'cat_id' => $category->term_id,
		        'cat_name' => $category->cat_name,
		        'cat_slug'  => $category->slug
		      );
		    }
		    //post category
		    //post author
		    $author_id = get_the_author_meta('ID');
		    //$author_link = get_author_posts_url($author_id);
		    $fname = get_the_author_meta('first_name');
		    $lname = get_the_author_meta('last_name');
		    $author_img =  get_the_author_meta( 'profile_picture',  get_the_author_meta('ID') ) ;
		    $author = array(
		        'author_id'   => $author_id,
		        //'author_link' => $author_link,
		        'first_name'  => $fname,
		        'last_lname'  => $lname,
		        'author_img'  => $author_img
		    );
		    //post author


		    //post image  ++ small medium large
		    $small_img = get_the_post_thumbnail_url($post_id,'tg-small');
		    $medium_img = get_the_post_thumbnail_url($post_id,'tg-medium');
		    $large_img = get_the_post_thumbnail_url($post_id,'tg-large');
		    $img = array(
		      'small'   => $small_img,
		      'medium'  => $medium_img,
		      'large'   => $large_img
		    );
		    //post image


		    //post like
		   
		    $no_of_likes = likecount( get_the_ID() );
		    //post like


		    //post views
		    $no_of_views = getPostViews(get_the_ID());
		    //post views

		    if( $author_id_check == '' ){
		    	$data[$count] = array(
	    		'id'           => $post_id, 
		      	'date'         => $date,
		    	'title'        => $post_title,
		      	'author'       => $author,
		      	'categories'   => $post_category,
		      	'image'        => $img,
		      	'content'      => $content,
		      	'excerpt'      => $excerpt,
		      	'like_count'   => $no_of_likes,
		      	'view_count'   => intval($no_of_views),
		      	'checklike'	   => 0,	
		    );
		    }else{

		    	$checklike = checklike( get_the_ID(), $author_id_check );
		  //   	global $wpdb;
		  //   	$table_name = $wpdb->prefix .'ws_like';

				// $results = $wpdb->get_results( "SELECT * FROM $table_name WHERE blog_id = $post_id AND user_id = $author_id_check", OBJECT );
				// if( $results ){
				// 	$like_id = $results[0]->like_id;
					
				// }else{
				// 	$like_id = 0;
				// }

		    	$data[$count] = array(
	    		'id'           => $post_id, 
		      	'date'         => $date,
		    	'title'        => $post_title,
		      	'author'       => $author,
		      	'categories'   => $post_category,
		      	'image'        => $img,
		      	'content'      => $content,
		      	'excerpt'      => $excerpt,
		      	'like_count'   => $no_of_likes,
		      	'view_count'   => intval($no_of_views),
		      	'checklike'	   => intval($checklike),	
		    );
		    }

			

		    $count++;



		} //while
		$array = array(
			'code' =>1,
			'message' => 'Success',
			'theme_color'=>array('theme_color'=>get_option('theme_color'), 'headline_color'=>get_option('headline_color')),
			'data'=>$data
			
		);
		return $array;
		//echo json_encode($array);
	}else{
		$array = array(
			"code" => 0,
			"message" => 'Invalid API Credential'
		);
		echo json_encode($array);
	}






	//return $all_data->apicredential->apiuser;
	// $s = array('a' => 'sarsij', 'b' => $data['sutki']);
	// echo json_encode($s);
} // function


function ws_api_users( $data ){

	$apicredential = array(
			'apiuser' 	=> 'sarasij94',
			'apipass'	=> '123' 
	);
	$all_data_json = file_get_contents('php://input');
	//{"apicredential":{"apiuser":"", "apipass": ""}, "users_id": "1" }
	$all_data = ( isset( $all_data_json ) && $all_data_json != "" )? json_decode( $all_data_json ) : "";

	if( $all_data->apicredential->apiuser == $apicredential['apiuser'] AND $all_data->apicredential->apipass == $apicredential['apipass']){
		$user_id = $all_data->users_id;
		
		$avatar_url = get_the_author_meta( 'profile_picture', $user_id ) ;
		$followCount = followerscount( $user_id );


	    $following = followingcount( $user_id );

		$data = array(
			'first_name'	=> get_the_author_meta( 'first_name', $user_id ),
			'last_lname'	=> get_the_author_meta( 'last_name', $user_id ),
			'description'	=> get_the_author_meta( 'description', $user_id ),
			'user_img'		=> $avatar_url,
			'followers'		=> $followCount,
			'following'		=> $following,
			'facebook'		=> get_the_author_meta( 'facebook', $user_id ),
			'username'	=> get_the_author_meta( 'nickname', $user_id ),
			'email'	=> get_the_author_meta( 'user_email', $user_id ),
		);

		$array = array(
			'code' =>1,
			'message' => 'Success',
			'data'=>$data
			
		);
		return $array;

	}else{
		$array = array(
			"code" => 0,
			"message" => 'Invalid API Credential'
		);
		echo json_encode($array);
	} // if

} //function


function ws_api_login( $data ){
	$apicredential = array(
		'apiuser' 	=> 'sarasij94',
		'apipass'	=> '123' 
	);
	$all_data_json = file_get_contents('php://input');
	//{"apicredential":{"apiuser":"", "apipass": ""}, "username": "sarasij94", "password": "sarasij94" }
	$all_data = ( isset( $all_data_json ) && $all_data_json != "" )? json_decode( $all_data_json ) : "";
	if( $all_data->apicredential->apiuser == $apicredential['apiuser'] AND $all_data->apicredential->apipass == $apicredential['apipass']){
		$username = $all_data->username;
		$password = $all_data->password;

		$login_array = array(
				'user_login' => $username,
				'user_password' => $password
		);
		$verify_user = wp_signon( $login_array, false );

		if( !is_wp_error( $verify_user ) ){
			$user_id = $verify_user->ID;
				$array = array(
					'code' =>1,
					'message' => 'Successful Login',
					'user_id' =>	$verify_user->ID,
					'first_name' => get_the_author_meta( 'first_name', $user_id ),
					'last_name' => get_the_author_meta( 'last_name', $user_id ),
					'image_url' => get_the_author_meta( 'profile_picture', $user_id ),
					'description' => get_the_author_meta( 'description', $user_id ),
					'followers'		=> followerscount( $user_id ),
					'following'	=> followingcount( $user_id ),
					'username'	=> get_the_author_meta( 'nickname', $user_id ),
					'email'	=> get_the_author_meta( 'user_email', $user_id ),

				);
			}else{
				$array = array(
					'code' =>0,
					'message' => 'Login Error',	
				);
			}

		return $array;
	}else{
		$array = array(
			"code" => 0,
			"message" => 'Invalid API Credential'
		);
		echo json_encode($array);
	}

} //function

function ws_api_register( $data ){
	$apicredential = array(
		'apiuser' 	=> 'sarasij94',
		'apipass'	=> '123' 
	);
	$all_data_json = file_get_contents('php://input');
	//{"apicredential":{"apiuser":"", "apipass": ""}, "username": "sarasij94", "password": "sarasij94", "email":"sarasij94@gmail.com" }
	$all_data = ( isset( $all_data_json ) && $all_data_json != "" )? json_decode( $all_data_json ) : "";
	if( $all_data->apicredential->apiuser == $apicredential['apiuser'] AND $all_data->apicredential->apipass == $apicredential['apipass']){
		$username = $all_data->username;
		$password = $all_data->password;
		$email 	  = $all_data->email;

		//check username 

		if( username_exists( $username ) ){
			$array = array(
				"code" => 0,
				"message" => 'Username exists'
			);
			echo json_encode($array);
			die();
		}
		if( email_exists( $email ) ){
			$array = array(
				"code" => 0,
				"message" => 'Email exists'
			);
			echo json_encode($array);
			die();
		}
		$new_user_id = wp_create_user( $username, $password, $email );
		$array = array(
				"code" => 1,
				"message" => 'User Registered',
				"user_id"=> $new_user_id
			);
		echo json_encode($array);
	}else{
		$array = array(
			"code" => 0,
			"message" => 'Invalid API Credential'
		);
		echo json_encode($array);
	}
} // function

function ws_api_likeandroid( $data ){
	$apicredential = array(
		'apiuser' 	=> 'sarasij94',
		'apipass'	=> '123' 
	);
	$all_data_json = file_get_contents('php://input');
	//{"apicredential":{"apiuser":"", "apipass": ""}, "blog_id": "22", "author_id": "2" }
	$all_data = ( isset( $all_data_json ) && $all_data_json != "" )? json_decode( $all_data_json ) : "";
	if( $all_data->apicredential->apiuser == $apicredential['apiuser'] AND $all_data->apicredential->apipass == $apicredential['apipass']){
		$blog_id = $all_data->blog_id;
		$author_id = $all_data->author_id;
		$checklike = checklike( $blog_id, $author_id );
		if( $checklike == 0 ){

			global $wpdb;
			$table_name = $wpdb->prefix .'ws_like';
			$addlike = $wpdb->insert( 
									$table_name, 
									array( 
										'user_id' => $author_id, 
										'blog_id' => $blog_id 
									), 
									array( 
										'%d', 
										'%d' 
									) 
						);
			if( $addlike ){
				$array = array(
				"code" => 1,
				"message" => 'Like Registered',
				"like_id" => $wpdb->insert_id
			);
			}else{
				$array = array(
				"code" => 0,
				"message" => 'Database error',
			);
			}
			
		}else{
			$array = array(
				"code" => 0,
				"message" => 'Already Liked'
			);
		}

		
		echo json_encode($array);
	}else{
		$array = array(
			"code" => 0,
			"message" => 'Invalid API Credential'
		);
		echo json_encode($array);
	}
}