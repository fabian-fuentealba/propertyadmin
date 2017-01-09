<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1"><?php
		if(!empty($meta)){
            foreach($meta as $name=>$content){
                echo "\n";
                echo "\t";  
                echo "\t";             
                ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php                
            }
        }?>  
		<title><?php echo $title ?></title>		
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">		
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">	
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.21/daterangepicker.min.css" type="text/css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster:400" type="text/css" />
		<link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Titillium+Web:300,400,700' type='text/css'><?php
		foreach($css as $file){	      
	        ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php	        
	    }?>	    		
	</head>

	<body>
		<?php echo $this->load->get_section('modal');?><?php echo $this->load->get_section('menu');?><div class="container"><div class="row"><div class="col-md-offset-1a col-md-10a"><div class="layout"><?php echo $output;?></div><?php echo $this->load->get_section('footer');?></div></div></div>
		<input type="hidden" id="site" value="<?php echo site_url()?>">
		<script type="text/javascript" data-main="<?php echo site_url('assets/js/app.js')?>" src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.2.0/require.min.js"></script>	
		<script type="text/javascript">		
        var link = document.createElement("link");
	    link.type = "text/css";
	    link.rel = "stylesheet";
	    link.href = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css";
	    document.getElementsByTagName("head")[0].appendChild(link);   
        require.config({
            shim : {               
                bootstrap : { deps :['jquery'] } ,
                bselect : { deps :['jquery','bootstrap'] } ,  
                'bselect.i18n' : { deps :['jquery','bootstrap','bselect'] },
                moment : { deps :['jquery'] } ,
                daterange : { deps :['jquery'] }
            },
            paths: {
                jquery: "https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min",              
                bootstrap : "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min",
                bselect : "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.0/js/bootstrap-select.min", 
                'bselect.i18n' : "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.0/js/i18n/defaults-es_CL.min",
                moment : "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min",
                daterange : "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.21/daterangepicker.min" 
            }
        }); 
        </script>	
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->	    
	</body>
</html>
