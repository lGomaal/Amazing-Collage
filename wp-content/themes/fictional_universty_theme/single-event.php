<?php
  
  get_header();
  /* This file is responsible for the rendering of the single event type-post */
  while(have_posts()) {
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
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Events Home</a> <span class="metabox__main"><?php the_title(); ?></span></p>
      </div>

      <div class="generic-content"><?php the_content(); ?></div>
      <?php
        $ProgramsRelated = get_post_meta(get_the_ID(),'ProgramsEventPosts', true);
        if($ProgramsRelated){
        echo '<h2>Related programs</h2>';
        echo '<ul>';
        foreach ( $ProgramsRelated as $prog) {?>
          <li><a href="<?php echo get_the_permalink($prog) ?>"><?php echo get_the_title($prog) ?></a></li>
        <?php }
        echo '</ul>';
        }
      ?>
    </div>
    

    
  <?php }

  get_footer();

?>