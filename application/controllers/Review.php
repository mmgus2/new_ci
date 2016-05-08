<?php
/**
 * Created by PhpStorm.
 * User: gusis
 * Date: 4/25/2016
 * Time: 12:37 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Database_model');
        $this->model = $this->Database_model;
    }

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
        $this->record = $this->model->read_a_forest($id);
        $forest = NULL;
        $forest["id"] = $this->record[0]["forest_id"];
        $forest["name"] = $this->record[0]["forest_name"];
        $forest["latitude"] = floatval($this->record[0]["latitude"]);
        $forest["longitude"] = floatval($this->record[0]["longitude"]);
        $forest["description"] = $this->record[0]["forest_description"];
        $sites = $this->model->read_site($forest["id"]);
        $forest['sites'] = $sites;
        /*for ($j=0; $j < sizeof($sites); $j++)
        {
            $forest['sites'][$j]['activities']= $this->model->read_site_act($sites[$j]['site_id']);
        }*/
        $activities = $this->model->read_forest_act($forest["id"]);
        $forest['activities'] = $activities;

        $data['aforest'] = $forest;
        $this->load->view('header');
        //$this->load->view('menu');
        $this->load->view('review-view',$data);
        $this->load->view('footer');

    }
}