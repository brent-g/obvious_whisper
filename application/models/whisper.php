<?php
class Whisper extends CI_Model 
{
	
	public function __construct()
	{
		$this->load->database();
		$this->load->helper('string');
	}
	// create this whisper in the database
	public function createWhisper()
	{
		$url = random_string('alnum', 8); // generate a random 8 character string 
		$user_ip = $_SERVER['REMOTE_ADDR']; // get the users IP
		$new_message = $this->input->post('message');
		$data = array(
			'message' 	=> $new_message,
			'user_ip'	=> $user_ip,
			'url' 		=> $url

		);
		$this->db->insert('message', $data); // insert the record into the database
		return $url; // return the url string
	}

	// access the newly posted url 
	public function loadWhisper($url='')
	{
		if (empty($url))
		{
			show_404('page', ['log_error']);
			//echo 'page not found';
		}
		else
		{
			$sql_query = "SELECT message FROM message WHERE url = ? LIMIT 1";
			$message = $this->db->query($sql_query, array($url));
			if ($message->num_rows() > 0)
			{
				return $message->row_array();
			}
		}
	}
}
?>