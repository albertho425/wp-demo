<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

?>
<?php astra_entry_before();?>

<article <?php echo astra_attr('article-single',
	array('id'=> 'post-'. get_the_id(),
		'class'=> join(' ', get_post_class()),
	));
?>>
<?php astra_entry_top();?>

<?php astra_entry_content_single();
?>

<?php 

// Display our custom fields in entry_content_single

// check that location is not empty
if (get_field('location')) {
	echo '<p class="location"><b>Location:</b> '. get_field('location') . '</p>';
}

// check that profile description is not empty
if (get_field('profile_description')) {
	//print the field
	the_field('profile_description');
}

// check that resume section is not empty
if (get_field('resume')) {
	echo '<p class="resume"><b>My Resume</b> </p>';

}
 
// https://www.advancedcustomfields.com/resources/have_rows/
if(have_rows('resume')) {
	echo '<div class="resume">';
	$format='<section class="resume-section">
<h4><span class="date">%1$s</span><span class="title">%2$s</span></h4><div class="simple-description">%3$s</div>%4$s </section>';


	// https://www.advancedcustomfields.com/resources/have_rows/
	while (have_rows('resume')) {
		the_row();
		// Set and format variables
		$title=get_sub_field('title');
		$simple_description=get_sub_field('simple_description');
		$start_date=get_sub_field('start_date');
		$end_date=get_sub_field('end_date');
		$full_description=get_sub_field('full_description');

		//if end date has a value, add start date, hyphen, end date. otherwise just list start date

		$dates=($end_date) ? $start_date . ' - '. $end_date: $start_date;

		printf($format,
			$dates,
			$title,
			$simple_description,
			$full_description);
	}

	echo '</div>';
}

// check that projects section is not empty
if (get_field('projects')) {
	echo '<p class="projects"><b>Projects</b> </p>';

}

// https://www.advancedcustomfields.com/resources/have_rows/
if(have_rows('projects')) {
	echo '<div class="projects">';
	$format='<section class="projects-section">
<h4><span class="date">%1$s</span><span class="title">%2$s</span></h4><div class="simple-description">%3$s</div>%4$s </section>';


	// https://www.advancedcustomfields.com/resources/have_rows/
	while (have_rows('projects')) {
		the_row();
		// Set and format variables
		$title=get_sub_field('title');
		$simple_description=get_sub_field('simple_description');
		$start_date=get_sub_field('start_date');
		$end_date=get_sub_field('end_date');
		$full_description=get_sub_field('full_description');

		//if end date has a value, add start date, hyphen, end date. otherwise just list start date

		$dates=($end_date) ? $start_date . ' - '. $end_date: $start_date;

		printf($format,
			$dates,
			$title,
			$simple_description,
			$full_description);
	}

	echo '</div>';
}
//show the friends relation post object that we defined in ACF
$friends=get_field('friends');

// check friends is not empty
if($friends) {
	echo '<h4>Friends</h4>
<ul class="profile-friends">';

	$format='<li><a href="%1$s" title="%2$s">%3$s</a></li>';

	foreach($friends as $post) {
		setup_postdata($post);
		printf($format,
			get_permalink(),
			get_the_title(),
			get_the_post_thumbnail(get_the_ID(), 'large'));
	}

	wp_reset_postdata();
	echo '</ul>';
}

?><?php astra_entry_bottom();
?></article><!-- #post-## --><?php astra_entry_after();
?>