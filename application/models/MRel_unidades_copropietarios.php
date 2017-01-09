<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MRel_unidades_copropietarios extends MY_Model {

	public function select( $where = array() , $is_row = FALSE ){

		$this->db->select()				
		->from('unidades')
		->join('tipos_unidades','unidades.id_tipo_unidad = tipos_unidades.id_tipo_unidad')
		->where_not_in('unidades.id_unidad','(SELECT a.id_unidad FROM rel_unidades_copropietarios a JOIN unidades b ON a.id_unidad = b.id_unidad WHERE b.id_empresa = ' . $this->session->userdata('id_empresa') . ' )' , FALSE )
		->where( $where )
		->order_by('nombre'); 
		$query = $this->db->get();
		if($is_row == TRUE ){
			return $query->row_array();
		}else{
			return $query->result_array();
		}	

	}

	public function insert( $user , $unidades ){

		$this->db->trans_start();
		$this->db->set( 'creado' , 'NOW()' , FALSE )
		->insert( 'copropietarios' , $user );
		$insert_id = $this->db->insert_id();
		foreach($unidades as $key => $value) {
					
			$sql_data_batch[$key] = array(
				'id_copropietario' => $insert_id ,					
				'id_creador' => $this->data_session['id_usuario'] ,
				'id_empresa' => $this->data_session['id_empresa'] ,
				'id_unidad' => $value
			);
		}
		$this->db->insert_batch('rel_unidades_copropietarios' , $sql_data_batch );
		$this->db->trans_complete();
		return $this->db->trans_status();

	}


}