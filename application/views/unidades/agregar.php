<?php echo (validation_errors())?'<div class="alert alert-danger"><ul>'.validation_errors('<li>','</li>').'</ul></div>':''; ?>
<?php echo $this->session->flashdata("message")?>

<?php echo form_open(NULL, array("class" => "form-horizontal" , "autocomplete"=>"off"))?>

    <div class="form-group">
        <div class="col-md-offset-3 col-md-9">
          <p class="form-control-static">Los campos con <i class="fa fa-asterisk"></i> son obligatorios</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"> <i class="fa fa-asterisk" aria-hidden="true"></i> TIPO UNIDAD </label>
        <div class="col-md-9">
            <select name="tipo_unidad" class="form-control">
                <option value=""></option>
                <optgroup label="TIPOS UNIDADES"><?php
                    foreach($tipos_unidades as $value){
                        ?>
                        <option value="<?php echo $value['id_tipo_unidad']?>" <?php echo set_select('tipo_unidad',$value['id_tipo_unidad'])?> ><?php echo $value['tipo_unidad']?></option><?php
                    }?>                 
                </optgroup>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">  <i class="fa fa-asterisk" aria-hidden="true"></i> NOMBRE </label>
        <div class="col-md-9">
            <input type="text" class="form-control" value="<?php echo set_value('nombre')?>" name="nombre" placeholder="101">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">  <i class="fa fa-asterisk" aria-hidden="true"></i> PISO </label>
        <div class="col-md-9">
            <input type="text" class="form-control" value="<?php echo set_value('piso')?>" name="piso" placeholder="17">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">  <i class="fa fa-asterisk" aria-hidden="true"></i> METROS<sup>2</sup> </label>
        <div class="col-md-3">
            <input type="text" class="form-control" value="<?php echo set_value('metros')?>" data-toggle="tooltip" data-placement="auto" title="<ul><li>Solo se permiten 2 decimales</li><li>Utilize punto (.) como separador de decimales</li></ul>" name="metros" placeholder="METROS CUADRADOS">
        </div>        
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"> REFERENCIA </label>
        <div class="col-md-9">
            <input type="text" class="form-control" value="<?php echo set_value('referencia')?>" name="referencia" placeholder="TORRE A">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"> <i class="fa fa-asterisk" aria-hidden="true"></i> ESTADO </label>
        <div class="col-md-9">
            <select name="estado" class="form-control">
              <option value=""></option>
              <optgroup label="ESTADOS">
                  <option value="1" <?php echo set_select('estado',1)?> >CONSIDERAR PARA GASTOS COMUNES</option>
                  <option value="0" <?php echo set_select('estado',0)?> >NO CONSIDERAR PARA GASTOS COMUNES</option>
              </optgroup>

            </select>
        </div>
    </div>

</form>