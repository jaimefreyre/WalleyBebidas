<?php ?>
<div class="row">
	<div class="col-md-12">
<!-- Single button -->
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="report/inventary-word.php">Word 2007 (.docx)</a></li>
  </ul>
</div>
		<h1><i class="glyphicon glyphicon-stats"></i> Inventario de Productos Sucursal <?php  echo UserData::getById($_SESSION["user_id"])->username; ?></h1>
		<div class="clearfix"></div>
		<div id="are" ></div>
		<div id="area-example" ></div>





<?php
$page = 1;
if(isset($_GET["page"])){
	$page=$_GET["page"];
}
$limit=10;
if(isset($_GET["limit"]) && $_GET["limit"]!="" && $_GET["limit"]!=$limit){
	$limit=$_GET["limit"];
}
$products = ProductData::getAll();
//$products = ProductData::disponibleXsucursal( $_SESSION["user_id"]);

if(count($products)>0){



if($page==1){
$curr_products = ProductData::getAllByPage($products[0]->id,$limit);
}else{
$curr_products = ProductData::getAllByPage($products[($page-1)*$limit]->id,$limit);

}
$npaginas = floor(count($products)/$limit);
 $spaginas = count($products)%$limit;

if($spaginas>0){ $npaginas++;}

	?>


<script type="text/javascript">
	Morris.Donut({
	  element: 'are',
	  data: [
	 	<?php foreach($products as $product):
	 		$q=OperationData::contadorXsucursal($product->id, $_SESSION["user_id"]);
	 		if($q !== 0): ?>
				<?php if( end($products)->id == $product->id): ?>
		  			{label:'<?php echo $product->name; ?>', value: <?php echo $q; ?>}
				<?php else: ?>			
				{label:'<?php echo $product->name; ?>', value: <?php echo $q; ?>},
				<?php endif; ?>
			<?php endif; ?>
		<?php endforeach;?>
	  ]
	});
	
	<?php 
	$inventarioQHay = array();
	foreach($products as $product):
 		$q=OperationData::contadorXsucursal($product->id, $_SESSION["user_id"]);
 		if($q !== 0): 
			$product->q = $q;
			array_push($inventarioQHay, $product);
		?>
		<?php endif; ?>
	<?php endforeach;?>

	var datosProductos = <?php print_r( json_encode($inventarioQHay) ); ?>;
	// console.log(datosProductos)

	// let indice = "";
	// $.each( datosProductos, function( key1, datosProductos2 ) {
	// 	if(key1== 0){
	// 	indice+= '<tr>';
	// 		$.each(datosProductos2, function( k, v ) {
	// 			indice+= '<tr>' +k+ '</tr>';
	// 			console.log( "Key: " + k + ", Value: " + v );
	// 		});
	// 	indice+= '<tr>';
	// 	}
	// });
	// console.log(indice)

	let valores='';
	$.each( datosProductos, function( key1, datosProductos2 ) {
		valores+= '<tr>';
		$.each( datosProductos2, function( key, value ) {
		  	if((key == 'image') || (key == 'created_at') || (key == 'presentation')|| (key == 'description')|| (key == 'unit')|| (key == 'is_active')){

		  	}
		  	else{
		  		valores+= '<td>'+value+'</td>';
		  	}
		  	// console.log( key + ": " + value );
		});
		valores+= '</tr>';
	});
	// console.log(valores)
	
	$(document).ready(function($) {
		// $('#indices_p').html(indice)
		$('#datos_p').html(valores)
	});
	// $('#indices_p').append()
</script>





<h2 onclick="$('#enstock').toggle();">Productos en Stock <small>Click aqui para ver o ocultar productos en stock</small></h2>

<table class="table table-bordered table-hover" id="enstock" style="display: none;">
	<thead>
		<td>Nombre</td>
		<td>Costo</td>
		<td>Precio 1</td>
		<td>Precio 2</td>
		<td>Id</td>
		<td>Barcode</td>
		<td>Minimo</td>
		<td>Categoria</td>
		<td>Stock</td>
	</thead>
	<tbody id="datos_p">
	</tbody> 
</table>

<h2 onclick="$('#todos').toggle();">Todos los Productos <small>Click aqui para ver o ocultar estado de productos en total</small></h2>
<div id="todos" style="display: none;">
<br>
<table class="table table-bordered table-hover">
	<thead>
		<th>Codigo</th>
		<th>Nombre</th>
		<th>Disponibles</th>
		<th>Minimo</th>
		<th>Sucursal</th>
		<th></th>
	</thead>
	<style type="text/css">
		.noseve{ !important}
	</style>
	<?php foreach($curr_products as $product):
	$q=OperationData::contadorXsucursal($product->id, $_SESSION["user_id"]);
	?>
	<tr  class="<?php if($q<=0){ echo "noseve";} else if($q<=$product->inventary_min){ echo "warning";} else if($q<=$product->inventary_min/2){ echo "danger";}?>">
		<td><?php echo $product->id; ?></td>
		<td><?php echo $product->name; ?></td>
		<td>
			
			<?php echo $q; ?>

		</td>
		<td><?php echo $product->inventary_min; ?></td>
		<td><?php echo UserData::getById($_SESSION["user_id"])->username; ?></td>
		<td style="width:93px;">
<!--		<a href="index.php?view=input&product_id=<?php echo $product->id; ?>" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-circle-arrow-up"></i> Alta</a>-->
		<a href="index.php?view=history&product_id=<?php echo $product->id; ?>" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-time"></i> Historial</a>
		</td>
	</tr>
	<?php endforeach;?>
</table>
<div class="btn-group pull-right">
<?php

for($i=0;$i<$npaginas;$i++){
	echo "<a href='index.php?view=inventaryuser&limit=$limit&page=".($i+1)."' class='btn btn-default btn-sm'>".($i+1)."</a> ";
}
?>
</div>
<form class="form-inline">
	<label for="limit">Limite</label>
	<input type="hidden" name="view" value="inventaryuser">
	<input type="number" value=<?php echo $limit?> name="limit" style="width:100px;" class="form-control">
</form>
	


	<h3>Pagina <?php echo $page." de ".$npaginas; ?></h3>
<div class="btn-group pull-right">
<?php
$px=$page-1;
if($px>0):
?>
<a class="btn btn-sm btn-default" href="<?php echo "index.php?view=inventaryuser&limit=$limit&page=".($px); ?>"><i class="glyphicon glyphicon-chevron-left"></i> Atras </a>
<?php endif; ?>

<?php 
$px=$page+1;
if($px<=$npaginas):
?>
<a class="btn btn-sm btn-default" href="<?php echo "index.php?view=inventaryuser&limit=$limit&page=".($px); ?>">Adelante <i class="glyphicon glyphicon-chevron-right"></i></a>
<?php endif; ?>
</div>
<div class="clearfix"></div>
	
</div>


<div class="clearfix"></div>

	<?php
}else{
	?>
	<div class="jumbotron">
		<h2>No hay productos</h2>
		<p>No se han agregado productos a la base de datos, puedes agregar uno dando click en el boton <b>"Agregar Producto"</b>.</p>
	</div>
	<?php
}

?>
<br><br><br><br><br><br><br><br><br><br>
	</div>
</div>