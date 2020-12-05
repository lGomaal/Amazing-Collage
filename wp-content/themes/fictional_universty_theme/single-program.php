<?php
  function cheak_exist($arr_prog,$title){
    if(!$arr_prog) return false;
    foreach ($arr_prog as &$value) {
      if($value->post_title == $title){
        return true;
      }
    }
    return false;
  }
  get_header();
  /* This file is responsible for the rendering of the single event type-post */
  if(have_posts()) {
    the_post(); ?>
    <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title(); ?></h1>
        <div class="page-banner__intro">
          <p>DONT FORGET TO REPLACE ME LATER</p>
        </div>
      </div>  
    </div>

    <div class="container container--narrow page-section">
          <div class="metabox metabox--position-up metabox--with-home-link">
          <!-- get_post_type_archive_link('event') is responsible for getting the like to a post-type archive link -->
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs</a> <span class="metabox__main"><?php the_title(); ?></span></p>
      </div>

      <div class="generic-content"><?php the_content(); ?></div>
      <?php
      $progam_title = get_the_title();
      ?>
      <hr class="section-break">
      <?php
        /* now we use a custom quary so that if we want to fetch posts in a non-related posts page as 
        home page like this and we give it array full of attributes
        -1 means all the posts that fits the requirments */
         $homepageEvents = new WP_Query([
          'posts_per_page' => -1,
          'post_type' => 'event',
          'meta_key' => 'DateEventPic',
          'order_by' => 'meta_value_num',
          'order' => 'ASC',
          'meta_query' =>[
            [
              'key'=> 'DateEventPic',
              'compare' =>'>=',
              'value' => date("Y-m-d"),  // thats means today date with this formate
              'type' => 'numeric'
            ]
          ]
          ]); 
          $cheak_header= true;
          while ($homepageEvents->have_posts()) {
            $homepageEvents->the_post();
            $arr_prog =get_post_meta(get_the_ID(),'ProgramsEventPosts', true);

            if(!cheak_exist($arr_prog,$progam_title)){
              continue;
            }
            if($cheak_header ){
              ?>
                <h2>Up Coming <?php the_title(); ?> Events</h2><br>
              <?php
                $cheak_header=false;
              }
            ?>
            <div class="event-summary">
              <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
                <span class="event-summary__month"><?php 
                  $event_date_time = new DateTime(get_post_meta(get_the_ID(),'DateEventPic', true));
                  echo $event_date_time->format('M');
                ?></span>
                <span class="event-summary__day"><?php 
                  $event_date_time = new DateTime(get_post_meta(get_the_ID(),'DateEventPic', true));
                  echo $event_date_time->format('d');
                ?></span>  
              </a>
              <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h5>
                <p><?php if (has_excerpt()) {
                          echo get_the_excerpt();
                        } 
                        else{
                          echo wp_trim_words(get_the_content(),18);
                        }
                        ?><a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
              </div>
            </div>
          <?php }
          // this is for the reset of the the_post and have_posts fuctions
          wp_reset_postdata();

          $Professors = new WP_Query([
            'posts_per_page' => -1,
            'post_type' => 'professor',
            'meta_key' => 'ProgramsProfPosts',
            'order_by' => 'title',
            'order' => 'ASC',
            'meta_query' =>[
              [
                'key'=> 'ProgramsProfPosts',
                'compare' =>'LIKE',
                'value' => $progam_title,  // thats means today date with this formate
                'type' => 'string'
              ]
            ]
            ]);
            // echo '<pre>';
            // var_dump($Professors->posts);
            // echo '</pre>';
            // die(); 

            if($Professors->posts){
              echo '<hr class="section-break">';
              echo '<h2>Professors Of this Subject</h2>';
              echo '<ul class="professor-cards">';
              while ( $Professors->have_posts()) {
                $Professors->the_post();
                ?>
                <li class="professor-card__list-item">
                  <a class="professor-card" href="<?php the_permalink() ?>">
                    <img src="<?php the_post_thumbnail_url('ProfessorLandScape'); ?>" alt="" class="professor-card__image">
                    <span class="professor-card__name"><?php the_title(); ?></span>
                  </a>
                </li>
              <?php }
              echo '</ul>';
              }
        ?>
    </div>
    

    
  <?php }
  get_footer();

?>