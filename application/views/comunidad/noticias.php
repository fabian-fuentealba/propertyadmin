<div class="page-header">
	<h1> <i class="fa fa-newspaper-o" aria-hidden="true"></i> Comunidad <small> noticias </small></h1>
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
		<p>LISTANDO <b><?php echo count($noticias)?></b> REGISTROS</p>
		<div class="list-group">
		<?php foreach ($noticias as $key => $value) {		
			?>
			<a href="#" class="list-group-item <?php echo($value['visto']) ? '' : 'active' ;?>" data-href="<?php echo site_url('noticias/ver/' . $value['id_noticia'])?>" data-buttons="false" data-toggle="modal" data-target="#myModal" style="padding-bottom: 0;" data-title="NOTICIAS <small> detalle</small>" >
				<p ><strong class="text-uppercase" ><?php echo $value['titulo']?></strong><br>	
				<?php echo substr($value['cuerpo'],0,100)?>...<br>
				<i class="fa fa-pencil-square-o"></i> publicado por <strong> <?php echo $value['rol']?></strong> / <strong><?php echo $value['creado']?></strong></p>
			</a><?php
		}?>
		</div>
	</div>
</div>