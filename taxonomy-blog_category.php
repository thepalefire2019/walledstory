<?php
get_header();
$taxonomy = get_queried_object();
$taxonomy_name = $taxonomy->name;
?>
<div class="tax-parent">
	<div class="tax-parent-img">
		<img src="<?php echo get_stylesheet_directory_uri().'/img/1.jpg' ?>">
	</div>
		<div class="tax-container">
			<h1><?php echo $taxonomy_name; ?></h1>
			<div class="row">

				<?php 

				$args = array(
		          'post_type' 		=> 'ws_blog',
		          'posts_per_page' 	=> 4,
			       'tax_query' 		=> array(
					                      array (
					                          'taxonomy' => 'blog_category',
					                          'field' => 'slug',
					                          'terms' => array($taxonomy_name)
					                      )
		              ),
		          'orderby' 		=> 'meta_value_num',
		          'meta_key' 		=> 'post_views_count',
		          'order' 			=> 'DESC'
		        );
				$popQuery =  new WP_Query( $args);
				while( $popQuery->have_posts() ):
					$popQuery->the_post();
					$pop_blog_id  = get_the_ID();
					$get_img = get_the_post_thumbnail_url( get_the_ID(), 'ws-regular' );

					$author_id = get_the_author_meta('ID');
			        $author_img =  get_avatar(get_the_author_meta('ID')); 
			        $avatar_url = get_the_author_meta( 'profile_picture',  get_the_author_meta('ID') ) ;
			        $author_first_name = get_the_author_meta( 'first_name', get_the_author_meta('ID') );
			        $author_last_name = get_the_author_meta( 'last_name', get_the_author_meta('ID') );
			        $author_permalink = get_author_posts_url(get_the_author_meta('ID'));
				?>

				<div class="col-md-3">
					<a href="<?php the_permalink(); ?>">
						<div class="pop-tax-box">
							<div class="pop-auth-img">
								<img src="<?php echo $avatar_url; ?>">
							</div>
							<div class="tax-box-img">
								<img src="<?php echo $get_img; ?>">
							</div>
							<div class="pop-tax-desc">
								<h3><?php echo wp_trim_words( get_the_title(), 10 ); ?></h3>
								<h5><?php echo wp_trim_words( get_the_content(), 10 ); ?>...</h5>
								<p>By <a href="<?php echo $author_permalink; ?>"><?php  echo $author_first_name.' '; ?><?php echo get_the_author_meta('last_name')[0] ?>.</a> <span>on</span> <?php echo get_the_time('d F, Y'); ?></p>
							</div>
						</div>
					</a>
				</div>
				<?php 
				endwhile; // popularpost
				wp_reset_postdata();
				 ?>				
				
			</div>
		</div>
</div>
<div class="space-custom-tax"></div>
<header>
		<div class="bl-header-image-sec">
            <div class="container-fluid">
                <div class="row">
                	<?php

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
                                <p><?php echo wp_trim_words( get_the_title(), 10 ); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php 
                	endwhile; ///all cat posts
                    ?>
                </div>
            </div>
        </div>
	</header>
<?php
get_footer();
?>