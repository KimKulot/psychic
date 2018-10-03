<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_Controller {


	function __contruct()
    {
        $this->load->model('Blog_model');
        
		
    }


	public function index()
	{	
		
		$data['user'] = Auth::me();
		
		if (isset($this->session->userdata["user"])) {
			$user = json_decode($this->session->userdata["user"]);
			$data['user_id'] = $user->id;
		}
		// get latest blog
		$data["blog"] = $this->Blog_model->get_latest_blog();
		$data["blogs"] = $this->Blog_model->get_latest_blogs();

		$this->load->view('template/header.php', $data);
		$this->load->view('blog.php', $data);
		$this->load->view('template/blog_footer');
		
	}

	public function article($id)
	{
		$data['user'] = Auth::me();
		
		if (isset($this->session->userdata["user"])) {
			$user = json_decode($this->session->userdata["user"]);
			$data['user_id'] = $user->id;
		}

		$data["blog"] = $this->Blog_model->get_blog($id);

		//var_dump($data["blog"]);exit;
		$data["blogs"] = $this->Blog_model->get_latest_blogs();
		$this->load->view('template/header.php', $data);
		$this->load->view('blog.php', $data);
		$this->load->view('template/blog_footer');
	}


}
