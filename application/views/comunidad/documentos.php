<div class="page-header">
	<h1> <i class="fa fa-folder-open" aria-hidden="true"></i> Comunidad <small> documentos </small></h1>
</div>

<div class="row">
	<div class="col-md-12 sub-menu">
		<div class="btn-group btn-group-md" role="group" aria-label="...">
			<a href="<?php echo site_url(uri_string())?>" class="btn btn-primary active"> <i class="fa fa-refresh" aria-hidden="true"></i> </a>			
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<p>LISTANDO <b><?php echo count($listado)?></b> REGISTROS</p>
		<div class="list-group" >
		<?php foreach ($listado as $key => $value) {		
			?>
			<a href="<?php echo base_url('uploads/' . sha1($value['id_empresa']) . '/' . $value['archivo'] )?>" target="new" style="padding-bottom: 0;" class="list-group-item">
				<p ><strong class="text-uppercase" ><?php echo $value['archivo_titulo']?></strong><br>		
				<span class="more"><?php echo $value['comentario']?></span><br>
				<i class="fa fa-pencil-square-o"></i> subido por <strong> <?php echo $value['rol']?></strong> / <strong><?php echo $value['creado']?></strong></p>
			</a><?php
		}?>
		</div>
	</div>
</div>