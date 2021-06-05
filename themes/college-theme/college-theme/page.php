<!-- page template for a single page -->
<!-- note single.php and page.php are similar to one another -->


<?php
get_header();

while (have_posts()) {
    the_post();
    
    //this function is in functions.php
    pageBanner(array(
      // 'title' => 'Hello this is the title',
      // 'subtitle' => 'This is the subtitle',
      // 'photo' => 'https://www.nbcsports.com/sites/rsnunited/files/styles/responsive_background_mobile/public/gallery/hero/Steph-Curry-Nikola-Jokic-USA-15931824.jpg'
    ));

?>


  <!-- center the content in a container -->
  <div class="container container--narrow page-section">

    <?php

        // retirms an interger value of the parent
        $theParent = wp_get_post_parent_id(get_the_ID());

        // show breadcrumbs of it page has sub-pages
        if ($theParent) { ?>

            <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); ?></a> <span class="metabox__main"><?php the_title(); ?></span></p>
            </div>

        <?php }

    ?>

    <?php 

    /**
     * if the current page has children, return a colleciton of children.
     * if current page has no children, this function will return nothing 
     */
    $sampleArray = get_pages(array(
        
        
        'child_of' => get_the_ID(  )
    ));
    /**
     * if the current page has children, return a colleciton of children.
     * if current page has no children, this function will return nothing 
     */
    
    if ( $theParent or $sampleArray ) { ?>


    <div class="page-links">
       <!-- Dynamically Display URL and title of parent page -->
      <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent);?>"><?php echo get_the_title($theParent);?></a></h2>
      <ul class="min-list">
        
        <!-- Dynamically Display dynamic sidebar menu -->
        <?php 

        // If you are on parent page, there is no parent
        if ($theParent) {
            $findChildrenOf = $theParent;
        } else {
            $findChildrenOf = get_the_ID();
        }

        //Display the menu on the sidebar if it is a sub page
        wp_list_pages(array(
            'title_li' => NULL,
            'child_of' => $findChildrenOf,
            //alows you to change the order of sub menu pages
            //go to admin dashboard and sort the pages in the order you want
            'sort_column' => 'menu_order'
        ));
        ?>
      </ul>
    </div>
    <?php } ?>

    <div class="generic-content">
      <?php the_content();?>
    </div>

  </div>

    
<?php }

get_footer();

?>