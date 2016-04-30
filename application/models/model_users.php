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

    public function add_temp_user($key){
        $data = array(
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'key' => $key
        );

        $query = $this->db->insert('temp_users', $data);

        print_r($query);

        if ($query){
            return true;
        } else {
            return false;
        }
    }
}