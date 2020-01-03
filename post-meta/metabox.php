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
		?>
		<div style="width: 100%">
			<table style="text-align:center;">
				<tr>
					<td>
						<label>Home Team: </label>
					</td>
					<td>
						<input type="text" name="">
					</td>
				</tr>
				<tr>
					<td>
						<label>Away Team: </label>
					</td>
					<td>
						<input type="text" name="">
					</td>
				</tr>
				<tr>
					<td>
						<label>Home Score: </label>
					</td>
					<td>
						<input type="text" name="">
					</td>
				</tr>
				<tr>
					<td>
						<label>Away Score: </label>
					</td>
					<td>
						<input type="text" name="">
					</td>
				</tr>
				<tr>
					<td>
						<label>Home Contribution: </label>
					</td>
					<td>
						<input type="text" name="">
					</td>
				</tr>
				<tr>
					<td>
						<label>Away Contribution: </label>
					</td>
					<td>
						<input type="text" name="">
					</td>
				</tr>
				<tr>
					<td>
						<label>MOM: </label>
					</td>
					<td>
						<input type="text" name="">
					</td>
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