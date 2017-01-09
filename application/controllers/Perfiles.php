<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfiles extends Logged {

	public function __construct(){

		parent::__construct();
		$this->load->model(array('MUsuarios','MRoles'));
	}	

	public function index(){
		
		if($this->access_module->is_ajax()){					
				
			$this->form_validation->set_rules('nombres','nombres','strip_tags|trim|strtoupper|required');
			$this->form_validation->set_rules('apellidos','apellidos','strip_tags|trim|strtoupper|required');
			$this->form_validation->set_rules('nacio','fecha nacimiento','strip_tags|trim|required');
			$this->form_validation->set_rules('correo','correo','trim|strtolower|valid_email|required');
			$this->form_validation->set_rules('fijo','teléfono fijo','strip_tags|trim');
			$this->form_validation->set_rules('movil','teléfono movil','strip_tags|trim');
			$this->form_validation->set_rules('sexo','sexo','strip_tags|trim|required');
			$this->form_validation->set_rules('usuario','usuario','strip_tags|trim|required');
			$this->form_validation->set_rules('password','password','strip_tags|trim|max_length[20]|min_length[6]');

			if($this->form_validation->run()){

				$data_update = array(								
											
					'nombres' => $this->input->post("nombres"),
					'apellidos' => $this->input->post("apellidos"),
					'nacimiento' => $this->input->post("nacio"),
					'correo' => $this->input->post("correo"),
					'fijo' => $this->input->post("fijo"),
					'movil' => $this->input->post("movil"),
					'sexo' => $this->input->post("sexo"),
					'usuario' => $this->input->post("usuario"),					
					'id_actualizador' => $this->data_session['id_usuario']
				);

				if($this->input->post("password") != NULL){
					$data_update['password'] = sha1($this->input->post("password"));
				}

				$update = $this->MUsuarios->update( $this->data_session['id_usuario'] , $data_update);
				if($update === TRUE){
					$this->session->set_flashdata("message",'<div class="alert alert-success">Registro actualizado con exito</div>');					
				}else{
					$this->session->set_flashdata("message",'<div class="alert alert-warning">' . $update . '</div>');
				}
				redirect(site_url(uri_string()));
			}
				
			$data['meta'] = $this->MUsuarios->select( array('usuarios.id_usuario' => $this->data_session['id_usuario'] ), TRUE ); 
			$this->output->unset_template();
			$this->load->view('perfiles/index',$data);
		}
	}

}