<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'libraries/REST_Controller.php');

use ElephantIO\Client as ElephantClient;
use ElephantIO\Engine\SocketIO\Version1X as SocketIO;

class Txtnation_api extends REST_Controller
{

    /**
    * Allowed IP server array
    *
    */
    //private $_allowedServers = array('127.0.0.1', '67.23.27.65','72.32.41.114','72.32.41.115','74.54.223.228','74.54.223.230','95.138.180.235','174.143.237.218','174.143.239.166','166.78.143.213','162.13.59.148','162.13.52.70','162.13.104.239','37.153.99.112','45.64.82.238');  

    private $_allowedServers = array('127.0.0.1', '67.23.27.65','72.32.41.114','72.32.41.115','74.54.223.228','74.54.223.230','95.138.180.235','174.143.237.218','174.143.239.166','166.78.143.213','162.13.59.148','162.13.52.70','162.13.104.239','37.153.99.112','45.64.82.238','5.39.71.100','149.202.136.48','149.202.136.49','149.202.136.50','149.202.136.51','149.202.136.52','149.202.136.53','149.202.136.54','149.202.136.55','162.13.59.148','162.13.52.70','162.13.104.239','162.13.56.28');  

    /**
    * This company's code sent on txt messages
    *
    */
    private $_companyCode = 'psychic';

    /**
    * And all other info
    *
    */
    private $_ekey = '1a989ce5a9b504b267a810be41c8d114';
    private $_chargeAmt = '1.5';
    private $_chargeCurrency = 'gbp';

    private $_companyName = 'psychiccontact';
    private $_txtnationGateway = 'http://client.txtnation.com/gateway.php';

    //private $_email_logs = '/../logs/email.txt';
    private $_email_logs = '/home/apptextpsychic1002/htdoc/text-a-psychic.com/application/logs/email.txt';
    private $_email_logs_fields = ['id', 'txtnation_msg_id', 'number', 'message', 'network', 'shortcode', 'billing', 'country'];

    public function __construct()
    {
        //$this->_email_logs = __DIR__ . $this->_email_logs;
        $this->_email_logs = $this->_email_logs;
        
        return parent::__construct();
    }

