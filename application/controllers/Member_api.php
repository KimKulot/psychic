<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'libraries/REST_Controller.php');

class Member_api extends REST_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Member_model');  
        $this->uk_db = $this->load->database('uk_db', TRUE);

    }
    public function register_post ()
    { 
        $errors = [];
        $success = true; 
        $data = null;
        $data = $this->post();
        $data['act_code'] = md5(uniqid(rand(), true));
        $record_id = "";
        
        $is_username_exist = count($this->db->get_where('members', array('username' => $data['username']))->result_array());
        $is_email_exist = count($this->db->get_where('members', array('email' => $data['email']))->result_array());
        $is_number_exist = count($this->db->get_where('members', array('mobile_number' => $data['mobile_number']))->result_array());
        if ($is_number_exist) {
            $success = false;
            $errors['error'] = "mobile number is already exist";
            return $this->response(compact('data', 'success', 'errors'));
        }
        if (!$is_email_exist) {
            if (!$is_username_exist) {
                if (substr( $data['mobile_number'], 0, 1 ) != 1 && substr( $data['mobile_number'], 0, 2) != '+1' ) {
                    $data['mobile_number'] = '1' . $data['mobile_number'];
                }
                $data['password'] = Auth::hash($data['password']);
                $data['registration_date'] = date('Y-m-d h:i:s');
                $success = $this->db->insert('members', $data);
                $record_id = $this->db->insert_id();
            } else {
                $success = false;
                $errors['error'] = "username is already exist";
            }
        } else {
            $success = false;
            $errors['error'] = "email is already exist";
        }
        if ($success) {
            $data['id'] = $record_id;
            $this->send_activation_link($data);
        }
        
        return $this->response(compact('data', 'success', 'errors'));
        
    }
     
    public function error_inbound($data) {
        $errors = [];
        $success = false; 
        
        $data = $data;

        $baseurl = $this->setBaseAPIUrl();
        $authorization = "Authorization: Bearer Y2Q4MGEzYzk5ZDIzMWQ4YWMxYWYyYTBmMDMxZmQz";
        //curl POST for SMS
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, array($authorization ));
        curl_setopt($ch, CURLOPT_URL,  $baseurl . "/api/v1/send_sms");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        

        $server_output = curl_exec ($ch);
        curl_close ($ch);

        $_data = json_decode($server_output);
        $success = isset($_data->success) ? $_data->success : $success;

        if ($success) {
            $datas['member'] = $this->db->query("SELECT * FROM members WHERE mobile_number =" . $data['sender_mobile_num'])->result_array();
            if(count($datas['member'])){
                if ($datas['member'][0]['is_error'] >= 2) {
                    $datas['member_balance'] = $this->db->query("SELECT * FROM member_balance WHERE member_id =" . $datas['member'][0]['id'])->result_array();
                    if (count($datas['member_balance'])) {
                        if ($datas['member_balance'][0]['credit'] != 0) {
                            $data_package = array(
                                'used' => $datas['member_balance'][0]['used'] + 1,
                                'credit' => $datas['member_balance'][0]['credit'] - 1
                            );
                            $this->db->where('id', $datas['member_balance'][0]['id']);  
                            $this->db->update('member_balance', $data_package);
                        }
                        $data_member = array(
                            'is_error' => 0
                        );
                        $this->db->where('id', $datas['member'][0]['id']);  
                        $this->db->update('members', $data_member);
                        
                    }
                } else {
                    $data_member = array(
                        'is_error' => $datas['member'][0]['is_error'] + 1
                    );
                    $this->db->where('id', $datas['member'][0]['id']);  
                    $this->db->update('members', $data_member);
                }
            }
        }
        return $this->response(compact('data', 'success', 'errors'));
    }

    public function send_sms_cp_post () {
        // $result = $this->db->delete('outbound_messages', array('id' => 79)); 
        // var_dump($result);die;
        // $postData = [
        //     'ref_message_id' => '72',
        //     'request_url' => 'reply=0&value=0&mobile_number=18504190087&message=Aleon%3A+Today+is+a+great+day..&currency=gbp&cc=psychiccontact&title=68899&ekey=1a989ce5a9b504b267a810be41c8d114&type=reader',
        //     'sender_id' => '1',
        //     'message' => 'test'

        // ];

        // $result = $this->db->insert('outbound_messages', $postData);
        // $messageId = $this->db->insert_id();
        // $q = $this->db->get_where('outbound_messages', array('id' => $messageId))->row();
        // var_dump($q);die;

        // echo 'hello';die;
        $errors = [];
        $success = true; 
        $data = null;
        // $inbound_log = null;
        // $data['is_random'] = 0;
        // $data['is_question'] = 0;
        // $is_random = 0;
        // $data['sender_mobile_num'] = isset($_GET["From"]) ? $_GET["From"] : isset($_POST['From'])? $_POST['From'] : null;
        // if ($data['sender_mobile_num'] == null) {
        //     $inbound_log = "Empty request";
        //     $this->logSMSIn("SMSIN_", "Error:$inbound_log");
        //     $success = false;
        //     return $this->response(compact('data', 'success', 'errors'));
        // }
        $text = isset($_GET["Text"]) ? $_GET["Text"] : $_POST['Text'];
        // $data['message'] = $text;
        // $data['mobile_number'] = isset($_GET["To"]) ? $_GET["To"] : $_POST['To'];
        // $data['is_help'] = 0;
        // $data['is_list'] = 0;
        // $reader_id = 0;
        // $preferred_psychic_id = 0;
        // $is_question = 0;

        $message = explode(" ", trim($text));
        // var_dump($message);die;
        if (isset($message[1])) {
            $is_name = $this->db->query("SELECT * FROM psychics WHERE username ='" . $message[1] . "'")->result_array();
            if (strtoupper($message[0]) == "PSYCHIC" || strtoupper($message[0]) == "PSYCHICS") {

                if (is_numeric($message[1])) {
                    //PSYCHIC PIN
                    $pin = $this->db->get_where('psychics', array('pin' => $message[1]))->result_array();
                    if (count($pin)) {
                        $data['mobile_number'] = $pin[0]['mobile_num'];
                        $preferred_psychic_id = $pin[0]['id'];
                    } else {
                        $data['message'] = "Invalid pin";
                        $errors['error'] = "Invalid pin";
                        $data['mobile_number'] = $data['sender_mobile_num'];
                    }
                } elseif (count($is_name)) {   
                    // PSYCHICS NAME {reader name}
                    $psychics_data = $this->db->query("SELECT * FROM psychics WHERE username ='" . $message[1] . "'")->result_array();
                    if (count($psychics_data)) {
                        $data['mobile_number'] = $psychics_data[0]['mobile_num'];
                        $preferred_psychic_id = $psychics_data[0]['id'];
                    } else {
                        $data['message'] = "Invalid name";
                        $errors['error'] = "Invalid pin";
                        $data['mobile_number'] = $data['sender_mobile_num'];
                    }
                } elseif (strtoupper($message[1]) == "RANDOM"){
                    //PSYCHIC RANDOM
                    $this->uk_db->insert('inbound_messages',[
                        'number' => $data['sender_mobile_num'],
                        'message' => $text,
                        'country' => 'US',
                        'preferred_psychic_id' => 0,
                        'responded_by' => 0,
                        'random' => 1,
                        'sent_at' => date('Y-m-d h:i:s')
                    ]);
                    $data['is_random'] = 1;
                    $is_random = $data['is_random'];
                    // return $this->response(compact('data', 'success', 'errors'));
                } elseif(strtoupper($message[1]) == "HELP" || strtoupper($message[1]) == "INFO") {
                    // PSYCHIC HELP
                    $data['mobile_number'] = $data['sender_mobile_num'];
                    $data['message'] = 'Getting a Psychic Reading Has Never Been Easier! Have a quick question? Love, relationships, money, career, predictions? Txt PSYCHICS <Your Questions> to 12399003577';
                    $data['is_help'] = 1;
                } elseif(strtoupper($message[1]) == "LIST") {
                    // PSYCHIC LIST
                    $psychics_data = $this->db->query("SELECT fname, pin FROM psychics")->result_array();
                    $list_message = '';
                    foreach ($psychics_data as $key => $value) {
                        $list_message .= $value['fname'] . ' / Pin ' . $value['pin'] . "\r\n";
                    }
                    $data['mobile_number'] = $data['sender_mobile_num'];
                    $data['message'] = $list_message; 
                    $data['is_help'] = 1;
                }else {
                    $data['is_question'] = 1;
                }
            } else {
                $data['mobile_number'] = $data['sender_mobile_num'];
                $data['message'] = "Wrong use of keyword";
                $data['is_help'] = 1;
                $this->error_inbound($data);
            }

            $is_question = $data['is_question'];
        } else {
            $data['mobile_number'] = $data['sender_mobile_num'];
            $data['message'] = "Please check your keyword used";
            $data['is_help'] = 1;
            $this->error_inbound($data);
        }

        $datas['member'] = $this->db->query("SELECT * FROM members WHERE mobile_number =" . $data['sender_mobile_num'])->result_array();
        
        
        if(count($datas['member']) && count($errors) == 0){
            $datas['member_balance'] = $this->db->query("SELECT * FROM member_balance WHERE member_id =" . $datas['member'][0]['id'])->result_array();
            if (count($datas['member_balance'])) {
                if ($datas['member_balance'][0]['credit'] != 0) {
                
                    $baseurl = $this->setBaseAPIUrl();
                    $authorization = "Authorization: Bearer Y2Q4MGEzYzk5ZDIzMWQ4YWMxYWYyYTBmMDMxZmQz";
                    //curl POST for SMS
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array($authorization ));
                    curl_setopt($ch, CURLOPT_URL,  $baseurl . "/api/v1/send_sms");
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    

                    $server_output = curl_exec ($ch);
                    curl_close ($ch);

                    $_data = json_decode($server_output);
                    
                    $success = isset($_data->success) ? $_data->success : $success;
                    if ($success) {
                        if ($is_random != 1) {
                            // $this->session->set_flashdata('response', "Successfully sent");
                            if ($data['is_help'] == 0) {
                                $this->uk_db->insert('inbound_messages',[
                                    'number' => $data['sender_mobile_num'],
                                    'message' => $text,
                                    'country' => 'US',
                                    'preferred_psychic_id' => $is_question == 1? 0 : $preferred_psychic_id,
                                    'responded_by' => 0,
                                    'random' => 0,
                                    'sent_at' => date('Y-m-d h:i:s')
                                ]);
                            }
                            
                        } 
                        
                        if ($data['is_help'] == 0) {
                            $data_package = array(
                                'used' => $datas['member_balance'][0]['used'] + 1,
                                // 'balance' => $datas['member_balance'][0]['balance'] - 1,
                                'credit' => $datas['member_balance'][0]['credit'] - 1
                            );
                            $this->db->where('id', $datas['member_balance'][0]['id']);  
                            $this->db->update('member_balance', $data_package);
                        }
                        $name = $datas['member'][0]['first_name'] . ' ' . $datas['member'][0]['last_name'];
                        $this->notify_admin($name);

                        $inbound_log = $data['mobile_number'] . '|' . $data['sender_mobile_num'] . '|' . $data['message'];
                        $this->logSMSIn("SMSIN_", "POST_REQUEST:$inbound_log");

                    } else {
                        $success = false;
                        $errors['sending'] = $data->errors;
                        // $this->session->set_flashdata('error', "Error, Failed sending Message");
                        $inbound_log = $errors['sending'];
                        $this->logSMSIn("SMSIN_", "Error:$inbound_log");
                    }
                } else {
                    $inbound_log = "Not enough credit to your account";
                    $data['mobile_number'] = $data['sender_mobile_num'];
                    $data['message'] = $inbound_log;
                    $data['is_help'] = 1;
                    $this->error_inbound($data);
                    $this->logSMSIn("SMSIN_", "Error:$inbound_log");
                }
            } else {
                $inbound_log = "Not enough credit to your account";
                $data['mobile_number'] = $data['sender_mobile_num'];
                $data['message'] = $inbound_log;
                $data['is_help'] = 1;
                $this->error_inbound($data);
                $this->logSMSIn("SMSIN_", "Error:$inbound_log");
            }
        } else {
            $inbound_log = "Number " . $data['sender_mobile_num'] . " is not existing in the members number. You can create account or update your number to https://devusa.text-a-psychic.com/";
            $data['mobile_number'] = $data['sender_mobile_num'];
            $data['message'] = $inbound_log;
            $data['is_help'] = 1;
            $this->error_inbound($data);
            $this->logSMSIn("SMSIN_", "Error:$inbound_log");
        }

        return $this->response(compact('data', 'success', 'errors'));


    }

    private function logSMSOut($file, $txt)
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . "/application/logs";
        file_put_contents("$path/$file".date('Ymd').'.txt', date('Y-m-d H:i:s').' - '.$txt."\n", FILE_APPEND);
    }

    private function logSMSIn($file, $txt)
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . "/application/logs";
        file_put_contents("$path/$file".date('Ymd').'.txt', date('Y-m-d H:i:s').' - '.$txt."\n", FILE_APPEND);
    }

    public function send_sms_post () 
    {
        $errors = [];
        $success = true; 
        $data = null;
        $info['member'] = Auth::me();
        $data = $this->post();
        $data['is_random'] = 0;
        $is_random = 0;

        $message = explode(" ", trim($this->post('message')));

        if (isset($message[1])) {
            //pin
            if (is_numeric($message[1])) {
                $pin = $this->db->get_where('psychics', array('pin' => $message[1]))->result_array();
                if (count($pin)) {
                    $data['mobile_number'] = $pin[0]['mobile_num'];
                }
            }

            //random
            if (strtoupper($message[1]) == "RANDOM"){
                $this->uk_db->insert('inbound_messages',[
                    'number' => $this->post('sender_mobile_num'),
                    'message' => $this->post('message'),
                    'country' => 'US',
                    'preferred_psychic_id' => 0,
                    'responded_by' => 0,
                    'random' => 1,
                    'sent_at' => date('Y-m-d h:i:s')
                ]);
                $data['is_random'] = 1;
                $is_random = $data['is_random'];
                // return $this->response(compact('data', 'success', 'errors'));
            }
        }
        
        $datas['member_balance'] = $this->db->query("SELECT * FROM member_balance WHERE member_id =" . $data['id'])->result_array();

        $baseurl = $this->setBaseAPIUrl();
        $authorization = "Authorization: Bearer Y2Q4MGEzYzk5ZDIzMWQ4YWMxYWYyYTBmMDMxZmQz";
        //curl POST for SMS
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($authorization ));
        curl_setopt($ch, CURLOPT_URL,  $baseurl . "/api/v1/send_sms");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        

        $server_output = curl_exec ($ch);

        curl_close ($ch);
        $data = json_decode($server_output);
        // var_dump($data);die;
        $success = isset($data->success) ? $data->success : $success;
        if ($success) {
            if ($is_random != 1) {
                // $this->session->set_flashdata('response', "Successfully sent");
                $this->uk_db->insert('inbound_messages',[
                    'number' => $this->post('sender_mobile_num'),
                    'message' => $this->post('message'),
                    'country' => 'US',
                    'preferred_psychic_id' => $this->post('psychic_id'),
                    'responded_by' => 0,
                    'random' => 0,
                    'sent_at' => date('Y-m-d h:i:s')
                ]);
                $data_package = array(
                    'used' => $datas['member_balance'][0]['used'] + 1,
                    // 'balance' => $datas['member_balance'][0]['balance'] - 1,
                    'credit' => $datas['member_balance'][0]['credit'] - 1
                );
                $this->db->where('id', $datas['member_balance'][0]['id']);  
                $this->db->update('member_balance', $data_package);

                
                $name = $info['member']['first_name'] . ' ' . $info['member']['last_name'];
                $this->notify_admin($name);
            }
        } else {
            $success = false;
            $errors['sending'] = $data->errors;
            // $this->session->set_flashdata('error', "Error, Failed sending Message");
        }

        return $this->response(compact('data', 'success', 'errors'));
    }


    public function notify_admin($user) {

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
        $this->email->to('edzelabliter@gmail.com');
        $this->email->bcc('kim@bywave.com.au');
        $subject = "Devusa.Text-A-Psychic: User " . $user . " send message";
        $this->email->subject($subject);

        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strit.dtd"><html><head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    </head><body>';

        $message .= '<p>Dear Jayson</p>';
        $message .= "<p>" . $user . " send message";
        $message .= '<p>devusa.text-a-psychic.com/</p>';
        $message .= '</body></html>';

        
        $this->email->message($message);
        if($this->email->send()) {

        } else {
            echo $this->email->print_debugger();
        }

    }

    public function send_activation_link($data) {
        $this->load->library('email');
        $config = array();
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
        $config['smtp_timeout'] = 120;
        $this->email->initialize($config);

        $this->email->from('webmaster@psychic-contact.com');
        $this->email->to($data['email']);
        $subject = "Text-A-Psychic: Activation Member " . $data['first_name'];
        $this->email->subject($subject);

        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strit.dtd"><html><head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    </head><body>';

        $message .= '<p>Dear ' . $data['first_name'] .  '</p>';
        $message .= "<p>Thank you for registering to Text-A-Psychic.com</p>";
        $message .= "<p><a href='https://" . $_SERVER['SERVER_NAME'] . "/members/activate_account?ACTIVATION_CODE=" . $data['act_code'] . ":" . $data['email'] . ":" . $data['id'] . "' a>Click here</a> to activate account.</p>";
        $message .= '</body></html>';

        $this->email->message($message);
        if($this->email->send()) {

        } else {
            echo $this->email->print_debugger();
        }
    }

    public function setBaseAPIUrl ()
    {
        $baseurl = "";
        if($_SERVER['HTTP_HOST'] == 'text-a-psychic-usa.test') {
            $baseurl = "http://smsapi.text-a-psychic.com";
        } else if($_SERVER['HTTP_HOST'] === 'devusa.text-a-psychic.com') {
            $baseurl = "http://smsapi.text-a-psychic.com";
        }else if($_SERVER['HTTP_HOST'] === 'text-a-psychic.com') {
            $baseurl = "http://smsapi.text-a-psychic.com";
        }
        return $baseurl;
    }

    public function email_notify_post() {
        $this->load->library('email');
        $config['protocol']     = $_POST["protocol"];
        $config['smtp_host']    = $_POST["smtp_host"];
        $config['smtp_user']    = $_POST["smtp_user"];
        $config['smtp_pass']    = $_POST["smtp_pass"];
        $config['smtp_port']    = $_POST["smtp_port"];
        $config['mailtype']     = $_POST["mailtype"];
        $config['smtp_crypto']  = $_POST["smtp_crypto"];
        $config['_smtp_auth']   = TRUE;
        $config['newline']      = "\r\n";
        $config['wordwrap']     = TRUE;
        $config['charset']      = 'utf-8';
        $this->email->initialize($config);

        $this->email->from('webmaster@psychic-contact.com');
        $this->email->to($_POST["email_to"]);
        $this->email->bcc($_POST["email_bcc"]);
        $subject = "Devusa.Text-A-Psychic: User test send message";
        $this->email->subject($subject);

        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strit.dtd"><html><head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    </head><body>';

        $message .= '<p>Dear Jayson</p>';
        $message .= "<p>test send message";
        $message .= '<p>devusa.text-a-psychic.com/</p>';
        $message .= '</body></html>';

        
        $this->email->message($message);
        if($this->email->send()) {
            echo "email sent";
        } else {
            echo $this->email->print_debugger();
        }

    }
}
