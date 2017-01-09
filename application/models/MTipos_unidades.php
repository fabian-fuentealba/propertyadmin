<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MTipos_unidades extends MY_Model {	

	public function select( $where = array() ){

		$this->db->select()				
		->from('tipos_unidades')
		->or_like($where)
		->order_by('tipo_unidad');
		$query = $this->db->get();
		return $query->result_array();

	}
}
