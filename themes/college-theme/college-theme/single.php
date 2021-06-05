<!-- page template for a single blog post -->
<!-- note single.php and page.php are similar to one another -->

<?php
get_header();
pageBanner();
while (have_posts()) {

    the_post(); ?>

<!-- pageBanner() function takes care of the page-banner div below -->

<!-- <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(
        <?php //echo get_theme_file_uri('images/ocean.jpg') ?>);">
    </div>
    
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php //the_title(); ?></h1>
      <div class="page-banner__intro">
        <p>Replace me later</p>
      </div>
    </div>  
  </div>  page-banner -->
  

 <!-- center the content in a container -->
 <div class="container container--narrow page-section">

 <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" 
         
         href="<?php echo site_url('/blog');  ?>"><i class="fa fa-home" aria-hidden="true"></i> Blog Home</a> 
         <span class="metabox__main">Posted by <?php the_author_posts_link();  ?> on <?php the_time('d-M-Y'); ?> Posted by <?php the_author_posts_link();  ?> on <?php the_time('d-M-Y'); ?> in 
            <!-- list one or more category, seperated by seperator -->
            <?php echo get_the_category_list(', ');?></span></p>
 </div> <!-- metabox -->
 

<!-- display the post content -->
 <div class="generic-content">
    <?php the_content(); ?>
</div>

        
        <!-- list one or more category, seperated by seperator -->
        <?php echo get_the_category_list(', ');?>

</div> <!-- container -->

<?php }
get_footer();
?>