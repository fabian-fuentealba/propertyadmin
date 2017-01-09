<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MRel_noticias_usuarios extends MY_Model {	

	public function insert($data){
		
		$this->db->replace('rel_noticias_usuarios',$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}

	}

	public function delete( $id ){

		$this->db->where( 'id_noticia' , $id )
		->delete('rel_noticias_usuarios');

	}
}