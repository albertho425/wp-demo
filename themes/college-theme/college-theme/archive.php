<!-- Page template for blog -->
<!-- for example archive.php takes care of archive for author or category  -->
<?php

get_header(); 
pageBanner(array(
  'title' => get_the_archive_title(),
  'subtitle' => get_the_archive_description()

))
?>

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