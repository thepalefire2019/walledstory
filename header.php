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

	<!------------ Header --------------->
        <header>
            <div class="container-fluid bl-header">
                <div class="row">
                    <div class="col-lg-2 bl-header-social">
                        <h4>Follow us on</h4>
                        <ul>
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        </ul>
                        <div class="hd-menu">
                            <img src="<?php echo get_stylesheet_directory_uri()?>/img/svg/menu.svg">
                        </div>
                    </div>
                    <div class="col-lg-8 bl-header-logo">
                        <h2><a href="<?php echo site_url(); ?>">Walledstory</a></h2>
                    </div>
                    <div class="col-lg-2 bl-header-search">
                        <i class="fas fa-search"></i>
                        
                       
                    </div>
                </div>
            </div>
            <div class="bl-nav">
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
            </div>
            
        </header>

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