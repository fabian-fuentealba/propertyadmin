<?php echo (validation_errors())?'<div class="alert alert-danger"><ul>'.validation_errors('<li>','</li>').'</ul></div>':''; ?>
<?php echo $this->session->flashdata("message")?>

<?php echo form_open(NULL, array("class" => "form-horizontal" , "autocomplete"=>"off"))?>

    <div class="form-group">
        <div class="col-md-offset-3 col-md-9">
          <p class="form-control-static">Los campos con <i class="fa fa-asterisk"></i> son obligatorios</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"> <i class="fa fa-asterisk" aria-hidden="true"></i> TIPO CUENTA </label>
        <div class="col-md-9">
            <select name="tipo_cuenta" class="form-control">
                <option value=""></option>
                <optgroup label="TIPOS CUENTAS"><?php
                    foreach($tipos_cuentas as $value){
                        ?>
                        <option value="<?php echo $value['id_tipo_cuenta']?>" <?php echo ($meta['id_tipo_cuenta'] == $value['id_tipo_cuenta']) ? 'selected' : '' ; ?> ><?php echo $value['tipo_cuenta']?></option><?php
                    }?>                 
                </optgroup>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">  <i class="fa fa-asterisk" aria-hidden="true"></i> CODIGO </label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="codigo" maxlength="10" value="<?php echo $meta['codigo']?>" placeholder="CODIGO">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">  <i class="fa fa-asterisk" aria-hidden="true"></i> NOMBRE </label>
        <div class="col-md-9">
            <input type="text" class="form-control" value="<?php echo $meta['nombre']?>" name="nombre" placeholder="NOMBRE">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"> DETALLE </label>
        <div class="col-md-9">
            <textarea class="form-control" rows="5" name="detalle" placeholder="DETALLE ..."><?php echo $meta['detalle']?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"> <i class="fa fa-asterisk" aria-hidden="true"></i> ESTADO </label>
        <div class="col-md-3">
            <select name="estado" class="form-control">
              <option value=""></option>
              <optgroup label="ESTADOS">
                  <option value="1" <?php echo ($meta['estado'] == 1 ) ? 'selected' : '' ; ?> >VISIBLE</option>
                  <option value="0" <?php echo ($meta['estado'] == 0 ) ? 'selected' : '' ; ?> >NO VISIBLE</option>
              </optgroup>

            </select>
        </div>
    </div>    
   
</form>