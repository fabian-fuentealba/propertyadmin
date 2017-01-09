<?php echo (validation_errors())?'<div class="alert alert-warning"><ul>'.validation_errors('<li>','</li>').'</ul></div>':''; ?>
<?php echo $this->session->flashdata("message")?>

<?php echo form_open(NULL, array("class" => "form-horizontal" , "autocomplete"=>"off"))?>

	

	<p>En la parte inferior se listan todos los modulos del sistema, seleccione los modulos que desea asociar al rol <b><?php echo $meta['rol']?></b> luego guarde.</p>

	<div id="no-more-tables">
	<table class="table table-bordered table-striped cf"> 
		<colgroup> <col class="col-xs-10"> <col class="col-xs-2"></colgroup> 
		
		<tbody><?php
		foreach ($listado as $padre => $modulos){			
			?>
			<tr>
				<th colspan="2" ><?php echo $padre?></th>
			</tr><?php
			foreach($modulos as $id => $modulo ){
				?>
				<tr>

					<td><?php echo $modulo?> <?php echo $id?></td>
					<td>
						<div class="material-switch pull-right">
							<input type="checkbox" name="modulo[]" id="options<?php echo $id ?>" value="<?php echo $id ?>" <?php echo (in_array( $id , $mod )) ? 'checked="checked"' : '' ;?> >	                          
                            <label for="options<?php echo $id ?>" class="label-success"></label>
                        </div>
					</td>
				</tr><?php
			}
		}?>	
		</tbody>
	</table>

</form>