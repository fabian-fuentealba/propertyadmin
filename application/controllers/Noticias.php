<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Noticias extends Logged {

	public function __construct(){

		parent::__construct();
		$this->load->model(array('MNoticias','MRel_noticias_usuarios'));
	}	

	public function ver(){
			
		$id = $this->uri->segment(3);	
		if($this->access_module->is_ajax() AND is_numeric($id)){
		
			$where =  array(
				'id_noticia' => $id ,
				'noticias.id_empresa' => $this->data_session['id_empresa']
			);
			$data['meta'] = $this->MNoticias->select( $where , TRUE );
			$where = array(
				'id_usuario' => $this->session->userdata('id_usuario'),
				'id_noticia' => $id
			);
			$this->MRel_noticias_usuarios->insert( $where );
			$this->output->unset_template();	
			$this->load->view( 'noticias/ver' , $data );
		}		
	}

	public function administrador(){

		if($this->access_module->have_access( 18 , $this->data_session['modules'] )){	

			if($this->input->method() == 'post'){
				
				foreach($this->input->post('eliminar') as $key => $value) {			
					$this->MNoticias->delete($value);
					$this->MRel_noticias_usuarios->delete($value);
				}			
				redirect(site_url(uri_string()));
			}
			
			$where =  array(
				'noticias.id_empresa' => $this->data_session['id_empresa']
			);
			$data['noticias'] = $this->MNoticias->select( $where );	
			$this->load->view('noticias/administrador',$data);
		}
	}

	public function agregar(){

		if($this->access_module->ajax_and_access( 18 , $this->data_session['modules'] )){
			
			$this->form_validation->set_rules('estado','estado','numeric|required')		
			->set_rules('titulo','titulo','strip_tags|trim|strtoupper|required')		
			->set_rules('cuerpo','cuerpo','strip_tags|trim|required');

			if($this->form_validation->run()){

				$data_insert = array(
					'estado' => $this->input->post("estado"),					
					'titulo' => $this->input->post("titulo"),					
					'cuerpo' => $this->input->post("cuerpo"),
					'id_rol' => $this->data_session['id_rol'] ,				
					'id_creador' => $this->data_session['id_usuario'] ,
					'id_empresa' => $this->data_session['id_empresa']
				);

				$insert = $this->MNoticias->insert($data_insert);
				if($insert === TRUE){
					$this->session->set_flashdata("message",'<div class="alert alert-success">Registro agregado con exito</div>');					
				}else{
					$this->session->set_flashdata("message",'<div class="alert alert-danger">' . $insert . '</div>');
				}
				redirect(site_url(uri_string()));

			}

			$this->output->unset_template();
			$this->load->view('noticias/agregar');

		}
	}

	public function editar(){

		$id = $this->uri->segment(3);
		if($this->access_module->ajax_and_access_and_number( 18 , $this->data_session['modules'] , $id )){			

			$this->form_validation->set_rules('estado','estado','numeric|required')		
			->set_rules('titulo','titulo','strip_tags|trim|strtoupper|required')		
			->set_rules('cuerpo','cuerpo','strip_tags|trim|required');

			if($this->form_validation->run()){

				$data_update = array(
					'estado' => $this->input->post("estado"),					
					'titulo' => $this->input->post("titulo"),					
					'cuerpo' => $this->input->post("cuerpo"),
					'id_rol' => $this->data_session['id_rol'] ,				
					'id_actualizador' => $this->data_session['id_usuario'] 
				);

				$insert = $this->MNoticias->update( $id , $data_update );
				if($insert === TRUE){
					$this->session->set_flashdata("message",'<div class="alert alert-success">Registro agregado con exito</div>');					
				}else{
					$this->session->set_flashdata("message",'<div class="alert alert-danger">' . $insert . '</div>');
				}
				redirect(site_url(uri_string()));
			}
			
			$where =  array(
				'id_noticia' => $id ,
				'noticias.id_empresa' => $this->data_session['id_empresa']
			);
			$data['meta'] = $this->MNoticias->select( $where , TRUE );	
			$this->output->unset_template();
			$this->load->view('noticias/editar' , $data );
		}
	}
}
