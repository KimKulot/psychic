<?php

class Inbound_message_model extends Base_model {

	const STATUS_AVAILABLE = 0;
	const STATUS_PENDING = 1;
	const STATUS_RESOLVED = 2;
	const STATUS_OPTOUT = 3;

	public static $statuses = [
		'Available',
		'Pending',
		'Resolved'
	];

	// easiest way to do this
	protected static $_belongs_to = [
		'outbound_message' => [
			'model' 	=> Outbound_message_model::class,
			'from'		=> 'id',
			'to'		=> 'ref_message_id',
			'fields'	=> ['message', 'request_url', 'sent_at']
		]
	];

	function get_responded_messages($id)
	{
		$query = $this->db->query("SELECT * FROM inbound_messages WHERE responded_by=$id");
		
		return $query->result_array();

	}

	public function get_count_all_messages($psychicId = null) {
		
        	//$query = $this->db->query("SELECT * FROM inbound_messages WHERE status!=2 ");
		//$query = $this->db->query("SELECT * FROM inbound_messages WHERE (status!=2 AND respondents='') OR respondents NOT LIKE '%$psychicId|%' ");
		$sql = "SELECT * FROM inbound_messages WHERE (random=1 AND respondents NOT LIKE '%0$psychicId|%') OR respondents=''";
		$query = $this->db->query($sql);
        	return $query->num_rows();

	}

	public function get_count_responded_messages($psychicId = null) {
		
        	//$query = $this->db->query("SELECT * FROM inbound_messages WHERE (responded_by=$psychicId AND status=2) OR respondents LIKE '%$psychicId|%'");
        	$query = $this->db->query("SELECT * FROM inbound_messages WHERE (random =1 AND respondents LIKE '%0$psychicId|%') OR responded_by=$psychicId");
		

		return $query->num_rows();

	}

	public function get_all_messages($psychicId = null) {
		//$query = $this->db->query("SELECT * FROM inbound_messages WHERE status IN (0,1) OR respondents LIKE '%$psychicId|%' ORDER BY id DESC");
		$query = $this->db->query("SELECT * FROM inbound_messages WHERE respondents LIKE '%0$psychicId|%' ORDER BY id DESC");

		return $query->result_array();
	}


	public function get_responded_messages_random($psychicId = null) {

		$sql = "SELECT inbound_messages.id, inbound_messages.message AS message, outbound_messages.message AS message_reply, inbound_messages.sent_at, inbound_messages.country, inbound_messages.number, inbound_messages.shortcode FROM inbound_messages JOIN outbound_messages ON outbound_messages.ref_message_id = inbound_messages.id  WHERE (inbound_messages.responded_by=$psychicId OR inbound_messages.respondents LIKE '%0$psychicId|%') AND outbound_messages.sender_id=$psychicId GROUP BY inbound_messages.id ORDER BY inbound_messages.id DESC";

		$query = $this->db->query($sql);

		//var_dump($sql);exit;
		return $query->result_array();
	}



	public function get_last_question($number) {
		$sql = "SELECT id FROM inbound_messages WHERE number='$number' ORDER BY id DESC LIMIT 1";

		$this->debugLog("SQL_", $sql);
		//$query = $this->db->query($sql);
		$query = $this->db->query($sql);

		$row = $query->row(); 
		$this->debugLog("SQL_", "$sql|" . $row->id);
		return $row->id;

	}


	public function updateRandom($id) {
		$data = array (
                    'random' => 1,
                    'preferred_psychic_id' => 0,
		    'status' => 0
                );
        	$this->db->where('id', $id);
    	   	$this->db->set($data);
        	$this->db->update('inbound_messages', $data);              

	}

	public function updateStatus($mobile_num, $data) {
        	$this->db->where('number', $mobile_num);
    	   	$this->db->set($data);
        	$this->db->update('inbound_messages', $data);              
	}


    private function debugLog ($file, $txt)
    {
        $path = "/home/apptextpsychic1002/htdoc/text-a-psychic.com/application/logs";
        file_put_contents("$path/$file".date('Ymd').'.txt', date('Y-m-d H:i:s').' - '.$txt."\n", FILE_APPEND);
    }

	// public $id;
	// public $txtnation_msg_id;
	// public $number;
	// public $message;
	// public $request_url;
	// public $network;
	// public $shortcode;
	// public $billing;
	// public $country;
	// public $responded_by;
	// public $status;
	// public $sent_at;
}
