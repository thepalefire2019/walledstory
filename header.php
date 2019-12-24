<!DOCTYPE html>
<html <?php language_attributes(); ?> >

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
 	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 	<link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>">
 	<link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
 	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
<?php
global $current_user, $wp_roles;
$avatar_url = get_the_author_meta( 'profile_picture', $current_user->ID ) ;
$user_fname = get_the_author_meta( 'first_name', $current_user->ID );
$user_lname = get_the_author_meta( 'last_name', $current_user->ID );
?>
	<!------------ Header --------------->
        <header>
            <div class="dark-header">
                <div class="row">
                    <div class="col-md-4 dark-header-social">
                         <ul>
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        </ul> 
                    </div>
                    <div class="col-md-4 dark-header-add-post" >
                        <?php if( is_user_logged_in() ){ ?>
                        <p data-toggle="modal" data-target="#exampleModalLong">
                        Create Blog
                        </p>
                        <?php } ?>
                    </div>
                    <div class="col-md-3 dark-header-profile">
                        <?php  if(is_user_logged_in()){ ?>
                        <div class="dropdown">
                            <a class="profile-btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span> <img src="<?php echo $avatar_url; ?>"></span><?php echo $user_fname; ?>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" x-placement="bottom-start">
                                <a class="dropdown-item" href="#"> <i class="fas fa-user"></i>&nbsp My Profile</a>
                                <a class="dropdown-item" href="<?php echo wp_logout_url(); ?>">  <i class="fas fa-sign-out-alt"></i> &nbsp;Logout</a>
                               
                            </div>
                        </div>
                        <?php }else{ ?>
                        <div class="col-md-3 dark-header-profile-login">
                            <a href="<?php echo wp_login_url(); ?>" class="login">Login</a>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="container-fluid bl-header">
                <div class="row">
                    <div class="col-lg-2 bl-header-social">
                       <!--  <h4>Follow us on</h4>
                        <ul>
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        </ul> -->
                        <div class="hd-menu">
                            <img src="<?php echo get_stylesheet_directory_uri()?>/img/svg/menu.svg">
                        </div>
                    </div>
                   
                    <div class="col-lg-8 bl-header-logo">
                        <h2><a href="<?php echo site_url(); ?>">Walledstory</a></h2>
                    </div>
                    <div class="col-lg-2">
                        <div class="main-menu">
                            <img src="<?php echo get_stylesheet_directory_uri()?>/img/svg/menu.svg">
                        </div>
                    </div>

                   <!--  <div class="col-lg-2 bl-header-search">
                        <i class="fas fa-search"></i>  
                    </div> -->
                </div>
            </div>
       <!--      <div class="bl-nav">
                <nav class="bl-nav-bar">
                    <div class="container">
                        <ul class="bl-nav-bar-list">
                            <li class=""><a href="<?php echo site_url('/') ?>">Home</a></li>
                            <li class="bl-nav-bar-list-a"><a href="<?php echo site_url('/about') ?>">About</a></li>
                            <li class="bl-nav-bar-list-a"><a href="#">Blog</a></li>
                            <li class="bl-nav-bar-list-a"><a href="#">Contact</a></li>
                            <?php if( is_user_logged_in() ){ ?>
                            <li class="bl-nav-bar-list-a"><a href="<?php echo site_url('/my-account'); ?>">Account</a></li>
                            <li class="bl-nav-bar-list-a"><a href="<?php echo site_url('/my-post'); ?>">My Post</a></li>
                            <li class="bl-nav-bar-list-a"><a href="<?php echo wp_logout_url(); ?>">Logout</a></li>
                            <?php }else{ ?>
                            <li class="bl-nav-bar-list-a"><a href="<?php echo wp_registration_url() ; ?>">Register</a></li>
                            <li class="bl-nav-bar-list-a"><a href="<?php echo wp_login_url(); ?>">Login</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </nav>
            </div> -->
            
        </header>
        <div class="main-menu-screen">
            <div class="space20"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 main-menu-column-column">
                        <h2>Main Menus</h2>
                        <ul>
                            <li><a href="<?php echo site_url('/') ?>">Home</a></li>
                            <li><a href="<?php echo site_url('/my-account'); ?>">My Profile</a></li>
                            <li><a href="<?php echo site_url('/about') ?>">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 main-menu-column-column">
                        <h2>Walled Story Levels</h2>
                        <ul style="left:120px;">
                            <li><a href="">Palefire Black</a></li>
                            <li><a href="">Palefire Gold</a></li>
                            <li><a href="">Palefire Silver</a></li>
                            <li><a href="">Palefire Bronze</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 main-menu-column-column">
                        <h2 style="text-align: right;">Please Visit Us</h2>
                        <ul  style="text-align: right;right: 18px;">
                            <li><a href="">Palefire Technology</a></li>
                            <li><a href="">Palefire Books</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="menu-footer"></div>
            
        </div>

        <div class="mobile-menu-screen">
            <div class="container">
                 <ul class="mob-nav-bar-list">
                    <li class=""><a href="<?php echo site_url('/'); ?>">Home</a></li>
                    <li class=""><a href="<?php echo site_url('/about'); ?>">About</a></li>
                    <li class=""><a href="#">Blog</a></li>
                    <li class=""><a href="#">Contact</a></li>
                    <?php if( is_user_logged_in() ){ ?>
                    <li class=""><a href="<?php echo site_url('/my-account'); ?>">Account</a></li>
                    <li class=""><a href="<?php echo site_url('/my-post'); ?>">My Post</a></li>
                    <li class=""><a href="<?php echo wp_logout_url(); ?>">Logout</a></li>
                    <?php }else{ ?>
                    <li class=""><a href="<?php echo wp_registration_url() ; ?>">Register</a></li>
                    <li class=""><a href="<?php echo wp_login_url(); ?>">Login</a></li>
                    <?php } ?>
                </ul> 

                <ul class="mob-nav-bar-extra-list">
                    <li><a href="#">Dummy Extra</a></li>
                    <li><a href="#">Dummy Extra</a></li>
                    <li><a href="#">Dummy Extra</a></li>
                    <li><a href="#">Dummy Extra</a></li>
                    <li><a href="#">Dummy Extra</a></li>
                    <li><a href="#">Dummy Extra</a></li>
                    <li><a href="#">Dummy Extra</a></li>
                </ul>
            </div>
          
        </div>

        <div class="director">

