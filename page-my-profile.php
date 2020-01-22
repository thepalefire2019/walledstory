<?php

if( !is_user_logged_in() ){
    wp_redirect(site_url());
}

get_header();


/* Get user info. */
global $current_user, $wp_roles;
//get_currentuserinfo(); //deprecated since 3.1

/* Load the registration file. */
//require_once( ABSPATH . WPINC . '/registration.php' ); //deprecated since 3.1
$error = array();    
/* If profile was saved, update profile. */

while( have_posts() ){
	the_post();
	the_content();
	$avatar_url = get_the_author_meta( 'profile_picture', $current_user->ID ) ;
    $mobile_back_img = get_stylesheet_directory_uri().'/img/1.jpg';
    $author_id = $current_user->ID
?>



<div class="author-full-page">
    <div class="space40"></div>
    <div class="container" style="margin-right: unset">
        <div class="author-bio">
            <div class="row">
                <div class="col-md-6">
                    <div class="space60"></div>
                    <div class="author-desc">
                        <div class="mobile-author-img">
                            <?php if( $avatar_url ){ ?>
                            <img src="<?php echo $avatar_url ?>">
                            <?php
                                }else{
                            ?>
                            <img src="<?php echo get_template_directory_uri() ?>/img/no_avatar.png">
                            <?php 
                            }
                            ?>
                        </div>
                        <div class="author-title">
                            <h3><?php  echo the_author_meta( 'first_name', $author_id ) ?><br>
                                <?php  echo the_author_meta( 'last_name', $author_id );  ?>
                            </h3>
                        </div>
                        <div class="author-biography">
                            <p><?php echo get_the_author_meta( 'description', $author_id ); ?></p>
                        </div>
                        <?php 
                        $followCount = new WP_Query( array(
                                    'post_type'     => 'follow',
                                    'meta_query'    => array(
                                        array(
                                            'key'       => 'followed_blog_id',
                                            'compare'   => '=',
                                            'value'     => $author_id
                                        ))
                                ) );


                        $following = new WP_Query( array(
                            'author'        => $author_id,
                            'post_type'     => 'follow'
                            ) );
                            ?>
                        <div class="author-follow">
                            <p  data-toggle="modal" data-target="#exampleModalLong">Edit Profile</p>
                        </div>



                        <div class="space30"></div>
                        <div class="author-followers">
                            <div class="followers">
                                
                                <h5>Follwers</h5>
                                <p class="js-followers"><?php echo $followCount->found_posts; ?></p>
                            </div>
                            <div class="followering">
                                <h5>Following</h5>
                                <p><?php echo $following->found_posts; ?></p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="author-img">
                        <?php if( $avatar_url ){ ?>
                        <img src="<?php echo $avatar_url ?>">
                        <?php
                            }else{
                        ?>
                        <img src="<?php echo get_template_directory_uri() ?>/img/no_avatar.png">
                        <?php 
                        }
                        ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            
            
        </div><!-- Author bio -->

        <div class="author-blogs">
            <h1>Blogs By <span><?php  echo the_author_meta( 'first_name', $author_id ) ?></span></h1>
            <p class="underline"></p>
            <div class="clearfix"></div>
            <header>
                <div class="bl-header-image-sec">
                    <div class="container-fluid">
                        <div class="row">
                            <?php 
                            $blog = new WP_Query( array(
                            'post_type'         => 'ws_blog',
                            'posts_per_page'    => 12   
                            ));
                            while( $blog->have_posts() ):
                                $blog->the_post();
                                $blog_id = get_the_ID();
                                $category = get_the_terms($blog_id, 'blog_category');
                                $blog_level = getLevel(get_the_ID());
                                $get_img = get_the_post_thumbnail_url( get_the_ID(), 'ws-regular' );
                             ?>
                            
                            <div class="col-lg-3 bl-header-image-div">
                                <img class="bl-header-images img-responsive" src="<?php the_post_thumbnail_url( get_the_ID(), 'ws-regular' ); ?>">
                                <div class="bl-header-images-date">
                                    <h3><?php echo get_the_time('F d, Y'); ?> in <?php echo $category[0]->name; ?></h3>
                                    <div class="bl-header-images-content">
                                        <a href="<?php the_permalink(); ?>"><p class="sarasij-p"><?php echo get_the_title(); ?></p></a>
                                    </div>
                                </div>
                            </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                             ?>
                        </div>
                    </div>
                </div>
            </header>
        </div><!-- Author blogs -->
    </div>
</div>



<!---- Modal Jhol jhal   --->


<!-- 
 <button type="button" class="" data-toggle="modal" data-target="#exampleModalLong">
            Edit Profile
</button> -->
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <!-- modal loop for edit -->
       <div id="post-<?php the_ID(); ?>">
        <div class="entry-content entry">
            <?php the_content(); ?>
            <?php if ( !is_user_logged_in() ) : ?>
                    <p class="warning">
                        <?php _e('You must be logged in to edit your profile.', 'profile'); ?>
                    </p><!-- .warning -->
            <?php else : ?>
                <?php if ( count($error) > 0 ) echo '<p class="error">' . implode("<br />", $error) . '</p>'; ?>
                <form method="post" id="adduser" action="<?php  the_permalink(); ?>">
                    <p class="form-username">
                        <label for="first-name"><?php _e('First Name', 'profile'); ?></label>
                        <input class="text-input" name="first-name" type="text" id="first-name" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>" />
                    </p><!-- .form-username -->
                    <p class="form-username">
                        <label for="last-name"><?php _e('Last Name', 'profile'); ?></label>
                        <input class="text-input" name="last-name" type="text" id="last-name" value="<?php the_author_meta( 'last_name', $current_user->ID ); ?>" />
                    </p><!-- .form-username -->
                    <p class="form-email">
                        <label for="email"><?php _e('E-mail *', 'profile'); ?></label>
                        <input class="text-input" name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $current_user->ID ); ?>" />
                    </p><!-- .form-email -->
                    <p class="form-url">
                        <label for="url"><?php _e('Website', 'profile'); ?></label>
                        <input class="text-input" name="url" type="text" id="url" value="<?php the_author_meta( 'user_url', $current_user->ID ); ?>" />
                    </p><!-- .form-url -->
                    
                    <p class="form-textarea">
                        <label for="description"><?php _e('Biographical Information', 'profile') ?></label>
                        <textarea name="description" id="description" rows="3" cols="50"><?php the_author_meta( 'description', $current_user->ID ); ?></textarea>
                    </p><!-- .form-textarea -->

                    <?php 
                        //action hook for plugin and extra fields
                        do_action('edit_user_profile',$current_user); 
                    ?>
                    <div class="modal-footer">
                    <p class="form-submit">
                        
                         <input name="updateuser" type="submit" id="updateuser" class="submit button btn btn-primary" value="<?php _e('Update', 'profile'); ?>" /> 
                        <?php wp_nonce_field( 'update-user' ) ?>
                        <input name="action" type="hidden" id="action" value="update-user" />
                    </p><!-- .form-submit -->
                    
        <button type="submit" class="btn btn-secondary" data-dismiss="modal" >Close</button>
        <!-- <input type="button" class="btn btn-primary" name="updateuser" id="updateuser">Save changes</input> -->
      </div>
                </form><!-- #adduser -->
            <?php endif; ?>
        </div><!-- .entry-content -->
    </div><!-- .hentry .post -->
    <!-- loop for modal edit -->
      </div>
      
    </div>
  </div>
