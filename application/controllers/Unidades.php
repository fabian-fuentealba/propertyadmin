<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unidades extends Logged {

	public function __construct(){

		parent::__construct();
		$this->load->model(array('MTipos_unidades','MUnidades'));
	}
	
	public function index(){

		if($this->access_module->have_access( 14 , $this->data_session['modules'] )){
		
			$where = array(
				'id_empresa' => $this->data_session['id_empresa']
			);
			$data['propiedades'] = $this->MUnidades->select($where);
			$this->load->view('unidades/index',$data);
		}
	}

	public function agregar(){	
		
		if($this->access_module->ajax_and_access( 14 , $this->data_session['modules'] )){

			$this->form_validation->set_rules('estado','estado','numeric|required')
			->set_rules('tipo_unidad','tipo unidad','numeric|required')
			->set_rules('nombre','nombre','strip_tags|trim|strtoupper|required')
			->set_rules('piso','piso','trim|integer|required')
			->set_rules('metros','metros','trim|numeric|required')
			->set_rules('referencia','referencia','strip_tags|trim|strtoupper');

			if($this->form_validation->run()){

				$data_insert = array(
					'estado' => $this->input->post("estado"),					
					'nombre' => $this->input->post("nombre"),					
					'piso' => $this->input->post("piso"),
					'metros' => $this->input->post("metros"),
					'referencia' => $this->input->post("referencia"),	
					'piso' => $this->input->post("piso"),				
					'id_creador' => $this->data_session['id_usuario'] ,
					'id_empresa' => $this->data_session['id_empresa'] ,
					'id_tipo_unidad' => $this->input->post('tipo_unidad')
				);

				$insert = $this->MUnidades->insert($data_insert);
				if($insert === TRUE){
					$this->session->set_flashdata("message",'<div class="alert alert-success">Registro agregado con exito</div>');					
				}else{
					$this->session->set_flashdata("message",'<div class="alert alert-danger">' . $insert . '</div>');
				}
				redirect(site_url(uri_string()));

			}

			$data['tipos_unidades'] = $this->MTipos_unidades->select();
			$this->output->unset_template();
			$this->load->view('unidades/agregar',$data);	

		}
		
	}

	public function editar(){
		
		$id = $this->uri->segment(3);
		if($this->access_module->ajax_and_access_and_number( 14 , $this->data_session['modules'] , $id )){

			$this->form_validation->set_rules('estado','estado','numeric|required')
			->set_rules('tipo_unidad','tipo unidad','numeric|required')
			->set_rules('nombre','nombre','strip_tags|trim|strtoupper|required')
			->set_rules('piso','piso','trim|integer|required')
			->set_rules('metros','metros','trim|numeric|required')
			->set_rules('referencia','referencia','strip_tags|trim|strtoupper');

			if($this->form_validation->run()){

				$data_update = array(
					'estado' => $this->input->post("estado"),					
					'nombre' => $this->input->post("nombre"),					
					'piso' => $this->input->post("piso"),
					'metros' => $this->input->post("metros"),
					'referencia' => $this->input->post("referencia"),	
					'piso' => $this->input->post("piso"),				
					'id_actualizador' => $this->data_session['id_usuario'] ,					
					'id_tipo_unidad' => $this->input->post('tipo_unidad')
				);

				$update = $this->MUnidades->update( $id , $data_update);
				if($update === TRUE){
					$this->session->set_flashdata("message",'<div class="alert alert-success">Registro actualizado con exito</div>');					
				}else{
					$this->session->set_flashdata("message",'<div class="alert alert-danger">' . $update . '</div>');
				}
				redirect(site_url(uri_string()));

			}

			$where = array(
				'id_empresa' => $this->data_session['id_empresa'] ,
				'id_unidad' => $id
			);
			$data['meta'] = $this->MUnidades->select( $where , TRUE );
			$data['tipos_unidades'] = $this->MTipos_unidades->select();
			$this->output->unset_template();
			$this->load->view('unidades/editar',$data);	
		}		
	}	
}