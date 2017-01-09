<?php echo (validation_errors())?'<div class="alert alert-danger"><ul>'.validation_errors('<li>','</li>').'</ul></div>':''; ?>
<?php echo $this->session->flashdata("message")?>

<?php echo form_open(NULL, array("class" => "form-horizontal" , "autocomplete"=>"off"))?>

    <div class="form-group">
        <div class="col-md-offset-3 col-md-9">
          <p class="form-control-static">Los campos con <i class="fa fa-asterisk"></i> son obligatorios</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"> <i class="fa fa-asterisk" aria-hidden="true"></i> AREA </label>
        <div class="col-md-9">
            <select name="area" class="form-control">
                <option value=""></option>
                <optgroup label="AREAS"><?php
                    foreach($areas as $value){
                        ?>
                        <option value="<?php echo $value['id_area']?>" <?php echo set_select('area',$value['id_area'])?> ><?php echo $value['area']?></option><?php
                    }?>                 
                </optgroup>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="inputPassword3" class="col-md-3 control-label">  <i class="fa fa-asterisk" aria-hidden="true"></i> ROL </label>
        <div class="col-md-9">
            <input type="text" class="form-control" value="<?php echo set_value('rol')?>" name="rol" placeholder="ROL">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"> <i class="fa fa-asterisk" aria-hidden="true"></i> MENSAJES </label>
        <div class="col-md-9">
            <select name="mensaje" class="form-control">
              <option value=""></option>
              <optgroup label="OPCIONES">
                  <option value="1" <?php echo set_select('mensaje',1)?> >SI PUEDE RECIBIR MENSAJE DE COPROPIETARIOS</option>
                  <option value="0" <?php echo set_select('mensaje',0)?> >NO PUEDE RECIBIR MENSAJE DE COPROPIETARIOS</option>
              </optgroup>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="inputPassword3" class="col-md-3 control-label"> <i class="fa fa-asterisk" aria-hidden="true"></i> ESTADO </label>
        <div class="col-md-3">
            <select name="estado" class="form-control">
              <option value=""></option>
              <optgroup label="ESTADOS">
                  <option value="1" <?php echo set_select('estado',1)?> >ACTIVO</option>
                  <option value="0" <?php echo set_select('estado',0)?> >INACTIVO</option>
              </optgroup>

            </select>
        </div>
    </div>

</form>