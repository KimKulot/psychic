<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'libraries/REST_Controller.php');

class Psychics extends REST_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Member_model');  
    }
    
    public function psychic_get ($id) {
        $errors = [];
        $success = true;
        
        if (count($errors)) {
            $success = false;
        }

        $data = $this->Psychic_model->all([
            'where' => [
                'id'    => [
                    $id
                ]
            ]
        ]);

        return $this->response(compact('data', 'success', 'errors'));
    }

    public function psychic_all_get () {
        $errors = [];
        $success = true;
        
        if (count($errors)) {
            $success = false;
        }

        $data = $this->Psychic_model->all();
        
        return $this->response(compact('data', 'success', 'errors'));
    }



    public function login_post ()
    {
        $errors = [];
        $success = true;
        $data = null;
        $is_member = "Reader";

        $username = $this->post('username');
        $password = $this->post('password');

        if (!$username) {
            $errors[] = 'Missing username';
        }
        if (!$password) {
            $errors[] = 'Missing password';
        }

        $data['auth_data']= Auth::login($username, $password);
        if ($data['auth_data']['user_type'] == "member") {
            $is_member = "Member";
        }

        if (!count($errors)) {
            if (!$data['auth_data']['success']) {
                $errors = Auth::$errors;    
            }
        }

        if (count($errors)) {
            $success = false;
        } else {
            $data['user'] = Auth::me();
            if (isset($data['user']['pin'])) {
                $user_data['status'] = 1;
                $this->Psychic_model->profile_update($data['user']['id'], $user_data);
            }
            
        }

        setcookie('user', json_encode(Auth::me()), time() + 7200, '/');
        $this->notify_admin($username, "In", $is_member);
        return $this->response(compact('data', 'success', 'errors'));
    }

    public function logout_get()
    {
        $errors = [];
        $success = true;
        $data = null;
        $authname = Auth::me();
        $data['user'] = Auth::me();
        $user_data['status'] = 0;
        $this->Psychic_model->profile_update($data['user']['id'], $user_data);
	    $reader = $authname['username'];
        $status  = Auth::logout();
        setcookie('user', '', 0, '/');
        $this->notify_admin($reader, "Out");
        return $this->response(compact('data', 'success', 'errors'));
    }

    public function notify_admin($reader, $action, $is_member = "Reader") {
        $this->load->library('email');
        $config['protocol']     = 'smtp';
        $config['smtp_host']    = 'mail.taroflash.com';
        $config['smtp_user']    = 'info@sms-psychics.co.uk';
        $config['smtp_pass']    = 'Inf02017*JLbb!9991';
        $config['smtp_port']    = 25;
        $config['mailtype']     = 'html';
        $config['smtp_crypto']  = 'tls';
        $config['_smtp_auth']   = TRUE;
        $config['newline']      = "\r\n";
        $config['wordwrap']     = TRUE;
        $config['charset']      = 'utf-8';
        $this->email->initialize($config);

        $this->email->from('webmaster@psychic-contact.com');
        $this->email->to('jlynndfs@yahoo.com');
	$this->email->bcc('ericvp2016@gmail.com');
        $subject = "Text-A-Psychic: " . $is_member . " " . $reader . "  Signed " . $action;
        $this->email->subject($subject);

        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strit.dtd"><html><head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    </head><body>';

        $message .= '<p>Dear Jayson</p>';
        $message .= "<p>Reader  " . $reader . " just signed " . strtolower($action);
$message .= '<p>Thank you!</p>';
        $message .= '<p>Text-A-Psychic.com</p>';
        $message .= '</body></html>';

        $this->email->message($message);
        if($this->email->send()) {

        } else {
            echo $this->email->print_debugger();
        }




}



// defined('BASEPATH') OR exit('No direct script access allowed');

// require_once(APPPATH . 'libraries/REST_Controller.php');

// class Psychics extends REST_Controller {

//     public function psychic_get ($id) {
//         $errors = [];
//         $success = true;
        
//         if (count($errors)) {
//             $success = false;
//         }

//         $data = $this->Psychic_model->first([
//             'where' => [
//                 'id'    => [
//                     $id
//                 ]
//             ]
//         ]);

//         return $this->response(compact('data', 'success', 'errors'));
//     }

//     public function psychic_all_get () {
//         $errors =  array();;
//         $success = true;
        
//         if (count($errors)) {
//             $success = false;
//         }

//         $data = $this->Psychic_model->all();

//         return $this->response(compact('data', 'success', 'errors'));
//     }



