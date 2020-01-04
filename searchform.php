<form role="search" method="get" id="searchform" action= "<?php echo home_url('/'); ?>">
	<div>
		<div> 
			<input type="text" value="<?php the_search_query(); ?>" autocomplete="off" name="s" id="s" placeholder="Search">
			<label><input type="submit" class="search-submit" value="Search" /><img src="<?php echo get_stylesheet_directory_uri() ?>/img/svg/search.svg"></label>
		</div>
	</div>
</form>