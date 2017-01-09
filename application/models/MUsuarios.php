<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MUsuarios extends MY_Model {

	public function select( $where = array() , $is_row = FALSE , $only_number = FALSE , $page = NULL , $quantity = NULL ){

		$this->db->select()		
		->from('usuarios')
		->join('roles','usuarios.id_rol = roles.id_rol','inner')
		->where($where)
		->where_not_in('usuarios.login',2)
		->order_by('rol');		
		$query = $this->db->get();
		if($is_row == TRUE ){
			return $query->row_array();
		}else{
			return $query->result_array();
		}		
	}

	public function colaboradores( $data ){

		$this->db->select('areas.area')
		->select('roles.rol')
		->select('usuarios.foto')
		->select('usuarios.nombres')
		->select('usuarios.apellidos')
		->from('areas')
		->join('roles','areas.id_area = roles.id_area')
		->join('usuarios','roles.id_rol = usuarios.id_rol')
		->where( $data )
		->where_not_in('areas.id_area', 5 )
		->order_by('areas.orden')
		->order_by('roles.rol')
		->order_by('usuarios.nombres');
		$query = $this->db->get();
		$data = array();
		foreach ($query->result_array() as $value) {
			$data[$value['area']][] = array(
				'rol' => $value['rol'],
				'nombres' => $value['nombres'],
				'apellidos' => $value['apellidos'],
				'foto' => $value['foto']
			);
		}
		return $data;
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