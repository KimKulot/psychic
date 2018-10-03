<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

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


	public function index()
	{	
		$record['is_activated_success'] = $this->session->flashdata('is_activated');
		$record['is_activated_false'] = $this->session->flashdata('is_activated_invalid');

		$this->hide_banner = true;

        $content = $this->system_vars->get_page('home');
        $content2 = $this->system_vars->get_page('home2');

        $record["content"] = $content['content'];
        $record["content2"] = $content2['content'];

        $this->load->model('Psychic_model');
        $record["readers"] = $this->Psychic_model->get_slider_readers();

		$this->load->model('Articles_model');
		$data["articles"] = $this->Articles_model->get_articles();

        $this->load->view('template/header', $record);
        $this->load->view('pages/home.php', $record);
        $this->load->view('template/footer', $data);
	}
}
