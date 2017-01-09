<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MCuentas extends MY_Model {	

	public function select( $where = array() , $is_row = FALSE ){

		$this->db->select()
		->from('cuentas')		
		->join('usuarios','cuentas.id_creador = usuarios.id_usuario')
		->where($where)
		->order_by('nombre');		
		$query = $this->db->get(); //echo $this->db->last_query();
		if($is_row == TRUE ){
			return $query->row_array();
		}else{
			return $query->result_array();
		}	

	}

	public function insert($data){

		$this->db->set('creado','NOW()',FALSE)
		->insert('cuentas',$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}

	}

	public function update( $id , $data ){

		$this->db->set('actualizado','NOW()',FALSE)
		->where('id_cuenta',$id)
		->update('cuentas',$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}

	}
	
}