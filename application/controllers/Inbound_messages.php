<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'libraries/REST_Controller.php');

class Inbound_messages extends REST_Controller {

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


	// public function index()
	// {	
	// 	$data['page_title'] = 'Bulletin board';
	// 	$this->load->view('template/header.php', $data);
	// 	$this->load->view('bulletin_board.php');
	// 	$this->load->view('template/footer.php');
	// }


	public function all_get() {
		$errors = [];
		$success = true;
		
		if (count($errors)) {
            $success = false;
        }

        $data = $this->Inbound_message_model->all([
	        'where' => [
	            'status'	=> [
	            	Inbound_message_model::STATUS_AVAILABLE,
	            	Inbound_message_model::STATUS_PENDING
	            ]
	        ]
        ]);

        return $this->response(compact('data', 'success', 'errors'));
	}


	public function resolved_messages_get($psychicId = null) {
		
        $errors = [];
		$success = true;
		$extraFilters = [];
		
		if ($psychicId) {
			$extraFilters = ['responded_by' => $psychicId];
		}

		if (count($errors)) {
            $success = false;
        }

	/*
        $messages = $this->Inbound_message_model->all([
	        'where' => [
	            'status'	=> [
	            	Inbound_message_model::STATUS_RESOLVED
	            ]
	        ] + $extraFilters,
	        'with'	=> ['outbound_message']
        ]);

        $data = array();
        $no = $_POST['start'];
        $ctr = 0;
        $row = array();
        foreach ($messages as $message) {
        	$ctr++;
            $no++;
            
            $row['id'] = $message->id;
            $row['message'] = $message->message;
            $row['message_reply'] = $message->outbound_message->message;
            $row['date_sent'] = substr($message->sent_at, 0, 10);
            $row['time_sent'] = substr($message->sent_at, 11, 8);
            $row['country'] = $message->country;
            $row['mobile'] = str_repeat('*', strlen($message->number) - 4).substr($message->number, -4);
            $row['shortcode'] = $message->shortcode;

            $data[] = $row;
        }
	*/
 
	$messages = $this->Inbound_message_model->get_responded_messages_random($psychicId);

        $data = array();
        $no = isset($_POST['start'])? $_POST['start'] : 0;
        $ctr = 0;
        $row = array();
        foreach ($messages as $message) {
        	$ctr++;
            $no++;
            
            $row['id'] = $message['id'];
            $row['message'] = $message['message'];
            //$row['message_reply'] = $message->outbound_message->message;
            $row['message_reply'] = $message['message_reply'];
            $row['date_sent'] = substr($message['sent_at'], 0, 10);
            $row['time_sent'] = substr($message['sent_at'], 11, 8);
            $row['country'] = $message['country'];
            $row['mobile'] = str_repeat('*', strlen($message['number']) - 4).substr($message['number'], -4);
            $row['shortcode'] = $message['shortcode'];

            $data[] = $row;
        }
        $output = array(
                        //"draw" => $_GET['draw'],
                        "recordsTotal" => $ctr,
                        "recordsFiltered" => $ctr,
                        "data" => $data,
                );
        echo json_encode($output);
	}



