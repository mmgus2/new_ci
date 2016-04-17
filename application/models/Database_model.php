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

    public function read_act($array)
    {
        $sql = "select f.forest_id as forest_id, forest_name, latitude, longitude
                from forest f, forest_activity fa
                where f.forest_id = fa.forest_id
                and activity_id in ?
                group by forest_id
                order by forest_name";
        $query = $this->db->query($sql, array($array));
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

    public function read_activities()
    {
        $sql = "SELECT * FROM activity";
        //$query = $this->db->query($sql);
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
