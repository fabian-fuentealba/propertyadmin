<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->model(array('MUsuarios','MModulos'));
		$this->load->section('footer', 'sections/footer');
		$this->output->set_template('simple');

	}

	public function index(){

		$this->form_validation->set_rules('usuario','usuario','trim|strip_tags|required')
		->set_rules('password','password','trim|strip_tags|required');

		if($this->form_validation->run()){

			$data_select = array(
				'SHA1(usuario)' => sha1($this->input->post("usuario")),
				'password' => sha1($this->input->post("password")),
				'usuarios.login' => 1
			);

			$data = $this->MUsuarios->login( $data_select );

			if(is_numeric($data['id_usuario'])){

				$data['logged_in'] = TRUE ;
				$data['modules'] = $this->MModulos->modules( array( 
					'rel_roles_empresas.id_empresa' => $data['id_empresa'] , 
					'rel_roles_empresas.id_rol' => $data['id_rol'] 
				));

				$data['menus'] = $this->MModulos->menus( array( 
					'rel_roles_empresas.id_empresa' => $data['id_empresa'] , 
					'rel_roles_empresas.id_rol' => $data['id_rol'] ,
					'a.estado' => 1
				));

				$this->session->set_userdata($data);
				redirect(site_url());

			}else{

				$this->session->set_flashdata("message",'<div class="alert alert-danger">Los datos ingresados no son validos</div>');
				redirect(site_url(uri_string()));
			}
		}

		$this->load->view( 'login' );

	}

}