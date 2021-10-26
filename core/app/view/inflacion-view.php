<?php
//Inicio las variables del Script
$porcentaje = floatval($_GET["xsen"]);
// echo gettype($porcentaje), "<br>";

//Guardar
$guardar = $_GET["guardar"];

$categoriaId = $_GET["CID"];
$todos_los_productos = null;
print_r('Categoria: ');
print_r($categoriaId);
print_r('<br>');
print_r('Porcentaje de Aumento: ');
print_r($porcentaje);
$todos_los_productos = ProductData::getAllByCategoryId($categoriaId);
// print_r($todos_los_productos);
print_r('<br>');
print_r('<hr>');



?>
<div class="row">
	<div class="col-md-12">
	<?php
	function Inflacion($todos_los_productos, $porcentaje, $guardar)
		{
		 
			foreach ($todos_los_productos as $productoInd) {
			 	if(count($productoInd)>0){
			 		// $product = ProductData::getById($productoInd->id);
			 		
			 		print_r('Nombre del Producto: ');
			 		print_r($productoInd->name);
			 		print_r('<br>');
			 		print_r($productoInd->name . ' valor precio entrada = ');
			 		print_r($productoInd->price_in);
			 		print_r('<br>');
			 		print_r(' valor precio Menor Margen = ');
			 		print_r($productoInd->price_out);
			 		print_r('<br>');
			 		print_r(' valor precio Mayor Margen = ');
			 		print_r($productoInd->user_id);
			 		print_r('<br>');

			 		$productoInd->price_in = $productoInd->price_in + $productoInd->price_in * ($porcentaje / 100);
			 		$productoInd->price_out =$productoInd->price_out + $productoInd->price_out * ($porcentaje / 100);
			 		$productoInd->user_id = $productoInd->user_id + $productoInd->user_id * ($porcentaje / 100);
			 		
			 		print_r(' valor con inflacion = ');
			 		print_r(' Costo = ');
			 		print_r($productoInd->price_in);
			 		print_r('<br>');
			 		print_r(' Venta con Menor Margen = ');
			 		print_r($productoInd->price_out);
			 		print_r('<br>');
			 		print_r(' Venta con Mayor Margen = ');
			 		print_r($productoInd->user_id);
			 		print_r('<br>');
			 		// print_r($productoInd);
			 		print_r('<br>');
			 		print_r('<hr>');
			 			
					if ($guardar) {
						$productoInd->update();
						setcookie("prdupd","true");
						// print "<script>setTimeout(function(){ window.location='index.php?view=categories' }, 600);</script>";
					}
					// $product->price_out = $productoInd["price_out"];
			 	}
			}
			if($guardar){
				print '<a class="btn btn-success btn-xs " href="index.php?view=products">Operacion Exitosa</a>';
				// print "<script>setTimeout(function(){ window.location='index.php?view=categories' }, 60000);</script>";
			}

		};

		inflacion($todos_los_productos, $porcentaje, $guardar);
		// index.php ? >view=editcategory&id=<?php echo $user->id;? >
	?>

	<?php if ($guardar){
	}else{
	?>

	<a class="btn btn-success btn-xs " href="index.php?view=inflacion&xsen=<?php echo $porcentaje;?>&CID=<?php echo $categoriaId;?>&guardar=true" id="ok">Confirmar Operacion</a>
	<a class="btn btn-danger btn-xs " href="index.php?view=categories">Cancelar Operacion</a>
	<?php
	}; 
	?>



	</div>
</div>