<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MRoles extends MY_Model {

	public function select( $where = array() , $is_row = FALSE , $only_number = FALSE , $page = NULL , $quantity = NULL ){

		$this->db->select()
		->select("IF(roles.estado IS TRUE , 'activo' , 'inactivo' ) AS estado_texto")			
		->from('roles')	
		->join('areas','roles.id_area = areas.id_area')
		->where('roles.id_empresa' , $this->session->userdata('id_empresa') )
		->like($where);	

		if($is_row == FALSE AND $only_number == FALSE ){
		
			if($page <= 1){

				$page = $quantity;
				$this->db->limit($page);

			}else{

				$page = ($page - 1) * $quantity;							
				$this->db->limit($quantity,$page);

			}
					
			$this->db->order_by('rol');
			
		}		
			
		$query = $this->db->get();

		if($is_row == TRUE ){

			return $query->row_array();

		}elseif($only_number == TRUE ){

			$numero = $query->num_rows();
			$query->free_result();
			return $numero;

		}else{

			return $query->result_array();
			
		}

	}

	public function insert($data){

		$this->db->set('creado','NOW()',FALSE)
		->insert('roles',$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}

	}

	public function update( $id , $data ){

		$this->db->set('actualizado','NOW()',FALSE)
		->where('id_rol',$id)
		->update('roles',$data); //echo $this->db->last_query();
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}

	}

}