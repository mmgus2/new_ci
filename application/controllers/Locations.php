<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: gusis
 * Date: 3/29/2016
 * Time: 9:44 PM
 */
class Locations extends CI_Controller
{
    public $model = NULL;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Database_model');
        $this->model = $this->Database_model;
        $this->load->database();
        $this->load->library('googlemaps');
        $this->load->library('geoip_lib');
        $this->load->helper('geodistance');
    }

    public function index()
    {
        $record = $this->model->read();
        //echo $record;
        $geo = NULL;
        if($this->geoip_lib->InfoIP()) {
            $geo = $this->geoip_lib->result_array();
            //source taken from: http://biostall.com/demos/google-maps-v3-api-codeigniter-library/multiplemarkers
            $config['center'] = $geo['latitude'].','. $geo['longitude'];
            $config['zoom'] = 'auto';
            $this->googlemaps->initialize($config);

            $marker = array();
            $marker['position'] = $geo['latitude'].','. $geo['longitude'];
            $marker['infowindow_content'] = 'You are here!';
            $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
            $this->googlemaps->add_marker($marker);


            if (isset($_POST['submit']) && isset($_POST['distance'])){
                $maxdistance = $_POST['distance'];
                $unit = $_POST['unit'];
                foreach ($record as $row_record){
                    //echo $maxdistance .','. $unit .'<br />';
                    if (distance(floatval($geo['latitude']),floatval($geo['longitude']),floatval($row_record['latitude']),floatval($row_record['longitude']),$unit) <= $maxdistance){
                        $marker = array();
                        $marker['position'] = $row_record['latitude'].','.$row_record['longitude'];
                        $marker['infowindow_content'] = ''.$row_record['name'];
                        //$marker['onclick'] = 'alert("You just clicked me!!")';
                        $this->googlemaps->add_marker($marker);
                    }
                }
            } else {
                foreach ($record as $row_record){
                    $marker = array();
                    $marker['position'] = $row_record['latitude'].','.$row_record['longitude'];
                    $marker['infowindow_content'] = ''.$row_record['name'];
                    //$marker['onclick'] = 'alert("You just clicked me!!")';
                    $this->googlemaps->add_marker($marker);
                }
            }
            $data['map'] = $this->googlemaps->create_map();
            $this->load->view('header', $data);
            $this->load->view('locations_page', $data);
            $this->load->view('footer');
        } else {
            echo '<strong>IP ERROR</strong>';
        }
    }
}
