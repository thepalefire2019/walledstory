<?php
get_header();
	
	?>
	<div class="container">
		<div class="row">
			<!-- left body -->
			<div class="col-md-8">

				<div class="row">
					<div class="col-md-12" id="english">
						<?php 
							$englishblogs = new WP_Query( array(
									'post_type' => 'ws_english',
									'posts_per_page' => -1		
							) );

							while( $englishblogs->have_posts() ){
								$englishblogs->the_post();

							
						?>
						<div  class="row">
							<div class="col-md-6">
								<input type="text" name="" value="<?php echo esc_attr( get_the_title() ); ?>">
							</div>	
							<div class="col-md-6">
								<textarea><?php echo esc_attr(wp_strip_all_tags( get_the_content() ) ); ?></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6"> <span class="edit"> Edit</span> </div>
							<div class="col-md-6"> <span class="delete"> Delete</span> </div>
						</div>
						<?php 
							} //end of the while
						?>
					</div>
				</div>

			</div>
			<!-- left body -->

			<!-- Right body -->
			<div class="col-md-4"></div>
			<!-- Right body -->
		</div>
	</div>



	<?php



get_footer();
?>