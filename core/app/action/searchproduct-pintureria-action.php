
<!-- <?php print_r( $_SESSION["user_id"] ) ?> -->
<?php if(isset($_GET["product"]) && $_GET["product"]!=""):?>
	<?php
//Todos los productos del Stock
$products = ProductData::getLike($_GET["product"]);

//Prodctos Vendidos por sucursal
// $products = ProductData::disponibleXsucursalXdetalle($_GET["product"], $_SESSION["user_id"]);
if(count($products)>0){
	?>
<h3>Resultados de la Busqueda</h3>
<table class="table table-bordered table-hover">
	<thead>
		<th>Codigo</th>
		<th>Nombre</th>
		<th>Unidad</th>
		<th>Precio unitario</th>
		<th>En inventario</th>
		<th>Sucursal</th>
		<th>Cantidad</th>
	</thead>
	<?php
	$products_in_cero=0;
	 foreach($products as $product):
		$q= OperationData::contadorXsucursal($product->id, $_SESSION["user_id"]);
		?>
		<?php 
		if($q>0 ):?>
		
		<tr class="<?php if( $q<=$product->inventary_min ){ echo "danger"; }?>">
			<td style="width:80px;"><?php echo $product->id; ?></td>
			<td><?php echo $product->name; ?></td>
			<td><?php echo $product->unit; ?></td>
			<td><b>$<?php echo $product->user_id; ?></b></td>
			<td>
				<?php echo $q; ?>
			</td>
			<td>
				<?php print_r( UserData::getById($_SESSION["user_id"])->username )?>
			</td>
			<td style="width:250px;">
				<form method="post" action="index.php?view=addtocart">
					<input type="hidden" name="product_id" value="<?php echo $product->id; ?>">

				<div class="input-group">
					<input type="" class="form-control" required name="q" placeholder="Cantidad ...">
			      <span class="input-group-btn">
					<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Agregar</button>
			      </span>
			    </div>

				</form>
			</td>
		</tr>
		
		<?php else:$products_in_cero++;?>
		<?php  endif; ?>
	<?php endforeach;?>
</table>
<?php if($products_in_cero>0){ echo "<p class='alert alert-warning'>Se omitieron <b>$products_in_cero productos</b> que no tienen existencias en el inventario total o de esta sucursal. <a href='index.php?view=inventary'>Ir al Inventario</a> </p>"; }?>

	<?php
}else{
	echo "<br><p class='alert alert-danger'>No se encontro el producto</p>";
}
?>
<hr><br>
<?php else:
?>
<?php endif; ?>