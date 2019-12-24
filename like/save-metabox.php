<?php
add_action("save_post","like_data_save");
function like_data_save( $like_id ){

	$liked_blog_id = isset( $_REQUEST["liked_blog_id"])?trim($_REQUEST["liked_blog_id"] ):"";
	if(!empty($liked_blog_id)){
		update_post_meta( $like_id,"liked_blog_id",intval($liked_blog_id) );
		}else{
 			update_post_meta( $like_id,"liked_blog_id","" ); 
		}
}