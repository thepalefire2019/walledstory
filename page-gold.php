<?php
get_header();
	
?>
<!-- <div class="front-page-background" style="background: linear-gradient(rgba(0,0,0,.5), rgba(255,255,255,1)), url('<?php echo get_stylesheet_directory_uri()."/img/front-back.jpeg" ?>') ;">  --> 
	<div class="container">
		<div class="row">
			<div class="col-md-8 left-layout">
				<?php 
					$blog = new WP_Query( array(
	                            'post_type'         => 'ws_blog',
	                            'posts_per_page'	=> 12   
	                            ));
					$loop_counter = 0;

					while( $blog->have_posts() ):
						$blog->the_post();
						$blog_id = get_the_ID();
				        $post_user_id = get_the_author_meta('ID');
				        $current_user_id = get_current_user_id();
				       
				        $category = get_the_terms($blog_id, 'blog_category');
				        $category_permalink = get_term_link( $category[0] );
				        $blog_level = getLevel(get_the_ID());

				        //author
				        $author_id = get_the_author_meta('ID');
				        $author_img =  get_avatar(get_the_author_meta('ID')); 
				        $avatar_url = get_the_author_meta( 'profile_picture',  get_the_author_meta('ID') ) ;
				        $author_first_name = get_the_author_meta( 'first_name', get_the_author_meta('ID') );
				        $author_last_name = get_the_author_meta( 'last_name', get_the_author_meta('ID') );
				        $author_nick_name = get_the_author_meta( 'user_nicename', get_the_author_meta('ID') );
				        $author_desc = get_the_author_meta( 'description', get_the_author_meta('ID') );
				        $author_permalink = get_author_posts_url(get_the_author_meta('ID'));

				        //Blog Details
				        $likeCount = new WP_Query( array(
	                                    'post_type'     => 'like',
	                                    'meta_query'    => array(
	                                        array(
	                                            'key'       => 'liked_blog_id',
	                                            'compare'   => '=',
	                                            'value'     => $blog_id
	                                        ))
	                                ) );
				        $no_of_likes = $likeCount->found_posts;
				        $no_of_views = getPostViews(get_the_ID());
				        //print_r($category);
				?>
				<div class="blog-card">
					<div class="blog-card-header <?php  if( $blog_level == 0 ){ echo 'bronze';}elseif( $blog_level ==1 ){echo 'silver';}else{echo 'gold';}?>">
						<div class="blog-card-author">
							<img src="<?php echo $avatar_url; ?>">
							<span><a href="<?php echo $author_permalink; ?>"><?php echo  $author_nick_name; ?></a></span>
						</div>	
						<div class="blog-card-level">
							<?php 
								if( $blog_level == 0 ){
									?>
									<!-- <p class="bronze">Bronze</p> -->
									<?php
								}elseif( $blog_level == 1 ){
									?>
									<!-- <p class="silver">SILVER</p> -->
									<?php
								}else{
									?>
									<!-- <p class="gold">GOLD</p> -->
									<?php
								}

							?>
							
						</div>		
						<div class="blog-card-category">
							<p><a href="<?php echo $category_permalink; ?>"><?php echo $category[0]->name; ?></a></p>
						</div>		
					</div>
					<div class="blog-card-body">
						<div class="blog-img">
							 <?php 
	                            if( has_post_thumbnail() ){
	                                the_post_thumbnail('ws-regular');
	                            }
	                        ?>
						</div>
						<div class="blog-details">
							<h1><?php echo wp_trim_words( get_the_title(), 15 ); ?></h1>
							<p><?php echo wp_trim_words( get_the_content(), 48 ); ?><span><a href="<?php the_permalink(); ?>"> Read More</a></span></p>
						</div>
					</div>
					<div class="blog-card-footer">
						<div class="blog-card-views">
							<span><i class="fas fa-eye"></i>&nbsp; <?php echo $no_of_views; ?></span>
						</div>
						<div class="blog-card-likes">
							<span><i class="fas fa-heart" style="<?php if( $no_of_likes >0 ){ echo 'color:red;';  } ?>"></i> &nbsp;<?php echo $no_of_likes; ?></span>
						</div>
					</div>
					
				</div><!-- Blog-card -->
				<?php 
					$loop_counter++;
				endwhile; //end of the while fro blog cart in left layout
				?>
				<div class="space20"></div>
				
			</div><!-- left layout -->


			<div class="col-md-4 right-layout">
				<div class="right-card">
					<div class="col-lg-12 bl-side-content">
						<aside class="bl-widget">
			                <h3>Related Posts</h3>
			                <div class="rel-post">
			                    <div class="rel-post-img">
			                    	<img src="<?php echo get_stylesheet_directory_uri().'/img/2.jpg' ?>">
			                        <?php // the_post_thumbnail('ws-regular'); ?>
			                    </div>
			                    <div class="rel-post-header"><h5><?php //echo get_the_time('F d, Y'); ?>December 9, 2019</h5></div>
			                    <a href="<?php// the_permalink() ?>">
			                        <div class="rel-post-content">
			                            <h2><?php// the_title(); ?>Est ante in nibh mauris cursus mattis molestie a iaculis.</h2>
			                        </div>
			                    </a>
			                </div>
			            </aside>
			        </div>
		        </div><!-- Right Card -->
		        <div class="space30"></div>
		        <div class="right-card">
			        <div class="col-lg-12 bl-side-content">
						<aside class="bl-widget">
		                    <h3>Categories</h3>      
		                    <ul>
		                        <li>
		                            <a href="#">Advertising</a><span>1</span>
		                        </li>
		                        <li>
		                            <a href="#">Creative</a><span>1</span>
		                        </li>
		                        <li>
		                            <a href="#">Inspiration</a><span>1</span>
		                        </li>
		                        <li>
		                            <a href="#">Life</a><span>3</span>
		                        </li>
		                        <li>
		                            <a href="#">Music</a><span>2</span>
		                        </li>
		                        <li>
		                            <a href="#">Photography</a><span>1</span>
		                        </li>
		                        <li>
		                            <a href="#">readolog</a><span>6</span>
		                        </li>
		                        <li>
		                            <a href="#">Travel</a><span>2</span>
		                        </li>
		                    </ul>
		                </aside>
					</div>
				</div> <!-- Right Card -->
			</div><!-- right layout -->
		</div>
		<div class="space20"></div>
		
	</div>	


<?php
get_footer();
?>

