<!-- page template for academic program post type -->

<!-- error, infinite while loop on single-program page when there is a teacher. chapter 33 -->
<!-- error: teachers li is showing chapter 34
error: only 1 teacher showing chapter 34 -->

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
            
            href="<?php echo get_post_type_archive_link('program');  ?>"><i class="fa fa-home" aria-hidden="true"></i> Programs Home</a> 
            <span class="metabox__main"><?php the_title();?>
    </div> <!-- metabox -->
    

  <!-- display the post content -->
  <div class="generic-content"> <?php the_content(); ?></div>  
  
  <?php 
            /**
             *  Display the relational post type teachers
             */
             $relatedTeachers = new WP_Query(array(
                
              //-1 will display all queries meeting the requiremnts
              'posts_per_page' => -1,
              'post_type' => 'teacher',
              'orderby' => 'title',
              'order' => 'ASC',
              'meta_query' => array(
                  
                  array(
                    'key' => 'related_programs',
                    'compare' => 'LIKE',
                    // we are searching for "100" not 100
                    'value' => '"' . get_the_ID() . '"'

                  )
              )
          ));
          // If the program has a related teacher
          if ($relatedTeachers->have_posts()) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium"> ' .    get_the_title() . ' Teachers</h2>';
            echo '<ul class="professor-cards">';

           while($relatedTeachers->have_posts()) {
                // get the data ready for each post
               $relatedTeachers->the_post(); ?>

                <!-- display the teacher -->
                <li class="professor-card__list-item">
                  <a class="professor-card" href="<?php the_permalink();?>">
                    <img class="professor-card__image" src="<?php the_post_thumbnail_url('teacherLandscape');?>">
                    <span class="professor-card__name"><?php the_title();  ?></span>
                  </a>
                </li> 
                 
          <?php  } // while($relatedTeachers>have_posts()) 
                              
          echo '</ul>';
          
          } // close if statement

          wp_reset_postdata();

            /**
             * display relational post type upcoming events for this program
             */

            $today = date('Ymd');
            //custom query to show events custom post type
            $homePageEvents = new WP_Query(array(
                
                //-1 will display all queries meeting the requiremnts
                'posts_per_page' => 2,
                'post_type' => 'event',
                'meta_key' => 'event_date',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'meta_query' => array(
                    array(

                      // Filter #1: events from today

                        'key' =>  'event_date',
                        'compare' => '>=',
                        'value' => $today
                        // 'type' => 'numeric'

                    ),
                    // Filter #2: related program
                    array(
                      'key' => 'related_programs',
                      'compare' => 'LIKE',
                      // we are search for "100" not 100
                      'value' => '"' . get_the_ID() . '"'

                    )
                )
            ));
            if ($homePageEvents->have_posts()) {
              echo '<hr class="section-break">';
              echo '<h2 class="headline headline--medium">Upcoming ' .  get_the_title() . ' Events</h2>';

              while($homePageEvents->have_posts()) {
                  //get the data ready for each post
                  $homePageEvents->the_post();
                  get_template_part('template-parts/content', 'event');           
              } //while($homePageEvents->have_posts()) {
              
            } // close the if stattment $homePageEvents->have_posts()

            wp_reset_postdata();
            //related_campus is an avanced custom field with realtionship
            $relatedCampuses = get_field('related_campus');

            if ($relatedCampuses) {

              echo '<hr class="section-break>';
              echo '<h2 class="headline headline--medium">' .  get_the_title() . ' is available at these campuses</h2>';

              echo '<ul class="min-list link-list">';
              foreach($relatedCampuses as $campus) {
                ?><li><a href="<?php echo get_the_permalink($campus); ?>"> 
                               <?php echo get_the_title($campus); ?></a></li>

                <?php } // end foreach loop

            } // end if statement

            echo '</ul>';

            ?>
           </div>

  
  

</div> <!-- container -->

<?php } //end while loop
get_footer();
?>