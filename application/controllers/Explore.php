<?php
/**
 * Created by PhpStorm.
 * User: gusis
 * Date: 5/6/2016
 * Time: 10:40 AM
 */
class Explore extends CI_Controller {

    public function index()
    {
        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('explore-view');
        $this->load->view('footer');
    }
}