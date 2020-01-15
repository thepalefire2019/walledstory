<!DOCTYPE html>
<html <?php language_attributes(); ?> >

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
 	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 	<link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>">
 	<link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <style type="text/css">
        :root {
          --gold-color: #ffd700;
          --silver-color: #999999;
          --bronze-color: #cd7f32;
          --theme-color:<?php echo get_option('theme_color'); ?>;
          --theme-color-dark: #000;
          --theme-color-light: #ffc4cd;
          --font-head-color: <?php echo get_option('headline_color'); ?>;
          --background-color: <?php echo get_option('background_color'); ?>;
        }
    </style>
 	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
<?php
global $current_user, $wp_roles;
$avatar_url = get_the_author_meta( 'profile_picture', $current_user->ID ) ;
$user_fname = get_the_author_meta( 'first_name', $current_user->ID );
$user_lname = get_the_author_meta( 'last_name', $current_user->ID );
?>

<!------------Dark Header --------------->
<div class="dark-header">
    <div class="row">
        <div class="col-md-2 col-4 dark-header-social">
             <ul>
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
            </ul> 
        </div>

        <div class="col-md-4 col-1 dark-header-search">
            <?php get_search_form() ?>
        </div>

        <div class="col-md-3 col-4 dark-header-add-post" >
            <?php if( is_user_logged_in() ){ ?>
            <p data-toggle="modal" data-target="#exampleModalLong">
            Create Blog
            </p>
            <?php } ?>
        </div>
        <div class="col-md-3 col-3 dark-header-profile">
            <?php  if(is_user_logged_in()){ ?>
            <div class="dropdown">
                <a class="profile-btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span> <img src="<?php echo $avatar_url; ?>"></span><?php echo $user_fname; ?>
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" x-placement="bottom-start">
                    <a class="dropdown-item" href="<?php echo site_url('/my-profile') ?>"> <i class="fas fa-user"></i>&nbsp My Profile</a>
                    <a class="dropdown-item" href="<?php echo wp_logout_url(); ?>">  <i class="fas fa-sign-out-alt"></i> &nbsp;Logout</a>
                   
                </div>
            </div>
            <?php }else{ ?>
            <div class="col-md-3 col-3 dark-header-profile-login">
                <a href="<?php echo site_url('/login') ?>" class="login">Login</a>
            </div>
            <?php } ?>
        </div>
       
    </div>
</div>
	<!------------ Header --------------->
    <?php 
    if( is_front_page() ){ 
        if( get_option('background_image') ==1 ){

    ?>
    <div class="front-page-background" style="background: linear-gradient(rgba(0,0,0,.7), rgba(255,255,255,1)), url('<?php echo get_option('background_image_url') ?>') ;">  
    <?php }else{ ?>
    <div class="front-page-background" style="background: var(--background-color)"> 
    <?php 
    }
        }elseif( is_page('gold') ){
            if( get_option('background_image') ==1 ){

    ?>
    <div class="front-page-background" style="background: linear-gradient(rgba(0,0,0,.7), rgba(255,255,255,1)), url('<?php echo get_option('background_image_url_gold') ?>') ;">  
    <?php }else{ ?>
    <div class="front-page-background" style="background: var(--background-color)"> 
    <?php 
    }
        }elseif( is_page('silver') ){
            if( get_option('background_image') ==1 ){

    ?>
    <div class="front-page-background" style="background: linear-gradient(rgba(0,0,0,.7), rgba(255,255,255,1)), url('<?php echo get_option('background_image_url_silver') ?>') ;">  
    <?php }else{ ?>
    <div class="front-page-background" style="background: var(--background-color)"> 
    <?php 
    }
        }elseif( is_page('bronze') ){
            if( get_option('background_image') ==1 ){

    ?>
    <div class="front-page-background" style="background: linear-gradient(rgba(0,0,0,.7), rgba(255,255,255,1)), url('<?php echo get_option('background_image_url_bronze') ?>') ;">  
    <?php }else{ ?>
    <div class="front-page-background" style="background: var(--background-color)"> 
    <?php 
    }
        }else{
    ?>
    <div class="front-page-background" > 
    <?php }?>
        <header>
            <div class="container-fluid bl-header">
                <div class="row">
                    <div class="col-lg-2 col-2 bl-header-social">
                       
                        <div class="hd-menu">
                            <img src="<?php echo get_stylesheet_directory_uri()?>/img/svg/menuwhite.svg">
                        </div>
                    </div>
                   
                    <div class="col-lg-8 col-8 bl-header-logo">
                        <!-- <h2><a href="<?php echo site_url(); ?>">Walledstory</a></h2> -->
                    </div>
                    <div class="col-lg-2 col-2">
                        <div class="main-menu">
                            <img class="main-menu-img" src="<?php echo get_stylesheet_directory_uri()?>/img/svg/menuwhite.svg">
                            <img class="main-menu-close" src="<?php echo get_stylesheet_directory_uri()?>/img/svg/delete.svg">
                        </div>
                        <div class="mobile-search">
                           <img class="mobile-search-img" src="<?php echo get_stylesheet_directory_uri() ?>/img/svg/search.svg">
                           <img class="mobile-search-img-close" src="<?php echo get_stylesheet_directory_uri() ?>/img/svg/delete.svg">
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
                    <li class=""><a href="<?php echo site_url('/login'); ?>">Login</a></li>
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

        <div class="mobile-search-screen">
            <div class="container">
                 <?php get_search_form() ?>
            </div>
           
        </div>
        <div class="director">
            <?php if( is_front_page() OR is_page('gold') OR is_page('silver') OR is_page('bronze') ){ ?>
            <div class="sidebar-left">
                <a href="<?php echo site_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri().'/img/logows.png' ?>"></a>
                <a href="<?php echo site_url('about') ?>"><p>About</p></a>
                <a href="<?php echo site_url('gold') ?>"><p>WS Gold</p></a>
                <a href="<?php echo site_url('silver') ?>"></a><p>Ws Silver</p></a>
                <a href="<?php echo site_url('bronze') ?>"></a><p>Ws Bronze</p></a>
                
            </div>
            <?php } ?>
           <!--  <div class="sidebar-right">
                
            </div> -->