<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MDocumentos extends MY_Model {	

	public function select( $where = array() , $is_row = FALSE ){

		$this->db->select('documentos.archivo_titulo')
		->select('documentos.archivo')
		->select('documentos.creado')
		->select('documentos.estado')
		->select('documentos.comentario')
		->select('roles.rol')
		->select('documentos.id_documento')
		->select('documentos.id_empresa')
		->from('documentos')		
		->join('usuarios','documentos.id_creador = usuarios.id_usuario')
		->join('roles','usuarios.id_rol = roles.id_rol')
		->where($where)
		->order_by('documentos.archivo_titulo');		
		$query = $this->db->get();
		if($is_row == TRUE ){
			return $query->row_array();
		}else{
			return $query->result_array();
		}	

	}

	public function insert($data){

		$this->db->set('creado','NOW()',FALSE)
		->insert('documentos',$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}

	}

	public function update( $id , $data ){

		$this->db->set('actualizado','NOW()',FALSE)
		->where( 'id_documento' , $id )
		->update( 'documentos' , $data );
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}

	}

	public function delete( $id ){

		$this->db->where( 'id_documento' , $id )
		->delete('documentos');

	}
	
}