<?php
add_action("save_post","like_data_save");
function like_data_save( $like_id ){

	$liked_english_id = isset( $_REQUEST["liked_english_id"])?trim($_REQUEST["liked_english_id"] ):"";
	if(!empty($liked_english_id)){
		update_post_meta( $like_id,"liked_english_id",intval($liked_english_id) );
		}else{
 			update_post_meta( $like_id,"liked_english_id","" ); 
		}
}