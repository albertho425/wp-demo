<!-- Page template for blog -->
<!-- Also the last fall back for WordPress -->
<?php

get_header(); 
pageBanner(array(
  'title' => 'Welcome to our Blog',
  'subtitle' => 'Keep up with the latests posts'
));
?>

<!-- pageBanner in functions.php takes care of page-banner div below -->
<!-- <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(
    <?php //echo get_theme_file_uri('images/ocean.jpg') ?>);"></div>
    
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Welcome to our Blog</h1>
      <div class="page-banner__intro">
        <p>Keep up with the latests posts</p>
      </div>
    </div>  
  </div> -->

  <div class="container container--narrow page-section">
  
  <?php while (have_posts()) {
    the_post(); ?>
    <div class="post-item">
        <!-- dynamically genenerate the permalink and title of each post -->
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?>
        </a></h2>
     

        <div class="metabox">
        <!-- dynammically generate author, date, category(s) of each post -->
            <p>Posted by <?php the_author_posts_link();  ?> on <?php the_time('d-M-Y'); ?> in 
            <!-- list one or more category, seperated by seperator -->
            <?php echo get_the_category_list(', ');?></p>
        </div>    

        <div class="generic-content">
            <?php the_excerpt(); ?>
            <p><a class="btn btn--blue" href="<?php the_permalink(); 
             ?>">Continue Reading</a></p>
        </div>

    </div> <!-- post item -->
    
    <?php }
    // pagination
    echo paginate_links();
  ?>

  </div> <!-- container -->
  



<?php get_footer();

?>