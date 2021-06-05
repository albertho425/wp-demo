
<div class="event-summary">
                <a class="event-summary__date t-center" href="
                <?php the_permalink();?>">
                <span class="event-summary__month">
                <?php 
                
                // We will print out the custom field date of the event instead of the date of the posting 

                // Note the advanced custom field of the event date field must have display format and return format to be identical otherwise DateTime will throw error

                //use PHP DateTime
                $eventDate = new DateTime(get_field('event_date'));
                echo $eventDate -> format('M');
                
                //display the custom field 
                // the_field('event_date');
                
                //display the posting date of the event post type
                //the_time('M');
                
                ?></span>
                <span class="event-summary__day">
                <?php 
                echo $eventDate -> format('d');
                ?></span>
                </a>

                <!-- The code below will determine how much of an exerpt to show -->
                <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a href="
                    <?php the_permalink();?>"><?php the_title();?></a></h5>
                    
                    <p><?php if (has_excerpt()){
                        // the_excerpt();
                        echo get_the_excerpt();
                    }else{
                        echo wp_trim_words(get_the_content(), 10);
                    }
                    ?>
                    <br><a href="<?php the_permalink();?>" class="nu gray">Learn more</a></p>

                </div> <!-- events summery content -->
          </div> <!-- events summery -->

        