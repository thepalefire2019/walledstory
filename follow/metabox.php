<?php
// =========================== post id metabox for like ================

add_action("add_meta_boxes", "followed_blog_id_mbx");
function followed_blog_id_mbx(  ){
	add_meta_box( 
        'followed-blog-id',
        'Followed blog ID',
        'followed_blog_id_mbx_fn',
        'follow',
        'normal',
        'high'
    );
}
function followed_blog_id_mbx_fn( $follow ){
	$follow_id = $follow->ID;
	$followed_author_id = get_post_meta( $follow_id,"followed_blog_id",true );
	?>

	<div>
		<label>Follwed Author Id</label>
		<input type="number" name="followed_blog_id" value="<?php  echo $followed_author_id; ?>">
	</div>

	<?php
	
	
}