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
    private $model = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Database_model');
        $this->model = $this->Database_model;
        $this->load->helper('geodistance');
    }

    //digunakan
    public function get_forests($choice)
    {
        if($choice == 'distance')
        {
            $this->record = $this->model->read_forest();
            $max_distance = $this->input->post('distance');
            $unit = $this->input->post('unit');
            $init_lat = $this->input->post('latitude');
            $init_lon = $this->input->post('longitude');
            $forests = NULL;
            for ($i=0; $i < sizeof($this->record); $i++)
            {
                $forest_distance = distance(floatval($init_lat), floatval($init_lon),
                    floatval($this->record[$i]["latitude"]), floatval($this->record[$i]["longitude"]), $unit);
                if ( $forest_distance <= $max_distance)
                {
                    $forests[$i]["id"] = $this->record[$i]["forest_id"];
                    $forests[$i]["name"] = $this->record[$i]["forest_name"];
                    $forests[$i]["latitude"] = floatval($this->record[$i]["latitude"]);
                    $forests[$i]["longitude"] = floatval($this->record[$i]["longitude"]);
                    $forests[$i]["description"] = $this->record[$i]["forest_description"];
                    $forests[$i]["distance"] = intval($forest_distance);
                    /*$sites = $this->model->read_site($forests[$i]["id"]);
                    $forests[$i]['sites'] = $sites;
                    for ($j=0; $j < sizeof($sites); $j++)
                    {
                        $forests[$i]['sites'][$j]['activities']= $this->model->read_site_act($sites[$j]['site_id']);
                    }*/
                    $activities = $this->model->read_forest_act($forests[$i]["id"]);
                    $forests[$i]['activities'] = $activities;
                }
            }
        }
        if($choice == 'activity')
        {
            $unit = $this->input->get('unit');
            $init_lat = $this->input->get('latitude');
            $init_lon = $this->input->get('longitude');
            $act_array = $this->input->get('activities');
            $this->record = $this->model->read_forest($act_array);
            //echo json_encode($record, JSON_PRETTY_PRINT);
            $forests = NULL;
            for ($i=0; $i < sizeof($this->record); $i++)
            {
                $forest_distance = distance(floatval($init_lat), floatval($init_lon),
                    floatval($this->record[$i]["latitude"]), floatval($this->record[$i]["longitude"]), $unit);
                $forests[$i]["id"] = $this->record[$i]["forest_id"];
                $forests[$i]["name"] = $this->record[$i]["forest_name"];
                $forests[$i]["latitude"] = floatval($this->record[$i]["latitude"]);
                $forests[$i]["longitude"] = floatval($this->record[$i]["longitude"]);
                $forests[$i]["description"] = $this->record[$i]["forest_description"];
                $forests[$i]["distance"] = intval($forest_distance);
                /*$sites = $this->model->read_site($forests[$i]["id"]);
                $forests[$i]['sites'] = $sites;
                for ($j=0; $j < sizeof($sites); $j++)
                {
                    $forests[$i]['sites'][$j]['activities']= $this->model->read_site_act($sites[$j]['site_id']);
                }*/
                $activities = $this->model->read_forest_act($forests[$i]["id"]);
                $forests[$i]['activities'] = $activities;
            }
        }
        echo json_encode($forests, JSON_PRETTY_PRINT);
    }

    //digunakan
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
            $sites[$i]["description"] = $this->record[$i]["site_description"];
            $sites[$i]["desc_link"] = $this->record[$i]["website"];
            $sites[$i]["distance"] = intval($site_distance);
        }
        echo json_encode($sites, JSON_PRETTY_PRINT);
    }

    //digunakan
    public function get_max_distances()
    {
        $this->record = $this->model->read_forest();
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

    //digunakan
    public function get_activities()
    {
        $this->record = $this->model->read_activity();
        for ($i=0; $i < sizeof($this->record); $i++)
        {
            $activity[$i]["activity_id"] = $this->record[$i]["activity_id"];
            $activity[$i]["activity_name"] = $this->record[$i]["activity_name"];
        }
        echo json_encode($activity, JSON_PRETTY_PRINT);
    }
}
