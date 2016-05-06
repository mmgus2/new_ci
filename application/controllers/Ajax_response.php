<?php
/**
 * Created by PhpStorm.
 * User: gusis
 * Date: 5/6/2016
 * Time: 11:20 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_response extends CI_Controller {

    private $record = null;
    private $model = null;

    public function __construct(){
        parent::__construct();
        $this->load->model('Database_model');
        $this->model = $this->Forest_model;
        $this->load->helper('geodistance');
    }

    //get forest list based on activity and/or distance
    public function get_forest(){
        $max_distance = $this->input->get('distance');
        $unit = $this->input->get('unit');
        $init_lat = $this->input->get('latitude');
        $init_lon = $this->input->get('longitude');
        $act_array = $this->input->get('activity');
        $forest = NULL;
        if ($act_array == null || sizeof($act_array) == 0) {
            $this->record = $this->model->read_forest();
        }
        if (sizeof($act_array) > 0){
            $this->record = $this->model->read_forest($act_array);
        }
        for ($i = 0; $i < sizeof($this->record); $i++) {
            $forest_distance = distance(floatval($init_lat), floatval($init_lon),
                floatval($this->record[$i]["latitude"]), floatval($this->record[$i]["longitude"]), $unit);
            if ($forest_distance <= $max_distance) {
                $forest[$i]["id"] = $this->record[$i]["forest_id"];
                $forest[$i]["name"] = $this->record[$i]["forest_name"];
                $forest[$i]["latitude"] = floatval($this->record[$i]["latitude"]);
                $forest[$i]["longitude"] = floatval($this->record[$i]["longitude"]);
                $forest[$i]["description"] = $this->record[$i]["forest_description"];
                $forest[$i]["distance"] = intval($forest_distance);
                $forest[$i]["activity"] = $this->model->get_forest_act($forest[$i]["id"]);
            }
        }
        echo json_encode($forest, JSON_PRETTY_PRINT);
    }

    //get activity list based on specific forest ID
    protected function get_forest_act($forest_id)
    {
        $this->record = read_forest_act($forest_id);
        $activity = null;
        for ($i = 0; $i < sizeof($this->record); $i++) {
            $activity[$i]["id"] = $this->record[$i]["activity_id"];
            $activity[$i]["name"] = $this->record[$i]["activity_name"];
        }
        return $activity;
    }

    //get site list based on specific forest ID
    public function get_site(){
        $forest_id = $this->input->get('forest_id');
        $unit = $this->input->get('unit');
        $init_lat = $this->input->get('latitude');
        $init_lon = $this->input->get('longitude');
        $this->record = $this->model->read_site($forest_id);
        for ($i=0; $i < sizeof($this->record); $i++)
        {
            $site_distance = distance(floatval($init_lat), floatval($init_lon),
                floatval($this->record[$i]["latitude"]), floatval($this->record[$i]["longitude"]), $unit);
            $site[$i]["id"] = $this->record[$i]["site_id"];
            $site[$i]["name"] = $this->record[$i]["site_name"];
            $site[$i]["latitude"] = floatval($this->record[$i]["latitude"]);
            $site[$i]["longitude"] = floatval($this->record[$i]["longitude"]);
            $site[$i]["description"] = $this->record[$i]["site_description"];
            $site[$i]["desc_link"] = $this->record[$i]["website"];
            $site[$i]["distance"] = intval($site_distance);
            $site[$i]["activity"] = $this->model->get_site_act($site[$i]["site_id"]);
        }
        echo json_encode($site, JSON_PRETTY_PRINT);
    }

    //get activity list based on specific site ID
    protected function get_site_act($site_id)
    {
        $this->record = read_site_act($site_id);
        $activity = null;
        for ($i = 0; $i < sizeof($this->record); $i++) {
            $activity[$i]["id"] = $this->record[$i]["activity_id"];
            $activity[$i]["name"] = $this->record[$i]["activity_name"];
        }
        return $activity;
    }

    //get maximum distance
    public function get_max_distance()
    {
        $this->record = $this->model->read_forest();
        $init_lat = $this->input->get('latitude');
        $init_lon = $this->input->get('longitude');
        $unit = "" . $this->input->get('unit');
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

    //get all activity list
    public function get_all_activity()
    {
        $this->record = $this->model->read_activity();
        for ($i=0; $i < sizeof($this->record); $i++)
        {
            $activity[$i]["id"] = $this->record[$i]["activity_id"];
            $activity[$i]["name"] = $this->record[$i]["activity_name"];
        }
        echo json_encode($activity, JSON_PRETTY_PRINT);
    }
}