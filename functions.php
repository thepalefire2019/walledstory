<?php

require get_template_directory(). '/inc/enqueue.php';
require get_template_directory(). '/inc/ajax_function_like_btn.php';
require get_template_directory(). '/inc/load_more_ajax.php';
require get_template_directory(). '/inc/custom_function.php';
require get_template_directory(). '/bengali/register.php';
require get_template_directory(). '/blog/register.php';
require get_template_directory(). '/like/register.php';
require get_template_directory(). '/follow/register.php';
require get_template_directory(). '/post-meta/metabox.php';
require get_template_directory(). '/post-meta/save-metabox.php';
require get_template_directory(). '/api/ws-api.php';



function site_setup(){
	add_theme_support('post-thumbnails');
   	add_image_size('ws-large', 1200, 675 );
    add_image_size('ws-regular',820,461 );
   	add_image_size('ws-square',300,300, true );
   	add_theme_support('html5',array('comment-list','comment-form','search-form','gallery'));
}
add_action('after_setup_theme','site_setup');






// *** =================  levels ============== *** //
function setLevel( $postID, $likesnum, $viewsnum ){
  $level_key = 'blog_level';
  //calculate level

  if( $viewsnum < 10 ){
    $view = 0;
  }elseif( $viewsnum >= 10 AND $viewsnum < 150 ) {
    $view = 1;
  }elseif( $viewsnum >= 150 AND $viewsnum < 220 ){
    $view = 2;
  }elseif( $viewsnum >= 220 AND $viewsnum < 330 ){
    $view = 3;
  }elseif( $viewsnum >= 330 AND $viewsnum < 450 ){
    $view = 4;
  }elseif( $viewsnum >= 450 AND $viewsnum < 560 ){
    $view = 5;
  }elseif( $viewsnum >= 560 AND $viewsnum < 660 ){
    $view = 6;
  }elseif( $viewsnum >= 660 AND $viewsnum < 770 ){
    $view = 7;
  }elseif( $viewsnum >= 770 AND $viewsnum < 880 ){
    $view = 8;
  }elseif( $viewsnum >= 880 AND $viewsnum < 1000 ){
    $view = 9;
  }else{
    $view = 10;
  }

  if( $likesnum < 1 ){
    $like = 0;
  }elseif( $likesnum >= 1 AND $likesnum < 15 ) {
    $like = 1;
  }elseif( $likesnum >= 15 AND $likesnum < 22 ){
    $like = 2;
  }elseif( $likesnum >= 22 AND $likesnum < 33 ){
    $like = 3;
  }elseif( $likesnum >= 33 AND $likesnum < 45 ){
    $like = 4;
  }elseif( $likesnum >= 45 AND $likesnum < 56 ){
    $like = 5;
  }elseif( $likesnum >= 56 AND $likesnum < 66 ){
    $like = 6;
  }elseif( $likesnum >= 66 AND $likesnum < 77 ){
    $like = 7;
  }elseif( $likesnum >= 77 AND $likesnum < 88 ){
    $like = 8;
  }elseif( $likesnum >= 88 AND $likesnum < 100 ){
    $like = 9;
  }else{
    $like = 10;
  }

  $view_rating = 0.3 * $view;
  $like_rating = 0.7 * $like;
  $rating = $view_rating + $like_rating;
  /** 
    == LEVEL ==
    0 -> Bronze
    1 -> Silver
    2 -> Gold
  **/
    if( $rating <= 0.9 ){ 
    $level = 0; 
  }elseif( $rating >0.9 AND $rating <=5.2 ){
    $level = 1;
  }else{
    $level = 2;
  }
  //calculate level
  $exits_blog_level = get_post_meta($postID, $level_key, true);
  if( $exits_blog_level == '' ){
    delete_post_meta($postID, $level_key);
    add_post_meta($postID, $level_key, $level);
  }else{
    update_post_meta($postID, $level_key, $level);
  }
}

