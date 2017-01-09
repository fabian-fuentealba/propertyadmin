<?php echo (validation_errors())?'<div class="alert alert-danger"><ul>'.validation_errors().'</ul></div>':''; ?>
<?php echo $this->session->flashdata("message")?>

<?php echo form_open(NULL, array("class" => "form-horizontal" , "autocomplete"=>"off"))?>

    <div class="form-group">
        <div class="col-md-offset-3 col-md-9">
          <p class="form-control-static">Los campos con <i class="fa fa-asterisk"></i> son obligatorios</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"> <i class="fa fa-asterisk" aria-hidden="true"></i> LOGIN </label>
        <div class="col-md-9">
            <select name="estado" class="form-control">
              <option value=""></option>
              <optgroup label="ESTADOS">
                  <option value="1" <?php echo set_select('estado',1)?> >SI PUEDE LOGUEARSE</option>
                  <option value="0" <?php echo set_select('estado',0)?> >NO PUEDE LOGUEARSE</option>
              </optgroup>

            </select>
        </div>
    </div>   

    <div class="form-group">
        <label class="col-md-3 control-label"> <i class="fa fa-asterisk" aria-hidden="true"></i> ROL </label>
        <div class="col-md-9">
            <select name="rol" class="form-control">
                <option value=""></option>
                <optgroup label="ROLES"><?php
                    foreach($roles as $value){
                        ?>
                        <option value="<?php echo $value['id_rol']?>" <?php echo set_select('rol',$value['id_rol'])?> ><?php echo $value['rol']?></option><?php
                    }?>                 
                </optgroup>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">  <i class="fa fa-asterisk" aria-hidden="true"></i> USUARIO </label>
        <div class="col-md-9">
            <input type="text" class="form-control" maxlength="20" value="<?php echo set_value('usuario')?>" name="usuario" placeholder="USUARIO">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">  <i class="fa fa-asterisk" aria-hidden="true"></i> PASSWORD </label>
        <div class="col-md-9">
            <input type="password" class="form-control" maxlength="20" name="password" placeholder="*******">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"> <i class="fa fa-asterisk" aria-hidden="true"></i> NOMBRES </label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="nombres" value="<?php echo set_value('nombres')?>" placeholder="NOMBRES">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label"> <i class="fa fa-asterisk" aria-hidden="true"></i> APELLIDOS </label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="apellidos" value="<?php echo set_value('apellidos')?>" placeholder="APELLIDOS">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label"> <i class="fa fa-asterisk" aria-hidden="true"></i> F. NACIMIENTO </label>
        <div class="col-md-3" >
            <input type="text" maxlength="10" class="form-control date" value="<?php echo set_value('nacio')?>" name="nacio" placeholder="9999-99-99">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"> <i class="fa fa-asterisk" aria-hidden="true"></i> CORREO </label>
        <div class="col-md-9">
            <input type="text" class="form-control" value="<?php echo set_value('correo')?>" name="correo" placeholder="correo@correo.com">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"> T. FIJO </label>
        <div class="col-md-9">
            <input type="text" class="form-control" value="<?php echo set_value('fijo')?>" name="fijo" data-mask="+(99) 9 9999 99 99" placeholder="">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"> T. MOVIL </label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="movil" value="<?php echo set_value('movil')?>" data-mask="+(99) 9 9999 99 99" placeholder="">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"> <i class="fa fa-asterisk" aria-hidden="true"></i> SEXO </label>
        <div class="col-md-3">
            <select name="sexo" class="form-control">
              <option value=""></option>
              <optgroup label="SEXOS">
                  <option value="H" <?php echo set_select('sexo','H')?> >HOMBRE</option>
                  <option value="M" <?php echo set_select('sexo','M')?> >MUJER</option>
              </optgroup>

            </select>
        </div>
    </div>
   
</form>