<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administracion extends Logged {
	
	public function index(){
		
		$this->load->view('administracion/index');
	}

	
}
