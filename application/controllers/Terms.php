<?php
/**
 * Created by PhpStorm.
 * User: gusis
 * Date: 4/13/2016
 * Time: 4:02 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms extends CI_Controller
{
    public function index()
    {
        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('term_condition-view');
        $this->load->view('footer');
    }
}