<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MCopropietarios extends MY_Model {

	public function select( $where = array() , $is_row = FALSE , $only_number = FALSE , $page = NULL , $quantity = NULL ){

		$this->db->select()		
		->from('copropietarios')
		->join('roles','copropietarios.id_rol = roles.id_rol','inner')
		->where($where)
		->where_not_in('copropietarios.login',2)
		->order_by('rol');		
		$query = $this->db->get();
		if($is_row == TRUE ){
			return $query->row_array();
		}else{
			return $query->result_array();
		}		
	}	

	public function login( $where = array() ){

		$this->db->select()	
		->from('usuarios')
		->join('roles','usuarios.id_rol = roles.id_rol','inner')
		->join('empresas','usuarios.id_empresa = empresas.id_empresa')
		->where($where);	
		$query = $this->db->get();
		return $query->row_array();

	}		

	public function insert($data){

		$this->db->set('creado','NOW()',FALSE)
		->insert('usuarios',$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return $this->db->insert_id();
		}else{
			return $error['message'];
		}

	}

	public function update( $id , $data ){

		$this->db->set('actualizado','NOW()',FALSE)
		->where('id_usuario',$id)
		->update('usuarios',$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}

}