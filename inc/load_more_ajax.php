<?php 
add_action('wp_ajax_nopriv_ws_load_more','ws_load_more');
add_action('wp_ajax_ws_load_more','ws_load_more');
function ws_load_more(){
$paged = $_POST["page"]+1;
$league = $_POST["league"];
if( $league == 'front' ){
  $args = array(
        'post_type'         => 'ws_blog',
        'posts_per_page'  => 2 ,
        'paged'     =>$paged,  
);  
}elseif( $league == 'gold' ){
  $args = array(
            'post_type'         => 'ws_blog',
            'posts_per_page'  => 2 ,
            'paged'     =>$paged,
            'meta_query'    => array(
                                    array(
                                        'key'       => 'blog_level',
                                        'compare'   => '=',
                                        'value'     => 2
                                    ))    
);
}elseif( $league == 'silver' ){
  $args = array(
            'post_type'         => 'ws_blog',
            'posts_per_page'  => 2 ,
            'paged'     =>$paged, 
            'meta_query'    => array(
                                    array(
                                        'key'       => 'blog_level',
                                        'compare'   => '=',
                                        'value'     => 1
                                    ))     
);
}elseif( $league == 'bronze' ){
  $args = array(
            'post_type'         => 'ws_blog',
            'posts_per_page'  => 2 ,
            'paged'     =>$paged,
            'meta_query'    => array(
                                      array(
                                          'key'       => 'blog_level',
                                          'compare'   => '=',
                                          'value'     => 0
                                      ))    
);
}

$query = new WP_Query( $args );   
while($query->have_posts()):
      $query->the_post();
      $blog_id = get_the_ID();
      $post_user_id = get_the_author_meta('ID');
      $current_user_id = get_current_user_id();
      $get_img = get_the_post_thumbnail_url( get_the_ID(), 'ws-regular' );

      $category = get_the_terms($blog_id, 'blog_category');
      $category_permalink = get_term_link( $category[0] );
      $blog_level = getLevel(get_the_ID());

      //author
      $author_id = get_the_author_meta('ID');
      $author_img =  get_avatar(get_the_author_meta('ID')); 
      $avatar_url = get_the_author_meta( 'profile_picture',  get_the_author_meta('ID') ) ;
      $author_first_name = get_the_author_meta( 'first_name', get_the_author_meta('ID') );
      $author_last_name = get_the_author_meta( 'last_name', get_the_author_meta('ID') );
      $author_nick_name = get_the_author_meta( 'user_nicename', get_the_author_meta('ID') );
      $author_desc = get_the_author_meta( 'description', get_the_author_meta('ID') );
      $author_permalink = get_author_posts_url(get_the_author_meta('ID'));

      //Blog Details
      $likeCount = new WP_Query( array(
                            'post_type'     => 'like',
                            'meta_query'    => array(
                                array(
                                    'key'       => 'liked_blog_id',
                                    'compare'   => '=',
                                    'value'     => $blog_id
                                ))
                        ) );
      $no_of_likes = $likeCount->found_posts;
      $no_of_views = getPostViews(get_the_ID());
      //print_r($category);
      ?>
      <div class="blog-card" >
        <?php  if( has_post_thumbnail() ){ ?>
        <div class="row">
          <div class="col-md-6 left-blog-card">
            <?php the_post_thumbnail('ws-regular')?>
            <a href="<?php echo $category_permalink; ?>"><p><?php echo $category[0]->name; ?></p></a>
          </div>
          <div class="col-md-6 right-blog-card">
            <div class="blog-card-header">
              <div class="blog-card-author">
                <span><a href="<?php echo $author_permalink; ?>"><?php echo  $author_nick_name; ?></a></span>
                <img src="<?php echo $avatar_url; ?>">
              </div>
            </div>
            <div class="blog-card-title">
              <h3><?php echo wp_trim_words( get_the_title(), 15 ); ?></h3>
              <p><?php echo wp_trim_words( get_the_content(), 18 ); ?></p>
            </div>
            <div class="credential">
              <span><i class="fas fa-eye"></i>&nbsp; <?php echo $no_of_views; ?></span>
              <span id="front-like" data-link="<?php the_permalink(); ?>"><i class="fas fa-heart" style="<?php if( $no_of_likes >0 ){ echo 'color:#ed4956;';  } ?>"></i> &nbsp;<?php echo $no_of_likes; ?></span>
              <span class="share-btn"><i class="fas fa-share-alt"></i></span>
            </div>
            <div class="share">
                <ul>
                  <li><a rel="nofollow" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" onclick="return fbs_click()" target="_blank" ><i class="fab fa-facebook-square"></i></a></li>
                  <li><a href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>&via=palefire16" onclick="window.open(this.href, 'mywin',
                                            'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" ><i class="fab fa-twitter-square"></i></a></li>
                </ul>
              </div>
            <div class="rd-more">
              <a href="<?php the_permalink() ?>"><p>Read More</p></a>
            </div>
            
          </div>
        </div>
        <?php }else{ ?>
        <div class="row">
          <div class="col-md-12 full-card">
            <div class="blog-card-header">
              <div class="blog-card-author">
                <span><a href="<?php echo $author_permalink; ?>"><?php echo  $author_nick_name; ?></a></span>
                <img src="<?php echo $avatar_url; ?>">
              </div>
              <a href="<?php echo $category_permalink; ?>"><p><?php echo $category[0]->name; ?></p></a>
            </div>
            <div class="blog-card-title">
              <h3><?php echo wp_trim_words( get_the_title(), 25 ); ?></h3>
              <p><?php echo wp_trim_words( get_the_content(), 65 ); ?></p>
            </div>
            <div class="credential">
              <span><i class="fas fa-eye"></i>&nbsp; <?php echo $no_of_views; ?></span>
              <span id="front-like" data-link="<?php the_permalink(); ?>"><i class="fas fa-heart" style="<?php if( $no_of_likes >0 ){ echo 'color:#ed4956;';  } ?>"></i> &nbsp;<?php echo $no_of_likes; ?></span>
              <span class="share-btn"><i class="fas fa-share-alt"></i></span>
            </div>
            <div class="share">
                <ul>
                  <li><a rel="nofollow" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" onclick="return fbs_click()" target="_blank" ><i class="fab fa-facebook-square"></i></a></li>
                  <li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
                </ul>
              </div>
            <div class="rd-more">
              <a href="<?php the_permalink(); ?>"><p>Read More</p></a>
            </div>
          </div>
        </div>
        <?php } ?>
        
        
      </div><!-- Blog-card -->
      <?php 
endwhile;
wp_reset_postdata();  
die();  
}
