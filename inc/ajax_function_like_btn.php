<?php
  add_action('wp_ajax_nopriv_ws_like_ajax','ws_like_ajax');
  add_action('wp_ajax_ws_like_ajax','ws_like_ajax');

  function ws_like_ajax(){
  	   
  	    $user_id = $_POST["userid"];
  	    $post_id = $_POST["postid"];


  	     global $wpdb;
  	     $table_name = 'wp_ws_like';
  	     $results = $wpdb->get_results( "SELECT * FROM wp_ws_like WHERE user_id = {$user_id}", OBJECT );

  	     if( $results == NULL ){
  	     	
  	     	 $wpdb->insert($table_name, 
                        array(
                                'user_id' => $user_id,
                                'post_id' => $post_id
                            
                                
                                ),
                                array(
                                '%d',
                                '%d',
                                
                            ) 
                            );
  	     }else{
  	     	echo 'Already Liked';
  	     }


  }