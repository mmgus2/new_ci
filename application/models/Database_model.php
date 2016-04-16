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
        //$sql = "SELECT * FROM forest ORDER BY forest_name";
        $sql = "SELECT * FROM forest ORDER BY ?";
        //$query = $this->db->query($sql);
        $query = $this->db->query($sql,array('forest_name'));
        return $query->result_array();
    }

    public function read_site($forestID)
    {
        //$sql = "SELECT * FROM site WHERE forest_id = ". $forestID ." ORDER BY site_name";
        $sql = "SELECT * FROM site WHERE forest_id = ? ORDER BY ?";
        //$query = $this->db->query($sql);
        $query = $this->db->query($sql, array($forestID,'site_name'));
        return $query->result_array();
    }
}
