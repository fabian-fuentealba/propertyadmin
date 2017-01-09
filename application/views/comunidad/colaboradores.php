<div class="page-header">
	<h1> <i class="fa fa-users" aria-hidden="true"></i> Comunidad <small> colaboradores </small></h1>
</div>

<div class="row">
	<div class="col-md-12 sub-menu">
		<div class="btn-group btn-group-md" role="group" aria-label="...">
			<a href="<?php echo site_url(uri_string())?>" class="btn btn-primary active"> <i class="fa fa-refresh" aria-hidden="true"></i> </a>			
		</div>
	</div>
</div>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"><?php
$c = 1;
foreach($listado as $key => $value) {
	?>
	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="heading<?php echo $c?>">
			<h4 class="panel-title">
				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $c?>" aria-expanded="<?php echo ($c == 1 ) ? 'true' : 'false';?>" aria-controls="collapse<?php echo $c?>">
					<strong> <i class="fa fa-users" aria-hidden="true"></i> <?php echo $key?></strong>
				</a>
			</h4>
		</div>
		<div id="collapse<?php echo $c?>" class="panel-collapse collapse <?php echo ($c == 1 ) ? 'in' : '';?>" role="tabpanel" aria-labelledby="heading<?php echo $c?>">
			<div class="panel-body" >				
				<?php
				foreach ($value as $key => $meta) {
					?>
					<div class="media">
						<div class="media-left">
							<a href="#">
								<img class="media-object img-thumbnail" src="<?php echo $meta['foto']?>" alt="...">
							</a>
						</div>
						<div class="media-body">
							<h4 class="media-heading"><b><?php echo $meta['nombres']?> <?php echo $meta['apellidos']?></b></h4>
							<?php echo $meta['rol']?>
						</div>
					</div><?php
				}?>
				</ol>
			</div>
		</div>
	</div><?php
	$c++;
}?>
</div>