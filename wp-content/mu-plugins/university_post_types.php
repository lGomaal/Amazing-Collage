<?php
/* here we declare a post_type 
   we can do it in the function.php file but will cause the he will never know how to edit if
   he changed the theme so the filr "must-use-plugins" inforce him to declare and run this file
 */
function university_post_types(){
  // Event post type
  register_post_type('event' , [
    'supports' => ['title' , 'editor' , 'excerpt' , 'custom-fields'],
    'rewrite' => ['slug' => 'events'],
    // we spesify that he has its own archive file and if he hasnot he will use the default archive.php
    'has_archive' => true,
    'public' => true,
    'labels' => [
      'name' => 'Events',
      'add_new_item' => 'Add New Event',
      'edit_item' => 'Edit Event',
      'all_items' => 'All Events',
      'singular_name' => 'Event'
    ],
    'menu_icon' => 'dashicons-list-view'
  ]);

   // Program post type
   register_post_type('program' , [
    'supports' => ['title' , 'editor' , 'excerpt' , 'custom-fields'],
    'rewrite' => ['slug' => 'programs'],
    // we spesify that he has its own archive file and if he hasnot he will use the default archive.php
    'has_archive' => true,
    'public' => true,
    'labels' => [
      'name' => 'Programs',
      'add_new_item' => 'Add New Program',
      'edit_item' => 'Edit Program',
      'all_items' => 'All Programs',
      'singular_name' => 'Program'
    ],
    'menu_icon' => 'dashicons-clipboard'
  ]);

  // Professor post type
  register_post_type('professor' , [
    'supports' => ['title' , 'editor' , 'excerpt' , 'custom-fields' , 'thumbnail'],
    'public' => true,
    'labels' => [
      'name' => 'Professors',
      'add_new_item' => 'Add New Professor',
      'edit_item' => 'Edit Professor',
      'all_items' => 'All Professors',
      'singular_name' => 'Professor'
    ],
    'menu_icon' => 'dashicons-welcome-learn-more'
  ]);
}

add_action('init' , 'university_post_types');

// here we are gonna create a class that handle all the custom field using Metabox

class CustomFeilds_Events{

  public function cheak_exist($arr_prog,$title){
    if(!$arr_prog) return false;
    foreach ($arr_prog as &$value) {
      if($value->post_title == $title){
        return true;
      }
    }
    return false;
  }

  public function __construct()
  {
    // this is for adding new metabox 
    add_action('add_meta_boxes' , [$this,'create_meta_box']);
    // this is for saving the meta box data when we hit save or edit or publish
    add_action('save_post' , [$this,'save_metabotx_event']);
  }

  public function create_meta_box(){
    add_meta_box('cf_event_date','Pick the date of that event' ,[$this,'meta_box_html'],['event']);
    add_meta_box('cf_event_Relation_program','Pick the one or more program realted to the event' ,[$this,'MetaBoxProgrmasRelation'],['event']);
  }

  // for event date picker
  public function meta_box_html(){
    ?>

    <!-- <label for="birthdaytime">Birthday (date and time):</label> -->
    <input type="date" id="birthdaytime" name="DateEventPic" value="<?php echo get_post_meta(get_the_ID(),'DateEventPic', true)?>">

    <?php
  }

  // for the Event program relationship
  public function MetaBoxProgrmasRelation(){
    $Programs_posts = new WP_Query([
      'post_type' => 'program',
      'post_per_page' => -1,
      ]);
      $numprog=0;
      $arr_prog =get_post_meta(get_the_ID(),'ProgramsEventPosts', true);
      while($Programs_posts->have_posts()){
        $Programs_posts->the_post();?>
        <input type="checkbox" id="<?php the_title(); ?>" name="<?php echo $numprog ?>" value="<?php echo get_the_ID(); ?>"
        <?php if($this->cheak_exist($arr_prog,get_the_title())){
          echo 'checked';
        }?>>
        <label for="<?php the_title(); ?>"> <?php the_title(); ?></label><br>
      <?php $numprog++; }

      ?>
        <input type="hidden" name="count_of_Programs" value="<?php echo $numprog ?>">
      <?php
  }

  // when the save_post happen it sends auto the postid as a parameter.
  public function save_metabotx_event($post_id){
    if(isset($_POST['DateEventPic'])){
      // echo '<pre>';
      // print_r($_POST);
      // echo '</pre>';
      // die();

      /* Sanitization is the process of cleaning or filtering your input data */
      $date_time = sanitize_text_field($_POST['DateEventPic']);
      update_post_meta($post_id ,'DateEventPic' , $date_time );
    }
    // prepare array full of post objects
    if(isset($_POST['count_of_Programs'])){
      $count=0;
      $arr_of_Prog=[];
      while ($count<intval($_POST['count_of_Programs'])) {
        if(!empty($_POST[$count])){
          array_push($arr_of_Prog,get_post(intval($_POST[$count])));
        }
        $count++;
      }
      update_post_meta($post_id ,'ProgramsEventPosts' ,  $arr_of_Prog );
    }
  }
  
}

new CustomFeilds_Events();

class CustomFeilds_Professors{

  public function cheak_exist($arr_prog,$title){
    if(!$arr_prog) return false;
    foreach ($arr_prog as &$value) {
      if($value->post_title == $title){
        return true;
      }
    }
    return false;
  }
  
  public function __construct()
  {
    // this is for adding new metabox 
    add_action('add_meta_boxes' , [$this,'create_meta_box']);
    // this is for saving the meta box data when we hit save or edit or publish
    add_action('save_post' , [$this,'save_metabotx_professor']);
  }

  public function create_meta_box(){
    add_meta_box('cf_professor_Relation_program','Which language does the Professor teach' ,[$this,'MetaBoxProgrmasRelation'],['professor']);
  }

  public function MetaBoxProgrmasRelation(){
    $Programs_posts = new WP_Query([
      'post_type' => 'program',
      'post_per_page' => -1,
      ]);
      $numprog=0;
      $arr_prog =get_post_meta(get_the_ID(),'ProgramsProfPosts', true);
      while($Programs_posts->have_posts()){
        $Programs_posts->the_post();?>
        <input type="checkbox" id="<?php the_title(); ?>" name="<?php echo $numprog ?>" value="<?php echo get_the_ID(); ?>"
        <?php if($this->cheak_exist($arr_prog,get_the_title())){
          echo 'checked';
        }?>>
        <label for="<?php the_title(); ?>"> <?php the_title(); ?></label><br>
      <?php $numprog++; }

      ?>
        <input type="hidden" name="count_of_Programs" value="<?php echo $numprog ?>">
      <?php
  }
  public function save_metabotx_professor($post_id){
    // prepare array full of post objects
    if(isset($_POST['count_of_Programs'])){
      $count=0;
      $arr_of_Prog=[];
      while ($count<intval($_POST['count_of_Programs'])) {
        if(!empty($_POST[$count])){
          array_push($arr_of_Prog,get_post(intval($_POST[$count])));
        }
        $count++;
      }
      update_post_meta($post_id ,'ProgramsProfPosts' ,  $arr_of_Prog );
    }
  }
}

new CustomFeilds_Professors();

?>