function getLevel( $postID ){
  $level_key = 'blog_level';
  $level = get_post_meta($postID, $level_key, true);
  return $level;
}
// Add level to a column in WP-Admin
add_filter('manage_posts_columns', 'posts_column_levels');
add_action('manage_posts_custom_column', 'posts_custom_column_levels',5,2);
function posts_column_levels($defaults){
    $defaults['post_levels'] = __('Level');
    return $defaults;
}
function posts_custom_column_levels($column_name, $id){
 if($column_name === 'post_levels'){
         $level = getLevel(get_the_ID());
         if( $level == 0 ){
          echo '<div style="width:20px; height:20px;border-radius:50%; background:#cd7f32" ></div>';
         }elseif ($level == 1) {
           echo '<div style="width:20px; height:20px;border-radius:50%; background:#999999" ></div>';
         }else{
          echo '<div style="width:20px; height:20px;border-radius:50%; background:#ffd700" ></div>';
         }

    }
}
// *** =================  Likes ============== *** //
function setLike( $postID, $no_of_like ){
  $like_key = 'blog_like_count';
  $like_count = get_post_meta($postID, $like_key, true);
  if( $like_count == '' ){
    delete_post_meta($postID, $like_key);
    add_post_meta($postID, $like_key, $no_of_like);
  }else{
     update_post_meta($postID, $like_key, $no_of_like);
  }
}
function getLikes( $postID ){
   $like_key = 'blog_like_count';
   $no_of_like = get_post_meta($postID, $like_key, true);
    if($no_of_like==''){
        return "0";
    }
   return $no_of_like;
}
// Add like to a column in WP-Admin
add_filter('manage_posts_columns', 'posts_column_likes');
add_action('manage_posts_custom_column', 'posts_custom_column_likes',5,2);
function posts_column_likes($defaults){
    $defaults['post_likes'] = __('Likes');
    return $defaults;
}
function posts_custom_column_likes($column_name, $id){
 if($column_name === 'post_likes'){
         echo getLikes(get_the_ID());
    }
}
// *** =================  Views ============== *** //
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
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

//add_action( 'admin_init','redirectsubscriber' );

function redirectsubscriber(){
  $currentUser = wp_get_current_user();

  if( count($currentUser->roles) == 1 AND  $currentUser->roles[0] == 'subscriber'){
    wp_redirect(site_url('/'));
    //exit;
  }
  // if( count($currentUser->roles) == 1 AND  $currentUser->roles[0] == 'author'){
  //   wp_redirect(site_url('/'));
  //   //exit;
  // }
}
function admin_default_page() {
  $currentUser = wp_get_current_user();
  
    return site_url('/');
  
  
}

add_filter('login_redirect', 'admin_default_page');
function js_logout_redirect( $url ) {
    return site_url( '/' );
}
add_filter( 'logout_redirect', 'js_logout_redirect' );
//  =================================//redirect subscriber after login=====================

//  =================================//hide admin top menu bar=====================

add_action( 'wp_loaded','nosubsadminbar' );

function nosubsadminbar(){
  $currentUser = wp_get_current_user();

  if( count($currentUser->roles) == 1 AND  $currentUser->roles[0] == 'subscriber'){
   show_admin_bar(false);
  }
  // if( count($currentUser->roles) == 1 AND  $currentUser->roles[0] == 'author'){
  //  show_admin_bar(false);
  // }
}
//  =================================//hide admin top menu bar=====================


//  =================================//Theme color in the settings=====================

add_action('admin_init', 'my_general_section');  
function my_general_section() {  
    add_settings_section(  
        'my_settings_section', // Section ID 
        'My Themes Option', // Section Title
        'my_section_options_callback', // Callback
        'general' // What Page?  This makes the section show up on the General Settings Page
    );

    add_settings_field( // Option 1
        'theme_color', // Option ID
        'Theme Color', // Label
        'my_theme_color_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'theme_color' // Should match Option ID
        )  
    ); 

    add_settings_field( // Option 2
        'headline_color', // Option ID
        'Headlines Color', // Label
        'my_headline_color_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'headline_color' // Should match Option ID
        )  
    ); 

    add_settings_field( // Option 2
        'background_color', // Option ID
        'Background Color', // Label
        'my_background_color_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'background_color' // Should match Option ID
        )  
    ); 

    add_settings_field( // Option 2
        'background_image', // Option ID
        'Background Image', // Label
        'my_background_image_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'background_image' // Should match Option ID
        )  
    );

    add_settings_field( // Option 2
        'background_image_url', // Option ID
        'Background Image Url', // Label
        'my_background_image_url_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'background_image_url' // Should match Option ID
        )  
    );

    add_settings_field( // Option 2
        'background_image_url_gold', // Option ID
        'Background Image Url Gold', // Label
        'my_background_image_url_gold_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'background_image_url_gold' // Should match Option ID
        )  
    );

    add_settings_field( // Option 2
        'background_image_url_silver', // Option ID
        'Background Image Url Silver', // Label
        'my_background_image_url_silver_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'background_image_url_silver' // Should match Option ID
        )  
    );

    add_settings_field( // Option 2
        'background_image_url_bronze', // Option ID
        'Background Image Url Bronze', // Label
        'my_background_image_url_bronze_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'background_image_url_bronze' // Should match Option ID
        )  
    );

    register_setting('general','theme_color', 'esc_attr');
    register_setting('general','headline_color', 'esc_attr');
    register_setting('general','background_color', 'esc_attr');
    register_setting('general','background_image', 'esc_attr');
    register_setting('general','background_image_url', 'esc_attr');
    register_setting('general','background_image_url_gold', 'esc_attr');
    register_setting('general','background_image_url_silver', 'esc_attr');
    register_setting('general','background_image_url_bronze', 'esc_attr');
}

