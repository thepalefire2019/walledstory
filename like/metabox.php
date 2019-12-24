<?php
// =========================== post id metabox for like ================

add_action("add_meta_boxes", "liked_blog_id_mbx");
function liked_blog_id_mbx(  ){
	add_meta_box( 
        'liked-blog-id',
        'Liked blog ID',
        'liked_blog_id_mbx_fn',
        'like',
        'normal',
        'high'
    );
}
function liked_blog_id_mbx_fn( $like ){
	$like_id = $like->ID;
	$liked_blog_id = get_post_meta( $like_id,"liked_blog_id",true );
	?>

	<div>
		<label>Liked blog Id</label>
		<input type="number" name="liked_blog_id" value="<?php echo $liked_blog_id; ?>">
	</div>

	<?php
	
	
}