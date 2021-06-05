
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
            
            href="<?php echo get_post_type_archive_link('campus');  ?>"><i class="fa fa-home" aria-hidden="true"></i> Campus Home</a> 
            <span class="metabox__main"><?php the_title();?>
    </div> <!-- metabox -->
    

<!-- display the post content -->
  <div class="generic-content">
      <?php the_content(); ?>
  </div>

  <div class = "acf-map">
  
    <?php $mapLocation = get_field('map_location'); ?>
  
      <!-- data attributes lattitude and longitute -->
      <div class="marker" data-lat="<?php echo $mapLocation['lat'] ?>"
            data-lng="<?php echo $mapLocation['lng'] ?>">
            <h3><?php the_title(); ?></h3>
     
    </div>  <!-- marker -->
     
       

      

</div>  <!-- acf-map -->
    
  <?php 
            /**
             *  Display the relational post type teachers
             */
             $relatedPrograms = new WP_Query(array(
                
              //-1 will display all queries meeting the requiremnts
              'posts_per_page' => -1,
              'post_type' => 'program',
              'orderby' => 'title',
              'order' => 'ASC',
              'meta_query' => array(
                  
                  array(
                    'key' => 'related_campus',
                    'compare' => 'LIKE',
                    // we are searching for "100" not 100
                    'value' => '"' . get_the_ID() . '"'

                  )
              )
          ));
          // If the campus has a related program
          if ($relatedPrograms->have_posts()) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">Programs available at this campus</h2>';

            echo '<ul class="min-list link-list">';
            while($relatedPrograms->have_posts()) {
                // get the data ready for each post
                $relatedPrograms->the_post(); ?>

                <!-- display the program -->
                <li>
                  <a href="<?php the_permalink();?>">
                    <?php the_title();  ?>
                  </a>
                </li>
                 
          <?php } // while($relatedTeachers>have_posts()) 
                              
          echo '</ul>';
          
          } // close if statement

          wp_reset_postdata();
        ?>

</div> 
<!-- container -->

<?php }   // close the while loop

get_footer();
?>