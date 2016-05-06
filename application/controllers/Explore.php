<?php
/**
 * Created by PhpStorm.
 * User: gusis
 * Date: 5/6/2016
 * Time: 10:40 AM
 */
class Explore extends CI_Controller {

    private $record = null;
    private $model = null;

    public function __construct(){
        parent::__construct();
        $this->load->model('Database_model');
        $this->model = $this->Database_model;
        $this->load->helper('geodistance');
    }

    public function index()
    {
        $this->record = $this->model->read_activity();
        $data['activity'] = $this->record;

        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('explore-view','$data');
        $this->load->view('footer');
    }
}