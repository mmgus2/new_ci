<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Database_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function read()
    {
        $sql = "SELECT * FROM forest ORDER BY forest_name";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function read_site($forestID)
    {
        $sql = "SELECT * FROM site WHERE forest_id = ". $forestID ." ORDER BY site_name";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
