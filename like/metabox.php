<?php
// =========================== post id metabox for like ================

add_action("add_meta_boxes", "liked_english_id_mbx");
function liked_english_id_mbx(  ){
	add_meta_box( 
        'liked-english-id',
        'Liked English ID',
        'liked_english_id_mbx_fn',
        'like',
        'normal',
        'high'
    );
}
function liked_english_id_mbx_fn( $like ){
	$like_id = $like->ID;
	$liked_english_id = get_post_meta( $like_id,"liked_english_id",true );
	?>

	<div>
		<label>Liked English Id</label>
		<input type="number" name="liked_english_id" value="<?php echo $liked_english_id; ?>">
	</div>

	<?php
	
	
}