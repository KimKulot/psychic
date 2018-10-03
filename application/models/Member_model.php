<?php

class Member_model extends Base_model {

    public $id;
    public $registration_date;
    public $last_login_date;
    public $email;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $gender;
    public $dob;
    public $country;
    public $mobile_number;
    public $profile_image;
    public $newsletter;
    public $validated;
    public $received_promo;
    public $banned;
    public $paypal_email;

    public function update_data($data) {
        extract($data);
        $table_name = 'members';
        $this->db->where('id', $id);
        $this->db->set($data);
        $this->db->update($table_name, $data);
        return true;
    }

    public function get_member($id)
    {
        $query = $this->db->query("SELECT * FROM members WHERE id = '$id'");
        
        return $query->result_array();
    }
}

