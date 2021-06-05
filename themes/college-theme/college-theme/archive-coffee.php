<!-- Page template for event campus -->
<?php
get_header(); 
pageBanner(array(
  'title' => 'Coffee Shops on Campus',
  'subtitle' => 'Get your caffeine fix on campus',
  'photo' => ''

));
?>
<div class="container container--narrow page-section">  
  <div class="acf-map">
  
  <?php 
    while (have_posts()) {
      the_post(); 
      $mapLocation = get_field('map_location'); 
      ?>  
      <!-- data attributes lattitude and longitute -->
      <div class="marker" data-lat="<?php echo $mapLocation['lat'] ?>"
            data-lng="<?php echo $mapLocation['lng'] ?>">
            <h3><a href="<?php the_permalink();?>"><?php the_title(); ?></h3></a>
     
        <?php echo $mapLocation['address']; ?>
      </div>  <!-- marker  -->
      

    <?php } // while (have_posts()) ?>

    </div>  <!-- acf-map -->
  </div> <!-- container -->
  
<?php get_footer();

?>