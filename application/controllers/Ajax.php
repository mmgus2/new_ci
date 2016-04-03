<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

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
    private $record = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Database_model');
        $this->model = $this->Database_model;
        $this->load->helper('geodistance');
        $this->record = $this->model->read();
    }

    public function get_sites()
    {
        $max_distance = $this->input->post('distance');
        $unit = $this->input->post('unit');
        $init_lat = $this->input->post('latitude');
        $init_lon = $this->input->post('longitude');
        //echo json_encode($record, JSON_PRETTY_PRINT);
        $sites = NULL;
        for ($i=0; $i < sizeof($this->record); $i++) {
            if (distance(floatval($init_lat), floatval($init_lon),
                    floatval($this->record[$i]["latitude"]), floatval($this->record[$i]["longitude"]), $unit) <= $max_distance
            ) {
                $sites[$i]["site_name"] = $this->record[$i]["name"];
                $sites[$i]["latitude"] = floatval($this->record[$i]["latitude"]);
                $sites[$i]["longitude"] = floatval($this->record[$i]["longitude"]);
            }
        }
        echo json_encode($sites, JSON_PRETTY_PRINT);
    }
}