function my_section_options_callback() { // Section Callback
    echo '<p>Custom Theme Options</p>';  
}

function my_theme_color_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}
function my_headline_color_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}
function my_background_color_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}
function my_background_image_callback($args) {  // Textbox Callback
  if( $option = get_option($args[0]) ){
    $checked = 'checked';
  }else{
    $checked ='';
  }
    
    echo '<input type="checkbox" id="'. $args[0] .'" name="'. $args[0] .'" '.$checked.' value="1" />';
}
function my_background_image_url_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" style="width:80%"/>';
}
function my_background_image_url_gold_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" style="width:80%"/>';
}
function my_background_image_url_silver_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" style="width:80%"/>';
}
function my_background_image_url_bronze_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" style="width:80%"/>';
}
//  =================================//Theme color in the settings=====================


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

// // if ( current_user_can('subscriber') && !current_user_can('upload_files') )
// add_action('init', 'allow_subscriber_uploads');


// function allow_subscriber_uploads() {

//     $new_role = get_role('subscriber');
//     $new_role->add_cap('upload_files');
// }

function only_show_user_images( $query ) {

$current_userID = get_current_user_id();

if ( $current_userID && !current_user_can('manage_options')) {

$query['author'] = $current_userID;

}

return $query;

}

add_filter( 'ajax_query_attachments_args', 'only_show_user_images' ); 





function wpse_29570_where_filter($where){
        global $wpdb;
        if( is_search() ) {
            $search= get_query_var('s');
            $query=$wpdb->prepare("SELECT user_id  FROM $wpdb->usermeta WHERE ( meta_key='first_name' AND meta_value LIKE '%%%s%%' ) or ( meta_key='last_name' AND meta_value LIKE '%%%s%%' )", $search ,$search);
            $authorID= $wpdb->get_var( $query );

            if($authorID){
                $where .= "  AND  ( wp_posts.post_author = {$authorID} ) ";
            }

         }
         return $where;
    }

    // add_filter('posts_where','wpse_29570_where_filter');




/**
 * Custom register email
 */
//add_filter( 'wp_new_user_notification_email', 'custom_wp_new_user_notification_email', 10, 3 );
function custom_wp_new_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {
 
    $user_login = stripslashes( $user->user_login );
    $user_email = stripslashes( $user->user_email );
    $login_url  = wp_login_url();
    $message  = __( 'Hi there,' ) . "/r/n/r/n";
    $message .= sprintf( __( "Welcome to %s! Here's how to log in:" ), get_option('blogname') ) . "/r/n/r/n";
    $message .= wp_login_url() . "/r/n";
    $message .= sprintf( __('Username: %s'), $user_login ) . "/r/n";
    $message .= sprintf( __('Email: %s'), $user_email ) . "/r/n";
    $message .= __( 'Password: The one you entered in the registration form. (For security reason, we save encripted password)' ) . "/r/n/r/n";
    $message .= sprintf( __('If you have any problems, please contact me at %s.'), get_option('admin_email') ) . "/r/n/r/n";
    $message .= __( 'bye!' );
 
    $wp_new_user_notification_email['subject'] = sprintf( '[%s] Your credentials.', $blogname );
    $wp_new_user_notification_email['headers'] = array('Content-Type: text/html; charset=UTF-8');
    $wp_new_user_notification_email['message'] = $message;
 
    return $wp_new_user_notification_email;
}


/**
 * Redirect for register
 */
add_action( 'init', 'wpse_login_register_password_title' );
function wpse_login_register_password_title() {
  if ( isset( $GLOBALS['pagenow'] ) && $GLOBALS['pagenow'] === 'wp-login.php' ) {
    if ( ! empty( $_REQUEST['action'] ) && $_REQUEST['action'] === 'register' ){
      wp_redirect(site_url('/register'));
    }
  }
}