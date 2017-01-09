<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MEmpresas extends MY_Model {	

	public function select( $where = array() ){

		$this->db->select()				
		->from('empresas')
		->or_like($where);		
		$query = $this->db->get();
		return $query->row_array();

	}

	public function update( $id , $data ){

		$this->db->set('actualizado','NOW()',FALSE)
		->where('id_empresa',$id)
		->update('empresas',$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}

	}
}
