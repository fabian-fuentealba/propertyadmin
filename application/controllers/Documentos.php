<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentos extends Logged {

	public function __construct(){

		parent::__construct();
		$this->load->model(array('MDocumentos'));
	}	

	public function administrador(){

		if($this->access_module->have_access( 22 , $this->data_session['modules'] )){

			if($this->input->method() == 'post'){
			
				foreach($this->input->post('eliminar') as $key => $value) {
							
					if(unlink('uploads/' . sha1($this->data_session['id_empresa']) . '/' . $value)){
						$this->MDocumentos->delete($key);
					}	
					
				}			
				redirect(site_url(uri_string()));
			}

			$where = array(
				'documentos.id_empresa' => $this->data_session['id_empresa']
			);
			$data['listado'] = $this->MDocumentos->select( $where );		
			$this->load->view('documentos/administrador' , $data );
		}
	}

	public function agregar(){
		
		if($this->access_module->ajax_and_access( 22 , $this->data_session['modules'] )){

			$this->load->library('upload');
			$this->form_validation->set_rules('estado','estado','numeric|required')	
			->set_rules('titulo','titulo','strip_tags|trim|strtoupper|required')			
			->set_rules('comentario','comentario','strip_tags|trim');
			
			$dir = './uploads/' . sha1($this->data_session['id_empresa']) . '/';
			if(!is_dir($dir)){
				mkdir($dir,0777);
				copy( './uploads/index.html' , $dir . 'index.html');
			}
			$config['upload_path'] = $dir;
            $config['allowed_types'] = 'jpeg|jpg|xls|doc|pdf|docx|xlsx|txt';
            $config['max_size'] = 2048; 
            $config['encrypt_name'] = TRUE;       
            $this->upload->initialize( $config );

			if(!$this->form_validation->run()){
				
			}elseif(!$this->upload->do_upload('userfile')){

			}else{
				
				$info = $this->upload->data();
				$sql_data = array(
					'estado' => $this->input->post('estado'),					
					'archivo_titulo' => $this->input->post('titulo'),					
					'comentario' => $this->input->post('comentario'),
					'archivo' => $info['file_name'],								
					'id_creador' => $this->data_session['id_usuario'] ,
					'id_empresa' => $this->data_session['id_empresa']
				);

				$insert = $this->MDocumentos->insert($sql_data);
				if($insert === TRUE){
					$this->session->set_flashdata('message','<div class="alert alert-success">Registro agregado con exito</div>');					
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger">' . $insert . '</div>');
				}
				redirect(site_url(uri_string()));

			}			

			$this->output->unset_template();
			$this->load->view('documentos/agregar');
		}
	}

	public function editar(){
		
		$id = $this->uri->segment(3);
		if($this->access_module->ajax_and_access_and_number( 22 , $this->data_session['modules'] , $id )){

			$this->load->library('upload');
			$this->form_validation->set_rules('estado','estado','numeric|required')	
			->set_rules('titulo','titulo','strip_tags|trim|strtoupper|required')			
			->set_rules('comentario','comentario','strip_tags|trim');		

			if($this->form_validation->run()){		
				
				$sql_data = array(
					'estado' => $this->input->post('estado'),					
					'archivo_titulo' => $this->input->post('titulo'),					
					'comentario' => $this->input->post('comentario'),												
					'id_actualizador' => $this->data_session['id_usuario']					
				);

				$answer = $this->MDocumentos->update( $id , $sql_data );
				if($answer === TRUE){
					$this->session->set_flashdata('message','<div class="alert alert-success">Registro actualizado con exito</div>');					
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger">' . $answer . '</div>');
				}
				redirect(site_url(uri_string()));

			}

			$where = array(
				'documentos.id_documento' => $id ,
				'documentos.id_empresa' => $this->data_session['id_empresa']
			);
			$data['meta'] = $this->MDocumentos->select( $where , TRUE );
			$this->output->unset_template();
			$this->load->view('documentos/editar' , $data );
		}
	}
}
