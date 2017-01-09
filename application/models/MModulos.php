<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MModulos extends MY_Model {	

	public function select( $where = array() ){

		$this->db->select('b.modulo AS padre')		
		->select('modulos.modulo')
		->select('modulos.id_modulo')			
		->from('modulos')		
		->join('modulos b','modulos.padre = b.id_modulo')
		->where($where)
		->where('modulos.url IS NOT NULL')
		->where('modulos.estado', 1 )
		->order_by('padre')
		->order_by('modulos.modulo');			
		$query = $this->db->get();
		$data = array();
		foreach ( $query->result_array() as $key => $value) {

		 	$data[$value['padre']][$value['id_modulo']] = $value['modulo'];

		}

		return $data ; 		

	}	

	public function modules( $where = array() ){

		$this->db->select('id_modulo')			
		->from('rel_roles_empresas')
		->where($where);			
		$query = $this->db->get();
		$data = array();
		foreach ( $query->result_array() as $key => $value) {

		 	$data[] = $value['id_modulo'];

		}

		return $data ; 

	}

	public function menus( $where = array() ){

		$this->db->select('b.modulo AS padre')
		->select('a.modulo')
		->select('a.url')			
		->from('rel_roles_empresas')
		->join('modulos a','rel_roles_empresas.id_modulo = a.id_modulo')
		->join('modulos b','a.padre = b.id_modulo')
		->where($where)
		->where('a.url IS NOT NULL')
		->order_by('padre,modulo');					
		$query = $this->db->get();
		$data = array();
		foreach ( $query->result_array() as $key => $value) {

		 	$data[$value['padre']][$value['url']] = $value['modulo'];

		}

		return $data ; 

	}

	public function insert( $data ){
		
		$this->db->insert_batch( 'rel_roles_empresas' , $data );
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}

	}

	public function delete( $where ){

		$this->db->where( $where )
		->delete( 'rel_roles_empresas' );
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}

	}

}
