<?php
add_action("save_post","follow_data_save");
function follow_data_save( $follow_id ){

	$followed_blog_id = isset( $_REQUEST["followed_blog_id"])?trim($_REQUEST["followed_blog_id"] ):"";
	if(!empty($followed_blog_id)){
		update_post_meta( $follow_id,"followed_blog_id",intval($followed_blog_id) );
		}else{
 			update_post_meta( $follow_id,"followed_blog_id","" ); 
		}
}