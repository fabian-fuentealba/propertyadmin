<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Copropietarios extends Logged {

	public function __construct(){

		parent::__construct();
		$this->load->model(array('MCopropietarios','MRoles','MRel_unidades_copropietarios'));
	}
	
	public function index(){		
	
		if($this->access_module->have_access( 10 , $this->data_session['modules'] )){

			if($this->input->method() == 'post'){
				
				foreach($this->input->post('eliminar') as $key => $value) {			
					$sql_data = array(
						'login' => 2 ,
						'usuario' => NULL ,
						'password' => NULL ,
						'id_actualizador' => $this->data_session['id_usuario']
					);
					//$this->MUsuarios->update( $value , $sql_data );
				}			
				redirect(site_url(uri_string()));
			}
			$where = array(
				'copropietarios.id_empresa' => $this->data_session['id_empresa']
			);
			$data['listado'] = $this->MCopropietarios->select( $where );
			$this->load->view('copropietarios/index' , $data );
		}
	}

	public function agregar(){
		//ajax_and_access
		if($this->access_module->have_access( 10 , $this->data_session['modules'] )){
				
			$this->form_validation->set_rules('estado','estado','numeric|required')					
			->set_rules('nombres','nombres','strip_tags|trim|strtoupper|required')
			->set_rules('apellidos','apellidos','strip_tags|trim|strtoupper|required')
			->set_rules('nacio','fecha nacimiento','strip_tags|trim|required')
			->set_rules('correo','correo','trim|strtolower|valid_email|required')
			->set_rules('fijo','teléfono fijo','strip_tags|trim')
			->set_rules('movil','teléfono movil','strip_tags|trim')			
			->set_rules('unidad[]','unidad(es)','required',array('required' => 'El campo {field} debe tener a lo menos una unidad seleccionada.'))
			->set_rules('usuario','usuario','strip_tags|trim|is_unique[copropietarios.usuario]|max_length[20]|min_length[6]|required',array('is_unique' => 'El campo {field} tiene un valor que ya existe en nuestros registros.'))
			->set_rules('password','password','strip_tags|trim|max_length[20]|min_length[6]');

			if($this->form_validation->run()){								

				$sql_data = array(
					'login' => $this->input->post('estado'),					
					'id_rol' => 6,					
					'nombres' => $this->input->post('nombres'),
					'apellidos' => $this->input->post('apellidos'),
					'nacimiento' => $this->input->post('nacio'),
					'correo' => $this->input->post('correo'),
					'fijo' => $this->input->post('fijo'),
					'movil' => $this->input->post('movil'),				
					'usuario' => $this->input->post('usuario'),
					'password' => sha1($this->input->post('password')),
					'id_creador' => $this->data_session['id_usuario'] ,
					'id_empresa' => $this->data_session['id_empresa']
				);
				$answer = $this->MRel_unidades_copropietarios->insert( $sql_data , $this->input->post('unidad[]') );
							
				if($answer){
					$this->session->set_flashdata('message','<div class="alert alert-success">Registro agregado con exito</div>');					
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger">Hubo un error al tratar de registrar datos, intenta nuevamente.</div>');
				}
				redirect(site_url(uri_string()));
			}

			$where = array(
				'unidades.id_empresa' => $this->data_session['id_empresa'],
				'unidades.estado' => 1
			);
			$data['unidades'] = $this->MRel_unidades_copropietarios->select( $where );
			$this->output->unset_template();
			$this->load->view('copropietarios/agregar',$data);
		}		
	}

	public function editar(){

		$id = $this->uri->segment(3);
		if($this->access_module->ajax_and_access_and_number( 10 , $this->data_session['modules'] , $id )){
				
			$this->form_validation->set_rules('estado','estado','numeric|required')	
			->set_rules('rol','rol','numeric|required')
			->set_rules('nombres','nombres','strip_tags|trim|strtoupper|required')
			->set_rules('apellidos','apellidos','strip_tags|trim|strtoupper|required')
			->set_rules('nacio','fecha nacimiento','strip_tags|trim|required')
			->set_rules('correo','correo','trim|strtolower|valid_email|required')
			->set_rules('fijo','teléfono fijo','strip_tags|trim')
			->set_rules('movil','teléfono movil','strip_tags|trim')			
			->set_rules('usuario','usuario','strip_tags|max_length[20]|min_length[6]|trim|required')
			->set_rules('password','password','strip_tags|trim|max_length[20]|min_length[6]');

			if($this->form_validation->run()){

				$sql_data = array(
					'login' => $this->input->post('estado'),					
					'id_rol' => $this->input->post('rol'),						
					'nombres' => $this->input->post('nombres'),
					'apellidos' => $this->input->post('apellidos'),
					'nacimiento' => $this->input->post('nacio'),
					'correo' => $this->input->post('correo'),
					'fijo' => $this->input->post('fijo'),
					'movil' => $this->input->post('movil'),
					'sexo' => $this->input->post('sexo'),
					'usuario' => $this->input->post('usuario'),					
					'id_actualizador' => $this->session->userdata('id_usuario')
				);

				if($this->input->post('password') != NULL){
					$data_update['password'] = sha1($this->input->post('password'));
				}

				$answer = $this->MUsuarios->update( $id , $sql_data );
				if($answer === TRUE){						
					$this->session->set_flashdata('message','<div class="alert alert-success">Registro actualizado con exito</div>');					
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger">' . $answer . '</div>');
				}
				redirect(site_url(uri_string()));
			}

			$data['roles'] = $this->MRoles->select( array( 'roles.estado' => 1 ) );				
			$data['meta'] = $this->MUsuarios->select( array('usuarios.id_usuario' => $id ) , TRUE ); 
			$this->output->unset_template();
			$this->load->view('colaboradores/editar' , $data);
			
		}
	}
}
