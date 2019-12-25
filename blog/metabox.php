<?php
// =========================== view metabox for blog ================

add_action("add_meta_boxes", "view_mbx");
function view_mbx(  ){
	add_meta_box( 
        'view-blog',
        'Blog Report',
        'view_mbx_fn',
        'ws_blog',
        'side',
        'high'
    );
}
function view_mbx_fn( $blog ){
	$blog_id = $blog->ID;
	$no_of_views = get_post_meta( $blog_id,"post_views_count",true );
	$no_of_likes = get_post_meta( $blog_id,"blog_like_count",true );
	$level = get_post_meta( $blog_id,"blog_level",true );
	if( $level == 0 ){
		$level_color = '#cd7f32';
		$level_text = 'Bronze';
	}elseif ($level == 1) {
		$level_color = '#999999';
		$level_text = 'Silver';
	}else{
		$level_color = '#ffd700';
		$level_text = 'Gold';
    }
	?>

	<div style="float: left;margin-right: 10px" >
		<label>Views</label>
		<input type="number" name="" value="<?php echo $no_of_views; ?>" style="border:1px solid #000;color: #000;width: 40px;"  disabled>
	</div>
	<div style="float: left;">
		<label style="color: red; ">Likes</label>
		<input type="number" name="" value="<?php echo $no_of_likes; ?>" style="border:1px solid #000;color: red;width:40px" disabled>
	</div>
	<div style="clear: both"></div>
	<div style="margin-top:5px;">
		<div style="width: 80px; height: 20px; background: <?php echo $level_color ?>; float: left; margin-left: 40%;transform: translateX(-50%); border-radius: 5px;">
			<p style="color: #000; text-align: center;padding: 2px 7px;"> <?php echo $level_text; ?></p>
		</div>
	</div>
	<div style="clear: both"></div>
	<?php
	
	
}