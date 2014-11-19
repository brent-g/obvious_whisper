<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->helper('date');
		$this->load->library('javascript');
		$this->load->view('components/header');
		$this->load->view('splash');
		$this->load->view('components/footer');
		$this->load->library('form_validation');
	}
}