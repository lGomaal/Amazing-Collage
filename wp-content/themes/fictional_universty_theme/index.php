<?php 
  // generic fall back for ur application , this is the jop of the index.php file
  get_header(); ?>
  
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri("/images/ocean.jpg");?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Welchome to our Blog</h1>
      <div class="page-banner__intro">
        <p>Keep up with the latiest news!</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">
    <?php 
      while(have_posts()){
        the_post();?>
        <div class="post-item">
          <h2><a class="headline headline--medium headline--post-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <div class="metabox">
            <p>Posted By <?php the_author_posts_link(); ?> on <?php the_time('n-j-Y') ?> in <?php echo get_the_category_list('& ') ?></p>
          </div>
          <div class="generic-content">
            <?php the_excerpt(); ?>
            <p><a class="btn btn--blue" href="<?php echo the_permalink() ?>">Continue Reading &raquo;</a></p>
          </div>
        </div>
     <?php }
      /* for pagination we use this as if we specigied the number of posts in the blog page in settings -Reading 
      the default value is 10. */
      echo paginate_links();
    ?>
  </div>

 <?php get_footer();
?>