<?php // Template Name: New Profile


// This page uses reuses parts of Astra's page.php and content-page.php

//ACF function
// https://www.advancedcustomfields.com/resources/acf_form/
acf_form_head();

get_header();?>

<?php if (astra_page_layout()=='left-sidebar') : ?><?php get_sidebar();?>

<?php endif ?><div id="primary"<?php astra_primary_class();?>>

<article itemtype="https://schema.org/CreativeWork"itemscope="itemscope"id="post-<?php the_ID(); ?>"

<?php post_class();?>>

	<div class="entry-content clear"itemprop="text"><h1 class="entry-title"itemprop="headline"><?php the_title();?></h1>

		<?php the_content();?>

		<?php acf_form(array('post_id'=> 'new_post',
				'post_title'=> true,
				'post_content'=> true,
				'new_post'=> array('post_type'=> 'post',
				//admin has to approve the new form submission	
				'post_status'=> 'draft',
					// category ID can be found in admin dashboard-->posts-->categories
					'post_category'=> array(2),
				),
			));?>
	</div><!-- .entry-content .clear -->
</article>
</div> <!-- #primary -->

	<?php if (astra_page_layout()=='right-sidebar') : ?><?php get_sidebar();?>

	<?php endif ?>

	<?php get_footer();
?>