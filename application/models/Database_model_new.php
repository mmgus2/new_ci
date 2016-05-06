<?php
/**
 * Created by PhpStorm.
 * User: gusis
 * Date: 5/6/2016
 * Time: 12:13 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Database_model_new extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //get forest data from forest table in database either without argument or with activities argument
    public function read_forest($arg = null)
    {
        if (isset($arg))
        {
            $sql = "select f.forest_id as forest_id, forest_name, latitude, longitude, forest_description
                from forest f, forest_activity fa
                where f.forest_id = fa.forest_id
                and activity_id in ?
                group by forest_id
                order by forest_name";
            $query = $this->db->query($sql, array($arg));
        }
        else
        {
            $sql = "SELECT * FROM forest ORDER BY ?";
            $query = $this->db->query($sql,array('forest_name'));
        }
        return $query->result_array();
    }

    //get activity data from database use a specific forest ID
    public function read_forest_act($forest_id)
    {
        $sql = "SELECT fa.activity_id as activity_id, a.activity_name as activity_name
                FROM forest f, forest_activity fa, activity a
                WHERE f.forest_id = fa.forest_id
                AND fa.activity_id = a.activity_id
                AND f.forest_id = ?
                GROUP BY activity_id
                ORDER BY activity_id;";
        $query = $this->db->query($sql, array($forest_id));
        return $query->result_array();
    }

    //get site data from site table in database according to a specific forest ID
    public function read_site($forest_id)
    {
        $sql = "SELECT * FROM site WHERE forest_id = ? ORDER BY ?";
        $query = $this->db->query($sql, array($forest_id,'site_name'));
        return $query->result_array();
    }

    //get activity data from database use a specific site ID
    public function read_site_act($site_id)
    {
        $sql = "SELECT sa.activity_id as activity_id, a.activity_name
                FROM site s, site_activity sa, activity a
                WHERE s.site_id = sa.site_id
                AND sa.activity_id = a.activity_id
                AND s.site_id = ?
                GROUP BY activity_id
                ORDER BY activity_id;";
        $query = $this->db->query($sql, array($site_id));
        return $query->result_array();
    }

    //get all activity data from activity table in database
    public function read_activity()
    {
        $sql = "SELECT * FROM activity";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}