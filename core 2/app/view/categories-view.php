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
						      <input type="number" onchange="tomarPorce()" class="form-control" id="porce" placeholder="Porcentaje de Aumento">
						    </div>
						  </div>
					</td>
					
					<td style="width:130px;">
						<a id="subir" href="index.php?view=inflacion&xsen=&CID=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Subir Costos</a>
						<a href="index.php?view=editcategory&id=<?php echo $user->id;?>" class="btn btn-primary btn-xs">Editar</a>
						<a href="index.php?view=delcategory&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>
					</td>
				</tr>

				<?php
			}



		}else{
			echo "<p class='alert alert-danger'>No hay Categorias</p>";
		}


		?>
		</table>

		<script type="text/javascript">
			let porViejo = null;
			function tomarPorce(){
				let porId = document.getElementById("porce").value;
				let enlace = document.getElementById("subir").href;
				let separador = '';
				console.log(porId);
				if(porViejo != null){
					separador = 'xsen=' + porViejo;
				}
				else{
					separador = 'xsen=';
				}
				
				let array_p = enlace.split(separador);
				document.getElementById("subir").href = array_p[0] + 'xsen=' + porId + array_p[1];

				console.log( document.getElementById("subir").href );
				
				porViejo = porId;
			}

		</script>


	</div>
</div>
