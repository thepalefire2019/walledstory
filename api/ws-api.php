<?php 

add_action('rest_api_init', 'ws_api_post');

function ws_api_post(){
  register_rest_route('ws/v1', 'blogs', array(
      'methods' => 'POST',
      'callback' => 'ws_api_blog_result'
    ));
}

function ws_api_blog_result( $data ){
	$apicredential = array(
			'apiuser' 	=> 'sarasij94',
			'apipass'	=> '123' 
	);
	$all_data_json = file_get_contents('php://input');
	//{"apicredential":{"apiuser":"", "apipass": ""} }
	$all_data = ( isset( $all_data_json ) && $all_data_json != "" )? json_decode( $all_data_json ) : "";


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
		    $author = array(
		        'author_id'   => $author_id,
		        //'author_link' => $author_link,
		        'first_name'  => $fname,
		        'last_lname'  => $lname
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

			$data[$count] = array(
	    		'id'           => $post_id, 
		      	'date'         => $date,
		    	'title'        => $post_title,
		      	'author'       => $author,
		      	'categories'   => $post_category,
		      	'image'        => $img,
		      	'content'      => $content,
		      	'excerpt'      => $excerpt
		    );

		    $count++;



		} //while
		$array = array(
			'code' =>1,
			'message' => 'Succes',
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
}