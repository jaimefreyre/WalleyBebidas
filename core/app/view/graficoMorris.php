

<script type="text/javascript">
Morris.Donut({
  element: 'are',
  data: [
 	<?php foreach($products as $product):
 		$q=OperationData::getQYesF($product->id);?>
		<?php if($q == 0){ ?>
		<?php }else { ?> 
	  		{label:'<?php echo $product->name; ?>', value: <?php echo $q; ?>},
		<?} ?>
		<?php if( end($products)->id == $product->id){ ?>
	  		{label:'<?php echo $product->name; ?>', value: <?php echo $q; ?>}
		<?php } ?>
	<?php endforeach?>
  ]
});
</script>