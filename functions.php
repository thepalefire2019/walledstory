<?php

require get_template_directory(). '/inc/enqueue.php';
require get_template_directory(). '/inc/ajax_function_like_btn.php';
require get_template_directory(). '/inc/custom_function.php';
require get_template_directory(). '/bengali/register.php';
require get_template_directory(). '/english/register.php';



function site_setup(){
	add_theme_support('post-thumbnails');
   	add_image_size('tg-large', 1200, 675 );
   	add_image_size('tg-regular',820,461 );
   	add_theme_support('html5',array('comment-list','comment-form','search-form','gallery'));
}
add_action('after_setup_theme','site_setup');






// *** =================  Views ============== *** //
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count;
}

function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
// Add it to a column in WP-Admin
add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
function posts_column_views($defaults){
    $defaults['post_views'] = __('Views');
    return $defaults;
}
function posts_custom_column_views($column_name, $id){
 if($column_name === 'post_views'){
         echo getPostViews(get_the_ID());
    }
}



//  =======================================color option for category========================

add_action ( 'edit_category_form_fields', 'category_color_fields');
function category_color_fields( $tag ) {    //check for existing featured ID
    $t_id = $tag->term_id;
    $cat_meta = get_option( "category_$t_id");
?>

<tr class="form-field">
<th scope="row" valign="top"><label><?php _e('Color'); ?></label></th>
<td>
<input type="text" name="Cat_meta[color]" id="Cat_meta[color]" size="25" style="width:60%;" value="<?php echo $cat_meta['color'] ? $cat_meta['color'] : ''; ?>"><br />
        <span class="description"><?php _e('Color'); ?></span>
    </td>
</tr>

<?php
}
add_action ( 'edited_category', 'save_category_color_fields');
function save_category_color_fields( $term_id ) {
    if ( isset( $_POST['Cat_meta'] ) ) {
        $t_id = $term_id;
        $cat_meta = get_option( "category_$t_id");
        $cat_keys = array_keys($_POST['Cat_meta']);
            foreach ($cat_keys as $key){
            if (isset($_POST['Cat_meta'][$key])){
                $cat_meta[$key] = $_POST['Cat_meta'][$key];
            }
        }
        //save the option array
        update_option( "category_$t_id", $cat_meta );
    }
} 

//Cat color column

add_filter('manage_edit-category_columns' , 'cat_color_taxonomy_columns');
function cat_color_taxonomy_columns( $columns )
{
  $columns['cat_color'] = __('Color');

  return $columns;
}
add_filter( 'manage_category_custom_column', 'cat_color_taxonomy_columns_content', 10, 3 );
function cat_color_taxonomy_columns_content( $content, $column_name, $term_id )
{
    if ( 'cat_color' == $column_name ) {
      $color_id = "category_" . $term_id;
      $color = get_option($color_id);
      $category_color = $color['color'];
      if($category_color){
        $content = '<span style="color:'.$category_color.'">&#11044;</span>';
      }
    }
  return $content;
}



//  =======================================//color option for category========================



//  =================================//custom profile picture author=====================
add_filter( 'get_avatar', 'slug_get_avatar', 10, 5 );
function slug_get_avatar($avatar, $id_or_email, $size, $default, $alt){
  $avatar_url = get_the_author_meta( 'profile_picture', $id_or_email ) ;
  if($avatar_url){
      $avatar = '<img alt="Author for Palefire" src="'.$avatar_url.'" style="max-width:30px"/>';
  }
  return $avatar;
}



add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
    <h3><?php _e("Extra profile information", "blank"); ?></h3>

    <table class="form-table">
    <tr>
        <th><label for="facebook"><?php _e("Facebook"); ?></label></th>
        <td>
            <input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your facebook url."); ?></span>
        </td>
    </tr>

    <tr>
        <th><label for="twitter"><?php _e("Twitter"); ?></label></th>
        <td>
            <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your twitter url."); ?></span>
        </td>
    </tr>

     <tr>
        <th><label for="youtube"><?php _e("Youtube"); ?></label></th>
        <td>
            <input type="text" name="youtube" id="youtube" value="<?php echo esc_attr( get_the_author_meta( 'youtube', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your youtube channel url."); ?></span>
        </td>
    </tr>

    <tr>
        <th><label for="instagram"><?php _e("Instagram"); ?></label></th>
        <td>
            <input type="text" name="instagram" id="instagram" value="<?php echo esc_attr( get_the_author_meta( 'instagram', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your instagram url."); ?></span>
        </td>
    </tr>

    <tr>
      <th><label ><?php _e("Profile Picture"); ?></label></th>
    <td>
      
    
        <input type = "button" class="button button secondary" value = "Upload Profile Picture" id = "upload-button">
      <input type="button" class="button button-secondary" value="Remove " id="remove-picture">
        <input type = "hidden" id="profile-picture" name = "profile_picture" value="<?php echo esc_attr( get_the_author_meta( 'profile_picture', $user->ID ) ); ?>"  />
      <br>
      <span class="description"><?php _e("Please click update after uploading."); ?></span>
    </td>

    </tr>
  
    </table>
<?php }


add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
    update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
    update_user_meta( $user_id, 'youtube', $_POST['youtube'] );
    update_user_meta( $user_id, 'instagram', $_POST['instagram'] );
    update_user_meta( $user_id, 'profile_picture', $_POST['profile_picture'] );
  
}
//  =================================//custom profile picture author=====================


//  =================================//redirect subscriber after login=====================

add_action( 'admin_init','redirectsubscriber' );

function redirectsubscriber(){
  $currentUser = wp_get_current_user();

  if( count($currentUser->roles) == 1 AND  $currentUser->roles[0] == 'subscriber'){
    wp_redirect(site_url('/'));
    exit;
  }
}
//  =================================//redirect subscriber after login=====================

//  =================================//redirect subscriber after login=====================

add_action( 'wp_loaded','nosubsadminbar' );

function nosubsadminbar(){
  $currentUser = wp_get_current_user();

  if( count($currentUser->roles) == 1 AND  $currentUser->roles[0] == 'subscriber'){
   show_admin_bar(false);
  }
}
//  =================================//redirect subscriber after login=====================


//  =================================//Customize login page=====================
add_filter('login_headerurl', 'ourheaderurl');

function ourheaderurl(){
  return esc_url(site_url('/'));
}

add_action( 'login_enqueue_scripts', 'ourloginscripts' );

function ourloginscripts(){
  // wp_enqueue_style('style',get_stylesheet_uri());
   wp_enqueue_style('customlogin',get_template_directory_uri().'/css/login.css');
}

add_filter('login_headertext', 'header_title');

function header_title(){
  return get_bloginfo('name'); 
}
//  =================================//Customize login page=====================