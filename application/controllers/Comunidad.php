<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comunidad extends Logged {

	public function __construct(){

		parent::__construct();
		$this->load->model(array('MDocumentos','MNoticias','MUsuarios'));
	}
	
	public function noticias(){		

		$where =  array(
			'noticias.id_empresa' => $this->data_session['id_empresa']
		);
		$data['noticias'] = $this->MNoticias->select( $where );
		$this->load->view( 'comunidad/noticias' , $data );
	}

	public function documentos(){
		
		$where =  array(
			'documentos.id_empresa' => $this->data_session['id_empresa'],
			'documentos.estado' => 1
		);
		$data['listado'] = $this->MDocumentos->select( $where );
		$this->load->view( 'comunidad/documentos' , $data );
	}

	public function colaboradores(){
		
		$where =  array(
			'usuarios.id_empresa' => $this->data_session['id_empresa'],
			'usuarios.login' => 1
		);
		$data['listado'] = $this->MUsuarios->colaboradores( $where );
		$this->load->view( 'comunidad/colaboradores' , $data );
	}

}