    /**
     * Responder API call by TxtNation gateway on message receive
     *
     */
    public function receive_message_post()
    {   
        /**
         * Let's respond to TxtNation
         * Reponse for this does not follow json instead TXTNation gateway specs
         */
        if (in_array($_SERVER['REMOTE_ADDR'], $this->_allowedServers) || 1) {

            //$this->email->from('testing@text-a-psychic.com', 'Txtapsy');
            //$this->email->to('dianahamster67@gmail.com, joyuybuisan@gmail.com, jlynndfs@yahoo.com', 'ericvp2016@gmail.com');

    		$post_params = json_encode($this->post);
    		$ip = $_SERVER['REMOTE_ADDR'];
            $this->debugLog("RECEIVE_", "POST_PARAMS:$post_params");
    		
            $number = $this->post('number');
            $message = $this->post('message');
            $network = $this->post('network');
            $id = $this->post('id');
            $optout = false;
	        $subsData = array();
            $inboundMsgData = array();
            $random = 0;

            $this->logSMSIn("SMSIN_", "POST_REQUEST:$ip|$number|$message|$network|$id");
            $this->debugLog("RECEIVE_", "POST:$ip|$number|$message|$network|$id");

            if (!$id) {
                $this->debugLog("RECEIVE_", "POST:$number|$message|$network|$id|Invalid ID");
                echo 'Invalid ID';
                return;
            } else if (!$number) {
                $this->debugLog("RECEIVE_", "POST:$number|$message|$network|$id|Invalid Number");
                echo 'Invalid number';
                return;
            } else if (!$message) {
                $this->debugLog("RECEIVE_", "POST:$number|$message|$network|$id|Invalid Message");
                echo 'Invalid message';
                return;
            } else if (!$network) {
                $this->debugLog("RECEIVE_", "POST:$number|$message|$network|$id|Invalid Network");
                echo 'Invalid network';
                return;
            }

            // check keyword
	    $preferred_psychic_id = 0;
            $question_type = "";
            $msg = explode(" ", $message);

            if (count($msg)) {
                if (count($msg) > 1) {
                    if (strtolower($msg[1]) == "stop" || strtolower($msg[0]) == "stop") {
                        $responseText = urlencode('We have successfully received your message. You will now stop receiving messages from us.');
                        //$strPostReq .= '&smscat=991';
                        $optout = true;
                        $command = "STOP";
                        $smscat = '&smscat=991';

                    } else if (strtolower($msg[1]) == "info") {
                        //$responseText = "Getting a Psychic Reading Has Never Been Easier! Have a quick question? Love, relationships, money, career, predictions? Txt PSYCHICS <Ur Questions> to 68899.";
			$responseText = "PSYCHICS YOUR Q to 68899 Cost: £1.50\nPSYCHICS RANDOM YOUR Q to 68899 = 1 Q answered by 4 Readers\nEach Answer from Readers = £1.50ea\nNO OBLIGATION TO BUY ALL";
                        $command = "INFO";
                    } else if (strtolower($msg[1]) == "support") {
			$responseText = "We have received your message. We will get back to you the soonest.";
                        $command = "SUPPORT";
			//send email
			$this->notify_support($number, $message);

                    } else if (strtolower($msg[1]) == "random") {
			$responseText = "Purchase 4 Random Reader Replies. 1st Reader reply is free. Next 3 different reader cost £1.50 per message total £4.50. Send PSYCHICS YES to 68899 to agree.";
                        $command = "RANDOM";

                    } else if (strtolower($msg[1]) == "yes") {
                        $responseText = "Thank you for choosing our RANDOM READER PACKAGE. To reply to a specific reader, txt PSYCHICS <Reader's name> TO 68899.";
                        $command = "YES";

                    } else {
                        $reader_name = strtolower($msg[1]);
                        // check if second keyword is reader's name
                        $reader = $this->Psychic_model->first([
                            'where' => [
                            'username' => $reader_name
                            ]
                        ]);

                        if ($reader) {
                            $preferred_psychic_id = $reader->id;

                            // check if there is a Q
                            if (count($msg) > 2) {
                                // treat as Q with preferred reader to answer the Q
                                $responseText = urlencode('We have received your question. The charge to your phone is £1.50. A Psychic will answer shortly. More info? Txt PSYCHICS INFO to 68899.');
                                $command = "QUESTION";
                                $question_type = "PREFERRED";
                            } else {
                                $responseText = "TY! for choosing me today. I hope I have helped you. Text me new Qs here or join me in a chat on our other site: PSYCHIC-CONTACT.COM.";
                                $command = "READER";
                            }

                        } else {

                            // check if second keyword is reader's pin
                            $reader_pin = $this->Psychic_model->first([
                                'where' => [
                                'pin' => $reader_name
                                ]
                            ]);
                            if ($reader_pin) {
                                $preferred_psychic_id = $reader_pin->id;

                                // check if there is a Q
                                if (count($msg) > 2) {
                                    // treat as Q with preferred reader to answer the Q
                                    $responseText = urlencode('We have received your question. The charge to your phone is £1.50. A Psychic will answer shortly. More info? Txt PSYCHICS INFO to 68899.');
                                    $command = "QUESTION";
                                    $question_type = "PREFERRED";
                                } else {

                                    $responseText = "TY! for choosing me today. I hope I have helped you. Text me new Qs here or join me in a chat on our other site: PSYCHIC-CONTACT.COM.";
                                    $command = "READER";
                                }
                            } else {
                                // this is a regular question
                                $responseText = urlencode('We have received your question. The charge to your phone is £1.50. A Psychic will answer shortly. More info? Txt PSYCHICS INFO to 68899.');
                                $command = "QUESTION";
                            }
                            
                        }
                        
                    }

                } else {
                    $responseText = "Getting a Psychic Reading Has Never Been Easier! Have a quick question? Love, relationships, money, career, predictions? Txt PSYCHICS <Ur Questions> to 68899.";
                }
            } else {
                $responseText = "Getting a Psychic Reading Has Never Been Easier! Have a quick question? Love, relationships, money, career, predictions? Txt PSYCHICS <Ur Questions> to 68899.";
            }

            $this->logSMSIn("SMSIN_", "RESPONSE_TEXT: $command|$responseText");

            $postData = $this->post();
            $strPostReq  = 'reply=1';
            $strPostReq .= '&id=' . $id;
            $strPostReq .= '&number=' . $number;
            $strPostReq .= '&network=' . $network;
            $strPostReq .= '&message=' . $responseText;
            if ($command == "QUESTION" || $command == "RANDOM")
              $strPostReq .= '&value=' . $this->_chargeAmt;
            else 
               $strPostReq .= '&value=0';
            $strPostReq .= '&currency=' . $this->_chargeCurrency;
            $strPostReq .= '&cc=' . $this->_companyName;
            $strPostReq .= '&title=';
            $strPostReq .= '&ekey=' . $this->_ekey;
            $strPostReq .= $smscat;
            $postData['request_url'] = $strPostReq;
            $postData['txtnation_msg_id'] = $postData['id'];
            $postData['random'] = $random;

            $strBuffer = $this->sendRequest($command, $id, $number, $network, $responseText, $smscat);
            unset($postData['id']);
            
            $this->debugLog("RECEIVE_", "POST:strBuffer");
            // get subscriber details
            $subscriber = $this->Subscriber_model->first([
                    'where' => [
                    'mobile_num' => $number
                ]
            ]);

            if(strstr($strBuffer, 'SUCCESS')){

		$this->debugLog("SUCCESS_", "$command|$strBuffer");
                // check command
                if ($command == "QUESTION" || $command == "RANDOM") {

                    if ($subscriber) {
			if ($question_type != "PREFERRED") {
		        	$preferred_psychic_id = $subscriber->preferred_psychic_id;
			}
                        $subscriber->updated_at = date("Y-m-d H:i:s");
                        $subscriber->active = 1;
                        $subscriber->save();
                    } else {
                        $subsData['mobile_num'] = $number;
                        $subsData['created_at'] = date("Y-m-d H:i:s");
                        $subsData['updated_at'] = date("Y-m-d H:i:s");
                        $subsData['active'] = 1;
                        $subs_model = new Subscriber_model($subsData);
                        $subs_model->save();
			//$preferred_psychic_id = 0;
                    }

                    $post_data = json_encode($postData);
                    $this->debugLog("RECEIVE_", "POST:$post_data");
                    
                    // insert message to inbound_messages
                    $inboundMsg = new Inbound_message_model($postData);
                    if ($preferred_psychic_id != "")
                        $inboundMsg->preferred_psychic_id = $preferred_psychic_id;
                    $inboundMsg->save();

                }

                if ($command == "STOP") {
                    if ($subscriber) {
                        $subscriber->optout_at = date("Y-m-d H:i:s");
                        $subscriber->updated_at = date("Y-m-d H:i:s");
                        $subscriber->active = 0;
                        $subscriber->save();
                        $this->debugLog("RECEIVE_", "POST:$strBuffer|OLD Subs");
                    } else {
                        $subsData['mobile_num'] = $number;
                        $subsData['created_at'] = date("Y-m-d H:i:s");
                        $subsData['optout_at'] = date("Y-m-d H:i:s");
                        $subsData['active'] = 0;
                        $subs_model = new Subscriber_model($subsData);
                        $subs_model->save();
                        $this->debugLog("RECEIVE_", "POST:$strBuffer|NEW Subs");
                        
                    }
                }

                if ($command == "READER") {
                    $subscriber->preferred_psychic_id =  $preferred_psychic_id;
                    $subscriber->save();
                }

                if (strtolower($command) == "yes") {
                    // check last Question of Client
		    $this->debugLog("RANDOM_", "$number");
                    $last_question_id = $this->Inbound_message_model->get_last_question($number);
		    $this->debugLog("RANDOM_", $last_question_id);
                    if ($last_question_id) {
		    	$this->debugLog("RANDOM_", $last_question_id);
			$this->Inbound_message_model->updateRandom($last_question_id);
		    	$this->debugLog("RANDOM_", "$last_question_id");
                    }
                }

                /*
                $postData['id'] = $inboundMsg->id;
                $this->email->subject('TXTNation Message Received');
                $this->email->message("A TXTNation message has been received.<br>Response to TXTNation from our server is '$strBuffer'. Excerpt as follows: <br><br>" . 
                $this->itemizeJSON($postData, $this->_email_logs_fields));  

                $this->email->send();
                */
                $this->debugLog("EMAIL_", 'SUCCESS - ' . date('c') . ' --> Response: ' . $strBuffer . ' --> ' . json_encode($postData));

                echo 'OK';

            } else if(strstr($strBuffer, 'BARRED')){
                $this->debugLog("RECEIVE_", "POST:$strBuffer|FAILED curl");

            	if ($subscriber) {
        		    $subscriber->optout_at = date("Y-m-d H:i:s");
        		    $subscriber->updated_at = date("Y-m-d H:i:s");
                    $subscriber->active = 0;
                    $subscriber->save();
                    $this->debugLog("RECEIVE_", "POST:$strBuffer|OLD Subs");
        		} else {
        		    $subsData['mobile_num'] = $number;
                    $subsData['created_at'] = date("Y-m-d H:i:s");
                    $subsData['optout_at'] = date("Y-m-d H:i:s");
                    $subsData['active'] = 0;
                    $subs_model = new Subscriber_model($subsData);
                    $subs_model->save();
                    $this->debugLog("RECEIVE_", "POST:$strBuffer|NEW Subs");
        		}

                /*
                 update all inbound messages to STATUS_OPTOUT
                 so that readers will not be able to read all messages from
                 those who optout of the service
                 -- check code for updating
                */
                $status = Inbound_message_model::STATUS_OPTOUT;
                $data = array (
                    'status' => $status      
                );
                $this->Inbound_message_model->updateStatus($number, $data);

            } else {

                $this->debugLog("RECEIVE_", "POST:$strBuffer|FAILED curl");
                $postData['id'] = 'NA';
                $this->email->subject('TXTNation Message Auto-reply Failed');
                $this->email->message("A TXTNation message has beed recieved, but failed to auto-reply.<br>Response to TXTNation from our server is '$strBuffer'. Excerpt as follows: <br><br>" . 
                $this->itemizeJSON($postData, $this->_email_logs_fields));  

                $this->email->send();
                $this->debugLog("EMAIL_", 'ERROR - ' . date('c') . ' --> Response: ' . $strBuffer . ' --> ' . json_encode($postData));
                    
                echo $strBuffer;
            }

        } else {
            $this->debugLog("RECEIVE_", "POST:$strBuffer|Server not allowed to call this API");
            echo 'Server not allowed to call this API';
        }
    }

