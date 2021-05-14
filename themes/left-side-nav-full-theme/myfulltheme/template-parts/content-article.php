<div class="container">
	<header class="content-header">
        <div class="meta mb-3"><span class="date"><?php the_date(); ?></span>
        <?php

            // https://developer.wordpress.org/reference/functions/the_tags/
            the_tags('<span class="tag"><i class="fa fa-tag"></i>' ,'<span class="tag"><i class="fa fa-tag"></i></span>','</span>' );
        ?>
        
                    <span class="comment">
        <a href="#comments"><i class='fa fa-comment'></i><?php comments_number(); ?></a></span></div>
	</header>


<?php
 
    the_content();
    comments_template();
?>


</div>