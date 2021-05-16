<?php
/**
 * Block Name: Favorite Tech Stack
 */

$id = 'fav-tech-stack-' . $block['id'];
//conditional assignment
//if defined, create a new class
$align_class = $block['align'] ? 'align' . $block['align'] : '';
// $align_class = $block['align'] ? 'align' . $block['align']
?>

<!-- generate markup for the block -->
<div class="fav-tech-stack <?php echo $align_class; ?>" id="<?php echo $id; ?>">
<!-- https://www.advancedcustomfields.com/resources/the_field/ -->
    <h4><?php the_field( 'title' ); ?></h4>
	
    <!-- https://www.advancedcustomfields.com/resources/image/ -->
    <!-- <div class="tech-image"><?php the_field( 'image' ); ?></div> -->

<?php 
// display imaage
$image = get_field('image');
if( !empty( $image ) ): 
?>
<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
<?php endif; ?>
    
<!-- display operating system -->
<div class="tech-os">
    <!-- https://www.advancedcustomfields.com/resources/get_field_object/ -->
   <?php $field = get_field_object('os'); ?>
   <p><?php echo $field['label']; ?>: <?php echo $field['value']; ?></p>
</div>

<!-- display programming language -->
<div class="tech-programming-languages">
    <!-- https://www.advancedcustomfields.com/resources/get_field_object/ -->
    <?php $field = get_field_object('programming_languages'); ?>
    <p><?php echo $field['label']; ?>: <?php echo $field['value']; ?></p>
</div>

<!-- display database -->
<div class="tech-database">
    <!-- https://www.advancedcustomfields.com/resources/get_field_object/ -->
    <?php $field = get_field_object('database'); ?>
    <p><?php echo $field['label']; ?>: <?php echo $field['value']; ?></p>
</div>


<!-- styling for this block in admin area and front end -->

<style type="text/css">
.fav-tech-stack {
	/* background: #CFCFCF; */
	border: 1px solid #666666;
	margin: 15px;
    padding: 15px;
    color: black;
}

.tech-os  {
    background: #CFCFCF;
    border: 1px solid #666666;
	margin: 15px;
    padding: 15px;
    color: black;
}

.tech-programming-languages {
    background: #CFCFCF;
    border: 1px solid #666666;
	margin: 15px;
    padding: 15px;
    color: black;
}

.tech-database  {
    background: #CFCFCF;
    border: 1px solid #666666;
	margin: 15px;
    padding: 15px;
    color: black; 
}
</style>