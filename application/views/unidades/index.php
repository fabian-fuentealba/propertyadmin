<div class="page-header">
	<h1> <i class="fa fa-building" aria-hidden="true"></i> Unidades <small> listado general </small></h1>
</div>

<div class="row">
	<div class="col-md-12 sub-menu">
		<div class="btn-group btn-group-md" role="group" aria-label="...">
			<a href="<?php echo site_url(uri_string())?>" class="btn btn-primary active"> <i class="fa fa-refresh" aria-hidden="true"></i> </a>
			<a href="#" data-href="<?php echo site_url( $this->uri->segment(1) . '/agregar' )?>" data-toggle="modal" data-target="#myModal" data-title="UNIDADES <small> agregar </small>" class="btn btn-default"> AGREGAR <i class="fa fa-plus" aria-hidden="true"></i> </a>
		</div>
	</div>
</div>

<div class="row">

	<div class="col-md-12">
	<p>LISTANDO <b><?php echo count($propiedades)?></b> REGISTROS</p><?php
		foreach($propiedades as $key => $value) {
			?>
			<div class="col-md-2 col-xs-6" style="margin:0;padding: 1px;">
				<a href="#" data-href="<?php echo site_url( $this->uri->segment(1) . '/editar/' . $value['id_unidad'])?>" data-toggle="modal" data-target="#myModal" data-title="UNIDADES <small> editar </small>" class="btn btn-<?php echo ($value['estado']) ? 'default':'danger';?> btn-block" >
				<?php echo $value['tipo_unidad']?> <br> 
				PISO <?php echo $value['piso']?> / NO. <?php echo $value['nombre']?><br>
				<kbd><?php echo ($value['estado']) ? 'activo' : 'inactivo' ;?></kbd>
				</a>
			</div>
			<?php
		}?>	
	</div>
</div>