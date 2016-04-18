<?php
/**
 * Created by PhpStorm.
 * User: gusis
 * Date: 4/13/2016
 * Time: 4:02 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {
    public function greet($name)
    {
        if(!$this->input->is_cli_request())
        {
            echo "accessible only from command line";
            return;
        }
        echo "Hello, $name" . PHP_EOL;
    }
}