    private function sendRequest($command, $id, $number, $network, $responseText, $smscat)
    {
        $strPostReq  = 'reply=1';
        $strPostReq .= '&id=' . $id;
        $strPostReq .= '&number=' . $number;
        $strPostReq .= '&network=' . $network;
        $strPostReq .= '&message=' . $responseText;
        if ($command == "QUESTION" || $command == "RANDOM")
            $strPostReq .= '&value=' . $this->_chargeAmt;
        else 
            $strPostReq .= '&value=0';
        $strPostReq .= '&currency=' . $this->_chargeCurrency;
        $strPostReq .= '&cc=' . $this->_companyName;
        $strPostReq .= '&title=';
        $strPostReq .= '&ekey=' . $this->_ekey;
        $strPostReq .= $smscat;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_txtnationGateway);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "$strPostReq");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $strBuffer = curl_exec($ch);
        curl_close($ch);

        $this->logSMSIn("SMSIN_", "API RESPONSE:$strPostReq|$strBuffer");

	if ($command == "INFO") {
		// send second message
		$message = "PSYCHICS READER's NAME to 68899 = PRIVATE SMS to that Reader\nPSYCHICS SUPPORT <message> to 68899 = CONTACT US\nOr email us here: support@text-a-psychic.com";
		$req = 'reply=0';
            	$req .= '&number=' . $number;
            	$req .= '&network=INTERNATIONAL';
            	$req .= '&message=' . urlencode($message);
            	$req .= '&value=0';
            	$req .= '&currency=' . $this->_chargeCurrency;
            	$req .= '&cc=' . $this->_companyName;
            	$req .= '&title=' . '68899';
            	$req .= '&ekey=' . $this->_ekey;
            	$req .= '&id=' . $id;

            	$ch = curl_init();
            	curl_setopt_array($ch, array(
                	CURLOPT_URL => $this->_txtnationGateway,
                	CURLOPT_POST => true,
                	CURLOPT_POSTFIELDS => $req,
                	CURLOPT_RETURNTRANSFER => true,
                	CURLOPT_CONNECTTIMEOUT => 10
            	));
            	$result = curl_exec($ch);
            	curl_close($ch);
        	$this->logSMSIn("SMSIN_", "API RESPONSE:$strPostReq|$strBuffer");

	}

        return $strBuffer;

    }

    /**
     * Delivery report API
     *
     */
    public function delivery_report_post()
    {

    }

    public function send_message_post()
    {
        $uk_db = $this->load->database('uk_db', TRUE);
        
        $success = true;
        $errors = [];
        $data = [];

        $fromMessageId = $this->post('ref_message_id');
        $senderId = $this->post('sender_id');
        $message = $this->post('message');

        $this->logSMSOut("SMSOUT_", "$fromMessageId|$senderId|$message");
        $this->debugLog("SEND_", "$fromMessageId|$senderId|$message");
        
        if (!$fromMessageId) {
            $this->debugLog("SEND_", "You must include an inbound message ID");
            $errors[] = 'You must include an inbound message ID';
        }
        if (!$message) {
            $this->debugLog("SEND_", "You must include a message to send");
            $errors[] = 'You must include a message to send';
        }
        if (!$senderId) {
            $this->debugLog("SEND_", "You must include a Psychic ID");
            $errors[] = 'You must include a Psychic ID';
        }

        $sender = $uk_db->get_where('psychics', array('id' => $senderId))->result_array();
        // var_dump($sender);die;
        // $sender = $this->Psychic_model->first([
        //     'where' => [
        //         'id' => $senderId
        //     ]
        // ]);
        if (!$sender) {
            $errors[] = 'Psychic does not exist';
        }

        $inboundMsg = $uk_db->get_where('inbound_messages', array('id' => $fromMessageId))->result_array();
        // var_dump($inboundMsg[0]['status']);die;
        // $inboundMsg = $this->Inbound_message_model->first([
        //     'where' => [
        //         'id' => 147
        //     ]
        // ]);
        if (!$inboundMsg) {
            $this->debugLog("SEND_", "Inbound message does not exist");
            $errors[] = 'Inbound message does not exist';

        // insert random message - 2017-07-25
        } else {
            if ($inboundMsg[0]['random']) {
                $this->debugLog("SEND_", "Random Message");
                if ($inboundMsg[0]['replies'] > 4) {
                    $errors[] = 'Question was already answered by 4 Readers';
                } 
                
            } else {
                if ($inboundMsg[0]['responded_by'] && $senderId != $inboundMsg[0]['responded_by']) {
                    $this->debugLog("SEND_", "This is being read by a different psychic");
                    $errors[] = 'This is being read by a different psychic';
                } else if ($inboundMsg[0]['status'] != Inbound_message_model::STATUS_PENDING) {
                    $this->debugLog("SEND_", "Message is not yet marked as read");
                    $errors[] = 'Message is not yet marked as read';
                }
            }

        }

        if (count($errors)) {
            $success = false;
            return $this->response(compact('success', 'errors'));
        }

        $sender = $sender[0]['username'];
        $message = "$sender: $message";
        $number = $inboundMsg[0]['number'];

        // check if subscriber is still active
        $subscriber = $this->Subscriber_model->first([
            'where' => [
                'mobile_num' => $number,
                'active' => 0 
            ]
        ]);
        if ($subscriber && $subscriber->active == 0) {
            $errors[] = 'Subscriber already opted out from the service.';
        } else {

	       // check if with respondents
            if (($inboundMsg[0]['respondents'] != "" || $inboundMsg[0]['respondents'] != null) AND $inboundMsg[0]['random'] == 1) {

                $req  = 'reply=0';
                $req .= '&value=' . $this->_chargeAmt;
		$charge = $this->_chargeAmt;
            } else {
                $req  = 'reply=0';
                $req .= '&value=0';
		$charge = 0;

            }
            //$req = 'reply=0';
            $req .= '&mobile_number=' . $number;
            $req .= '&message=' . urlencode($message);
            $req .= '&currency=' . $this->_chargeCurrency;
            $req .= '&cc=' . $this->_companyName;
            //$req .= '&title=' . $sender;
            $req .= '&title=' . '12399003577';
            $req .= '&ekey=' . $this->_ekey;
            $req .= '&type=' . 'reader';

            $postData = $this->post();
            $postData['request_url'] = $req;
            // $outboundMsg = new Outbound_message_model($postData);
            // $outboundMsg->save();
            $uk_db->insert('outbound_messages', $postData); 

            $messageId = $uk_db->insert_id();
            $req .= '&id=' . $messageId;

            $baseurl = $this->setBaseAPIUrl();
            $authorization = "Authorization: Bearer Y2Q4MGEzYzk5ZDIzMWQ4YWMxYWYyYTBmMDMxZmQz";
            //curl POST for SMS
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array($authorization));
            curl_setopt($ch, CURLOPT_URL,  $baseurl . "/api/v1/send_sms");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($ch);
            
            curl_close ($ch);

            $data = json_decode($result);
            $success = isset($data->success)? $data->success : false;
            $this->logSMSOut("SMSOUT_", "$fromMessageId|$senderId|$message|$charge|$result");

            $post_data = json_encode($postData);
            $this->debugLog("SEND_", "$post_data");
            
            // $result = 'SUCCESS';
            $this->debugLog("SEND_", "$result");
            if($success){

                // insert random message 07-25-2017
                if ($inboundMsg[0]['random']) {
                    // dont set status,just update respondents for random readers and number of replies
                    $inboundMsg[0]['respondents'] = $inboundMsg[0]['respondents'] . "0$senderId|";
                    $inboundMsg[0]['replies'] = $inboundMsg[0]['replies'] + 1;
                } else {
                    $inboundMsg[0]['respondents'] = $inboundMsg[0]['respondents'] . "0$senderId|";
                    $inboundMsg[0]['status'] = Inbound_message_model::STATUS_RESOLVED;
                    $inboundMsg[0]['replies'] = $inboundMsg[0]['replies'] + 1;
                }

                if ($uk_db->update("inbound_messages", $inboundMsg[0], ['id' => $inboundMsg[0]['id']])) {
                    
                    $data = $uk_db->get_where('outbound_messages', array('id' => $messageId))->row();
                    //SocketIO_helper::sendEvent('message_resolved', $inboundMsg->to('array'));
                } else {
                    $this->debugLog("SEND_", "Unable to save");
                    $errors[] = "Unable to save";
                }
            } else {
                $this->debugLog("SEND_", "FAILED");
                $uk_db->delete('outbound_messages', array('id' => $messageId));
                $inboundMsg[0]['status'] = Inbound_message_model::STATUS_AVAILABLE;
                $inboundMsg[0]['responded_by'] = 0;
                if ($inboundMsg->save()) {
                    $data = $inboundMsg->to('array');
                    
                }
                $this->debugLog("SEND_", "Recipient $number: $result");
                $errors[] = "Recipient $number: $result";
            }
        }


        if (count($errors)) {
            $success = false;
        } else {
            $info['member'] = Auth::me();
            $name =  $info['member']['fname'] . ' ' . $info['member']['lname'];
            $this->notify_admin($name, $number);
        }

        return $this->response(compact('success', 'errors', 'data'));
    }

    public function notify_admin($user, $number) {

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
        $subject = "Devusa.Text-A-Psychic: Reader " . $user . " send message to mobile number: " . $number;
        $this->email->subject($subject);

        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strit.dtd"><html><head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    </head><body>';

        $message .= '<p>Dear Jayson</p>';
        $message .= "<p>" . $user . " send message to mobile number: " . $number;
        $message .= '<p>devusa.text-a-psychic.com/</p>';
        $message .= '</body></html>';

        
        $this->email->message($message);
        if($this->email->send()) {

        } else {
            echo $this->email->print_debugger();
        }

    }

    private function pretiffyJSON ($json)
    {
        $json = str_replace(array("\\r","\\n","\\t"), "", json_encode($json, JSON_PRETTY_PRINT));
        $json = preg_replace('#(?<!\\\\)(\\$|\\\\)#', "", $json);

        $string = '<pre>';
        $string .= $json;
        $string .= '</pre><hr>';

        return $string;
    }

    private function itemizeJSON ($json, $fields)
    {
        $string = '';

        foreach ($fields as $field) {
            $string .= '<strong>' . ucwords(str_replace('_', ' ', $field)) . '</strong>: ' . $json[$field] . '<br/>';
        }

        return $string;
    }

    private function debugLog ($file, $txt)
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . "/application/logs";
        file_put_contents("$path/$file".date('Ymd').'.txt', date('Y-m-d H:i:s').' - '.$txt."\n", FILE_APPEND);
    }

    private function logSMSIn($file, $txt)
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . "/application/logs";
        file_put_contents("$path/$file".date('Ymd').'.txt', date('Y-m-d H:i:s').' - '.$txt."\n", FILE_APPEND);
    }

    private function logSMSOut($file, $txt)
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . "/application/logs";
        file_put_contents("$path/$file".date('Ymd').'.txt', date('Y-m-d H:i:s').' - '.$txt."\n", FILE_APPEND);
    }


    public function notify_support($number, $message) {

        $this->load->library('email');
        $config = array();
        $config['useragent']           = "CodeIgniter";
        $config['mailpath']            = "/usr/sbin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']            = "smtp";
        $config['smtp_host']           = "localhost";
        $config['smtp_port']           = "25";
        $config['mailtype'] = 'html';
        $config['charset']  = 'utf-8';
        $config['newline']  = "\r\n";
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);

        $this->email->from('webmaster@psychic-contact.com');
        $this->email->to('smshelp@text-a-psychic.com');
        $this->email->subject("Text-A-Psychic: Contact Us");

        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strit.dtd"><html><head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    </head><body>';

        $message .= '<p>Inquiry: $message</p>';
        $message .= "<p>Mobile No.: " . $number;
        $message .= '</body></html>';

        $this->email->message($message);
        if($this->email->send()) {

        } else {
                echo $this->email->print_debugger();exit;
        }



    }

    public function setBaseAPIUrl ()
    {
        $baseurl = "";
        if($_SERVER['HTTP_HOST'] == 'dev.txtapsy.com') {
            $baseurl = "http://localhost:8000";
        } else if($_SERVER['HTTP_HOST'] === 'devusa.text-a-psychic.com') {
            $baseurl = "http://smsapi.text-a-psychic.com";
        }else if($_SERVER['HTTP_HOST'] === 'text-a-psychic.com') {
            $baseurl = "http://smsapi.text-a-psychic.com";
        }
        return $baseurl;
    }


}
