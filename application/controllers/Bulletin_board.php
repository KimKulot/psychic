<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bulletin_board extends MY_Controller {

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

	function __contruct()
    {
        $this->load->model('Inbound_message_model');
        $this->load->model('Psychic_model');
        $data['title'] = 'Bulletin board';
		$data['user'] = Auth::me();

		
    }


	public function index()
	{	

		$data['title'] = 'Bulletin board';
		$data['user'] = Auth::me();
		
		if (isset($this->session->userdata["user"])) {
			$user = json_decode($this->session->userdata["user"]);
			$data['user_id'] = $user->id;
		}

		if ($user->activated) {

			$data['resolved_messages'] = $this->Inbound_message_model->get_count_responded_messages($user->id);
			//$data['all_messages'] = $this->Inbound_message_model->get_count_all_messages($user->id);
			$data['all_messages'] = 0;
			$this->load->view('template/reader_header.php', $data);
			$this->load->view('bulletin_board.php');
		} else {
			// send activation code
			$this->Psychic_model->send_validation_email($user->email_address, $user->fname, $user->reg_time, $user->pin);

			// logged out user
			Auth::logout();
        		setcookie('user', '', 0, '/');

			$getPage = $this->db->query("SELECT * FROM pages WHERE url = 'about-us' LIMIT 1");
        		$this->load->view('template/header', $getPage->row_array());
			$this->load->view('send_email_validation', array('email_address' => $user->email_address ));
			$this->load->view('template/footer2');
		}
		
	}


	public function resolved_messages($user_id)
    {
    	// get responded messages
		$messages = $this->inbound_message->get_responded_messages($user_id);
        $data = array();
        $no = $_POST['start'];
        foreach ($messages as $message) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $message->id;
            $row[] = $message->message;
            $row[] = substr($message->sent_at, 0, 10);
            $row[] = substr($message->sent_at, 11, 8);
            $row[] = $message->country;
            $row[] = substr($message->number, -4) . str_repeat('*', strlen($message->number) - 4);
            $row[] = $message->shortcode;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->messages->count_all(),
                        "recordsFiltered" => $this->messages->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

	public function profile_get($psychicId) {
		var_dump($psychicId);

	}


	public function validate_email($email_address, $email_code) {

		$email_code = trim($email_code);

		$validated = $this->Psychic_model->validate_email($email_address, $email_code);

		if ($validated === true) {
			$this->hide_banner = true;
        	
        	$getPage = $this->db->query("SELECT * FROM pages WHERE url = 'about-us' LIMIT 1");
        	$this->load->view('template/header', $getPage->row_array());
			$this->load->view('email_validated', array('email_address' => $email_address ));
			$this->load->view('template/footer2');
		} else {
			// this should never happen
			//echo 'Error giving email activated confirmation, please contact ' . $this->config->item('admin_email');

			echo 'Error giving email activated confirmation, please contact webmaster@psychic-contact.com';
		}
	}
}
