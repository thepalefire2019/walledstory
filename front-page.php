<?php
get_header();
	
	?>
	<div class="front-page-parent">
		<article class="front-page-banner">
			<div class="banner-parent" style="background:url(' <?php echo get_stylesheet_directory_uri()?>/img/banner.jpg')">
				<div class="banner-parent-shadow"></div>
				<div class="banner-post">
					<div id="carouselExampleIndicators" class="carousel slide carousel-ws-banner" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner carousel-inner-banner">
							<?php
							$i = 0;
							$loop_count_banner = 0;
							while( $i<3 ){
							 ?>
							
							<div class="carousel-item carousel-item-banner <?php if( $loop_count_banner == 1 ){ echo 'active';} ?>">
								<div class="banner-content">
							 		<h1>Final Test This is a Custom Text for Title</h1>
							 		<h3>by</h3>
							 		<h2>Sarasij Roy</h2>
							 		<p>This is some dummy text for the tseting of the site and the designning. The more the content the more the design will be understood so i am making up this shit just to increase the size of the content.This is some dummy text for the tseting of the site and the designning.</p>
							 		<h5><a href="#">Read More</a></h5>
							 	</div>
							</div>
					
							<?php
							$i++;
							$loop_count_banner++; 
							}//end of while 
							?>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
				<div class="banner-level">
					<div class="container">
						<div class="row">
							<div class="col-md-3 col-3">
								<a href="#">
									<div class="banner-level-img">
										<img src="<?php echo get_stylesheet_directory_uri()?>/img/black.png">
									</div>
								</a>
							</div>
							<div class="col-md-3 col-3">
								<a href="">
									<div class="banner-level-img">
										<img src="<?php echo get_stylesheet_directory_uri()?>/img/gold.png">
									</div>
								</a>
							</div>
							<div class="col-md-3 col-3">
								<a href="#">
									<div class="banner-level-img">
										<img src="<?php echo get_stylesheet_directory_uri()?>/img/silver.png">
									</div>
								</a>
							</div>
							<div class="col-md-3 col-3">
								<a href="#">
									<div class="banner-level-img">
										<img src="<?php echo get_stylesheet_directory_uri()?>/img/bronze.png">
									</div>
								</a>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</article><!-- banner -->


		<div class="space40"></div>
		<article class="front-page-gold">
			<div class="front-page-gold-background"></div>
			<div class="tag-line">
				<span class="gold-line"></span>
				<span class="gold">Gold</span>
				<a href="#"><span class="read-all">Read All</span></a>
			</div>
			<div class="space30"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-6  gold-content">
						<h1><a href="#">Final Test This is a Custom Text for Title</a></h1>
						<h2>This is some dummy text for the tseting of the site and the designning</h2>
						<p> <span>Dec 13 -</span> Sarasij Roy</p>
					</div>
					<div class="col-md-6">
						<div class="first-post-img-gold">
							<img src="<?php echo get_stylesheet_directory_uri() ?>/img/1.jpg">
							<p class="first-post-cat-gold">Category</p>
						</div>
					</div>
				</div>
				<div class="space30"></div>
				<div class="row">
					<div class="col-md-6  gold-content">
						<h1><a href="#">Final Test This is a Custom Text for Title</a></h1>
						<h2>This is some dummy text for the tseting of the site and the designning</h2>
						<p> <span>Dec 13 -</span> Sarasij Roy</p>
					</div>
					<div class="col-md-6">
						<div class="first-post-img-gold">
							<img src="<?php echo get_stylesheet_directory_uri() ?>/img/1.jpg">
							<p class="first-post-cat-gold">Category</p>
						</div>
					</div>
				</div>

			</div>

		</article> <!--Gold -->
		<div class="space30"></div>
		<article class="most-viewed-parent" style="background:url('<?php echo get_stylesheet_directory_uri() ?>/img/banner.jpg');">
			<div class="shape">
				<img src="<?php echo get_stylesheet_directory_uri() ?>/img/shape.png">
			</div>
			<div class="head">
				<h1>Top Viewed Post</h1>
				<p>Have a look at the top viewed posts.</p>
			</div>
			<div class="post-box">
				<div class="container">
					<div class="row">
						<?php 
						$most_viewed_counter = 0;
						$temp = 0;
						while( $temp <= 2 ){
							if( $most_viewed_counter == 0 ){
						?>
						<div class="col-md-4">
							<div class="single-box-black">
								<h1>This is the heading of the post which can be a large one.</h1>
								<p>This is some dummy text for the tseting of the site and the designning. The more the content the more the design will be understood so i am making up this shit just to increase.</p>
								<a href="#"><h2>Read</h2></a>
							</div>
						</div>
						<?php 
							$most_viewed_counter++;
							$temp++;
							continue;
							}//end of if?>
						<div class="col-md-4">
							<div class="single-box-white">
								<h1>This is the heading of the post which can be a large one.</h1>
								<p>This is some dummy text for the tseting of the site and the designning. The more the content the more the design will be understood so i am making up this shit just to increase.</p>
								<a href="#"><h2>Read</h2></a>
							</div>
						</div>
						<?php 
						$most_viewed_counter++;
						$temp++;
						}// end of while
						?>
						
					</div>
				</div>
			</div>
		</article> <!--Most Viewed -->
		
		<div class="space30"></div>

		<article class="front-page-silver">
			<div class="front-page-silver-background"></div>
			<div class="tag-line">
				<span class="silver-line"></span>
				<span class="silver">silver</span>
				<a href="#"><span class="read-all">Read All</span></a>
			</div>
			<div class="space30"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-6 silver-content">
						<h1><a href="#">Final Test This is a Custom Text for Title</a></h1>
						<h2>This is some dummy text for the tseting of the site and the designning</h2>
						<p> <span>Dec-13</span> Sarasij Roy</p>
					</div>
					<div class="col-md-6">
						<div class="first-post-img-silver">
							<img src="<?php echo get_stylesheet_directory_uri() ?>/img/2.jpg">
							<p class="first-post-cat-silver">Category</p>
						</div>
					</div>
				</div>
			</div>

		</article> <!--silver -->
		<div class="space30"></div>


		<article class="all-categories">
			<div class="container">
				<h1>More Posts on</h1>
				<p class="underline-p"></p>
				<div class="row">
					<?php
					$categories = get_terms([
					    'taxonomy' => 'english_category',
					    'hide_empty' => false,
					]);
					$category_counter = 1;
					foreach( $categories as $category ){
						if( $category_counter == 13 ){
							break;
						}
					$cat_color_id = "eng_category_" . $category->term_id;
					$eng_cat_color = get_option($cat_color_id);
					if($eng_cat_color){
						$eng_cat_bgcolor = $eng_cat_color['color'];
					}else{
						$eng_cat_bgcolor = '#00D99F';
					}
					?>
					<div class="col-md-2 col-6">
						<a href="#">
							<div class="cat-box" style="background:<?php echo$eng_cat_bgcolor; ?>">
								<p><?php echo $category->name; ?></p>
							</div>
						</a>
					</div>
					<?php 
					$category_counter++;
					} 

					?>

				</div>	
			</div>
				
		</article>
		<div class="space30"></div>


		<article class="front-page-bronze">
			<div class="front-page-bronze-background"></div>
			<div class="tag-line">
				<span class="bronze-line"></span>
				<span class="bronze">bronze</span>
				<a href=""><span class="read-all">Read All</span></a>
			</div>
			<div class="space30"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-6 bronze-content">
						<h1><a href="#">Final Test This is a Custom Text for Title</a></h1>
						<h2>This is some dummy text for the tseting of the site and the designning</h2>
						<p> <span>Dec-13</span> Sarasij Roy</p>
					</div>
					<div class="col-md-6">
						<div class="first-post-img-bronze">
							<img src="<?php echo get_stylesheet_directory_uri() ?>/img/3.jpg">
							<p class="first-post-cat-bronze">Category</p>
						</div>
					</div>
				</div>
			</div>

		</article> <!--bronze -->
		<div class="space30"></div>	
	</div>	

<?php
get_footer();
?>

