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
        $category = get_the_terms($post_id, 'blog_category');

        //author
        $author_id = get_the_author_meta('ID');
        $author_img =  get_avatar(get_the_author_meta('ID')); 
        $avatar_url = get_the_author_meta( 'profile_picture',  get_the_author_meta('ID') ) ;
        $author_first_name = get_the_author_meta( 'first_name', get_the_author_meta('ID') );
        $author_last_name = get_the_author_meta( 'last_name', get_the_author_meta('ID') );
        $author_desc = get_the_author_meta( 'description', get_the_author_meta('ID') );
        $author_permalink = get_author_posts_url(get_the_author_meta('ID'));

        setPostViews(get_the_ID()); 
        //getPostViews(get_the_ID());
        //echo getLikes(get_the_ID());
        //echo getLevel(get_the_ID());

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
                                                <a href="#"><?php echo $category[0]->name; ?></a>
                                            </div>
                                            <div class="col-lg-4 col-xs-12 text-right">
                                               <?php 
                                                $likeCount = new WP_Query( array(
                                                    'post_type'     => 'like',
                                                    'meta_query'    => array(
                                                        array(
                                                            'key'       => 'liked_blog_id',
                                                            'compare'   => '=',
                                                            'value'     => $post_id
                                                        ))
                                                ) );

                                                $like_style = '';
                                                $data_exist = 'data-exist="no"';
                                                // set no of likes in metakey
                                                setLike( $post_id, $likeCount->found_posts );

                                                // set levels in metakey
                                                setLevel( $post_id, $likeCount->found_posts, getPostViews(get_the_ID()) );

                                                if( is_user_logged_in() ){
                                                    $checklike = new WP_Query( array(
                                                    'author'        => get_current_user_id(),
                                                    'post_type'     => 'like',
                                                    'meta_query'    => array(
                                                        array(
                                                            'key'       => 'liked_blog_id',
                                                            'compare'   => '=',
                                                            'value'     => $post_id
                                                        ))
                                                    ) );

                                                     if( $checklike->found_posts ){
                                                        $like_style = 'style="color:red"';
                                                        $data_exist = 'data-exist="yes"';
                                                     }
                                                }
                                                 

                                                
                                               ?>
                                                <span class="like-box" <?php echo $data_exist; ?> data-blog="<?php echo get_the_ID(); ?>" data-like="<?php if( isset( $checklike->posts[0]->ID ) ){echo $checklike->posts[0]->ID;} ?>">
                                            		<i class="fas fa-heart" <?php echo $like_style;?> >
                                            			
                                            		</i>
                                            		&nbsp;&nbsp;
                                            		<label class="present-like-count"><?php echo $likeCount->found_posts; ?></label> likes
                                                
                                                    &nbsp;&nbsp;&nbsp;
                                                </span>
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
                </div>



         
		

		<?php

	}//end of while

	?>

	   <!---------------- Side Column -------------->
            <!-- Author Description -->
                <div class="col-sm-4 col-sm-4 bl-side-sec">
                    <div class="col-lg-12 bl-side-content">
                        <aside class="bl-widget">
                            <h3>About The Author</h3>
                            <div class="bl-photo-holder">
                                 <img src="<?php echo $avatar_url ?>"> 
                                <!-- <?php echo $author_img; ?> -->
                            </div>
                            <p>
                                <?php echo $author_desc; ?>
                            </p>
                        </aside>

                       <!--  <aside class="bl-widget">
                            <h3>Categories</h3>      
                            <ul>
                                <li>
                                    <a href="#">Advertising</a><span>1</span>
                                </li>
                                <li>
                                    <a href="#">Creative</a><span>1</span>
                                </li>
                                <li>
                                    <a href="#">Inspiration</a><span>1</span>
                                </li>
                                <li>
                                    <a href="#">Life</a><span>3</span>
                                </li>
                                <li>
                                    <a href="#">Music</a><span>2</span>
                                </li>
                                <li>
                                    <a href="#">Photography</a><span>1</span>
                                </li>
                                <li>
                                    <a href="#">readolog</a><span>6</span>
                                </li>
                                <li>
                                    <a href="#">Travel</a><span>2</span>
                                </li>
                            </ul>
                        </aside> -->

                        <aside class="bl-widget">
                            <h3>Related Posts</h3>
                            <?php
                            $rel_post_cat = new WP_Query( array(
                                'post_type'         => 'ws_blog',
                                'tax_query'         => array(
                                                          array (
                                                              'taxonomy' => 'blog_category',
                                                              'field' => 'slug',
                                                              'terms' => array($category[0]->name)
                                                          )
                                                  ),
                            ));
                            $rel_post_counter = 0;
                            while( $rel_post_cat->have_posts() ){
                                $rel_post_cat->the_post();
                            ?>
                            <div class="rel-post">
                                <div class="rel-post-img">
                                    <?php the_post_thumbnail('ws-regular'); ?>
                                </div>
                                <div class="rel-post-header"><h5><?php echo get_the_time('F d, Y'); ?></h5></div>
                                <a href="<?php the_permalink() ?>">
                                    <div class="rel-post-content">
                                        <h2><?php the_title(); ?></h2>
                                    </div>
                                </a>
                            </div>
                            <?php 
                            $rel_post_counter++;
                            }// end of while
                            wp_reset_postdata();
                            ?>




                        </aside>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related posts -->
        <header>
		<div class="bl-header-image-sec">
            <div class="container-fluid">
                <aside class="bl-widget">
                    <h3><a href="<?php echo $author_permalink ?>">More Posts By The Author</a></h3>
                </aside>
                <div class="row">

                    <?php 
                    $rel_author_post = 0;
                    $rel_post_auth = new WP_Query( array(
                                'post_type'         => 'ws_blog',
                                'author'            => $author_id,
                                'posts_per_page'    =>4
                            ));
                    while( $rel_post_auth->have_posts() ){
                       
                        $rel_post_auth->the_post();

                        $rel_auth_post_id = get_the_ID();
                        $rel_auth_category = get_the_terms($post_id, 'blog_category');
                        $get_img = get_the_post_thumbnail_url($rel_auth_post_id,'ws-regular');
                        ?>
                    <div class="col-lg-3 bl-header-image-div">
                        <img class="bl-header-images img-responsive" src="<?php echo $get_img; ?>">
                        <div class="bl-header-images-date">
                            <h3><?php echo get_the_time('F d, Y'); ?> in <?php echo $rel_auth_category[0]->name; ?></h3>
                            <div class="bl-header-images-content">
                                <a href="<?php the_permalink(); ?>"><p><?php the_title(); ?></p></a>
                            </div>
                        </div>
                    </div>
                    <?php 
                    $rel_author_post++;
                    }// end of while
                    ?>

                </div>
            </div>
        </div>
	</header>
	<div class="space30"></div>
	<?php


get_footer();