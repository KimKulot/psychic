<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {


	function __contruct()
    {
        $this->load->model('Articles_model');
        
		
    }


	public function index()
	{	
		
		// get latest blog
		$data["article"] = $this->Articles_model->get_latest_article();
		$data["articles"] = $this->Articles_model->get_articles();

		$this->load->view('template/auth_header.php', $data);
		$this->load->view('login.php', $data);
		$this->load->view('template/footer');
		
	}

	public function register()
	{	
		
		// get latest blog
		$data["article"] = $this->Articles_model->get_latest_article();
		$data["articles"] = $this->Articles_model->get_articles();

		$this->load->view('template/auth_header.php', $data);
		$this->load->view('register.php', $data);
		$this->load->view('template/footer');
		
	}


}
