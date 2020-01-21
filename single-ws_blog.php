<?php
get_header();
?>
	


    <div class="container-fluid bl-main-content">
        <div class="row bl-main-content-row">
<?php
	while(have_posts()):
		the_post();
        $post_id = get_the_ID();
        $post_user_id = get_the_author_meta('ID');
        $current_user_id = get_current_user_id();
        $like = get_like_num( $post_id );
        $category = get_the_terms($post_id, 'blog_category');
        $get_img = get_the_post_thumbnail_url( get_the_ID());

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
                                                 

                                                if( is_user_logged_in() ){
                                               ?>
                                                <span class="like-box" <?php echo $data_exist; ?> data-blog="<?php echo get_the_ID(); ?>" data-like="<?php if( isset( $checklike->posts[0]->ID ) ){echo $checklike->posts[0]->ID;} ?>">
                                                <?php 
                                                }else{
                                                ?>
                                                <span class="logout-like-box" >
                                                <?php }?>
                                            		<i class="fas fa-heart" <?php echo $like_style;?> >
                                            			
                                            		</i>
                                            		&nbsp;&nbsp;
                                            		<label class="present-like-count"><?php echo $likeCount->found_posts; ?></label> likes
                                                
                                                    &nbsp;&nbsp;&nbsp;
                                                </span>
                                            </div>
                                        </div>

                                        <?php 
                                        if( is_user_logged_in() ){
                                            if( $author_id == get_current_user_id() ){ 
                                        ?>
                                        <div class="row">
                                             <div class="col-md-6 blog-edit">
                                                <p data-toggle="modal" data-target="#exampleModalLongedit">Edit</p>
                                            </div>
                                            <div class="col-md-6 blog-delete">
                                                <p id="delete-blog" data-id="<?php the_ID(); ?>">Delete</p>
                                            </div>
                                        </div>
                                        <?php 
                                            } //check if user_id and author of the post is same
                                        }// check if logged in for edit delete
                                         ?>



                                    </div>
                                    <div class="bl-post-content-header-title">
                                        <h2><a href="#"><?php echo get_the_title(); ?></a></h2>
                                    </div>
                                </header>
                                <div class="bl-content">
                                   <div class="bl-entry-content">
                                        <?php the_content(); ?>                     
                                   </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div><!-- bl-post-sec -->

                    <!-- Edit Modal -->
                <div class="modal fade" id="exampleModalLongedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Blog</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                             </div>
                        <div class="modal-body">
                            <input type="hidden" id="blog_id" value="<?php the_ID() ?>">
                            <div class="form-group">
                                <label for="post-title">Title of Post</label>
                                <input type="text" class="form-control" id="post-title-edit" placeholder="Enter The Title" value="<?php echo get_the_title(); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="post-category">Select Category</label>
                                <select class="form-control" id="post-category-edit">
                                    <?php 
                                    $eng_cats = get_terms([
                                        'taxonomy' => 'blog_category',
                                        'hide_empty' => false,
                                    ]);
                
                                    foreach( $eng_cats as $eng_cat ){
                                    ?>
                                    <option value="<?php echo $eng_cat->term_id; ?>" <?php if( $category[0]->term_id == $eng_cat->term_id ){ echo 'selected'; } ?>><?php echo $eng_cat->name; ?></option>
                                    
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="post-content">Post Content</label>
                                <textarea class="form-control" id="post-content-edit" rows="3" required=""><?php echo wp_strip_all_tags( get_the_content() ); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="post-content">Select Featured Image</label>
                                <input  type="hidden" class="img_url_1" id="post-img-id-edit" value="<?php echo get_post_thumbnail_id(); ?>">
                                <span class="btn btn-secondary select-image-1" id="select-image-1">Select Image</span>
                                <img class="pro_img_1"  height="50" width="50" src="<?php echo $get_img ?>">
                            </div>
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="edit-post">Edit Blog</button>
                        </div>
                    </div>
                  </div>
                </div>


             <!-- Edit Modal -->

         
		

		<?php

	endwhile;//end of main while loop

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
                </div><!-- bl-side-sec -->
            </div><!-- bl-main-content-row -->
        </div><!-- bl-main-content -->


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
                        <?php if( has_post_thumbnail() ){?> 
                        <img class="bl-header-images img-responsive" src="<?php echo $get_img; ?>">
                    <?php }else{?>
                         <img class="bl-header-images img-responsive" src="<?php echo get_stylesheet_directory_uri().'/img/black.jpg' ?>" >
                    <?php } ?>
                        <div class="bl-header-images-date">
                            <h3><?php echo get_the_time('F d, Y'); ?> in <?php echo $rel_auth_category[0]->name; ?></h3>
                            <div class="bl-header-images-content">
                                <a href="<?php the_permalink(); ?>"><p><?php echo wp_trim_words( get_the_title(), 9 ); ?></p></a>
                            </div>
                        </div>
                    </div>
                    <?php 
                    $rel_author_post++;
                    }// end of while
                    wp_reset_postdata();
                    ?>

                </div>
            </div>
        </div>
	</header>
	<div class="space30"></div>









<?php
get_footer();






