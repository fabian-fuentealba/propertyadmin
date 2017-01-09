<?php echo (validation_errors())?'<div class="alert alert-danger"><ul>'.validation_errors('<li>','</li>').'</ul></div>':''; ?>
<?php echo ($this->upload->display_errors())?'<div class="alert alert-danger"><ul>'.$this->upload->display_errors('<li>','</li>').'</ul></div>':''; ?>
<?php echo $this->session->flashdata("message")?>

<?php echo form_open( NULL , array("class" => "form-horizontal" ))?>

    <div class="form-group">
        <div class="col-md-offset-3 col-md-9">
          <p class="form-control-static">Los campos con <i class="fa fa-asterisk"></i> son obligatorios</p>
        </div>
    </div>   

    <div class="form-group">
        <label class="col-md-3 control-label">  <i class="fa fa-asterisk" aria-hidden="true"></i> TITULO </label>
        <div class="col-md-9">
            <input type="text" class="form-control" value="<?php echo $meta['archivo_titulo']?>" name="titulo" placeholder="TITULO">
        </div>
    </div>    

    <div class="form-group">
        <label class="col-md-3 control-label"> COMENTARIO </label>
        <div class="col-md-9">
            <textarea class="form-control" rows="5" name="comentario" placeholder="COMENTARIO ..."><?php echo $meta['comentario']?></textarea>
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