</div>



















	

<?php
}
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

    /* Update user password. */
    if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
        if ( $_POST['pass1'] == $_POST['pass2'] )
            wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
        else
            $error[] = __('The passwords you entered do not match.  Your password was not updated.', 'profile');
    }

    /* Update user information. */
    if ( !empty( $_POST['url'] ) )
        wp_update_user( array( 'ID' => $current_user->ID, 'user_url' => esc_url( $_POST['url'] ) ) );
    if ( !empty( $_POST['email'] ) ){
        if (!is_email(esc_attr( $_POST['email'] )))
            $error[] = __('The Email you entered is not valid.  please try again.', 'profile');
        elseif(email_exists(esc_attr( $_POST['email'] )) != $current_user->ID )
            $error[] = __('This email is already used by another user.  try a different one.', 'profile');
        else{
            wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
        }
    }

    if ( !empty( $_POST['first-name'] ) )
        update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
    if ( !empty( $_POST['last-name'] ) )
        update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
    if ( !empty( $_POST['description'] ) )
        update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );

    /* Redirect so the page will show updated info.*/
  /*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
    if ( count($error) == 0 ) {
        //action hook for plugins and extra fields saving
        do_action('edit_user_profile_update', $current_user->ID);
        
	    //wp_redirect( site_url() );
	    //exit;
	    echo '<meta http-equiv="refresh" content="0.1;url='.site_url('my-profile').'" />';
        
    }
}

//wp_redirect(site_url());
get_footer();
 ?>