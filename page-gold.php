<?php
get_header();
	
?>
 <script>
  function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}
</script>
<!-- <div class="front-page-background" style="background: linear-gradient(rgba(0,0,0,.5), rgba(255,255,255,1)), url('<?php echo get_stylesheet_directory_uri()."/img/front-back.jpeg" ?>') ;">  --> 
	<div class="container" >
		<div class="row">
			<div class="col-md-8 left-layout">
				<div class="load-more-block">
				<?php 
					$blog = new WP_Query( array(
	                            'post_type'         => 'ws_blog',
	                            'posts_per_page'	=> 12,
	                            'meta_query'    => array(
                                                        array(
                                                            'key'       => 'blog_level',
                                                            'compare'   => '=',
                                                            'value'     => 2
                                                        ))   
	                            ));
					$loop_counter = 0;

					while( $blog->have_posts() ):
						$blog->the_post();
						$blog_id = get_the_ID();
				        $post_user_id = get_the_author_meta('ID');
				        $current_user_id = get_current_user_id();
				        $get_img = get_the_post_thumbnail_url( get_the_ID(), 'ws-regular' );
				       
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


				
				<div class="blog-card" >
					<?php  if( has_post_thumbnail() ){ ?>
					<div class="row">
						<div class="col-md-6 left-blog-card">
							<?php the_post_thumbnail('ws-regular')?>
							<a href="<?php echo $category_permalink; ?>"><p><?php echo $category[0]->name; ?></p></a>
						</div>
						<div class="col-md-6 right-blog-card">
							<div class="blog-card-header">
								<div class="blog-card-author">
									<span><a href="<?php echo $author_permalink; ?>"><?php echo  $author_nick_name; ?></a></span>
									<img src="<?php echo $avatar_url; ?>">
								</div>
							</div>
							<div class="blog-card-title">
								<h3><?php echo wp_trim_words( get_the_title(), 15 ); ?></h3>
								<p><?php echo wp_trim_words( get_the_content(), 18 ); ?></p>
							</div>
							<div class="credential">
								<span><i class="fas fa-eye"></i>&nbsp; <?php echo $no_of_views; ?></span>
								<span id="front-like" data-link="<?php the_permalink(); ?>"><i class="fas fa-heart" style="<?php if( $no_of_likes >0 ){ echo 'color:#ed4956;';  } ?>"></i> &nbsp;<?php echo $no_of_likes; ?></span>
								<span class="share-btn"><i class="fas fa-share-alt"></i></span>
							</div>
							<div class="share">
								<ul>
									<li><a rel="nofollow" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" onclick="return fbs_click()" target="_blank" ><i class="fab fa-facebook-square"></i></a></li>
									<li><a href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>&via=palefire16" onclick="window.open(this.href, 'mywin',
                                            'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" ><i class="fab fa-twitter-square"></i></a></li>
								</ul>
							</div>
							<div class="rd-more">
								<a href="<?php the_permalink() ?>"><p>Read More</p></a>
							</div>
							
						</div>
					</div>
					<?php }else{ ?>
					<div class="row">
						<div class="col-md-12 full-card">
							<div class="blog-card-header">
								<div class="blog-card-author">
									<span><a href="<?php echo $author_permalink; ?>"><?php echo  $author_nick_name; ?></a></span>
									<img src="<?php echo $avatar_url; ?>">
								</div>
								<a href="<?php echo $category_permalink; ?>"><p><?php echo $category[0]->name; ?></p></a>
							</div>
							<div class="blog-card-title">
								<h3><?php echo wp_trim_words( get_the_title(), 25 ); ?></h3>
								<p><?php echo wp_trim_words( get_the_content(), 65 ); ?></p>
							</div>
							<div class="credential">
								<span><i class="fas fa-eye"></i>&nbsp; <?php echo $no_of_views; ?></span>
								<span id="front-like" data-link="<?php the_permalink(); ?>"><i class="fas fa-heart" style="<?php if( $no_of_likes >0 ){ echo 'color:#ed4956;';  } ?>"></i> &nbsp;<?php echo $no_of_likes; ?></span>
								<span class="share-btn"><i class="fas fa-share-alt"></i></span>
							</div>
							<div class="share">
								<ul>
									<li><a rel="nofollow" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" onclick="return fbs_click()" target="_blank" ><i class="fab fa-facebook-square"></i></a></li>
									<li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
								</ul>
							</div>
							<div class="rd-more">
								<a href="<?php the_permalink(); ?>"><p>Read More</p></a>
							</div>
						</div>
					</div>
					<?php } ?>
					
					
				</div><!-- Blog-card -->
			
				<?php 
					$loop_counter++;
				endwhile; //end of the while for blog card in left layout
				wp_reset_postdata();
				?>
				</div><!-- load-more-block -->
				<div class="space20"></div>

				<div class="loadnewpost">
					
				</div>


				<div class="load-more-button-div">
					<a class="load-more-btn" data-url="<?php echo admin_url('admin-ajax.php') ?>" data-page="1" data-league="gold">
						<button class="load-more-btn-btn">Load More...</button>
						<div class="loading">
							<img src="<?php echo get_stylesheet_directory_uri().'/img/load-more-2.gif' ?>">
						</div>
					</a>
				</div>
				
			</div><!-- left layout -->


			<div class="col-md-4 right-layout">
				<div class="right-card">
					<div class="col-lg-12 bl-side-content">
						<aside class="bl-widget">
			                <h3>Walledstory Sports</h3>


			                <?php 
			                $sports = new WP_Query( array(
		                            'post_type'         => 'post',
		                            'posts_per_page'	=> 4,
		                            'category_name'		=> 'sports'  
		                            ));
			                while( $sports->have_posts() ):
			                	$sports->the_post();
			                 ?>

			                <div class="rel-post">
			                    <div class="rel-post-img">
			                    	<!-- <img src="<?php echo get_stylesheet_directory_uri().'/img/2.jpg' ?>"> -->
			                        <?php  the_post_thumbnail('ws-regular'); ?>
			                    </div>
			                    <div class="rel-post-header"><h5><?php echo get_the_time('F d, Y'); ?></h5></div>
			                    <a href="<?php the_permalink() ?>">
			                        <div class="rel-post-content">
			                            <h2><?php echo wp_trim_words(get_the_title(),6); ?></h2>
			                        </div>
			                    </a>
			                </div>
			                <?php 
			            	endwhile;
			            	wp_reset_postdata();
			                ?>

			            </aside>
			        </div>
		        </div><!-- Right Card -->
		        <div class="space30"></div>
		        <div class="right-card" >
			        <div class="col-lg-12 bl-side-content" style="padding:0 0">

			        	<a href="https://thepalefire.com/palefire-books/">
			        		<div class="pf-book-ad">
			        			<h2>PALEFIRE <span>BOOKS</span></h2>
			        			<h3>Visit Website</h3>
			        			<p>Palefire Books is created by <span>THEPALEFIRE.COM</span>, where our aim is to make rare books affordable. The desire behind Palefire Books is to give access to those rare and beautiful people who still sit by the windows on rainy days, and read.</p>
			        		</div>
			        	</a>
						<!-- <aside class="bl-widget">
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
		                </aside> -->
					</div>
				</div> <!-- Right Card -->
			</div><!-- right layout -->
		</div>
		<div class="space20"></div>
		
	</div>	


<?php
get_footer();
?>

