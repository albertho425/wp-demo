<?php
/**
 * Block Name: Favorite Quote
 */

$id = 'fav-quote-' . $block['id'];
//conditional assignment
//if defined, create a new class
$align_class = $block['align'] ? 'align' . $block['align'] : '';
// $align_class = $block['align'] ? 'align' . $block['align']
?>

<!-- generate markup for the block -->
<div class="fav-quote <?php echo $align_class; ?>" id="<?php echo $id; ?>">
<!-- https://www.advancedcustomfields.com/resources/the_field/ -->
    <h4><?php the_field( 'title' ); ?></h4>
	<div class="quote-description"><?php the_field( 'description' ); ?></div>
</div>

<!-- styling for block in admin area and front end -->

<style type="text/css">
.fav-quote {
	background: #CFCFCF;
	border: 1px solid #666666;
	margin: 15px;
    padding: 15px;
    color: red;
}



.fav-quote h4 {
    border-bottom: #666666;
    color: blue;
}
</style>