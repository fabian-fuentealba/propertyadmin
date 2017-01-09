<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access_module {

	protected $CI;

	public function __construct(){

		$this->CI =& get_instance();
	}

    public function is_ajax(){
    	
    	if(!$this->CI->input->is_ajax_request()){    		

    		$data = array(
    			'heading' => 'Metodo acceso prohibido',
    			'message' => 'El metodo de acceso no esta permitido'
    		);
    		
    		$this->CI->output->set_output( $this->CI->load->view( 'errors/access_module' , $data , TRUE ) );  
            return FALSE ;

    	}else{

            return TRUE ;
        }
    }   

    public function have_access( $needle , $haystack ){
    	
    	if(!in_array( $needle , $haystack )){      		

    		$data = array(
    			'heading' => 'Acceso prohibido',
    			'message' => 'Usted no tiene los privilegios necesarios para acceder a este modulo'
    		);

    		if($this->CI->input->is_ajax_request()){
    			$this->CI->output->unset_template();
    		}
    		
    		$this->CI->output->set_output( $this->CI->load->view( 'errors/access_module' , $data , TRUE ) );
    		return FALSE ;

    	}else{

    		return TRUE ;

    	}
    }

    public function is_number( $value ){
        
        if(!is_numeric( $value )){           

            $data = array(
                'heading' => 'Acceso prohibido',
                'message' => 'Los parametros proporcionados no corresponden'
            );

            if($this->CI->input->is_ajax_request()){
                $this->CI->output->unset_template();
            }
            
            $this->CI->output->set_output( $this->CI->load->view( 'errors/access_module' , $data , TRUE ) );
            return FALSE ;

        }else{

            return TRUE ;

        }
    }

    public function ajax_and_access( $needle , $haystack ){
    
        if( !$this->is_ajax() ){            

        }elseif( !$this->have_access( $needle , $haystack ) ){  
           
        }else{

            return TRUE ;
        }
    }

    public function ajax_and_access_and_number( $needle , $haystack , $number ){
    
        if( !$this->is_ajax() ){            

        }elseif( !$this->have_access( $needle , $haystack ) ){ 

        }elseif( !$this->is_number( $number ) ){  
           
        }else{

            return TRUE ;
        }
    }   
}