//     public function login_post ()
//         $errors = array();
//         $success = true;
//         $data = null;

//         $username = $this->post('username');
//         $password = $this->post('password');

//         if (!$username) {
//             $errors[] = 'Missing username';
//         }
//         if (!$password) {
//             $errors[] = 'Missing password';
//         }

//         if (!count($errors)) {
//             if (!Auth::login($username, $password)) {
//                 $errors = Auth::$errors;    
//             }
//         }

//         if (count($errors)) {
//             $success = false;
//         }

//         //var_dump(Auth::me());exit;
//         setcookie('user', json_encode(Auth::me()), time() + 7200, '/');

// 	$this->notify_admin($username, "In");

//         return $this->response(compact('data', 'success', 'errors'));
//     }

//     public function update_profile_post () {
//         $errors = [];
//         $success = true;
//         $data = [];
//         $id = $this->post('psychic_id');

//         $profile = $this->Psychic_model->first([
//             'where' => [
//                 'id'        => $id 
//             ]
//         ]);

//         if (!$profile) {
//                 $errors[] = 'Profile does not exists';
//         }

//         if (!count($errors)) {

//             $data = array (
//                 'fname' => $this->post('fname'),
//                 'lname' => $this->post('lname'),
//                 'home_address' => $this->post('home_address'),
//                 'email_address' => $this->post('email_address'),
//                 'paypal_address' => $this->post('paypal_address'),
//                 'mobile_num' => $this->post('mobile_num'),
//                 'home_phone' => $this->post('home_phone')        
//             );

//             $this->Psychic_model->profile_update($id, $data);

//         } else {
//             $success = false;
//         }

//         return $this->response(compact('data', 'success', 'errors'));
//     }

//     public function change_password_post () {
//         $errors = [];
//         $success = true;
//         $data = [];
//         $id = $this->post('psychic_id');
//         $password = trim($this->post('password'));
//         $new_password = trim($this->post('new_password'));

//         $profile = $this->Psychic_model->first([
//             'where' => [
//                 'id'        => $id 
//             ]
//         ]);

//         if (!$profile) {
//                 $errors[] = 'Profile does not exists';
//         }

        
//         if (Auth::hash($password) != $profile->password) {
//             $errors[] = 'Password is incorrect'; 
//         }

//         if (!count($errors)) {
//             $new_password = Auth::hash($new_password);
//             $data = array (
//                 'password' => $new_password
//             );

//             $this->Psychic_model->profile_update($id, $data);
//             $data = [];
            

//         } else {
//             $success = false;
//         }

//         return $this->response(compact('data', 'success', 'errors'));
//     }

    

//     public function logout_get()
//     {

// 	if (isset($this->session->userdata["user"])) {
// 		$user = json_decode($this->session->userdata["user"]);
// 		$reader = $user->username;
// 	}
//         $errors = [];
//         $success = true;
//         $data = null;

//         Auth::logout();

//         setcookie('user', '', 0, '/');

// 	$this->notify_admin($reader, "Out");
//         return $this->response(compact('data', 'success', 'errors'));
//     }


//     public function notify_admin($reader, $action) {

// 	$this->load->library('email');
//      	$config = array();
//         $config['useragent']           = "CodeIgniter";
//         $config['mailpath']            = "/usr/sbin/sendmail"; // or "/usr/sbin/sendmail"
//         $config['protocol']            = "smtp";
//         $config['smtp_host']           = "localhost";
//         $config['smtp_port']           = "25";
//         $config['mailtype'] = 'html';
//         $config['charset']  = 'utf-8';
//         $config['newline']  = "\r\n";
//         $config['wordwrap'] = TRUE;
//         $this->email->initialize($config);

//         $this->email->from('webmaster@psychic-contact.com');
//         $this->email->to('jlynndfs@yahoo.com');
//     	$this->email->bcc('joy.rutaquio@gmail.com');
//         $this->email->subject("Text-A-Psychic: Reader $reader Signed $action");

//         $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
//                     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strit.dtd"><html><head>
//                     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
//                     </head><body>';

//         $message .= '<p>Dear Jayson</p>';
//         $message .= "<p>Reader $reader just signed " . strtolower($action);
//         $message .= '<p>Thank you!</p>';
//         $message .= '<p>Text-A-Psychic.com</p>';
//         $message .= '</body></html>';

//         $this->email->message($message);
//         if($this->email->send()) {

//         } else {
//                 echo $this->email->print_debugger();exit;
//         }



//     }
}
