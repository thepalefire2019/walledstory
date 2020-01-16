<?php 

add_action("add_meta_boxes", "sports_mbx");
function sports_mbx(){
	add_meta_box( 
        'post-sports-mbx',
        'Sports Information',
        'sports_mbx_fn',
        'post',
        'normal',
        'high'
    );
}
function sports_mbx_fn( $post ){
	$post_id = $post->ID;
	$category = get_the_terms($post_id, 'category');
	//print_r($category);
	if( $category[0]->slug == 'sports' ){
		$home_team = get_post_meta( $post_id,"home_team",true );
		$away_team = get_post_meta( $post_id,"away_team",true );
		$home_score = get_post_meta( $post_id,"home_score",true );
		$away_score = get_post_meta( $post_id,"away_score",true );
		$home_contributor = get_post_meta( $post_id,"home_contributor",true );
		$away_contributor = get_post_meta( $post_id,"away_contributor",true );
		$mom = get_post_meta( $post_id,"mom",true );

		$home_player_1 = get_post_meta( $post_id,"home_player_1",true );
		$home_player_2 = get_post_meta( $post_id,"home_player_2",true );
		$home_player_3 = get_post_meta( $post_id,"home_player_3",true );
		$home_player_4 = get_post_meta( $post_id,"home_player_4",true );
		$home_player_5 = get_post_meta( $post_id,"home_player_5",true );
		$home_player_6 = get_post_meta( $post_id,"home_player_6",true );
		$home_player_7 = get_post_meta( $post_id,"home_player_7",true );
		$home_player_8 = get_post_meta( $post_id,"home_player_8",true );
		$home_player_9 = get_post_meta( $post_id,"home_player_9",true );
		$home_player_10 = get_post_meta( $post_id,"home_player_10",true );
		$home_player_11 = get_post_meta( $post_id,"home_player_11",true );
		$home_player_12 = get_post_meta( $post_id,"home_player_12",true );
		$home_player_13 = get_post_meta( $post_id,"home_player_13",true );
		$home_player_14 = get_post_meta( $post_id,"home_player_14",true );
		$home_player_15 = get_post_meta( $post_id,"home_player_15",true );

		$away_player_1 = get_post_meta( $post_id,"away_player_1",true );
		$away_player_2 = get_post_meta( $post_id,"away_player_2",true );
		$away_player_3 = get_post_meta( $post_id,"away_player_3",true );
		$away_player_4 = get_post_meta( $post_id,"away_player_4",true );
		$away_player_5 = get_post_meta( $post_id,"away_player_5",true );
		$away_player_6 = get_post_meta( $post_id,"away_player_6",true );
		$away_player_7 = get_post_meta( $post_id,"away_player_7",true );
		$away_player_8 = get_post_meta( $post_id,"away_player_8",true );
		$away_player_9 = get_post_meta( $post_id,"away_player_9",true );
		$away_player_10 = get_post_meta( $post_id,"away_player_10",true );
		$away_player_11 = get_post_meta( $post_id,"away_player_11",true );
		$away_player_12 = get_post_meta( $post_id,"away_player_12",true );
		$away_player_13 = get_post_meta( $post_id,"away_player_13",true );
		$away_player_14 = get_post_meta( $post_id,"away_player_14",true );
		$away_player_15 = get_post_meta( $post_id,"away_player_15",true );
		?>
		<div style="width: 100%">
			<table style="text-align:center;">
				<tr>
					<td>
						<label>Home Team: </label>
					</td>
					<td>
						<input type="text" name="home_team" value="<?php echo $home_team ?>">
					</td>
				</tr>
				<tr>
					<td>
						<label>Away Team: </label>
					</td>
					<td>
						<input type="text" name="away_team" value="<?php echo $away_team; ?>">
					</td>
				</tr>
				<tr>
					<td>
						<label>Home Score: </label>
					</td>
					<td>
						<input type="text" name="home_score" value="<?php echo $home_score ?>">
					</td>
				</tr>
				<tr>
					<td>
						<label>Away Score: </label>
					</td>
					<td>
						<input type="text" name="away_score" value="<?php echo $away_score ?>">
					</td>
				</tr>
				<tr>
					<td>
						<label>Home Contributors: </label>
					</td>
					<td>
						<input type="text" name="home_contributor" value="<?php echo $home_contributor  ?>">
					</td>
				</tr>
				<tr>
					<td>
						<label>Away Contributors: </label>
					</td>
					<td>
						<input type="text" name="away_contributor" value="<?php echo $away_contributor ?>">
					</td>
				</tr>
				<tr>
					<td>
						<label>MOM: </label>
					</td>
					<td>
						<input type="text" name="mom" value="<?php echo $mom ?>">
					</td>
				</tr>
			</table>
			<h1 style="text-align: center;">Squad</h1>
			<h2 style="text-align: center;">Home Team</h2>
			<table>
				<tr>
					<td><input type="text" name="home_player_1" placeholder="Home Player 1" value="<?php echo $home_player_1 ?>"></td>
					<td><input type="text" name="home_player_2" placeholder="Home Player 2" value="<?php echo $home_player_2 ?>"></td>
					<td><input type="text" name="home_player_3" placeholder="Home Player 3" value="<?php echo $home_player_3 ?>"></td>
				</tr>
				<tr>
					<td><input type="text" name="home_player_4" placeholder="Home Player 4" value="<?php echo $home_player_4 ?>"></td>
					<td><input type="text" name="home_player_5" placeholder="Home Player 5" value="<?php echo $home_player_5 ?>"></td>
					<td><input type="text" name="home_player_6" placeholder="Home Player 6" value="<?php echo $home_player_6 ?>"></td>
				</tr>
				<tr>
					<td><input type="text" name="home_player_7" placeholder="Home Player 7" value="<?php echo $home_player_7 ?>"></td>
					<td><input type="text" name="home_player_8" placeholder="Home Player 8" value="<?php echo $home_player_8 ?>"></td>
					<td><input type="text" name="home_player_9" placeholder="Home Player 9" value="<?php echo $home_player_9 ?>"></td>
				</tr>
				<tr>
					<td><input type="text" name="home_player_10" placeholder="Home Player 10" value="<?php echo $home_player_10 ?>"></td>
					<td><input type="text" name="home_player_11" placeholder="Home Player 11" value="<?php echo $home_player_11 ?>"></td>
					<td><input type="text" name="home_player_12" placeholder="Home Player 12" value="<?php echo $home_player_12 ?>"></td>
				</tr>
				<tr>
					<td><input type="text" name="home_player_13" placeholder="Home Player 13" value="<?php echo $home_player_13 ?>"></td>
					<td><input type="text" name="home_player_14" placeholder="Home Player 14" value="<?php echo $home_player_14 ?>"></td>
					<td><input type="text" name="home_player_15" placeholder="Home Player 15" value="<?php echo $home_player_15 ?>"></td>
				</tr>
			</table>

			<h2 style="text-align: center;">Away Team</h2>
			<table>
				<tr>
					<td><input type="text" name="away_player_1" placeholder="Away Player 1" value="<?php echo $away_player_1 ?>"></td>
					<td><input type="text" name="away_player_2" placeholder="Away Player 2" value="<?php echo $away_player_2 ?>"></td>
					<td><input type="text" name="away_player_3" placeholder="Away Player 3" value="<?php echo $away_player_3 ?>"></td>
				</tr>
				<tr>
					<td><input type="text" name="away_player_4" placeholder="Away Player 4" value="<?php echo $away_player_4 ?>"></td>
					<td><input type="text" name="away_player_5" placeholder="Away Player 5" value="<?php echo $away_player_5 ?>"></td>
					<td><input type="text" name="away_player_6" placeholder="Away Player 6" value="<?php echo $away_player_6 ?>"></td>
				</tr>
				<tr>
					<td><input type="text" name="away_player_7" placeholder="Away Player 7" value="<?php echo $away_player_7 ?>"></td>
					<td><input type="text" name="away_player_8" placeholder="Away Player 8" value="<?php echo $away_player_8 ?>"></td>
					<td><input type="text" name="away_player_9" placeholder="Away Player 9" value="<?php echo $away_player_9 ?>"></td>
				</tr>
				<tr>
					<td><input type="text" name="away_player_10" placeholder="Away Player 10" value="<?php echo $away_player_10 ?>"></td>
					<td><input type="text" name="away_player_11" placeholder="Away Player 11" value="<?php echo $away_player_11 ?>"></td>
					<td><input type="text" name="away_player_12" placeholder="Away Player 12" value="<?php echo $away_player_12 ?>"></td>
				</tr>
				<tr>
					<td><input type="text" name="away_player_13" placeholder="Away Player 13" value="<?php echo $away_player_13 ?>"></td>
					<td><input type="text" name="away_player_14" placeholder="Away Player 14" value="<?php echo $away_player_14 ?>"></td>
					<td><input type="text" name="away_player_15" placeholder="Away Player 15" value="<?php echo $away_player_15 ?>"></td>
				</tr>
			</table>

		</div>
		<div>
			
		</div>
		<?php
	}else{
		echo '<h3 style="color:red;">This post is not of sports category. To assign select category and update.</h3>';
	}
}