<?php 
  // this php file handle the view of Author and Category related posts insted of using index.php.
  get_header(); ?>
  
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri("/images/ocean.jpg");?>);"></div>
    <div class="page-banner__content container container--narrow">
      <!-- the_archive_title() will fetch posts by itself based on the category,author,date,year,
      day,month and so on so its a good thing to us it-->
      <h1 class="page-banner__title"><?php the_archive_title(); ?></h1>
      <div class="page-banner__intro">
        <!-- this the_archive_description() is related with the Biografical_info for the Author,
        and for the category he will view the description of the category that u made.  -->
        <p><?php the_archive_description(); ?></p>
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
            <!-- the_excerpt() view a little bit of your content if u want to view it in a nice way -->
            <?php the_excerpt(); ?>
            <p><a class="btn btn--blue" href="<?php echo the_permalink() ?>">Continue Reading &raquo;</a></p>
          </div>
        </div>
     <?php }
    ?>
  </div>

 <?php get_footer();
?>