<div class="page-header">
	<h1> <i class="fa fa-newspaper-o" aria-hidden="true"></i> Noticias <small> administrador </small></h1>
</div>
<?php echo form_open()?>	

	<div class="row">
		<div class="col-md-12 sub-menu">
			<div class="btn-group btn-group-md" role="group" aria-label="...">
				<a href="<?php echo site_url(uri_string())?>" class="btn btn-primary active"> <i class="fa fa-refresh" aria-hidden="true"></i> </a>
				<button type="submit" class="btn btn-default" > ELIMINAR <i class="fa fa-trash" aria-hidden="true"></i> </button>
				<a href="#" data-href="<?php echo site_url( $this->uri->segment(1) . '/agregar' )?>" data-toggle="modal" data-target="#myModal" data-title="NOTICIAS <small> agregar </small>" class="btn btn-default"> AGREGAR <i class="fa fa-plus" aria-hidden="true"></i> </a>
			</div>
		</div>
	</div>

	<p>LISTANDO <b><?php echo count($noticias)?></b> REGISTROS</p>
	<div id="no-more-tables">
		<table class="table table-bordered table-striped cf">
			<colgroup> <col class=col-xs-8> <col class=col-xs-1> <col class="col-xs-1"> <col class="col-xs-1"> <col class="col-xs-1"> </colgroup>
			<thead class="cf">
				<tr>				
					<th>TITULO</th>
					<th>USUARIO</th>							
					<th>OPCIONES</th>	
					<th>ELIMINAR</th>
				</tr>
			</thead>
			<tbody><?php
			if(count($noticias) > 0){
				foreach ($noticias as $key => $value) {			
					?>
					<tr>					
						<th data-title="TITULO"><?php echo $value['titulo']?> <?php echo ($value['estado']) ? '<span class="label label-success pull-right">VISIBLE</span>':'';?></th>	
						<td data-title="USUARIO"><code><?php echo $value['usuario']?></code></td>						
						<td>
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-chevron-down" aria-hidden="true"></i> 
								</button>
								<ul class="dropdown-menu dropdown-menu">
									<li class=dropdown-header>OPCIONES</li>
									<li><a href="#" data-href="<?php echo site_url('noticias/editar/'.$value['id_noticia'])?>" data-toggle="modal" data-target="#myModal" data-title="NOTICIAS <small>editar </small>" > EDITAR </a> </li>	
									<li><a href="#" data-href="<?php echo site_url('noticias/ver/'.$value['id_noticia'])?>" data-toggle="modal" data-target="#myModal" data-buttons="false" data-title="NOTICIAS <small>vista previa </small>" > VISTA PREVIA </a> </li>													
								</ul>
							</div>
						</td>
						<td> 
							&nbsp;<div class="material-switch pull-right">
								<input type="checkbox" name="eliminar[]" id="option<?php echo $value['id_noticia']?>" value="<?php echo $value['id_noticia']?>">	                          
	                            <label for="option<?php echo $value['id_noticia']?>" class="label-danger"></label>
	                        </div>
						</td>					
					</tr><?php
				}
			}else{
				?>
				<tr>
					<td colspan="6">NADA PARA LISTAR</td>
				</tr><?php
				}?>
			</tbody>		
		</table>
	</div>
</form>