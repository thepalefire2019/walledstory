
</div><!-- Director -->
</div>
<footer>
	<div class="container">
		<div class="row foot">
			<div class="space30"></div>
			<div class="col-md-3 bl-footer-logo">
				<h2><a href="<?php echo site_url(); ?>">Walledstory</a></h2>
			
				<div class="space40"></div>
				<div class="ft-content">
					<p>Mauris fermentum porta sem, non hendrerit enim bibendum consectetur. Fusce diam est, porttitor vehicula gravida at, accumsan bibendum tincidunt imperdiet. Maecenas quis magna faucibus, varius ante sit amet, varius augue. Praesent aliquam, augue ac pulvinar accumsan.</p>
				</div>
				<div class="space40"></div>
			</div>
			<div class="col-md-3"></div>
			<div class="col-md-3"></div>
			<div class="col-md-3"></div>
		</div>
	</div>
</footer>
<div class="final-footer">
	
</div>



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
<?php wp_footer(); ?>
	</body>
</html>