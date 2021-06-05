<!-- Page template for event archives -->
<!-- copy archive.php and modified -->
<?php

get_header(); 
pageBanner(array(
  'title' => 'All Programs',
  'subtitle' => 'See what our school offers'
))
?>

  <div class="container container--narrow page-section">
  
    <ul class="link-list min-list">
    <?php 
      
      while (have_posts()) {
        the_post(); ?>
        <li><a href="<?php the_permalink();?>">
          <?php the_title(); ?>
        </a></li>
        

      <?php }
      // pagination
      echo paginate_links();
    ?>
  </ul>
</div> <!-- container -->
<hr class="section-break">
<?php get_footer();?>