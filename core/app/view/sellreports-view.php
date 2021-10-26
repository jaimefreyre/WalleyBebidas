<?php
$clients = PersonData::getClients();
$Users= UserData::getAll();
?>
<section class="content">
<div class="row">
	<div class="col-xs-12 col-md-12">
	<h1>Reportes de Ventas</h1>

						<form>
						<input type="hidden" name="view" value="sellreports">
<div class="row">
<div class="col-xs-12 col-md-2">
	<label for="cid">Clientes</label>
	<select name="cid" class="form-control">
		<option value="">--  TODOS --</option>
		<?php foreach($clients as $p):?>
		<option value="<?php echo $p->id;?>"><?php echo $p->name;?></option>
		<?php endforeach; ?>
</select>
</div>

<div class="col-xs-12 col-md-2">
<label for="user_id">Sucursales</label>
<select name="user_id" class="form-control">
	<option value="">--  TODOS --</option>
	<?php foreach($Users as $p):?>
	<option value="<?php echo $p->id;?>"><?php echo $p->username;?></option>
	<?php endforeach; ?>
</select>
</div>
<!--
<select name="client_id" class="form-control">
	<option value="">--  TODOS --</option>
	<?php foreach($clients as $p):?>
	<option value="<?php echo $p->id;?>"><?php echo $p->name;?></option>
	<?php endforeach; ?>
</select>
-->

<div class="col-xs-12 col-md-3">
	<label for="sd">Desde</label>
	<input type="date" name="sd" value="<?php if(isset($_GET["sd"])){ echo $_GET["sd"]; }?>" class="form-control">
</div>
<div class="col-xs-12 col-md-3">
	<label for="ed">Hasta</label>
	<input type="date" name="ed" value="<?php if(isset($_GET["ed"])){ echo $_GET["ed"]; }?>" class="form-control">
</div>

<div class="col-xs-12 col-md-2">
	<label></label>
	<input type="submit" class="btn btn-success btn-block" value="Procesar">
</div>

</div>
<!--
<br>
<div class="row">
<div class="col-md-4">

<select name="mesero_id" class="form-control">
	<option value="">--  MESEROS --</option>
	<?php foreach($meseros as $p):?>
	<option value="<?php echo $p->id;?>"><?php echo $p->name;?></option>
	<?php endforeach; ?>
</select>

</div>

<div class="col-md-4">

<select name="operation_type_id" class="form-control">
	<option value="1">VENTA</option>
</select>

</div>

</div>
-->
</form>

	</div>
	</div>
<br><!--- -->
<div class="row">
	
	<div class="col-md-12">
		<?php if(isset($_GET["sd"]) && isset($_GET["ed"]) ):?>
		<?php if($_GET["sd"]!=""&&$_GET["ed"]!=""):?>
			<?php 
			$operations = array();

			if(($_GET["user_id"]=="") && ($_GET["cid"]=="")){
			$operations = SellData::getAllByDateOp($_GET["sd"],$_GET["ed"],2);
			}
			elseif($_GET["user_id"]) {
				$operations = SellData::g_dat_usuarioyfecha($_GET["user_id"],$_GET["sd"],$_GET["ed"],2);
			}
			elseif($_GET["cid"]) {
				$operations = SellData::getAllByDateBCOp($_GET["cid"],$_GET["sd"],$_GET["ed"],2);
			}
			else{
			$operations = SellData::g_dat_usuarioyfecha($_GET["user_id"],$_GET["cid"],$_GET["sd"],$_GET["ed"],2);
			} 


			 ?>

			 <?php if(count($operations)>0):?>
			 	<?php $supertotal = 0; ?>
<table class="table table-bordered">
	<thead>
		<th>Id</th>
		<th>Sucursal</th>
		<th>Cliente</th>
		<th>Subtotal</th>
		<th>Descuento</th>
		<th>Total</th>
		<th>Fecha</th>
	</thead>
<?php foreach($operations as $operation):?>
	<tr>
		<td><?php echo $operation->id; ?></td>
		<td><?php echo UserData::getById($operation->user_id)->username; ?></td>
		<td><?php if( $operation->person_id == ''){
					echo 'Cliente anonimo';
				}
				else {
					echo PersonData::getById($operation->person_id)->name;
				}
		 ?></td>
		<td>$ <?php echo number_format($operation->total,2,'.',','); ?></td>
		<td>$ <?php echo number_format($operation->discount,2,'.',','); ?></td>
		<td>$ <?php echo number_format($operation->total-$operation->discount,2,'.',','); ?></td>
		<td><?php echo $operation->created_at; ?></td>
	</tr>
<?php
$supertotal+= ($operation->total-$operation->discount);
 endforeach; ?>

</table>
<h1>Total de ventas: $ <?php echo number_format($supertotal,2,'.',','); ?></h1>

			 <?php else:
			 // si no hay operaciones
			 ?>
<script>
	$("#wellcome").hide();
</script>
<div class="jumbotron">
	<h2>No hay operaciones</h2>
	<p>El rango de fechas seleccionado no proporciono ningun resultado de operaciones.</p>
</div>

			 <?php endif; ?>
<?php else:?>
<script>
	$("#wellcome").hide();
</script>
<div class="jumbotron">
	<h2>Fecha Incorrectas</h2>
	<p>Puede ser que no selecciono un rango de fechas, o el rango seleccionado es incorrecto.</p>
</div>
<?php endif;?>

		<?php endif; ?>
	</div>
</div>

<br><br><br><br>
</section>