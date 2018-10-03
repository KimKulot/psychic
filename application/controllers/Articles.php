<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends MY_Controller {


	function __contruct()
    {
        $this->load->model('Articles_model');
        
		
    }


	public function index()
	{	
		
		// get latest blog
		$data["article"] = $this->Articles_model->get_latest_article();
		$data["articles"] = $this->Articles_model->get_articles();

		$this->load->view('template/header.php', $data);
		$this->load->view('articles.php', $data);
		$this->load->view('template/footer2');
		
	}

	public function article($id)
	{
		
		$data["article"] = $this->Articles_model->get_article($id);

		//var_dump($data["article"]);exit;

		$this->load->view('template/header.php', $data);
		$this->load->view('article.php', $data);
		$this->load->view('template/footer2');
	}


}
