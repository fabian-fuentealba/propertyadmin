<div class="row" >
	<div class="col-md-offset-4 col-md-4">

		<div class="text-center text-primary">
			<br>
			<br>		
			<i class="fa fa-stack-overflow fa-5x" aria-hidden="true"></i>
			<p><?php echo $this->logo?></p>				
			<br>
		</div>

		<ul class="nav nav-tabs">
	        <li role="presentation" class="active"><a data-toggle="tab" href="#menu1">COPROPIETARIO</a></li>
	        <li role="presentation"><a data-toggle="tab" href="#menu2">ADMINISTRACIÓN</a></li>
	    </ul>
	    <br>
	    <div style="padding-left:40px;padding-right:40px;" >
		    <?php echo (validation_errors())?'<div class="alert alert-danger"><ul>'.validation_errors().'</ul></div>':''; ?>
			<?php echo $this->session->flashdata("message")?>
		</div>
	    <div class="tab-content">
	    	<div id="menu1" class="tab-pane active animated zoomIn" style="padding-left:40px;padding-right:40px;" >
	    							

					<div class="form-group">
						<label for="exampleInputEmail1">USUARIO</label>
						<input type="text" name="usuario" class="form-control" value="<?php echo set_value("usuario")?>" autocomplete="off" placeholder="USUARIO" autofocus>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">PASSWORD</label>
						<input type="password" name="password" class="form-control" autocomplete="off" placeholder="PASSWORD">
					</div>
					<br>
					<button type="submit" class="btn btn-success btn-block">INGRESAR</button>
				
	    	</div>
        	<div id="menu2" class="tab-pane animated zoomIn" style="padding-left:40px;padding-right:40px;" >
				
				<?php echo form_open( NULL , array("autocomplete"=>"off") )?>
					<div class="form-group">
						<label for="exampleInputEmail1">USUARIO</label>
						<input type="text" name="usuario" class="form-control" value="<?php echo set_value("usuario")?>" autocomplete="off" placeholder="USUARIO" autofocus>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">PASSWORD</label>
						<input type="password" name="password" class="form-control" autocomplete="off" placeholder="PASSWORD">
					</div>
					<br>
					<button type="submit" class="btn btn-success btn-block">INGRESAR</button>
				</form>
				
			</div>
		</div>
	</div>
</div>