	public function all_messages_get($psychicId = null) {
		
        $errors = [];
		$success = true;
		$extraFilters = [];
		
		if ($psychicId) {
			$extraFilters = ['responded_by' => $psychicId];
		}

		if (count($errors)) {
            		$success = false;
        	}


        /*
        $messages = $this->Inbound_message_model->all([
	        'where' => [
	            'status'	=> [
	            	Inbound_message_model::STATUS_RESOLVED
	            ]
	        ] + $extraFilters,
	        'with'	=> ['outbound_message']
        ]);
        */

        $messages = $this->Inbound_message_model->all([
	        'where' => [
	            'status'	=> [
	            	Inbound_message_model::STATUS_AVAILABLE,
	            	Inbound_message_model::STATUS_PENDING
	            ]
	        ]
        ]);

        $data = array();
        $no = isset($_POST['start'])? $_POST['start'] : 0;
        $ctr = 0;
        $row = array();
        foreach ($messages as $message) {
            $no++;
            $respondents = explode("|", $message->respondents);
	    $preferred_psychic_id = 0;

	    //$this->debugLog("ALL_", "$psychicId-".$message->respondents."-".count($respondents));
	    if (count($respondents) < 5) {
            		if (!in_array( "0$psychicId", $respondents)) {

				// check preferred_psychic_id of message
				/*
				$subscriber = $this->Subscriber_model->first([
                    			'where' => [
                    			'mobile_num' => $message->number
                			]
            			]);
				if ($subscriber) {
					$preferred_psychic_id = $subscriber->preferred_psychic_id;
				}
				*/

				$respondents = explode("|", $message->respondents);
				if ($message->preferred_psychic_id != 0) {
					if ($message->preferred_psychic_id == $psychicId) {
				//if ($preferred_psychic_id) {
				//	if ($preferred_psychic_id == $psychicId) {
            					$ctr++;
            					$row['id'] = $message->id;
	            				$row['message'] = $message->message;
	            				$row['date_sent'] = substr($message->sent_at, 0, 10);
	            				$row['time_sent'] = substr($message->sent_at, 11, 8);
	            				$row['country'] = $message->country;
	            				$row['mobile'] = str_repeat('*', strlen($message->number) - 4).substr($message->number, -4);
	            				$row['shortcode'] = $message->shortcode;
	            				$row['status'] = $message->status;
	            				$row['random'] = $message->random;
						if ($message->random == 1) {
	            					//$row['respondents'] = (count($respondents) ). " of 4 have answered";
	            					$row['respondents'] = $message->replies . " of 4 have answered";
						} else {
	            					$row['respondents'] = "";
						}
						if ($message->preferred_psychic_id == 1) {
	            					$row['preferred_psychic_id'] = "Yes";
						} else {
	            					$row['preferred_psychic_id'] = "";
						}
	            				$row['action_id'] = $message->id;
	            				$data[] = $row;
            				}
				} else {
            				$ctr++;
            				$row['id'] = $message->id;
	            			$row['message'] = $message->message;
	            			$row['date_sent'] = substr($message->sent_at, 0, 10);
	            			$row['time_sent'] = substr($message->sent_at, 11, 8);
	            			$row['country'] = $message->country;
	            			$row['mobile'] = str_repeat('*', strlen($message->number) - 4).substr($message->number, -4);
	            			$row['shortcode'] = $message->shortcode;
	            			$row['status'] = $message->status;
	            			$row['random'] = $message->random;
					if ($message->random == 1) {
	            				$row['respondents'] = $message->replies . " of 4 have answered";
	            				//$row['respondents'] = (count($respondents) - 1) . " of 4 have answered";
					} else {
	            				$row['respondents'] = "";
					}
					if ($message->preferred_psychic_id == 1) {
	            				$row['preferred_psychic_id'] = "Yes";
					} else {
	            				$row['preferred_psychic_id'] = "";
					}
	            			$row['action_id'] = $message->id;
	            			$data[] = $row;
				}
			}
		}

            
        }
 
        $output = array(
                        //"draw" => $_GET['draw'],
                        "recordsTotal" => $ctr,
                        "recordsFiltered" => $ctr,
                        "data" => $data,
                );
        echo json_encode($output);
	}


	public function accept_message_post()
	{

		$errors = [];
		$success = true;
		$data = null;

        $psychicId = $this->post('psychic_id');
        $messageId = $this->post('message_id');
        
        if (!$psychicId) {
        	$errors[] = 'Include a psychic ID';
        }
        if (!$messageId) {
        	$errors[] = 'Include a message ID';
        }

        if (!count($errors)) {
	        // Check if psychic is not reading other messages
	        $heldMessage = $this->Inbound_message_model->first([
	        	'where' => [
	        		'status'		=> Inbound_message_model::STATUS_PENDING,
	        		'responded_by'	=> $psychicId 
	        	]
	        ]);
	        if ($heldMessage) {
	        	$errors[] = 'Psychic is still reading another message';
	        }

	        if (!count($errors)) {
		        // Check if this message is held by someone else
		        $currentMessage = $this->Inbound_message_model->first([
		        	'where' => [
		        		'id'	=> $messageId
		        	]
		        ]);
		        if (!$currentMessage) {
		        	$errors[] = 'Message does not exist';
		        } else if ($currentMessage->status != Inbound_message_model::STATUS_AVAILABLE) {
		        	$errors[] = "Message is not available $messageId";
		        } else {
		        	$data = $currentMessage;
		        }
		    }
	    }

        if (count($errors)) {
            $success = false;
        } else {
        	// if random message, make message available to all readers, don't update status
        	if (!$currentMessage->random) {
        		$data->status = Inbound_message_model::STATUS_PENDING;
        	}
        	
        	$data->responded_by = $psychicId;
	        $data->save();
	        $data = $data->to('array');

	        //SocketIO_helper::sendEvent('message_accepted', $data);
        }


        return $this->response(compact('data', 'success', 'errors'));
	}

	public function decline_message_post()
	{
		$errors = [];
		$success = false;
		$data = null;

		$messageId = $this->post('message_id');

		if (!$messageId) {
        	$errors[] = 'Include a message ID';
        }

        if (!count($errors)) {
        	$heldMessage = $this->Inbound_message_model->first([
	        	'where' => [
	        		'status'	=> Inbound_message_model::STATUS_PENDING,
	        		'id'		=> $messageId 
	        	]
	        ]);

	        if (!$heldMessage) {
	        	$errors[] = 'Message does not exist or not read';
	        }
        }

        if (!count($errors)) {
        	$heldMessage->status = Inbound_message_model::STATUS_AVAILABLE;
        	$heldMessage->responded_by = 0;
	        if ($heldMessage->save()) {
		        $data = $heldMessage->to('array');

		        //SocketIO_helper::sendEvent('message_declined', $data);
		        $success = true;
	        } else {
	        	$errors[] = 'Unable to save';
	        }
        }

        return $this->response(compact('data', 'success', 'errors'));
	}

    private function debugLog ($file, $txt)
    {
        $path = "/home/apptextpsychic1002/htdoc/text-a-psychic.com/application/logs";
        file_put_contents("$path/$file".date('Ymd').'.txt', date('Y-m-d H:i:s').' - '.$txt."\n", FILE_APPEND);
    }

}

