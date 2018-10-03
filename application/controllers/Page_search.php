<?php

class page_search extends MY_Controller {

    function __construct()
    {

        parent :: __construct();

        $this->settings = $this->system_vars->get_settings();
    }

    function index()
    {

        $uri = $this->uri->segment('1');

        $findReader = $this->db->query
                        ("
			
				SELECT 
					members.username 
					
				FROM 
					members
					
				JOIN profiles ON profiles.id = members.id AND profiles.active = 1
				
				WHERE members.username = '{$uri}'
				
				LIMIT 1
			
			")->row_array();

        if ($findReader)
        {

            redirect("/profile/{$findReader['username']}");
        }
        else
        {

            $getPage = $this->db->query("SELECT * FROM pages WHERE url = '{$uri}' LIMIT 1");

            if ($getPage->num_rows() == 0)
            {

                if ($uri == 'vadmin') {
                    $this->load->view('error_page');
                } else { 
                    $this->load->view('template/header', $getPage->row_array());
                    $this->load->view('error_page');
                    $this->load->view('template/footer');
                }
            }
            else
            {
                $data['packages'] = null;
                if ($uri == 'package') {
                    $data['packages'] = $this->db->query("SELECT * FROM packages WHERE type = 'sms'")->result_array();
                }
                $data["content"] = $getPage->row_array();
                $this->load->view('template/header', $getPage->row_array());
                $this->load->view('static_page', $data);
                $this->load->view('template/footer2');
            }
        }
    }

}
