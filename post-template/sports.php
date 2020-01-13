<?php
  /*
  Template Name: Sports
  Template Post Type: post, ws_blog
  */

get_header();
?>
	

    <div class="container-fluid bl-main-content">
        <div class="row bl-main-content-row">
<?php
	while(have_posts()):
		the_post();
        $post_id = get_the_ID();
        $category = get_the_terms($post_id, 'blog_category');
        //print_r($category);
        $author_id = get_the_author_meta('ID');
		?>


            <!---------------- Post -------------->

                 <div class="col-md-8 col-sm-8 bl-post-sec">
                    <div class="col-lg-12 bl-post-body">
                        <article>
                            <div class="bl-post-image">
                                <?php 
                                    if( has_post_thumbnail() ){
                                        the_post_thumbnail('ws-large');
                                    }
                                ?>
                                
                            </div>
                            <div class="bl-post-content">
                                <header class="bl-post-content-header">
                                    <div class="bl-post-content-header-content">
                                        <div class="row">
                                            <div class="col-lg-8 col-xs-12 text-left">
                                                <span>posted on</span>
                                                <a href="#"><?php echo get_the_time('d-M, Y'); ?></a>
                                                <span>posted in</span>
                                                <a href="<?php echo get_category_link($category[0]->term_id) ?>"><?php echo $category[0]->name; ?></a>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    <div class="bl-post-content-header-title">
                                        <h2><a href="#"><?php echo get_the_title(); ?></a></h2>
                                    </div>
                                </header>
                                <div class="bl-content">
                                   <div class="bl-entry-content">
                                        <?php echo get_the_content(); ?>                     
                                   </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div><!-- bl-post-sec -->

         
		

		<?php

	endwhile;//end of while

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

                        <aside class="bl-widget">
                        	<h3>Scorecard</h3>
                        	<div class="row">
                        		<div class="col-md-6 scorecard">
                        			<h2>Arsenal</h2>
                        			<h3>2</h3>
                        			<p>Pepe(13'), Socrates(45')</p>
                        		</div>
                        		<div class="col-md-6 scorecard">
                        			<h2>Man Utd</h2>
                        			<h3>0</h3>
                        			<p></p>
                        		</div>
                        	</div>	
                        	<div class="row">
                        		<div class="col-md-12 scorecard">
                        			<h1>Man Of the Match : <span>Pepe</span></h1>
                        		</div>
                        	</div>
                        </aside>

                        <aside class="bl-widget">
                        	<h3>Squad</h3>
                        	<div class="squad-parent">
	                        	<div class="row">
	                        		<div class="col-md-6 squad">
	                        			<h3>Arsenal</h3>
	                        			<ul>
	                        				<?php
	                        				$i = 0;
	                        				while( $i<10 ){
	                        				 ?>
			                                <li>
			                                    <a href="#">Leno</a>
			                                </li>
			                                <?php 
			                                $i++;
			                            	}
			                                ?>
			                               
			                            </ul>
	                        		</div>
	                        		<div class="col-md-6 squad">
	                        			<h3>Man Utd</h3>
	                        			<ul style="text-align: right">
	                        				<?php
	                        				$j = 0;
	                        				while( $j<10 ){
	                        				 ?>
			                                <li >
			                                    <a href="#">De Gea</a>
			                                </li>
			                                <?php 
			                                $j++;
			                            	}
			                                ?>
			                               
			                            </ul>
	                        		</div>
	                        	</div>
                        	</div>
                        </aside>
                    </div>
                </div><!-- bl-side-sec -->
            </div><!-- bl-main-content-row -->

        </div><!-- bl-main-content -->



        <header>
            <div class="bl-header-image-sec">
                <div class="container-fluid">
                    <div class="row">
                        <?php 
                            $rel_post_auth = new WP_Query( array(
                                'author'            => $author_id,
                                'posts_per_page'    =>4
                            ));
                            while( $rel_post_auth->have_posts() ):
                                $rel_post_auth->the_post();
                                $rel_auth_post_id = get_the_ID();
                                $rel_auth_category = get_the_category( $rel_auth_post_id );
                                $get_img = get_the_post_thumbnail_url($rel_auth_post_id,'ws-regular');
                         ?>
                        <div class="col-lg-3 bl-header-image-div">
                            <img class="bl-header-images img-responsive" src="<?php echo $get_img; ?>">
                            <div class="bl-header-images-date">
                                <h3><?php echo get_the_time('F d, Y'); ?> in <?php echo $rel_auth_category[0]->name; ?></h3>
                                <div class="bl-header-images-content">
                                    <a href="<?php the_permalink(); ?>"><p><?php echo wp_trim_words( get_the_title(), 9 ); ?></p></a>
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

	<?php


get_footer();