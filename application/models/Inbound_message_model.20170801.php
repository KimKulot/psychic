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
		
        $query = $this->db->query("SELECT * FROM inbound_messages WHERE status!=2");
        return $query->num_rows();

	}

	public function get_count_responded_messages($psychicId = null) {
		
        $query = $this->db->query("SELECT * FROM inbound_messages WHERE responded_by=$psychicId AND status=2");
		

		return $query->num_rows();

	}

	public function get_all_messages($psychicId = null) {
		$query = $this->db->query("SELECT * FROM inbound_messages WHERE status IN (0,1) OR respondents LIKE '0$psychicId|%'");

		return $query->result_array();
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