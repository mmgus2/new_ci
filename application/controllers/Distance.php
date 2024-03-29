<?php
/**
 * Created by PhpStorm.
 * User: gusis
 * Date: 4/3/2016
 * Time: 3:58 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Distance extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {

        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('distance-view');
        $this->load->view('maptable-view');
        $this->load->view('footer');
    }
}