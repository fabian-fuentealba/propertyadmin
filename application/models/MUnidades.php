<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MUnidades extends MY_Model {	

	public function select( $where = array() , $is_row = FALSE ){

		$this->db->select()				
		->from('unidades')
		->join('tipos_unidades','unidades.id_tipo_unidad = tipos_unidades.id_tipo_unidad')
		->where($where)
		->order_by('estado','DESC')
		->order_by('tipo_unidad,piso,nombre'); 
		$query = $this->db->get();
		if($is_row == TRUE ){
			return $query->row_array();
		}else{
			return $query->result_array();
		}	

	}	

	public function insert($data){

		$this->db->set('creado','NOW()',FALSE)
		->insert('unidades',$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}

	}

	public function update( $id , $data ){

		$this->db->set('actualizado','NOW()',FALSE)
		->where('id_unidad',$id)
		->update('unidades',$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}

	}
}
