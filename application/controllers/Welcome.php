<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Logged {
	
	public function index(){
		
		$this->load->view('welcome_message');
	}
}
