<?php

class Psychic_model extends Base_model {

	public $id;
    public $username;
    public $fname;
	public $lname;
    public $password;
    public $home_address;
    public $email_address;
    public $paypal_address;
    public $profile_img;
    public $mobile_num;
    public $home_phone;
    public $status;

    public function __get($name)
    {
    	switch ($name) {
    		case 'displayName':
    			return $this->fname." ".$this->lname;
    		
    		default:
    			return parent::__get($name);
    	}
    }

    public function profile_update($psychic_id, $data) 
    {
        $this->db->where('id', $psychic_id);
        $this->db->set($data);
        return $this->db->update('psychics', $data);              
    }

    public function update_pin($psychic_id, $pin) 
    {
	/*
        $this->db->where('id', $psychic_id);
        $this->db->set($data);
        $this->db->update('_psychics', $data);              
	*/
        $sql = "UPDATE psychics SET pin='$pin' WHERE id='$psychic_id'";
	   $this->db->query($sql);
    }

	public function send_validation_email($email_address, $fname, $reg_time, $pin) {

	
    	$this->load->library('email');
    	$config = array();
        /* -- Prod */
    	$config['useragent']           = "CodeIgniter";
    	$config['mailpath']            = "/usr/sbin/sendmail"; // or "/usr/sbin/sendmail"
    	$config['protocol']            = "smtp";
    	$config['smtp_host']           = "localhost";
    	$config['smtp_port']           = "25";
    	$config['mailtype'] = 'html';
    	$config['charset']  = 'utf-8';
    	$config['newline']  = "\r\n";
    	$config['wordwrap'] = TRUE;
        //*/

        /* -- Staging 
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'mail.taroflash.com';
        $config['smtp_port']    = '587';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'noreply@astral-foundations.com';
        $config['smtp_pass']    = 'NoRep2017*123abc';
        $config['smtp_crypto'] = 'tls'; 
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['wordwrap'] = TRUE;
        $config['validation'] = TRUE; // bool whether to validate email or not  
        */    

        /**/
        $this->email->initialize($config);

        $email = $email_address;
        $email_code = md5((string)$reg_time);

        $this->email->set_mailtype('html');
        $this->email->from('webmaster@psychic-contact.com');
        $this->email->to($email_address); // email of reader
	    $this->email->bcc('ericvp2016@gmail.com');
        $this->email->subject('Please activate your account at Text-A-Psychic.com');

        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strit.dtd"><html><head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    </head><body>';

        $message .= '<p>Dear ' . $fname . ',</p>';
        // the link will look like /bulletin_board/validate_email/john@doe.com/d23fdsf342rewrwefdsfsadfasf
        $message .= '<p>Thanks for registering on Text-A-Psychic.com! Please <strong><a href="' . base_url() . 'bulletin_board/validate_email/' . $email . '/' . $email_code . '">click here</a></strong> to activate your account. After you have activated your account, you will be able to log into to Text-A-Psychic.com and start answering Questions from clients!</p>';
        $message .= "<p>Here's your pin: $pin</p>";
        $message .= '<p>Thank you!</p>';
        $message .= '<p>Text-A-Psychic.com</p>';
        $message .= '</body></html>';

        $this->email->message($message);
        if($this->email->send()) {

	   } else {
		echo $this->email->print_debugger();exit;
	   }
       //*/

	
    }

    public function validate_email($email_address, $email_code) {

        $sql = "SELECT email_address, reg_time, fname FROM psychics WHERE email_address='{$email_address}' LIMIT 1 ";
        $result = $this->db->query($sql);
        $row = $result->row();
        
        if ($result->num_rows() === 1 && $row->fname) {
            if (md5((string)$row->reg_time) === $email_code)
            $result = $this->activate_account($email_address);
            if ($result === true) {
                return true;
            } else {
                // this should never happen
                //echo 'There was an error when activating your account. Please contact the admin at ' . $this->config->item('admin_email');
                echo 'There was an error when activating your account. Please contact the admin at  webmaster@psychic-contact.com';
            }
        } else {
            // this should never happen
            //echo 'There was an error when activating your account. Please contact the admin at ' . $this->config->item('admin_email');
            echo 'There was an error when activating your account. Please contact the admin at  webmaster@psychic-contact.com';
        }
    }


    private function activate_account($email_address) {
        //$sql = "UPDATE psychics SET activated=1 WHERE email_address='" .$email_address."' LIMIT 1";
        $sql = "UPDATE psychics SET activated=1, in_slider=1 WHERE email_address='" .$email_address."' LIMIT 1";
	$this->db->query($sql);
        if ($this->db->affected_rows() === 1 ) {
            return true;
        } else {
            // this should never happen
            //echo 'Error when activating your account in the database, please contact ' . $this->config->item('admin_email');
            echo 'Error when activating your account in the database, please contact webmaster@psychic-contact.com';
            return false;
        }

    }



    public function get_reader($id)
    {
        $query = $this->db->query("SELECT * FROM psychics WHERE id='$id' LIMIT 0, 1");
        
        return $query->row();

    }

    public function get_slider_readers()
    {
        $query = $this->db->query("SELECT * FROM psychics WHERE test_account=0 AND activated=1 AND in_slider=1 ORDER BY id ");
        
        return $query->result_array();

    }

    public function get_readers()
    {
        $query = $this->db->query("SELECT * FROM psychics WHERE test_account=0 AND activated=1 ORDER BY id ");
        
        return $query->result_array();

    }
}

