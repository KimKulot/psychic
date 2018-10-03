<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

class Members extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        
        if(!$this->session->userdata('member_is_logged') )
        { 
            // echo $_SERVER['REQUEST_URI'];die;
            $server_request_uri = $_SERVER['REQUEST_URI'];
            if (strlen(strstr($server_request_uri, '/members/activate_account'))) {
                //
            } else 
{                redirect('/');
                exit;
            } 
        }

        $data['member'] = Auth::me();
        $this->error = null;
        $this->load->model('Member_model');
        $this->load->library('MyAuthorize');
        $this->uk_db = $this->load->database('uk_db', TRUE);
        
    }

    public function index()
    {
        $data['packages'] = $this->db->query("SELECT * FROM packages WHERE type = 'sms'")->result_array();
        $data['member'] = Auth::me();
        $data['title'] = 'Member Account';
        $data['member_balance'] = $this->db->query("SELECT * FROM member_balance WHERE member_id = " . $data['member']['id'])->result_array();
        $this->load->view('member/header.php', $data);
        $this->load->view('member/member_account.php');
        $this->load->view('member/footer');
    }

    public function edit($id)
    {
        $data['member'] = Auth::me();
        $data['member_data'] = $this->Member_model->get_member($id);
        $data['title'] = 'Edit account';
        $this->load->view('member/header.php', $data);
        $this->load->view('member/edit_member_form.php');
        $this->load->view('member/footer');
    }

    public function update() 
    {
        $id = $this->input->post('id');
        $data = array(
            'id' => $this->input->post('id'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'username' => $this->input->post('username'),
            'mobile_number' => $this->input->post('mobile_number'),
            'email' => $this->input->post('email'),
            'gender' => $this->input->post('gender'),
            'dob' => $this->input->post('dob'),
            'country' => $this->input->post('country'),
        );
        if ($this->input->post('password') != null || $this->input->post('password') != '') {
            $data['password'] = Auth::hash($this->input->post('password'));
        }
        // load the model first
        if($this->Member_model->update_data($data)) // call the method from the model
        {
            $this->session->set_flashdata('response', "Successfully updated");
            redirect("/members/edit/$id");
        }
        else
        {   
            $this->session->set_flashdata('response', "Error, Something went wrong please try again");
            redirect("/members/edit/$id");
        }
        
    }

    public function psychics()
    {
        $data['title'] = 'Online Readers';
        $data['member'] = Auth::me();
        $data['psychics'] = $this->db->query("SELECT * FROM psychics WHERE test_account = 0")->result_array();
        $this->load->view('member/header.php', $data);
        $this->load->view('member/psychics.php');
        $this->load->view('member/footer');
    }

    public function view_psychic($id)
    {
        $data['title'] = 'Online Reader Profile';
        $data['member'] = Auth::me();
        $data['psychic'] = $this->db->query("SELECT * FROM psychics WHERE id = '$id'")->result_array();
        $this->load->view('member/header.php', $data);
        $this->load->view('member/view_psychic.php');
        $this->load->view('member/footer');
    }

    public function member_account()
    {
        $data['packages'] = $this->db->query("SELECT * FROM packages WHERE type = 'sms'")->result_array();
        $data['member'] = Auth::me();
        $data['title'] = 'Member';
        $data['member_balance'] = $this->db->query("SELECT * FROM member_balance WHERE member_id = " . $data['member']['id'])->result_array();
        $this->load->view('member/header.php', $data);
        $this->load->view('member/member_account.php');
        $this->load->view('member/footer');
    }

    public function logout()
    {   
        $errors = [];
        $success = true;
        $data = null;
        $authname = Auth::me();
        $reader = $authname['username'];
        $status  = Auth::logout();
        setcookie('member_is_logged', '', 0, '/');
        setcookie('user', '', 0, '/');
        $this->notify_admin($reader, "Out");
        redirect('/');
    
    }

    public function notify_admin($reader, $action) {

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
        $this->email->initialize($config);

        $this->email->from('webmaster@psychic-contact.com');
        $this->email->to('jlynndfs@yahoo.com');
    $this->email->bcc('ericvp2016@gmail.com');
        $subject = "Text-A-Psychic: Reader " . $reader . "  Signed " . $action;
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

    // Paypal get token
    public function fund_account($id) {
        
        if (!isset($id)) {
            $this->session->set_flashdata('response', "Error, Please select package");
            redirect("/members/price_menu");
        }
        $package_id = $id;
        $data['packages'] = $this->db->query("SELECT * FROM packages WHERE id = '$package_id'")->result_array();

        $paypal = new ApiContext(
            new OAuthTokenCredential(
                $this->config->item('client_id'), 
                $this->config->item('secret')
            )
        );
        $product = "sms credit";
        $price = $data['packages'][0]['price'];
        $shipping = 0;

        $total = $price + $shipping;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName($product)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($price);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $details = new Details();
        $details->setShipping($shipping)
            ->setSubtotal($price);

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($total)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Fund Account Payment')
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($this->config->item('base_url') . 'members/pay_account?id=' . $package_id . '&success=true')
            ->setCancelUrl($this->config->item('base_url') . 'members/pay_account.php?id=' . $package_id . '&success=false');
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            $payment->create($paypal);
        } catch (Exception $e) {
            die($e);
        }

        $approvalUrl = $payment->getApprovalLink();
        
        header("Location: {$approvalUrl}"); 
    }

    // Paypal - add balance to text a psychic account
    public function pay_account() {
        
        if (!isset($_GET['success'], $_GET['paymentId'], $_GET['PayerID'], $_GET['id'])) {
            $this->session->set_flashdata('response', "Error, Something went wrong Paying, Please try again");
            redirect("/members/member_account");
        }
        $data['member'] = Auth::me();
        $id = $data['member']['id'];

        if(!$_GET['success']) {
            $this->session->set_flashdata('response', "Error, Something went wrong Paying, Please try again");
            redirect("/members/member_account");
        }

        $paymentId = $_GET['paymentId'];
        $payerId = $_GET['PayerID'];
        $paypal = new ApiContext(
            new OAuthTokenCredential(
                $this->config->item('client_id'), 
                $this->config->item('secret')
            )
        );

        $payment = Payment::get($paymentId, $paypal);

        $execute = new PaymentExecution();
        $execute->setPayerId($payerId);

        try {
            $result = $payment->execute($execute, $paypal);
        } catch (Exception $e) {
            $this->session->set_flashdata('response', "Error, Something went wrong Paying, Please try again");
            redirect("/members/member_account");
        }
        $data['member_balance'] = $this->db->query("SELECT * FROM member_balance WHERE member_id = '$id'")->result_array();
        $data['packages'] = $this->db->query("SELECT * FROM packages WHERE id =" . $_GET['id'])->result_array();

        $data_package = array(
            'datetime' => date('Y-m-d h:i:s'),
            'member_id' => $id,
            'type' => $data['packages'][0]['type'],
            'tier' => $data['packages'][0]['promo'] == 1? 'promo' : 'regular',
            'region' => 'us',
            'total' => $data['packages'][0]['price'],
            'used' => 0,
            'balance' => $data['packages'][0]['price'],
            'credit' => $data['packages'][0]['value']
        );

        if (count($data['member_balance'])) {
            $data_package = array(
                'total' => $data['member_balance'][0]['total'] + $data['packages'][0]['price'],
                'used' => $data['member_balance'][0]['used'],
                'balance' => $data['member_balance'][0]['balance'] + $data['packages'][0]['price'],
                'credit' => $data['member_balance'][0]['credit'] + $data['packages'][0]['value']
            );
            $this->db->where('id', $data['member_balance'][0]['id']);  
            $this->db->update('member_balance', $data_package);
        } else {            
            $success = $this->db->insert('member_balance', $data_package);

        }
        
        $this->session->set_flashdata('response', "Success! Payment made. Thanks!");
        redirect("/members/member_account");

    }

    //authorize.net 
    public function add_authorize_details($id) {
        if (!isset($id)) {
            $this->session->set_flashdata('response', "Error, Please select package");
            redirect("/members/price_menu");
        }
        $data['package_id'] = $id;
        $data['member'] = Auth::me();
        $data['packages'] = $this->db->query("SELECT * FROM packages WHERE type = 'sms'")->result_array();
        $data['title'] = 'Member Account';
        $this->load->view('member/header.php', $data);
        $this->load->view('member/authorizenet_form.php');
        $this->load->view('member/footer');
    }

    // Authorize.net push payment
    public function push_payment() {
        if ($this->input->post('id') == null) {
            $this->session->set_flashdata('response', "Error, Please select package");
            redirect("/members/price_menu");
        }
        $data['member'] = Auth::me();
        $id = $data['member']['id'];
        $package_id = $this->input->post('id');
        $data['member_balance'] = $this->db->query("SELECT * FROM member_balance WHERE member_id = '$id'")->result_array();
        $data['packages'] = $this->db->query("SELECT * FROM packages WHERE id = '$package_id'")->result_array();
        $dataCustomers=array("fname"=>$this->input->post('fname'),
                 "lname"=>$this->input->post('lname'),
                 "address"=>$this->input->post('address'),
                 "city"=>$this->input->post('city'),
                 "state"=>$this->input->post('state'),
                 "country"=>$this->input->post('country'),
                 "zip"=>$this->input->post('zip'),
                 "phone"=>$this->input->post('phone') != null? $this->input->post('phone') : '',
                 "email"=>$this->input->post('email'),
                 "cnumber"=>$this->input->post('cnumber'),
                 "cexpdate"=>$this->input->post('cexpdate'),
                 "ccode"=>$this->input->post('ccode'),
                 "cdesc"=>$this->input->post('cdesc'),
                 "amount"=>$data['packages'][0]['price']
        );   
        $result = $this->myauthorize->chargerCreditCard($dataCustomers);
        if ($result['success']) {
            $data_package = array(
                'datetime' => date('Y-m-d h:i:s'),
                'member_id' => 122,
                'type' => $data['packages'][0]['type'],
                'tier' => $data['packages'][0]['promo'] == 1? 'promo' : 'regular',
                'region' => 'us',
                'total' => $data['packages'][0]['price'],
                'used' => 0,
                'balance' => $data['packages'][0]['price'],
                'credit' => $data['packages'][0]['value']
            );

            if (count($data['member_balance'])) {
                $data_package = array(
                    'total' => $data['member_balance'][0]['total'] + $data['packages'][0]['price'],
                    'used' => $data['member_balance'][0]['used'],
                    'balance' => $data['member_balance'][0]['balance'] + $data['packages'][0]['price'],
                    'credit' => $data['member_balance'][0]['credit'] + $data['packages'][0]['value']
                );
                $this->db->where('id', $data['member_balance'][0]['id']);  
                $this->db->update('member_balance', $data_package);
            } else {
                $success = $this->db->insert('member_balance', $data_package);
            }
            $this->session->set_flashdata('response', "Success! Payment made. Thanks!");
            redirect("/members/add_authorize_details/" . $package_id);
        } else {
            $this->session->set_flashdata('error', $result['errors']['credit_card']);
            redirect("/members/add_authorize_details/" . $package_id);
        }
        
    }

    // price menu
    public function price_menu() {
        $data['packages'] = $this->db->query("SELECT * FROM packages WHERE type = 'sms'")->result_array();
        $data['member'] = Auth::me();
        $data['title'] = 'Member Account';
        $this->load->view('member/header.php', $data);
        $this->load->view('member/price_menu.php');
        $this->load->view('member/footer');
    }

    public function activate_account() {
        // $this->session->set_flashdata('error', 'Account has been successfully activated!');
        // redirect('/users');

        $data = null;
        $success = true;
        $errors = [];
        
        $params = explode(':', $_GET['ACTIVATION_CODE']);

        if (isset($params[0]) && isset($params[1])) {
            $act_code = $params[0];
            $email = $params[1];
            $id = $params[2];
            $members = $this->db->query("SELECT * FROM `members`  WHERE `email` =  '$email' AND `act_code`= '$act_code' AND `id` = '$id'")->result_array();
            $is_exist = count($members);
            // var_dump($members);die;

            if ($members[0]['validated']) {
                $this->session->set_flashdata('response', 'Account ' . $members[0]['username'] . ' is already activated!');
                redirect('/users');
                // echo 'Account ' . $members[0]['username'] . ' is already activated!';
                $success = false;
            }
            if ($is_exist) {
                $data['validated'] = 1;
                $data['id'] = $id;
                $success = $this->Member_model->update_data($data);
            } else {
                $this->session->set_flashdata('error', 'Activation code is invalid or email is not existing! Please register');
                redirect('/users');
                // echo 'Activation code is invalid or email is not existing! Please register';
                $success = false;
            }
            if ($success == true) {
                $this->session->set_flashdata('response', 'Account ' . $members[0]['username'] . ' has been successfully activated!');
                // echo 'Account ' . $members[0]['username'] . ' has been successfully activated!';
                redirect('/users');
            }
        } else {
            $this->session->set_flashdata('error', 'Unathorized!'); 
            redirect('/users');
            // $success = false;
            // $errors['error'] = "Unathorized";
            // echo json_encode($errors);
        }
        return false;
    }

    /*
    * function: sms_sent
    * Member sent SMS
    *
    */
    public function sms_sent() {
        $data['member'] = Auth::me();
        $mobile_number = $data['member']['mobile_number'];
        $data['message_psychic'] = $this->uk_db->query("SELECT * FROM `inbound_messages` JOIN `psychics` ON `psychics`.`id` = `inbound_messages`.`preferred_psychic_id`  WHERE `number` = '$mobile_number'")->result_array();
        $data['message'] = $this->db->query("SELECT * FROM `inbound_messages` WHERE preferred_psychic_id = '0' AND `number` = '$mobile_number'")->result_array();
        $data['sms_sents'] = array_merge($data['message_psychic'], $data['message']); 
        $data['title'] = 'SMS Sent';
        $this->load->view('member/header.php', $data);
        $this->load->view('member/member_sent_sms.php');
        $this->load->view('member/footer');
    }

    /*
    * function: sms_sent
    * Member sent SMS
    *
    */
    public function sms_received() {
        $data['member'] = Auth::me();
        $mobile_number = $data['member']['mobile_number'];
        $data['sms_receiveds'] = $this->uk_db->query("SELECT *, `inbound_messages`.`message`as `message_inbound` FROM `inbound_messages` 
            JOIN `outbound_messages` ON `outbound_messages`.`ref_message_id` = `inbound_messages`.`id`
            JOIN `psychics` ON `psychics`.`id` = `inbound_messages`.`preferred_psychic_id`
            WHERE `number` = '$mobile_number'")->result_array();
        $data['title'] = 'SMS Sent';
        // var_dump($data['sms_receiveds']);die;
        $this->load->view('member/header.php', $data);
        $this->load->view('member/member_sms_received.php');
        $this->load->view('member/footer');
    }
}
