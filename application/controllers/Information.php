<?php
/**
 * Created by PhpStorm.
 * User: gusis
 * Date: 4/13/2016
 * Time: 4:02 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Information extends CI_Controller {

    private $record = null;
    private $model = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Database_model');
        $this->model = $this->Database_model;
    }

    public function index()
    {

        $this->record = $this->model->read_forest();
        $forests = NULL;
        for ($i=0; $i < sizeof($this->record); $i++)
        {
            $forests[$i]["id"] = $this->record[$i]["forest_id"];
            $forests[$i]["name"] = $this->record[$i]["forest_name"];
            $forests[$i]["latitude"] = floatval($this->record[$i]["latitude"]);
            $forests[$i]["longitude"] = floatval($this->record[$i]["longitude"]);
            $forests[$i]["description"] = $this->record[$i]["forest_description"];
            $sites = $this->model->read_site($forests[$i]["id"]);
            $forests[$i]['sites'] = $sites;/*
            for ($j=0; $j < sizeof($sites); $j++)
            {
                $forests[$i]['sites'][$j]['activities']= $this->model->read_site_act($sites[$j]['site_id']);
            }*/
        }
        $data['allforests'] = $forests;
        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('information-view',$data);
        $this->load->view('footer');
    }

    public function get_forest($forestID){
        //later
    }
}