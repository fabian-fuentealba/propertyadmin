<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends Logged {

	public function __construct(){

		parent::__construct();
		$this->load->model(array('MModulos','MRoles','MAreas'));
	}	

	public function index(){			

		if($this->access_module->have_access( 2 , $this->data_session['modules'] )){
		
			$data['listado'] = $this->MRoles->select( array( 'roles.id_empresa' => $this->data_session['id_empresa'] , 'mostrar' => 1 ));
			$this->load->view('roles/index',$data);
		}

	}

	public function agregar(){

		if($this->access_module->ajax_and_access( 2 , $this->data_session['modules'] )){
				
			$this->form_validation->set_rules('estado','estado','numeric|required')
			->set_rules('mensaje','mensaje','numeric')	
			->set_rules('area','area','numeric|required')	
			->set_rules('rol','rol','strip_tags|trim|strtoupper|required');				

			if($this->form_validation->run()){

				$data_insert = array(										
					'rol' => $this->input->post('rol'),		
					'id_area' => $this->input->post('area'),
					'recibe_mensaje' => $this->input->post('mensaje'),				
					'id_empresa' => $this->data_session['id_empresa'],
					'id_creador' => $this->data_session['id_usuario'],
					'estado' => $this->input->post('estado'),					
				);

				$insert = $this->MRoles->insert($data_insert);
				if($insert === TRUE){
					$this->session->set_flashdata('message','<div class="alert alert-success">Registro agregado con exito</div>');					
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger">' . $insert . '</div>');
				}
				redirect(site_url(uri_string()));
			}
			
			$data['areas'] = $this->MAreas->select();
			$this->output->unset_template();
			$this->load->view( 'roles/agregar' , $data );			
		}	
	}

	public function editar(){

		$id = $this->uri->segment(3);
		if($this->access_module->ajax_and_access_and_number( 2 , $this->data_session['modules'] , $id )){		

			$this->form_validation->set_rules('estado','estado','numeric|required')
			->set_rules('mensaje','mensaje','numeric')	
			->set_rules('area','area','numeric|required')	
			->set_rules('rol','rol','strip_tags|trim|strtoupper|required');	

			if($this->form_validation->run()){

				$data_update = array(
					'rol' => $this->input->post('rol'),	
					'id_area' => $this->input->post('area'),
					'recibe_mensaje' => $this->input->post('mensaje'),						
					'id_actualizador' => $this->data_session['id_usuario'],
					'estado' => $this->input->post('estado'),
				);			

				$update = $this->MRoles->update( $this->uri->segment(3) , $data_update );
				if($update === TRUE){
					$this->session->set_flashdata('message','<div class="alert alert-success">Registro actualizado con exito</div>');					
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger">' . $update . '</div>');
				}
				redirect(site_url(uri_string()));
			}

			$where = array(
				'id_rol' => $this->uri->segment(3) 
			);

			$data['meta'] = $this->MRoles->select( $where , TRUE );	
			$data['areas'] = $this->MAreas->select();
			$this->output->unset_template();	
			$this->load->view('roles/editar',$data);			
		}
	}

	public function modulo(){

		$id = $this->uri->segment(3);
		if($this->access_module->ajax_and_access_and_number( 2 , $this->data_session['modules'] , $id )){	

			$this->form_validation->set_rules('modulo[]','modulo','trim');	
			
			$where = array(
				'id_rol' => $id 
			);
			$data['meta'] = $this->MRoles->select( $where , TRUE );

			if($this->form_validation->run()){

				$this->MModulos->delete( array( 'id_rol' => $data['meta']['id_rol'] , 'id_empresa' => $this->data_session['id_empresa'] ) );

				if( count($this->input->post('modulo[]')) > 0 ){
					foreach ($this->input->post('modulo') as $key => $value) {						
						$data_insert[$key] = array(
							'id_rol' => $data['meta']['id_rol'] ,
							'id_modulo' => $value ,						
							'id_creador' => $this->data_session['id_usuario'] ,
							'id_empresa' => $this->data_session['id_empresa'] 						
						);							
						
					}
					$this->MModulos->insert( $data_insert );
				}
				
				$this->session->set_flashdata('message','<div class="alert alert-success">Registros actualizados con exito</div>');
				redirect(site_url(uri_string()));	
				
			}		

			$data['listado'] = $this->MModulos->select( array( 'modulos.estado' => 1 ) );
			$data['mod'] = $this->MModulos->modules( array( 
				'rel_roles_empresas.id_empresa' => $this->data_session['id_empresa'] , 
				'rel_roles_empresas.id_rol' => $data['meta']['id_rol'] ,
			));		
			$this->output->unset_template();				
			$this->load->view('roles/modulo', $data );
		}
	}
}