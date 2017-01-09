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
                ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php                
            }
        }?>       
        <title><?php echo $title ?></title>     
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">        
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">  
        <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Titillium+Web:400,700' type="text/css"><?php
        foreach($css as $file){
            echo "\n";
                echo "\t";
            ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
        }echo "\n";?>
        <style type="text/css">
            body{
                background-color: #f4f4f4;
            }
        </style>
    </head>

    <body>       
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-10">
                    <div class="<?php echo( in_array( $this->uri->segment(1) , array('login','activate') ) )? '' : 'layout' ;?>">
                        <?php echo $output;?>

                        <?php echo $this->load->get_section('footer');?>
                    </div>
                </div>
            </div>          
        </div>  
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>          
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->                
    </body>
</html>