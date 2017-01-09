<div class="page-header">
	<h1> <i class="fa fa-book" aria-hidden="true"></i> Cuentas <small> listado general </small></h1>
</div>

<div class="row">
	<div class="col-md-12 sub-menu">
		<div class="btn-group btn-group-md" role="group" aria-label="...">
			<a href="<?php echo site_url(uri_string())?>" class="btn btn-primary active"> <i class="fa fa-refresh" aria-hidden="true"></i> </a>
			<a href="#" data-href="<?php echo site_url( $this->uri->segment(1) . '/agregar' )?>" data-toggle="modal" data-target="#myModal" data-title="CUENTAS <small> agregar </small>" class="btn btn-default"> AGREGAR <i class="fa fa-plus" aria-hidden="true"></i> </a>
		</div>
	</div>
</div>

<p>LISTANDO <b><?php echo count($listado)?></b> REGISTROS</p>
<div id="no-more-tables">
	<table class="table table-bordered table-striped cf"> 
		<colgroup> <col class=col-xs-9> <col class="col-xs-1"> <col class="col-xs-1"> <col class="col-xs-1"></colgroup> 
		<thead class="cf" > 
			<tr> 
				<th>CUENTA</th> 				
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
					<th data-title="CUENTA" > <?php echo $value['nombre']?> <code><?php echo $value['codigo']?></code>  </th> 					
					<td data-title="ESTADO" > <?php echo ($value['estado']) ? '<code>visible</code>' : '' ; ?> </td>
					<td data-title="OPCIONES" > <div class="dropdown clearfix"> 
						<button class="btn btn-default btn-xs dropdown-toggle" type=button id=dropdownMenu3 data-toggle=dropdown aria-haspopup=true aria-expanded=true> <i class="fa fa-chevron-down" aria-hidden="true"></i> </button> 
						<ul class="dropdown-menu" aria-labelledby=dropdownMenu3> 
							<li class=dropdown-header>OPCIONES</li> 
							<li><a href="#" data-href="<?php echo site_url( $this->uri->segment(1) . '/editar/' . $value['id_cuenta'])?>" data-toggle="modal" data-target="#myModal" data-title="USUARIOS <small>editar </small>" >EDITAR</a></li>					
						</ul> 
						</div></td>
					<td>
						&nbsp;<div class="material-switch pull-right">
							<input type="checkbox" name="eliminar[]" id="option<?php echo $value['id_cuenta']?>" value="<?php echo $value['id_usuario']?>">
	                        <label for="option<?php echo $value['id_cuenta']?>" class="label-danger"></label>
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