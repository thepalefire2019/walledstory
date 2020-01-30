
</div><!-- Director -->
</div>
<footer>
	<div class="container" >
		<div class="row foot">
			
			<div class="col-md-3 bl-footer-logo">
				<div class="space20"></div>
				<h2><a href="<?php echo site_url(); ?>">Walledstory</a></h2>
			
				<div class="space40"></div>
				<div class="ft-content">
					<p>WALLEDSTORY is a web-based social platform connecting the artists of the world. From Poets to Painters, Writers to Designers, WALLEDSTORY is the new symposium for Expression.</p>
				</div>
				<div class="space40"></div>
			</div>
			<div class="col-md-3 menus">
				<div class="space20"></div>
				<h2>Menus</h2>
				<div class="space20"></div>
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">Privacy Policy</a></li>
					<li><a href="#">Terms and Condition</a></li>
					<li><a href="#">Disclaimer</a></li>
					<li><a href="#">Palefire Tech</a></li>
					<li><a href="#">Palefire Books</a></li>
					<li><a href="#">About Us</a></li>
				</ul>
			</div>
			<div class="col-md-3 pop-post">
				<div class="space20"></div>
				<h2>Pouplar Posts</h2>
				<div class="space20"></div>
				<?php 
					$blog_pop= new WP_Query( array(
	                            'post_type'         => 'ws_blog',
	                            'posts_per_page'	=> 3 ,
	                            'orderby' 			=> 'meta_value_num',
						        'meta_key' 			=> 'post_views_count',
						        'order' 			=> 'DESC' 
	                            ));
					
					while( $blog_pop->have_posts() ){
						$blog_pop->the_post();
						$get_img = get_the_post_thumbnail_url( get_the_ID(), 'ws-regular' );
					?>
					<a href="<?php the_permalink() ?>">
						<div class="ul">
							<div class="li">
								<?php if( has_post_thumbnail() ){ ?>
								<img src="<?php echo $get_img ?>">
								<h3><?php echo wp_trim_words( get_the_title(), 12 ) ?></h2>
								<?php 
								}else{
								?>
								<h3 style="width: 100%;"><?php echo wp_trim_words( get_the_title(), 12 ) ?></h2>
								<?php } ?>
							</div>
						</div>
					</a>
					<hr>
					<?php
						
					} //while
					wp_reset_postdata();
				?>
			</div>
			<div class="col-md-3 img">
				<div class="space20"></div>
				<h2>Photos</h2>
				<div class="space20"></div>
				<!-- caroisel -->
				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<?php 
							$blog_img = new WP_Query( array(
			                            'post_type'         => 'ws_blog',
			                            'posts_per_page'	=> -1   
			                            ));
							$img_counter = 0;
							while( $blog_img->have_posts() ){
								$blog_img->the_post();
								$get_img = get_the_post_thumbnail_url( get_the_ID(), 'ws-regular' );
								if( has_post_thumbnail() ){
						?>
									<div class="carousel-item <?php if( $img_counter == 0 ){ echo 'active' ;} ?>">
										<img class="d-block height-40" src="<?php echo $get_img; ?>" >
									</div>
						<?php 
									$img_counter++;
								}
							} //while
							wp_reset_postdata();
						
						?>
						
					</div>
					<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>

				<!-- caroisel -->
			</div>
		</div>
	</div>
</footer>
<div class="final-footer">
	<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 left-final-footer">
			<h3>A Palefire Private Limited Brand</h3>
			
		</div>
		<div class="col-md-4 middle-final-footer">
			<h3>&copy; Walledstory 2020. All Rights Reserved. </h3>
		</div>
		<div class="col-md-4 right-final-footer">
			<h3>Email: contact@walledstory.com</h3>
			<h3>Conatct No : +91 1234567891</h3>
		</div>
	</div>
	</div>
</div>



<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-jorkore-margin" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Create New Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
		<div class="form-group">
			<label for="post-title">Title of Post</label>
			<input type="text" class="form-control" id="post-title" placeholder="Enter The Title" required>
		</div>
		<div class="form-group">
			<label for="post-category">Select Category</label>
			<select class="form-control" id="post-category">
				<?php 
				$eng_cats = get_terms([
				    'taxonomy' => 'blog_category',
				    'hide_empty' => false,
				]);
				foreach( $eng_cats as $eng_cat ){
				?>
				<option value="<?php echo $eng_cat->term_id; ?>"><?php echo $eng_cat->name; ?></option>
				
				<?php } ?>
			</select>
		</div>
			<div class="form-group">
			<label for="post-category">Select Template</label>
			<select class="form-control" id="post-template">
				<option value="0"> Default</option>
				<option value="1"> Poem</option>
				<option value="2"> Sports</option>
			</select>
		</div>
		 <div class="form-group">
			<label for="post-content">Post Content</label>
			<textarea class="form-control" id="post-content" rows="3" required=""></textarea>
		</div>
		<div class="form-group">
			<label for="post-content">Select Featured Image</label>
			<input type="hidden"  class="img_url_1" id="post-img-id" value="134">
			<span class="btn btn-secondary select-image-1" id="select-image-1">Select Image</span>
			<img class="pro_img_1"  height="50" width="50">
		</div>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-post">Create Post</button>
      </div>
    </div>
  </div>
</div>
<?php wp_footer(); ?>
	</body>
</html>