<?php
get_header();
?>	
<div class="my-post-page">
	<div class="container my-post-page-container">
		<div class="space40"></div>
		<div class="row">
			<?php
			$englishblogs = new WP_Query( array(
									'post_type' => 'ws_english',
									'posts_per_page' => -1		
							) );
			$temp_loop = 5;
			$temp_start_loop = 1;
			$loop_count = 0;
			while( $englishblogs->have_posts() ){
				$englishblogs->the_post();
				if( $loop_count == 1 ){
					?>
						<div class="col-md-4">
							<div class="sa-content">
								<h2>Sarasij</h2>
								<h5>Your Personal Wall</h5>
								<p data-toggle="modal" data-target="#exampleModalLong">
									New Post
								</p>
							</div>
						</div>
					<?php
					
				}
			?>
			<div class="col-md-4">
				<div class="sk-content">
					<div class="sk-topic">
						<img src=" <?php echo get_stylesheet_directory_uri().'/img/'.$temp_start_loop.'.jpg' ?>">
					</div>
					<div class="sk-item">
						<h4>My take on minimus and fashion</h4>
					</div>
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
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
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
				    'taxonomy' => 'english_category',
				    'hide_empty' => false,
				]);
				foreach( $eng_cats as $eng_cat ){
				?>
				<option value="<?php echo $eng_cat->term_id; ?>"><?php echo $eng_cat->name; ?></option>
				
				<?php } ?>
			</select>
		</div>
		 <div class="form-group">
			<label for="post-content">Post Content</label>
			<textarea class="form-control" id="post-content" rows="3" required=""></textarea>
		</div>
		<div class="form-group">
			<label for="post-content">Select Featured Image</label>
			<input type="hidden"  class="img_url_1" id="post-img-id">
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