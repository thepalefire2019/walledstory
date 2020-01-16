<?php 

global $user_ID;
global $wpdb;
if( !$user_ID ){
	if( $_POST ){
		$username = esc_sql($_POST['username']);
		$password = esc_sql($_POST['password']);

		$login_array = array(
				'user_login' => $username,
				'user_password' => $password
		);
		$user = get_user_by( 'login', $username);
		$roles = $user->roles;
		//echo($roles[0]);

		if( $roles[0] == 'subscriber' ){
			$verify_user = wp_signon( $login_array, false );
			if( !is_wp_error( $verify_user ) ){
				 echo '<script>window.location = "'.site_url().'"</script>';
			}else{
				echo '<script>alert("Invalid Credentials")</script>';
			}
		}else{
			$verify_user = wp_signon( $login_array, false );
			if( !is_wp_error( $verify_user ) ){
				 echo '<script>window.location = "'.site_url('wp-admin').'"</script>';
				 // wp_set_auth_cookie( $user->ID, true, is_ssl() );
				 $userID = $user->ID;

				wp_set_current_user( $userID, $user_login );
				wp_set_auth_cookie( $userID, true, false );
				do_action( 'wp_login', $user_login );
			}else{
				echo '<script>alert("Invalid Credentials")</script>';
			}
		}
		
		
	}
	get_header();
	?>



		<div class="container">
			<div class="login-box">
				<div class="left-box">
					<div class="left-box-details">
						<h2>Walledstory</h2>
						<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
					</div>
					
				</div>
				<div class="right-box">
					<div class="right-box-details">
						<h2>Welcome Aboard</h2>
						<form method="post">
							<input type="text" name="username" id="username" placeholder="Username / Email ID" >
							<br>
							<input type="password" name="password" id="password" placeholder="Password" >
							<br>
							<button type="submit" name="btn_submit" >LOG IN</button>
							<a href="<?php echo site_url('/register') ?>" class="sign-up" >SIGN UP</a>
						</form>
					</div>
					
				</div>
			</div>
		</div>


		
	<?php
	get_footer();
}else{
	
	wp_redirect(site_url('/'));
}
?>

