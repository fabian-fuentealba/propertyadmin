<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entradas extends Logged {

	public function __construct(){

		parent::__construct();
		$this->load->model(array('MEntradas'));
	}