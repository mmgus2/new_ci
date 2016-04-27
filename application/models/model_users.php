<?php
/**
 * Created by PhpStorm.
 * User: gusis
 * Date: 4/27/2016
 * Time: 4:22 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_users extends CI_Model{
    public function can_log_in(){
        $this->db->where('email',$this->input->post('email'));
        $this->db->where('password',md5($this->input->post('password')));

        $query = $this->db->get('users');

        if($query->num_rows() == 1){
            return true;
        } else {
            return false;
        }
    }
}