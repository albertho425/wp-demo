<?php
/**
 * Block Name: Favorite Food
 */

$id = 'favorite-food-' . $block['id'];
//conditional assignment
//if defined, create a new class
$align_class = $block['align'] ? 'align' . $block['align'] : '';
// $align_class = $block['align'] ? 'align' . $block['align']
?>

<!-- generate markup for the block -->
<div class="favorite-food <?php echo $align_class; ?>" id="<?php echo $id; ?>">
<!-- https://www.advancedcustomfields.com/resources/the_field/ -->
    <h4><?php the_field( 'title' ); ?></h4>
    
	<div class="food-appetizer"><?php the_field( 'appetizer' ); ?></div>
    <div class="food-entree"><?php the_field( 'entree' ); ?></div>
    <div class="food-dessert"><?php the_field( 'dessert' ); ?></div>
</div>

<!-- styling for block in admin area and front end -->

<style type="text/css">

.favorite-food{
    color: black;
    
}

.food-appetizer {
    background: #CFCFCF;
    border: 1px solid #666666;
	margin: 15px;
    padding: 15px;
	
    color: black;
}

.food-entree {
	background: #CFCFCF;
	border: 1px solid #666666;
	margin: 15px;
    padding: 15px;
    color: black;
}

.food-dessert {
	background: #CFCFCF;
	border: 1px solid #666666;
	margin: 15px;
    padding: 15px;
    color: black;;
}

.favorite-food h4 {
    /* border-bottom: #666666;
    color: blue; */
}
</style>