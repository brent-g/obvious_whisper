<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Find_whisper extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('whisper');
		$this->load->helper('string');
	}

	public function index()
	{
		$url = $this->uri->segment(2); // create a var of the second uri parameter
		$message = $this->whisper->LoadWhisper($url);
		$data = array();
		$data['message'] = strip_quotes($message['message']);

		if (empty($data['message']) || $data['message'] === FALSE)
		{
			self::error();
		}
		else
		{
			// the message display page!
			$this->load->view('components/header');
			$this->load->view('message', $data, false);
			$this->load->helper('date');
			$data['this_year'] = mdate('%Y'); // send the year to the footer
			$this->load->view('components/footer',$data);
		}
	}

	public function error()
	{
		$this->load->view('components/header');
		$this->load->view('error');
		$data['this_year'] = mdate('%Y'); // send the year to the footer
		$this->load->view('components/footer',$data);
	}
}