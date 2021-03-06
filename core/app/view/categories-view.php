<?php ?>
<div class="row">
	<div class="col-md-12">
		<div class="btn-group pull-right">
			<a href="index.php?view=newcategory" class="btn btn-default"><i class='fa fa-th-list'></i> Nueva Categoria</a>
		</div>
		<h1>Categorias</h1>
		<br>
		<?php
		// $porcentaje = 10;
		$users = CategoryData::getAll();
		if(count($users)>0){
			// si hay usuarios
			?>

			<table class="table table-bordered table-hover">
			<thead>
				<th>Nombre</th>
				<th>Porcentaje</th>
				<th>Acciones</th>
			</thead>
			<?php
			foreach($users as $user){
				?>
				<tr>
					<td><?php echo $user->name." ".$user->lastname; ?></td>
					<td>
						 <div class="form-group">
						    <label for="inputEmail1" class="col-lg-3 control-label">%</label>
						    <div class="col-md-8">
						      <input type="number" class="form-control" id="porcentaje<?php echo $user->id;?>" placeholder="Porcentaje de Aumento" >
						      <button type="button" id="btnj<?php echo $user->id;?>" class="btn btn-success">Ingresar %porcentaje</button>
						    </div>
						  </div>
					</td>
					
					<td id="cat<?php echo $user->id; ?>" style="width:130px;">
						
						<a href="index.php?view=editcategory&id=<?php echo $user->id;?>" class="btn btn-primary btn-xs">Editar</a>
						<a href="index.php?view=delcategory&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>
						<hr>
					</td>
				</tr>

				<script type="text/javascript">
			$('#btnj<?php echo $user->id;?>').click(function(event) {
				console.log( $('#porcentaje<?php echo $user->id;?>').val() )
				let boton = '<a id="subir" style="padding: 5px !important;margin: 2px;" href="index.php?view=inflacion&xsen='+ $('#porcentaje<?php echo $user->id;?>').val() +'&CID=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Subir Costos '+ $('#porcentaje<?php echo $user->id;?>').val() +' % </a>';
				$('#cat<?php echo $user->id; ?>').append(boton);						
			});


		</script>

				<?php
			}



		}else{
			echo "<p class='alert alert-danger'>No hay Categorias</p>";
		}


		?>
		</table>

		<script type="text/javascript">
			$('#btnj<?php echo $user->id;?>').click(function(event) {
				console.log( $('#porcentaje<?php echo $user->id;?>').val() )
				let boton = '<a id="subir" style="padding: 5px !important;margin: 2px;" href="index.php?view=inflacion&xsen='+ $('#porcentaje<?php echo $user->id;?>').val() +'&CID=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Subir Costos '+ $('#porcentaje<?php echo $user->id;?>').val() +' % </a>';
				$('#cat<?php echo $user->id; ?>').append(boton);						
			});


		</script>


	</div>
</div>
