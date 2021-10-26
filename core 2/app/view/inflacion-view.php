<?php
//Inicio las variables del Script
$porcentaje = $_GET["xsen"];
$categoriaId = $_GET["CID"];
$todos_los_productos = null;
print_r($porcentaje);
// $todos_los_productos = ProductData::getAll();
$todos_los_productos = ProductData::getAllByCategoryId($categoriaId);

// if($categoriaId == null){
// //tomar todos los productos
// }
// else{
// //tomar todos los productos de una categoria por su id
// }

?>
<div class="row">
	<div class="col-md-12">
	<?php
	 foreach ($todos_los_productos as $productoInd) {
	 	if(count($productoInd)>0){
	 		// $product = ProductData::getById($productoInd->id);
	 		
	 		echo $productoInd->name + ' = ';
	 		print_r($productoInd->price_in);

	 		$productoInd->price_in = $productoInd->price_in + $productoInd->price_in * ($porcentaje / 100);
	 		$productoInd->price_out = $productoInd->price_out + $productoInd->price_out * ($porcentaje / 100);
	 		// $productoInd->price_in = $porcentaje;
	 		print_r(' = ');
	 		print_r($productoInd->price_in);
	 		print_r('<br>');
	 		
	 		$productoInd->update();
	// 		// $product->price_out = $productoInd["price_out"];
	 	}
	}

	// setcookie("prdupd","true");
	print "<script>setTimeout(function(){ window.location='index.php?view=categories' }, 6000);</script>";
	// index.php?view=editcategory&id=<?php echo $user->id;?>

	?>
	</div>
</div>