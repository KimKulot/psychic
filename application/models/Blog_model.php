<?php

class Blog_model extends Base_model {


    public function get_blog($id)
    {
        $query = $this->db->query("SELECT * FROM blogs WHERE id='$id' LIMIT 0, 1");
        
        return $query->result_array();

    }

    public function get_latest_blog()
    {
        $query = $this->db->query("SELECT * FROM blogs ORDER BY id DESC LIMIT 0, 1");
        
        return $query->result_array();

    }

    public function get_latest_blogs()
    {
        $query = $this->db->query("SELECT * FROM blogs ORDER BY id DESC LIMIT 0, 5");
        
        return $query->result_array();

    }
}