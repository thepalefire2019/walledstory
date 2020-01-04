<?php
get_header();
?>
<header>
	<div class="bl-header-image-sec">
        <div class="container-fluid">
            <div class="row">
				<?php
				if( have_posts() ){
					while( have_posts() ):
						the_post();
						$blog_id  = get_the_ID();
					    $get_img = get_the_post_thumbnail_url( get_the_ID(), 'ws-regular' );
					    $category = get_the_terms($blog_id, 'blog_category');
					?>
						   <div class="col-lg-3 bl-header-image-div">
			                    <img class="bl-header-images img-responsive" src="<?php echo $get_img; ?>">
			                    <div class="bl-header-images-date">
			                        <h3><?php echo get_the_time('d F, Y'); ?></h3>
			                        <div class="bl-header-images-content">
			                            <a href="<?php the_permalink(); ?>"><p><?php echo wp_trim_words( get_the_title(), 9 ); ?></p></a>
			                        </div>
			                    </div>
			                </div>
					<?php
					endwhile;
				}else{
					?>
					<div class="no-content">
						<h3>There is no matching Result.</h3>
					</div>
					<?php
				}//end if 
				?>
			</div>
		</div>
	</div>
</header>
<?php
get_footer();
?>