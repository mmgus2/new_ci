<?php
/**
 * Created by PhpStorm.
 * User: gusis
 * Date: 4/30/2016
 * Time: 11:13 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Facebook extends CI_Controller {

    function _remap($method,$args)
    {

        if (method_exists($this, $method))
        {
            $this->$method($args);
        }
        else
        {
            $this->index($method,$args);
        }
    }

    public function index($id)
    {
        $data['forest_id'] = $id;
        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('facebook-view', $data);
        $this->load->view('footer');
    }
}