<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuentas extends Logged {

	public function __construct(){

		parent::__construct();
		$this->load->model(array('MCuentas','MTipos_cuentas'));
	}
	
	public function index(){		
	
		if($this->access_module->have_access( 19 , $this->data_session['modules'] )){			

			$data['listado'] = $this->MCuentas->select( array( 'cuentas.id_empresa' => $this->data_session['id_empresa'] ));
			$this->load->view('cuentas/index' , $data );
		}	
		
	}

	public function agregar(){

		if($this->access_module->ajax_and_access( 19 , $this->data_session['modules'] )){

			$this->form_validation->set_rules('estado','estado','integer|required')	
				->set_rules('tipo_cuenta','tipo cuenta','integer|required')
				->set_rules('codigo','codigo','strip_tags|trim|strtoupper|required')
				->set_rules('nombre','nombre','strip_tags|trim|strtoupper|required')
				->set_rules('detalle','detalle','strip_tags|trim|strtoupper');
				
			if($this->form_validation->run()){

				$data_insert = array(
					'estado' => $this->input->post('estado'),					
					'id_tipo_cuenta' => $this->input->post('tipo_cuenta'),					
					'codigo' => $this->input->post('codigo'),
					'nombre' => $this->input->post('nombre'),
					'detalle' => $this->input->post('detalle'),								
					'id_creador' => $this->data_session['id_usuario'] ,
					'id_empresa' => $this->data_session['id_empresa'] 					
				);

				$insert = $this->MCuentas->insert($data_insert);
				if($insert === TRUE){
					$this->session->set_flashdata('message','<div class="alert alert-success">Registro agregado con exito</div>');					
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger">' . $insert . '</div>');
				}
				redirect(site_url(uri_string()));

			}

			$where = array(
				'categoria' => 1 ,
				'estado' => 1
			);
			$data['tipos_cuentas'] = $this->MTipos_cuentas->select( $where );
			$this->output->unset_template();
			$this->load->view('cuentas/agregar' , $data);
		}	
				
	}

	public function editar(){

		$id = $this->uri->segment(3);
		if($this->access_module->ajax_and_access_and_number( 19 , $this->data_session['modules'] , $id )){

			$this->form_validation->set_rules('estado','estado','integer|required')	
				->set_rules('tipo_cuenta','tipo cuenta','integer|required')
				->set_rules('codigo','codigo','strip_tags|trim|strtoupper|required')
				->set_rules('nombre','nombre','strip_tags|trim|strtoupper|required')
				->set_rules('detalle','detalle','strip_tags|trim|strtoupper');
				
			if($this->form_validation->run()){

				$sql_data = array(
					'estado' => $this->input->post('estado'),					
					'id_tipo_cuenta' => $this->input->post('tipo_cuenta'),					
					'codigo' => $this->input->post('codigo'),
					'nombre' => $this->input->post('nombre'),
					'detalle' => $this->input->post('detalle'),								
					'id_actualizador' => $this->data_session['id_usuario'] 			
				);

				$answer = $this->MCuentas->update( $id , $sql_data );
				if($answer === TRUE){
					$this->session->set_flashdata('message','<div class="alert alert-success">Registro actualizado con exito</div>');					
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger">' . $insert . '</div>');
				}
				redirect(site_url(uri_string()));
			}

			$where = array(
				'categoria' => 1 ,
				'estado' => 1
			);
			$data['tipos_cuentas'] = $this->MTipos_cuentas->select( $where );
			$where = array(
				'cuentas.id_empresa' => $this->data_session['id_empresa'],
				'cuentas.id_cuenta' => $id
			);
			$data['meta'] = $this->MCuentas->select( $where , TRUE );
			$this->output->unset_template();
			$this->load->view('cuentas/editar' , $data );
		}	
				
	}

}