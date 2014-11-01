<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create_whisper extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('whisper');
	}

	public function index()
	{
		show_404();
	}

	public function create()
	{
		$message = $this->input->post('message');
		if (empty($message) || $message === FALSE)
		{
			echo 'No message specified';
			return FALSE;
		}
		else
		{
			$url = $this->whisper->createWhisper();
			$return_data = array (
				"url" => $url
			);
			echo json_encode($return_data);
		}
	}
}
