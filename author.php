<?php 
get_header();
global $current_user, $wp_roles;
$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
$author_id = $author->ID;
$avatar_url = get_the_author_meta( 'profile_picture', $author_id ) ;
?>
<div class="author-full-page">
	<div class="space40"></div>
	<div class="container ">
		<div class="author-bio">
			<div class="row">
				<div class="col-md-6">
					<div class="space60"></div>
					<div class="author-desc">
						<div class="mobile-author-img">
							<?php if( $avatar_url ){ ?>
							<img src="<?php echo $avatar_url ?>">
							<?php
								}else{
							?>
							<img src="<?php echo get_template_directory_uri() ?>/img/no_avatar.png">
							<?php 
							}
							?>
						</div>
						<div class="author-title">
							<h3><?php  echo the_author_meta( 'first_name', $author_id ) ?><br>
							 	<?php  echo the_author_meta( 'last_name', $author_id );  ?>
							</h3>
						</div>
						<div class="author-biography">
							<p><?php echo get_the_author_meta( 'description', $author_id ); ?></p>
						</div>
						<?php 
						$data_exist = 'data-followexist="no"';
						$follow = "Follow";
						$followCount = new WP_Query( array(
                                    'post_type'     => 'follow',
                                    'meta_query'    => array(
                                        array(
                                            'key'       => 'followed_blog_id',
                                            'compare'   => '=',
                                            'value'     => $author_id
                                        ))
                                ) );


						 if( is_user_logged_in() ){
                            $checkfollow = new WP_Query( array(
                            'author'        => get_current_user_id(),
                            'post_type'     => 'follow',
                            'meta_query'    => array(
                                array(
                                    'key'       => 'followed_blog_id',
                                    'compare'   => '=',
                                    'value'     => $author_id
                                ))
                            ) );

                             if( $checkfollow->found_posts ){
                                //$like_style = 'style="color:red"';

                                $data_exist = 'data-followexist="yes" style="background:var(--theme-color-dark);color:#fff"';
                                $follow = "Unfollow";
                             }
                        }
                        $following = new WP_Query( array(
                            'author'        => $author_id,
                            'post_type'     => 'follow'
                            ) );



                        if( get_current_user_id() == $author_id ){
                        	echo '';
                        }else{
                         if( is_user_logged_in() ){
						?>
						<div class="author-follow">
							<p class="click-follow" <?php echo $data_exist; ?> data-author_id="<?php echo $author_id; ?>"  <?php if( isset( $checkfollow->posts[0]->ID ) ){ echo 'data-follow_id ="'.$checkfollow->posts[0]->ID.'"'; } ?>> <?php echo $follow; ?> </p>
						</div>
						<?php }else{ ?>
						<div class="author-follow">
							<p class="click-follow-logged-off" >Follow</p>
						</div>
						<?php }// logged in check
						}// current user = the author check ?>



						<div class="space30"></div>
						<div class="author-followers">
							<div class="followers">
								
								<h5>Follwers</h5>
								<p class="js-followers"><?php echo $followCount->found_posts; ?></p>
							</div>
							<div class="followering">
								<h5>Following</h5>
								<p><?php echo $following->found_posts; ?></p>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="author-img">
						<?php if( $avatar_url ){ ?>
						<img src="<?php echo $avatar_url ?>">
						<?php
							}else{
						?>
						<img src="<?php echo get_template_directory_uri() ?>/img/no_avatar.png">
						<?php 
						}
						?>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			
			
		</div><!-- Author bio -->

		<div class="author-blogs">
			<h1>Blogs By <span>Sarasij</span></h1>
			<p class="underline"></p>
			<div class="clearfix"></div>
			<header>
				<div class="bl-header-image-sec">
		            <div class="container-fluid">
		                <div class="row">
		                	<?php 
		                	$blog = new WP_Query( array(
                            'post_type'         => 'ws_blog',
                            'posts_per_page'	=> 12   
                            ));
		                	while( $blog->have_posts() ):
		                		$blog->the_post();
		                		$blog_id = get_the_ID();
		                		$category = get_the_terms($blog_id, 'blog_category');
			        			$blog_level = getLevel(get_the_ID());
			        			$get_img = get_the_post_thumbnail_url( get_the_ID(), 'ws-regular' );
		                	 ?>
		                	
		                    <div class="col-lg-3 bl-header-image-div">
		                        <img class="bl-header-images img-responsive" src="<?php the_post_thumbnail_url( get_the_ID(), 'ws-regular' ); ?>">
		                        <div class="bl-header-images-date">
		                            <h3><?php echo get_the_time('F d, Y'); ?> in <?php echo $category[0]->name; ?></h3>
		                            <div class="bl-header-images-content">
		                                <a href="<?php the_permalink(); ?>"><p class="sarasij-p"><?php echo get_the_title(); ?></p></a>
		                            </div>
		                        </div>
		                    </div>
		                    <?php
		                	endwhile;
		                     ?>
		                </div>
		            </div>
		        </div>
			</header>
		</div><!-- Author blogs -->
	</div>
</div>
<?php
get_footer();
?>