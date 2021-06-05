<?php

get_header();

while (have_posts()) {
    pageBanner();
    the_post();

     ?>

 <!-- center the content in a container -->
 <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" 
            
            href="<?php echo get_post_type_archive_link('coffee');  ?>"><i class="fa fa-coffee" aria-hidden="true"></i> Coffee Shops</a> 
            <span class="metabox__main"><?php the_title();?>
    </div> <!-- metabox -->
    

<!-- display the post content -->
  <div class="generic-content">
      <?php the_content(); ?>
  </div>

  
  
    <?php $mapLocation = get_field('map_location'); 
    
    if( $mapLocation ): ?>
      <div class="acf-map" data-zoom="16">
          <div class="marker" data-lat="<?php echo esc_attr($mapLocation['lat']); ?>" data-lng="<?php echo esc_attr($mapLocation['lng']); ?>"></div>
      </div>
      <h3><?php the_title(); ?></h3>

      
  <?php endif; ?>
    

    
  
      
       

      


    


</div> 
<!-- container -->

<?php }   // close the while loop

get_footer();
?>