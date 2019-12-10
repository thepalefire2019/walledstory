<?php
get_header();
?>
	


    <div class="container-fluid bl-main-content">
        <div class="row bl-main-content-row">
<?php
	while(have_posts()){
		the_post();
        $post_id = get_the_ID();
        $post_user_id = get_the_author_meta('ID');
        $current_user_id = get_current_user_id();
        $like = get_like_num( $post_id );
		?>


            <!---------------- Post -------------->

                <div class="col-md-8 col-sm-8 bl-post-sec">
                    <div class="col-lg-12 bl-post-body">
                        <article>
                            <div class="bl-post-image">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/post.jpg">
                            </div>
                            <div class="bl-post-content">
                                <header class="bl-post-content-header">
                                    <div class="bl-post-content-header-content">
                                        <div class="row">
                                            <div class="col-lg-8 col-xs-12 text-left">
                                                <span>posted on</span>
                                                <a href="#">august 2, 2019</a>
                                                <span>posted in</span>
                                                <a href="#">PF</a>
                                            </div>
                                            <div class="col-lg-4 col-xs-12 text-right">
                                                <span data-userid = "<?php echo $current_user_id ?>" data-ajaxurl="<?php echo admin_url('admin-ajax.php') ?>" data-like="<?php echo $like; ?>" data-postid="<?php echo get_the_ID(); ?>" id="like-btn">
                                                	<a href="#" style="">
                                                		<i class="fas fa-heart" <?php if( check_user_like( $current_user_id, $post_id ) ){ echo 'style="color:red;"'; } ?>>
                                                			
                                                		</i>
                                                		&nbsp;&nbsp;
                                                		<?php echo $like; ?> likes</a>
                                                </span>
                                                &nbsp;&nbsp;&nbsp;
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bl-post-content-header-title">
                                        <h2><a href="#">If you wanted to get rich, how would you do it ?</a></h2>
                                    </div>
                                </header>
                                <div class="bl-content">
                                   <div class="bl-entry-content">
                                        <?php echo get_the_content(); ?>
                                      
                                        <?php 
                                            if( is_user_logged_in() ){
                                                $user_id = get_current_user_id();
                                                $like = get_like_num( $post_id );
                                        ?>
                                        <div class="like-btn-div">
                                            <button data-userid = "<?php echo $user_id ?>"  data-ajaxurl="<?php echo admin_url('admin-ajax.php') ?>" data-like="<?php echo $like; ?>" data-postid="<?php echo get_the_ID(); ?>" id="like-btn" <?php if( check_user_like( $user_id, $post_id ) ){ echo 'disabled'; } ?>>Like</button>
                                            <span id="like"><?php echo $like ?></span>
                                        </div>
                                        <?php
                                            } // user login check

                                        ?>
                                   </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>



         
		

		<?php

	}//end of while

	?>

	   <!---------------- Side Column -------------->

                <div class="col-sm-4 col-sm-4 bl-side-sec">
                    <div class="col-lg-12 bl-side-content">
                        <aside class="bl-widget">
                            <h3>About Me</h3>
                            <div class="bl-photo-holder">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/about.jpg">
                            </div>
                            <p>
                                My name is John Snow. I’m a blogger based in Melbourne. I spend a lot of time to talk to strangers and try to understand global culture...
                            </p>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <header>
		<div class="bl-header-image-sec">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 bl-header-image-div">
                        <img class="bl-header-images img-responsive" src="<?php echo get_template_directory_uri() ?>/img/1.jpg">
                        <div class="bl-header-images-date">
                            <h3>August 2, 2019 in PF</h3>
                            <div class="bl-header-images-content">
                                <p>If you wanted to get rich, how would do it?</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 bl-header-image-div">
                        <img class="bl-header-images img-responsive" src="<?php echo get_template_directory_uri() ?>/img/2.jpg">
                        <div class="bl-header-images-date">
                            <h3>August 2, 2019 in PF</h3>
                            <div class="bl-header-images-content">
                                <p>If you wanted to get rich, how would do it?</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 bl-header-image-div">
                        <img class="bl-header-images img-responsive" src="<?php echo get_template_directory_uri() ?>/img/3.jpg">
                        <div class="bl-header-images-date">
                            <h3>August 2, 2019 in PF</h3>
                            <div class="bl-header-images-content">
                                <p>If you wanted to get rich, how would do it?</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 bl-header-image-div">
                        <img class="bl-header-images img-responsive" src="<?php echo get_template_directory_uri() ?>/img/4.jpg">
                        <div class="bl-header-images-date">
                            <h3>August 2, 2019 in PF</h3>
                            <div class="bl-header-images-content">
                                <p>If you wanted to get rich, how would do it?</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</header>
	<div class="space30"></div>
	<?php


get_footer();