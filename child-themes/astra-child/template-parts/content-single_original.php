<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

?><?php astra_entry_before();
?><article itemtype="https://schema.org/CreativeWork"itemscope="itemscope"id="post-<?php the_ID(); ?>"<?php post_class();
?>><?php astra_entry_top();
?><?php astra_entry_content_single();

?><?php if (get_field('location')) {
	echo '<p class="location"><b>Location:</b> '. get_field('location') . '</p>';
}

if (get_field('profile_description')) {
	the_field('profile_description');
}

if(have_rows('resume')) {
	echo '<div class="resume">';
	$format='<section class="resume-section">
<h4><span class="date">%1$s</span><span class="title">%2$s</span></h4><div class="simple-description">%3$s</div>%4$s </section>';


	while (have_rows('resume')) {
		the_row();
		// Set and format variables
		$title=get_sub_field('title');
		$simple_description=get_sub_field('simple_description');
		$start_date=get_sub_field('start_date');
		$end_date=get_sub_field('end_date');
		$full_description=get_sub_field('full_description');

		$dates=($end_date) ? $start_date . ' - '. $end_date: $start_date;

		printf($format,
			$dates,
			$title,
			$simple_description,
			$full_description);
	}

	echo '</div>';
}

//**** */ Friends section ***/

$friends=get_field('friends');

if($friends) {
	echo '<h4>Friends</h4>
<ul class="profile-friends">';

	$format='<li><a href="%1$s" title="%2$s">%3$s</a></li>';

	foreach($friends as $post) {
		setup_postdata($post);
		printf($format,
			get_permalink(),
			get_the_title(),
			get_the_post_thumbnail(get_the_ID(), 'medium'));
	}

	wp_reset_postdata();
	echo '</ul>';
}

?><?php astra_entry_bottom();
?></article><!-- #post-## --><?php astra_entry_after();
?>