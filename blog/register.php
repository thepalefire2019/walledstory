<?php

//  ======================================= Register English post type===============================
add_action( 'init', 'english_post_type' );

function english_post_type(){
	$labels = array(
    'name'                => _x( 'Blog', 'post type general name', 'your-plugin-textdomain'),
    'singular_name'       => _x( 'Blog', 'post type singular name', 'your-plugin-textdomain' ), 
    'menu_name'           => _x( 'Blog', 'admin menu', 'your-plugin-textdomain' ),
    'name_admin_bar'      => _x( 'Blog', 'add new on admin bar', 'your-plugin-textdomain' ),
    'add_new'             => _x( 'Add New', 'Blog', 'your-plugin-textdomain' ),
    'add_new_item'        => __( 'Add New Blog', 'your-plugin-textdomain' ),
    'new_item'            => __( 'New Blog', 'your-plugin-textdomain' ),
    'edit_item'           => __( 'Edit Blog', 'your-plugin-textdomain' ),
    'view_item'           => __( 'View Blog', 'your-plugin-textdomain' ),
    'all_items'           => __( 'All Blog', 'your-plugin-textdomain' ),
    'search_items'        => __( 'Search Blog', 'your-plugin-textdomain' ),
    'parent_item_colon'   => __( 'Parent Blog:', 'your-plugin-textdomain' ),
    'not_found'           => __( 'No blog post found.', 'your-plugin-textdomain' ),
    'not_found_in_trash'  => __( 'No blog post found in Trash.', 'your-plugin-textdomain' )
  ); 

  $args = array(
    'labels'              => $labels,
    'description'         => __( 'Description.', 'your-plugin-textdomain' ),
    'public'              => true,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'query_var'           => true,
    'rewrite'             => array( 'slug' => 'blogs' ),
    'has_archive'         => true,
    'hierarchical'        => false,
    'menu_position'       => null,
    'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments','revisions'),
    'taxonomies'          => array('blog_category','post_tag'),
    'show_in_rest'        => true,
    'menu_icon'           => 'dashicons-editor-textcolor',
    'menu_position'       => 5,
    'capability_type'     => 'blog',
    'map_meta_cap'        => true  
);

	register_post_type( 'ws_blog', $args );
}

//  ======================================= Register Bengali post type===============================




//  ======================================= Register Category Tax for Bengali========================

add_action( 'init', 'create_eng_cat_tax' );
function create_eng_cat_tax(){

	register_taxonomy(
        'blog_category',
        'ws_blog',
        array(
            'labels' =>array(
                        'name' =>'Categories',
                        'singular_name' => 'Category',
                        'search_items' => 'Search Category',
                        'all_items' => 'All Category',
                        'parent_item' => 'Parent Category',
                        'parent_item_colon' => 'Parent category :',
                        'edit_item' => 'Edit Category',
                        'update_item' => 'Update category',
                        'add_new_item' => 'Add New Category',
                        'new_item_name'=> 'New category Name',
                        'menu_name' => 'Category',
                        'not_found' =>'No category found',
                        ) ,
            'rewrite' => array( 'slug' => 'english-category'),
            'hierarchical' => true,
            'show_ui'       => true,
            'show_admin_column' =>true,
            'show_in_menu' => true,
            'query_var' => true,
            'show_in_nav_menus' => true,
            'show_in_quick_edit' => true,
            'public' => true,
            'publicly_queryable' => true,
            'show_in_rest'      => true,
            'capabilities' => array(
                'manage_terms' => 'manage_eng_cat',
                'edit_terms' => 'edit_eng_cat',
                'delete_terms' => 'delete_eng_cat',
                'assign_terms' => 'assign_eng_cat',
) 

        )
    );

}
//  ======================================= Register Category Tax for Bengali========================


//  ======================================= Add Extra Files========================
require get_template_directory(). '/blog/metabox.php';
//  ======================================= Add Extra Files========================

//  =======================================color option for bengali category========================

add_action ( 'blog_category_edit_form_fields', 'eng_category_color_fields');
function eng_category_color_fields( $tag ){
    $t_id = $tag->term_id;
    $cat_meta = get_option( "eng_category_$t_id");
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
add_action ( 'edited_blog_category', 'save_eng_category_color_fields');
function save_eng_category_color_fields( $term_id ) {
    if ( isset( $_POST['Cat_meta'] ) ) {
        $t_id = $term_id;
        $cat_meta = get_option( "eng_category_$t_id");
        $cat_keys = array_keys($_POST['Cat_meta']);
            foreach ($cat_keys as $key){
            if (isset($_POST['Cat_meta'][$key])){
                $cat_meta[$key] = $_POST['Cat_meta'][$key];
            }
        }
        //save the option array
        update_option( "eng_category_$t_id", $cat_meta );
    }
}

//Cat color column

add_filter('manage_edit-blog_category_columns' , 'eng_cat_color_taxonomy_columns');
function eng_cat_color_taxonomy_columns( $columns )
{
  $columns['cat_color'] = __('Color');

  return $columns;
} 
add_filter( 'manage_blog_category_custom_column', 'eng_cat_color_taxonomy_columns_content', 10, 3 );
function eng_cat_color_taxonomy_columns_content( $content, $column_name, $term_id )
{
    if ( 'cat_color' == $column_name ) {
      $color_id = "eng_category_" . $term_id;
      $color = get_option($color_id);
      $category_color = $color['color'];
      if($category_color){
        $content = '<span style="color:'.$category_color.'">&#11044;</span>';
      }
    }
  return $content;
}



//  =======================================color option for bengali category========================
