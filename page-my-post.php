<?php
if( !is_user_logged_in() ){
    wp_redirect(site_url('/wp-login.php'));
}
get_header();
global $current_user, $wp_roles;
?>	
<div class="my-post-page">
	<div class="container my-post-page-container">
		<div class="space40"></div>
		<div class="row">
			<div class="col-md-4">
				<div class="sa-content">
					<h2><?php echo the_author_meta( 'first_name', $current_user->ID )?></h2>
					<h5>Your Personal Wall</h5>
					<p data-toggle="modal" data-target="#exampleModalLong">
						New Post
					</p>
				</div>
			</div>
			<?php
			$englishblogs = new WP_Query( array(
									'post_type' 		=> 'ws_blog',
									'posts_per_page'	=> -1,
									'author'			=> get_current_user_id()			
							) );
			$temp_loop = 5;
			$temp_start_loop = 1;
			$loop_count = 0;
			while( $englishblogs->have_posts() ){
				$englishblogs->the_post();
				
			?>
			<div class="col-md-4">
				<div class="sk-content">
					<a href="<?php echo get_the_permalink(); ?>">
						<div class="sk-topic">
							<?php the_post_thumbnail('ws-regular'); ?>
						</div>
						<div class="sk-item">
							<h4><?php echo get_the_title(); ?></h4>
						</div>
						<div class="sk-outer-border"></div>
						<div class="sk-inner-border"></div>
						<div class="sk-top-black-box"></div>
						<div class="sk-right-black-box"></div>
						<div class="sk-left-black-box"></div>
					</a>
					
				</div>
			</div>
			<?php
			$loop_count++;
			$temp_start_loop++;
			} //end of while
			 ?>
		</div> <!-- end of row for content box -->

	</div>
</div>
<?php 
get_footer();
?>
<!-- Button trigger modal -->


<!-- Modal -->
