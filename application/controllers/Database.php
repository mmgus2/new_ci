<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Database extends CI_Controller {

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
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Database_model');
        $this->model = $this->Database_model;
    }

    public function index()
    {
        $this->read();
    }

    /**
     *
     */
    public function read()
    {
        $data["data"] = $this->model->read();
        $this->load->view('database_view', $data);
    }
}
