<?php
/**
 * Created by PhpStorm.
 * User: gusis
 * Date: 4/30/2016
 * Time: 11:13 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Facebook extends CI_Controller {
    public function index()
    {

        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('facebook2-view');
        $this->load->view('footer');
    }
}