<?php
add_action("save_post","sports_data_save");
function sports_data_save( $post_id ){

	$home_team = isset( $_REQUEST["home_team"])?trim($_REQUEST["home_team"] ):"";
	if(!empty($home_team)){
		update_post_meta( $post_id,"home_team",$home_team );
	}else{
		update_post_meta( $post_id,"home_team","" ); 
	}

	$away_team = isset( $_REQUEST["away_team"])?trim($_REQUEST["away_team"] ):"";
	if(!empty($away_team)){
		update_post_meta( $post_id,"away_team",$away_team );
	}else{
		update_post_meta( $post_id,"away_team","" ); 
	}

	$home_score = isset( $_REQUEST["home_score"])?trim($_REQUEST["home_score"] ):"";
	if(!empty($home_score)){
		update_post_meta( $post_id,"home_score",$home_score );
	}else{
		update_post_meta( $post_id,"home_score","" ); 
	}

	$away_score = isset( $_REQUEST["away_score"])?trim($_REQUEST["away_score"] ):"";
	if(!empty($away_score)){
		update_post_meta( $post_id,"away_score",$away_score );
	}else{
		update_post_meta( $post_id,"away_score","" ); 
	}

	$home_contributor = isset( $_REQUEST["home_contributor"])?trim($_REQUEST["home_contributor"] ):"";
	if(!empty($home_contributor)){
		update_post_meta( $post_id,"home_contributor",$home_contributor );
	}else{
		update_post_meta( $post_id,"home_contributor","" ); 
	}

	$away_contributor = isset( $_REQUEST["away_contributor"])?trim($_REQUEST["away_contributor"] ):"";
	if(!empty($away_contributor)){
		update_post_meta( $post_id,"away_contributor",$away_contributor );
	}else{
		update_post_meta( $post_id,"away_contributor","" ); 
	}

	$mom = isset( $_REQUEST["mom"])?trim($_REQUEST["mom"] ):"";
	if(!empty($mom)){
		update_post_meta( $post_id,"mom",$mom );
	}else{
		update_post_meta( $post_id,"mom","" ); 
	}

	$home_player_1 = isset( $_REQUEST["home_player_1"])?trim($_REQUEST["home_player_1"] ):"";
	if(!empty($home_player_1)){
		update_post_meta( $post_id,"home_player_1",$home_player_1 );
	}else{
		update_post_meta( $post_id,"home_player_1","" ); 
	}

	$home_player_2 = isset( $_REQUEST["home_player_2"])?trim($_REQUEST["home_player_2"] ):"";
	if(!empty($home_player_2)){
		update_post_meta( $post_id,"home_player_2",$home_player_2 );
	}else{
		update_post_meta( $post_id,"home_player_2","" ); 
	}

	$home_player_3 = isset( $_REQUEST["home_player_3"])?trim($_REQUEST["home_player_3"] ):"";
	if(!empty($home_player_3)){
		update_post_meta( $post_id,"home_player_3",$home_player_3 );
	}else{
		update_post_meta( $post_id,"home_player_3","" ); 
	}

	$home_player_4 = isset( $_REQUEST["home_player_4"])?trim($_REQUEST["home_player_4"] ):"";
	if(!empty($home_player_4)){
		update_post_meta( $post_id,"home_player_4",$home_player_4 );
	}else{
		update_post_meta( $post_id,"home_player_4","" ); 
	}

	$home_player_5 = isset( $_REQUEST["home_player_5"])?trim($_REQUEST["home_player_5"] ):"";
	if(!empty($home_player_5)){
		update_post_meta( $post_id,"home_player_5",$home_player_5 );
	}else{
		update_post_meta( $post_id,"home_player_5","" ); 
	}

	$home_player_6 = isset( $_REQUEST["home_player_6"])?trim($_REQUEST["home_player_6"] ):"";
	if(!empty($home_player_6)){
		update_post_meta( $post_id,"home_player_6",$home_player_6 );
	}else{
		update_post_meta( $post_id,"home_player_6","" ); 
	}

	$home_player_7 = isset( $_REQUEST["home_player_7"])?trim($_REQUEST["home_player_7"] ):"";
	if(!empty($home_player_7)){
		update_post_meta( $post_id,"home_player_7",$home_player_7 );
	}else{
		update_post_meta( $post_id,"home_player_7","" ); 
	}

	$home_player_8 = isset( $_REQUEST["home_player_8"])?trim($_REQUEST["home_player_8"] ):"";
	if(!empty($home_player_8)){
		update_post_meta( $post_id,"home_player_8",$home_player_8 );
	}else{
		update_post_meta( $post_id,"home_player_8","" ); 
	}

	$home_player_9 = isset( $_REQUEST["home_player_9"])?trim($_REQUEST["home_player_9"] ):"";
	if(!empty($home_player_9)){
		update_post_meta( $post_id,"home_player_9",$home_player_9 );
	}else{
		update_post_meta( $post_id,"home_player_9","" ); 
	}

	$home_player_10 = isset( $_REQUEST["home_player_10"])?trim($_REQUEST["home_player_10"] ):"";
	if(!empty($home_player_10)){
		update_post_meta( $post_id,"home_player_10",$home_player_10 );
	}else{
		update_post_meta( $post_id,"home_player_10","" ); 
	}

	$home_player_11 = isset( $_REQUEST["home_player_11"])?trim($_REQUEST["home_player_11"] ):"";
	if(!empty($home_player_11)){
		update_post_meta( $post_id,"home_player_11",$home_player_11 );
	}else{
		update_post_meta( $post_id,"home_player_11","" ); 
	}

	$home_player_12 = isset( $_REQUEST["home_player_12"])?trim($_REQUEST["home_player_12"] ):"";
	if(!empty($home_player_12)){
		update_post_meta( $post_id,"home_player_12",$home_player_12 );
	}else{
		update_post_meta( $post_id,"home_player_12","" ); 
	}

	$home_player_13 = isset( $_REQUEST["home_player_13"])?trim($_REQUEST["home_player_13"] ):"";
	if(!empty($home_player_13)){
		update_post_meta( $post_id,"home_player_13",$home_player_13 );
	}else{
		update_post_meta( $post_id,"home_player_13","" ); 
	}

	$home_player_14 = isset( $_REQUEST["home_player_14"])?trim($_REQUEST["home_player_14"] ):"";
	if(!empty($home_player_14)){
		update_post_meta( $post_id,"home_player_14",$home_player_14 );
	}else{
		update_post_meta( $post_id,"home_player_14","" ); 
	}

	$home_player_15 = isset( $_REQUEST["home_player_15"])?trim($_REQUEST["home_player_15"] ):"";
	if(!empty($home_player_15)){
		update_post_meta( $post_id,"home_player_15",$home_player_15 );
	}else{
		update_post_meta( $post_id,"home_player_15","" ); 
	}



	$away_player_1 = isset( $_REQUEST["away_player_1"])?trim($_REQUEST["away_player_1"] ):"";
	if(!empty($away_player_1)){
		update_post_meta( $post_id,"away_player_1",$away_player_1 );
	}else{
		update_post_meta( $post_id,"away_player_1","" ); 
	}

	$away_player_2 = isset( $_REQUEST["away_player_2"])?trim($_REQUEST["away_player_2"] ):"";
	if(!empty($away_player_2)){
		update_post_meta( $post_id,"away_player_2",$away_player_2 );
	}else{
		update_post_meta( $post_id,"away_player_2","" ); 
	}

	$away_player_3 = isset( $_REQUEST["away_player_3"])?trim($_REQUEST["away_player_3"] ):"";
	if(!empty($away_player_3)){
		update_post_meta( $post_id,"away_player_3",$away_player_3 );
	}else{
		update_post_meta( $post_id,"away_player_3","" ); 
	}

	$away_player_4 = isset( $_REQUEST["away_player_4"])?trim($_REQUEST["away_player_4"] ):"";
	if(!empty($away_player_4)){
		update_post_meta( $post_id,"away_player_4",$away_player_4 );
	}else{
		update_post_meta( $post_id,"away_player_4","" ); 
	}

	$away_player_5 = isset( $_REQUEST["away_player_5"])?trim($_REQUEST["away_player_5"] ):"";
	if(!empty($away_player_5)){
		update_post_meta( $post_id,"away_player_5",$away_player_5 );
	}else{
		update_post_meta( $post_id,"away_player_5","" ); 
	}

	$away_player_6 = isset( $_REQUEST["away_player_6"])?trim($_REQUEST["away_player_6"] ):"";
	if(!empty($away_player_6)){
		update_post_meta( $post_id,"away_player_6",$away_player_6 );
	}else{
		update_post_meta( $post_id,"away_player_6","" ); 
	}

	$away_player_7 = isset( $_REQUEST["away_player_7"])?trim($_REQUEST["away_player_7"] ):"";
	if(!empty($away_player_7)){
		update_post_meta( $post_id,"away_player_7",$away_player_7 );
	}else{
		update_post_meta( $post_id,"away_player_7","" ); 
	}

	$away_player_8 = isset( $_REQUEST["away_player_8"])?trim($_REQUEST["away_player_8"] ):"";
	if(!empty($away_player_8)){
		update_post_meta( $post_id,"away_player_8",$away_player_8 );
	}else{
		update_post_meta( $post_id,"away_player_8","" ); 
	}

	$away_player_9 = isset( $_REQUEST["away_player_9"])?trim($_REQUEST["away_player_9"] ):"";
	if(!empty($away_player_9)){
		update_post_meta( $post_id,"away_player_9",$away_player_9 );
	}else{
		update_post_meta( $post_id,"away_player_9","" ); 
	}

	$away_player_10 = isset( $_REQUEST["away_player_10"])?trim($_REQUEST["away_player_10"] ):"";
	if(!empty($away_player_10)){
		update_post_meta( $post_id,"away_player_10",$away_player_10 );
	}else{
		update_post_meta( $post_id,"away_player_10","" ); 
	}

	$away_player_11 = isset( $_REQUEST["away_player_11"])?trim($_REQUEST["away_player_11"] ):"";
	if(!empty($away_player_11)){
		update_post_meta( $post_id,"away_player_11",$away_player_11 );
	}else{
		update_post_meta( $post_id,"away_player_11","" ); 
	}

	$away_player_12 = isset( $_REQUEST["away_player_12"])?trim($_REQUEST["away_player_12"] ):"";
	if(!empty($away_player_12)){
		update_post_meta( $post_id,"away_player_12",$away_player_12 );
	}else{
		update_post_meta( $post_id,"away_player_12","" ); 
	}

	$away_player_13 = isset( $_REQUEST["away_player_13"])?trim($_REQUEST["away_player_13"] ):"";
	if(!empty($away_player_13)){
		update_post_meta( $post_id,"away_player_13",$away_player_13 );
	}else{
		update_post_meta( $post_id,"away_player_13","" ); 
	}

	$away_player_14 = isset( $_REQUEST["away_player_14"])?trim($_REQUEST["away_player_14"] ):"";
	if(!empty($away_player_14)){
		update_post_meta( $post_id,"away_player_14",$away_player_14 );
	}else{
		update_post_meta( $post_id,"away_player_14","" ); 
	}

	$away_player_15 = isset( $_REQUEST["away_player_15"])?trim($_REQUEST["away_player_15"] ):"";
	if(!empty($away_player_15)){
		update_post_meta( $post_id,"away_player_15",$away_player_15 );
	}else{
		update_post_meta( $post_id,"away_player_15","" ); 
	}
}