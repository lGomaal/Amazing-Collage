<?php

require get_theme_file_path('/inc/search-route.php');

function university_custome_rest(){
  // post type , what ever u want to name the new feild , array to manage the feild
    register_rest_field('post','authorName',[
      'get_callback' => function (){return get_the_author();}
    ]);
}

add_action('rest_api_init' , 'university_custome_rest');
function university_files() {
  // for including the scripts and css and site
  wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), ['jquery'], microtime(), true);
  wp_enqueue_script('main-script-js', get_theme_file_uri('/js/Search.js'), NULL, microtime(), true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('university_main_styles', get_stylesheet_uri(),NULL,microtime());
  wp_localize_script('main-script-js' , 'universiry_data' , [
    'root_url' => get_site_url(),
    
  ]);
}

add_action('wp_enqueue_scripts', 'university_files');

function university_features() {
  // include the navigation bars
  register_nav_menu('HeaderMenuLocation' , 'Header Menu Location');
  register_nav_menu('Footerlocation1' , 'Footer Location One');
  register_nav_menu('Footerlocation2' , 'Footer Location Two');
  // to change the titles related to the page we on.
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_image_size('ProfessorLandScape', 400 , 260, true);
  add_image_size('ProfessorPortrait', 400 , 650, true);
}

add_action('after_setup_theme' , 'university_features');

function university_adjust_queries($query) {
  if (!is_admin() && is_post_type_archive('event') && $query->is_main_query()) {
    $query->set('meta_key' , 'DateEventPic');
    $query->set('orderby' , 'meta_value_num');
    $query->set('order' , 'ASC');
    $query->set('meta_query' , [
      [
        'key'=> 'DateEventPic',
        'compare' =>'>=',
        'value' => date("Y-m-d"),  // thats means today date with this formate
        'type' => 'numeric'
      ]
    ]);
  }

  if (!is_admin() && is_post_type_archive('program') && $query->is_main_query()) {
    $query->set('post_per_page' , -1);
    $query->set('orderby' , 'title');
    $query->set('order' , 'ASC');
  }
}

add_action('pre_get_posts' , 'university_adjust_queries');

