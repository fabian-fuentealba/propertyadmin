<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MTipos_cuentas extends MY_Model {	

	public function select( $where = array() ){

		$this->db->select()				
		->from('tipos_cuentas')
		->or_like($where)
		->order_by('tipo_cuenta');
		$query = $this->db->get();
		return $query->result_array();

	}
}
