<?php
/**
 * Created by PhpStorm.
 * User: gusis
 * Date: 4/13/2016
 * Time: 4:02 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

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
        /*if(!$this->input->is_cli_request())
        {
            //echo "accessible only from command line";
            //reject if the request is not from cli
            return;
        }
        echo "Hello world!" . '<br />';//PHP_EOL;
        for ($i = 0; $i < 10; $i++)
        {
            print date('H:i:s') . '<br />';
            sleep(1);
        }*/
        $this->record = $this->model->read();
        $appID = "bc57a5521a9424bb94bd5f16cb57c281";

        for ($i=0; $i < sizeof($this->record); $i++)
        {
            $url = "http://api.openweathermap.org/data/2.5/weather?" .
                "lat=" . floatval($this->record[$i]["latitude"]) . "&lon=" . floatval($this->record[$i]["longitude"]) .
                "&appid=" . $appID;

            $response = file_get_contents($url);
            $jsonobj = json_decode($response);
            print_r($jsonobj);
            echo "<hr />";
            sleep(1); //delay 2 seconds for each request
        }
    }
}