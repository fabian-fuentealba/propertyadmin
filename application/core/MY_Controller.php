<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

	var $site = 'motelADM';	
	var $logo = 'motel<b>ADM</b>';	
	var $page = 'desafiolaboral.cl';
	var $email_contacto ;
	var $email_nocontestar = 'noreply@desafiolaboral.cl';
	var $data_session ;

	public function __construct(){

		parent::__construct();
        $this->email_contacto = 'contacto@'.strtolower($this->page);   
        $this->output->set_title($this->site);
		$this->output->set_template('layout');
		$this->load->section('menu','sections/menu');
		$this->load->section('modal','sections/modal');
		$this->load->section('footer','sections/footer');
		$this->load->css('assets/css/default.css');	
		$this->load->css('assets/css/theme.css');		
	}
}

class Logged extends MY_Controller{

	public function __construct(){

		parent::__construct();
		if($this->session->userdata('logged_in') != TRUE){
			if($this->input->is_ajax_request()){
				show_error('Para poder continuar debe iniciar sesión antes, cierre esta ventana y recargue la pagina.', 200 , 'Credenciales de acceso');
			}else{
				redirect(site_url('login'));
			}			
		}else{
			$this->data_session = $this->session->userdata();						
		}
	}
}