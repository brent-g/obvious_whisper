<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		//$this->load->model('whisper');
	}

	public function index()
	{
		$this->load->library('javascript');
		$this->load->view('components/header');
		$this->load->view('splash');
		$this->load->view('components/footer');
		$this->load->library('form_validation');
	}

	// public function create()
	// {
	// 	$this->load->helper('form');
	// 	$this->load->library('form_validation');

	// 	$data['title'] = 'Obvious Whisper';

	// 	$this->form_validation->set_rules('message', 'message', 'required');
	// 	if ($this->form_validation->run() === FALSE)
	// 	{
	// 		$this->load->view('welcome/create');
	// 		$data['error'] = 'Please enter a message!';
	// 	}
	// 	else
	// 	{
	// 		$this->whisper->createWhisper();
	// 		//$this->whisper->
	// 	}
	// }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */