<?php

class Articles_model extends Base_model {


    public function get_article($id)
    {
        $query = $this->db->query("SELECT * FROM articles WHERE id='$id' LIMIT 0, 1");
        
        return $query->row();

    }

    public function get_latest_article()
    {
        $query = $this->db->query("SELECT * FROM articles ORDER BY id DESC LIMIT 0, 1");
        
        return $query->result_array();

    }

    public function get_articles()
    {
        $query = $this->db->query("SELECT * FROM articles ORDER BY id DESC LIMIT 0, 5");
        
        return $query->result_array();

    }
}