<?php 
  get_header(); ?>
  <!-- This file will handle the archive of the events like :www.localhost/sitename/events. -->
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri("/images/ocean.jpg");?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Past Events</h1>
      <div class="page-banner__intro">
        <p>A recap of whats happening in our World!</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">
    <?php 

        $past_events = new WP_Query([
            'paged' =>get_query_var('paged' ,1), //go and get the number at the end of the url and default is 1
            'posts_per_page' => 1,
            'post_type' => 'event',
            'meta_key' => 'DateEventPic',
            'order_by' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' =>[
              [
                'key'=> 'DateEventPic',
                'compare' =>'<',
                'value' => date("Y-m-d"),  // thats means today date with this formate
                'type' => 'numeric'
              ]
            ]
            ]); 
      
      while($past_events->have_posts()){
        $past_events->the_post();?>
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
                <p><?php echo wp_trim_words(get_the_content(),18);?>;<a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
              </div>
          </div>
     <?php }
         echo paginate_links([
             'total' => $past_events->max_num_pages
         ]);
    ?>
  </div>

 <?php 
    get_footer();
?>