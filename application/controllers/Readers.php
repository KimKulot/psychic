<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Readers extends MY_Controller {


	function __contruct()
    {
        $this->load->model('Psychic_model');
        
		
    }


	public function index()
	{	
		
		$data["readers"] = $this->Psychic_model->get_readers();

		$this->load->view('template/header.php', $data);
		$this->load->view('readers.php', $data);
		$this->load->view('template/footer2');
		
	}

	public function reader($id)
	{
		
		$data["reader"] = $this->Psychic_model->get_reader($id);

		$this->load->view('template/header.php', $data);
		$this->load->view('reader.php', $data);
		$this->load->view('template/footer2');
	}


}

