<?php
get_header();
while( have_posts() ){
	the_post();
	?>
	<div class="container privacy">
		<?php echo get_the_content(); ?>
	</div>
	<div class="space60"></div>
	<?php
}
get_footer();
 ?>