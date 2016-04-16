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
    }

    public function get_forests()
    {
        $this->record = $this->model->read();
        $max_distance = $this->input->post('distance');
        $unit = $this->input->post('unit');
        $init_lat = $this->input->post('latitude');
        $init_lon = $this->input->post('longitude');
        //echo json_encode($record, JSON_PRETTY_PRINT);
        $forests = NULL;
        for ($i=0; $i < sizeof($this->record); $i++)
        {
            $forest_distance = distance(floatval($init_lat), floatval($init_lon),
                floatval($this->record[$i]["latitude"]), floatval($this->record[$i]["longitude"]), $unit);
            if ( $forest_distance <= $max_distance)
            {
                $forests[$i]["forest_id"] = $this->record[$i]["forest_id"];
                $forests[$i]["forest_name"] = $this->record[$i]["forest_name"];
                $forests[$i]["latitude"] = floatval($this->record[$i]["latitude"]);
                $forests[$i]["longitude"] = floatval($this->record[$i]["longitude"]);
                $forests[$i]["distance"] = intval($forest_distance);
                //$forests[]["max_distance"] = $max_distance;
            }
        }
        echo json_encode($forests, JSON_PRETTY_PRINT);
    }
    public function get_sites()
    {
        $forest_id = $this->input->post('forest_id');
        $unit = $this->input->post('unit');
        $init_lat = $this->input->post('latitude');
        $init_lon = $this->input->post('longitude');
        $this->record = $this->model->read_site($forest_id);
        for ($i=0; $i < sizeof($this->record); $i++)
        {
            $site_distance = distance(floatval($init_lat), floatval($init_lon),
                floatval($this->record[$i]["latitude"]), floatval($this->record[$i]["longitude"]), $unit);
            $sites[$i]["site_id"] = $this->record[$i]["site_id"];
            $sites[$i]["site_name"] = $this->record[$i]["site_name"];
            $sites[$i]["latitude"] = floatval($this->record[$i]["latitude"]);
            $sites[$i]["longitude"] = floatval($this->record[$i]["longitude"]);
            $sites[$i]["description"] = $this->record[$i]["access_desc"];
            $sites[$i]["distance"] = intval($site_distance);
        }
        echo json_encode($sites, JSON_PRETTY_PRINT);
    }

    public function get_max_distances()
    {
        $this->record = $this->model->read();
        $init_lat = $this->input->post('latitude');
        $init_lon = $this->input->post('longitude');
        $unit = "" . $this->input->post('unit');
        $maxDistance = 0;
        for ($i=0; $i < sizeof($this->record); $i++)
        {
            $site_distance = distance(floatval($init_lat), floatval($init_lon),
                floatval($this->record[$i]["latitude"]), floatval($this->record[$i]["longitude"]), $unit);
            if ($site_distance > $maxDistance)
            {
                $maxDistance = $site_distance;
            }
        }
        echo ceil($maxDistance);
    }
}
