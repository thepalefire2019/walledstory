<?php
get_header();   
global $wpdb, $user_ID;  
//Check whether the user is already logged in  
if ($user_ID) 
{  
   
    // They're already logged in, so we bounce them back to the homepage.  
   
    header( 'Location:' . home_url() );  
   
} else
 {  
   
    $errors = array();  
   
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ) 
      {  
   
        // Check username is present and not already in use  
        $username = esc_sql($_REQUEST['username']);  
        if ( strpos($username, ' ') !== false )
        {   
            $errors['username'] = "Sorry, no spaces allowed in usernames";  
        }  
        if(empty($username)) 
        {   
            $errors['username'] = "Please enter a username";  
        } elseif( username_exists( $username ) ) 
        {  
            $errors['username'] = "Username already exists, please try another";  
        }  
   
        // // Check email address is present and valid  
        $email = esc_sql($_REQUEST['email']);  
        $password = esc_sql($_REQUEST['password']);  
        if( !is_email( $email ) ) 
        {   
            $errors['email'] = "Please enter a valid email";  
        } elseif( email_exists( $email ) ) 
        {  
            $errors['email'] = "This email address is already in use";  
        }  
   
        // Check password is valid  
        if(0 === preg_match("/.{6,}/", $_POST['password']))
        {  
          $errors['password'] = "Password must be at least six characters";  
        }  
   
        // Check password confirmation_matches  
        if(0 !== strcmp($_POST['password'], $_POST['password_confirmation']))
         {  
          $errors['password_confirmation'] = "Passwords do not match";  
        }  
   
        // Check terms of service is agreed to  
        if($_POST['terms'] != "Yes")
        {  
            $errors['terms'] = "You must agree to Terms of Service";  
        }  
   
        if(0 === count($errors)) 
         {  
   
            // $password = $_POST['password'];  
   
            $new_user_id = wp_create_user( $username, $password, $email );  
   
            // You could do all manner of other things here like send an email to the user, etc. I leave that to you.  
   
            $success = 1;  
   
            //header( 'Location:' . get_bloginfo('url') . '/login/?success=1&u=' . $username );  
            echo '<script>window.location = "'.site_url('wp-admin/login/?success=1$u=').$username.'"</script>';
        }  else{
            foreach( $errors as $error ){
                ?>
                <script type="text/javascript">
                    jQuery(document).ready( function(){
                        $('.notice').append('<p>'+'<?php echo $error ?>'+'</p>');
                    } );
                </script>
                <?php
            }
        }
   
    }  
}  
  
?>  
<style type="text/css">
    .login-box{height: 80vh;}
    @media only screen and (max-width : 767px) {
        .login-box{height: 92vh}
    }
</style>
    <div class="container">
            <div class="login-box" >
                <div class="left-box">
                    <div class="left-box-details">
                        <h2>Walledstory</h2>
                        <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    </div>
                    
                </div>
                <div class="right-box">
                    <div class="right-box-details" >
                        <div class="notice">
                           
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <h2>Welcome Aboard</h2>
                        <form id="wp_signup_form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">  
  
                                
                                <input type="text" name="username" id="username" placeholder="Username">  
                         
                                <input type="text" name="email" id="email" placeholder="Email Address">  
                                
                                <input type="password" name="password" id="password" placeholder="Password">  
                                 
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">  <br>
                          
                                <input name="terms" id="terms" type="checkbox" value="Yes">  
                                <label for="terms">I agree to the Terms of Service. <a href="#" class="terms">Read Terms and Condition</a></label>  
                          
                                <input type="submit" id="submitbtn" name="submit" value="Sign Up" />  
                                <a href="<?php echo site_url('/login') ?>" class="sign-up" >LOG IN</a>

                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
  
  
<?php get_footer(); ?>