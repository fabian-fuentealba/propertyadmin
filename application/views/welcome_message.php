<br>
<center><img src="<?php echo base_url($this->data_session['logo'])?>" class="img-responsive"></center>
<br>
<center><a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
	DATA SESSION
</a></center>
<div class="collapse" id="collapseExample">
	<div class="well">
		<?php print_r($this->session->userdata())?>
	</div>
</div>