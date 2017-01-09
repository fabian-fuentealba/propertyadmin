<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MAreas extends MY_Model {	

	public function select( $where = array() ){

		$this->db->select()				
		->from('areas')
		->or_like($where)
		->order_by('orden');
		$query = $this->db->get();
		return $query->result_array();

	}
}
