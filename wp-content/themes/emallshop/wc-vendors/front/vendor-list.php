<?php 
/*
*	Template Variables available 
*   $shop_name : pv_shop_name
*   $shop_description : pv_shop_description (completely sanitized)
*   $shop_link : the vendor shop link 
*   $vendor_id  : current vendor id for customization 
*/

$grid_column=(12/ (emallshop_get_option('vendor-list-per-row', 3)));
$classes= 'col-xs-6 col-md-'. $grid_column;
?>

<div class="vendor_list <?php echo esc_attr($classes);?>">
		<center>
		<a href="<?php echo $shop_link; ?>"><?php echo get_avatar($vendor_id, 200); ?></a><br />
		<a href="<?php echo $shop_link; ?>" class="button"><?php echo $shop_name; ?></a>
		<br /><br />
		</center>
</div>
