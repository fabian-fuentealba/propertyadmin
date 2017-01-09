<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MNoticias extends MY_Model {	

	public function select( $where = array() , $is_row = FALSE ){

		$this->db->select('noticias.titulo')		
		->select('noticias.cuerpo')	
		->select('noticias.creado')
		->select('noticias.id_noticia')	
		->select('areas.area')
		->select('roles.rol')
		->select('noticias.estado')
		->select('usuarios.usuario')
		->select('(SELECT COUNT(*) FROM rel_noticias_usuarios a WHERE noticias.id_noticia = a.id_noticia AND usuarios.id_usuario = ' . $this->session->userdata('id_usuario')  .' ) AS visto', FALSE )
		->from('noticias')
		->join('roles','noticias.id_rol = roles.id_rol')
		->join('areas','roles.id_area = areas.id_area')
		->join('usuarios','noticias.id_creador = usuarios.id_usuario')
		->where($where)
		->order_by('noticias.creado','DESC');		
		$query = $this->db->get();
		if($is_row == TRUE ){
			return $query->row_array();
		}else{
			return $query->result_array();
		}	

	}

	public function insert($data){

		$this->db->insert('noticias',$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}

	}

	public function update( $id , $data ){

		$this->db->set('actualizado','NOW()',FALSE)
		->where('id_noticia',$id)
		->update('noticias',$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}

	}

	public function delete( $id ){

		$this->db->where( 'id_noticia' , $id )
		->delete('noticias');

	}
}
