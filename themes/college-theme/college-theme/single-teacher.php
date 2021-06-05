<!-- page template for teacher post type posts -->

<?php
get_header();
while (have_posts()) {

    the_post(); 
    pageBanner();
    ?>

  

 <!-- center the content in a container -->
 <div class="container container--narrow page-section">
    <!-- for testing only. -->
    <?php //print_r($pageBannerImage); ?>

 <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" 
         
         href="<?php echo get_post_type_archive_link('teacher');  ?>"><i class="fa fa-home" aria-hidden="true"></i> Events Home</a> 
         <span class="metabox__main"><?php the_title();?>
 </div>
  <!-- metabox -->
 

<!-- display the post content -->
 <div class="generic-content">
        <div class="row group">

            <div class="one-third">
                <?php the_post_thumbnail('teacherPortrait'); ?>
            </div>

            <div class="two-thirds">
                <?php the_content(); ?>
            </div>
    
        </div> <!-- row group -->
   
<?php

      $relatedPrograms = get_field('related_programs');
      $eventDate = get_field('event_date');
      

      // check if the event has any realted programs
      if ($relatedPrograms)
      {
        echo '<hr class="section-break">';
        echo '<h3 class="headline headline--medium">Subject(s) Taught</h2>';
        echo '<ul class="link-list min-list">';
  
        forEach($relatedPrograms as $program) { ?>
          <li><a href="<?php echo get_the_permalink($program); ?>">
          <?php echo get_the_title($program); ?></a></li>
  
          
        
        <?php }
  
      }


      
      // print_r($relatedPrograms);

      echo '</ul>';
  
?>
</div> <!-- generic content -->


        
        

</div> <!-- container -->

<?php }
get_footer();
?>