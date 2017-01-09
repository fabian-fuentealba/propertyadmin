<div class="page-header">
	<h1> <i class="fa fa-folder-open" aria-hidden="true"></i> Documentos <small> administrador </small></h1>
</div>
<?php echo form_open()?>	
	<div class="row">
			<div class="col-md-12 sub-menu">
				<div class="btn-group btn-group-md" role="group" aria-label="...">
					<a href="<?php echo site_url(uri_string())?>" class="btn btn-primary active"> <i class="fa fa-refresh" aria-hidden="true"></i> </a>
					<button type="submit" class="btn btn-default" > ELIMINAR <i class="fa fa-trash" aria-hidden="true"></i> </button>
					<a href="#" data-href="<?php echo site_url( $this->uri->segment(1) . '/agregar' )?>" data-toggle="modal" data-target="#myModalFile" data-title="DOCUMENTOS <small> agregar </small>" class="btn btn-default"> AGREGAR <i class="fa fa-plus" aria-hidden="true"></i> </a>
				</div>
			</div>
		</div>

	<p>LISTANDO <b><?php echo count($listado)?></b> REGISTROS</p>
	<div id="no-more-tables">
		<table class="table table-bordered table-striped cf"> 
			<colgroup> <col class=col-xs-9> <col class="col-xs-1"> <col class="col-xs-1"> <col class="col-xs-1"></colgroup> 
			<thead class="cf" > 
				<tr> 
					<th>ARCHIVO</th> 				
					<th>ESTADO</th>
					<th>OPCIONES</th>
					<th>ELIMINAR</th>
				</tr> 
			</thead> 
			<tbody><?php
			if(count($listado) > 0){
				foreach($listado as $key => $value) {
					?>
					<tr> 
						<th data-title="CUENTA" > <?php echo $value['archivo_titulo']?> </th> 					
						<td data-title="ESTADO" > <?php echo ($value['estado']) ? '<code>visible</code>' : '' ; ?> </td>
						<td data-title="OPCIONES" > <div class="dropdown clearfix"> 
							<button class="btn btn-default btn-xs dropdown-toggle" type=button id=dropdownMenu3 data-toggle=dropdown aria-haspopup=true aria-expanded=true> <i class="fa fa-chevron-down" aria-hidden="true"></i> </button> 
							<ul class="dropdown-menu" aria-labelledby=dropdownMenu3> 
								<li class=dropdown-header>OPCIONES</li> 
								<li><a href="#" data-href="<?php echo site_url( $this->uri->segment(1) . '/editar/' . $value['id_documento'])?>" data-toggle="modal" data-target="#myModal" data-title="DOCUMENTOS <small>editar </small>" >EDITAR</a></li>	
								<li><a href="<?php echo base_url('uploads/' . sha1($value['id_empresa']) . '/' . $value['archivo'] )?>" target="new"> DESCARGAR</a></li>				
							</ul> 
							</div></td>
						<td data-title="ELIMINAR">
							&nbsp;<div class="material-switch pull-right">
								<input type="checkbox" name="eliminar[<?php echo $value['id_documento']?>]" id="option<?php echo $value['id_documento']?>" value="<?php echo $value['archivo']?>">
		                        <label for="option<?php echo $value['id_documento']?>" class="label-danger"></label>
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