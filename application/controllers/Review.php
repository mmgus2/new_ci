<?php
/**
 * Created by PhpStorm.
 * User: gusis
 * Date: 4/25/2016
 * Time: 12:37 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {
    public function index()
    {
        $this->login();
    }

    public function login()
    {
        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('login-view');
        $this->load->view('footer');
    }

    public function signup(){
        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('signup-view');
        $this->load->view('footer');
    }

    public  function members()
    {
        if($this->session->userdata('is_logged_in')){
            $this->load->view('header');
            $this->load->view('menu');
            $this->load->view('members-view');
            $this->load->view('footer');
        } else {
            redirect(base_url().'Review/restricted');
        }
    }

    public function restricted(){
        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('restricted-view');
        $this->load->view('footer');
    }

    public function login_validation()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|trim|callback_validate_credentials');
        $this->form_validation->set_rules('password', 'Password', 'required|md5|trim');

        if($this->form_validation->run()){
            $data = array(
                'email' => $this->input->post('email'),
                'is_logged_in' => 1
            );
            $this->session->set_userdata($data);
            redirect(base_url().'Review/members');
            //$this->members();
        } else {
            $this->login();
        }
    }

    public function signup_validation(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');

        $this->form_validation->set_message('is_unique', "That email address already exists.");

        if($this->form_validation->run()){

            //generate a random key
            $key = md5(uniqid());

            //send an email to the user
            //$this->load->library('email', array('mailtype' => 'html')); //set email to html for registration link
            $this->load->library('email');

            $this->email->initialize(array(
                'protocol' => 'smtp',
                'smtp_host' => 'smtp.sendgrid.net',
                'smtp_user' => 'azure_575578cf162423c4d82b8168f0e4eaad@azure.com',
                'smtp_pass' => 'deltasolutions123+',
                'smtp_port' => 587,
                'crlf' => "\r\n",
                'newline' => "\r\n"
            ));

            $this->email->from('solutionsdelta1@gmail.com','Delta Solutions');
            $this->email->to($this->input->post('email'));
            $this->email->subject("Confirm your account at XploreForest!");

            $message = "<p>Thank you for signing up!</p>";
            $message .= "<p><a href='".base_url()."Review/register_user/$key'>Click here</a>" .
                " to confirm your account</p>";

            $this->email->message($message);

            if($this->email->send()){
                echo "The email has been sent!";
            }else{
                echo "Could not send the email.";
            }

            //add them to the temp_users db

        } else {
            $this->signup();
        }
    }

    public function validate_credentials()
    {
        $this->load->model('model_users');

        if($this->model_users->can_log_in()){
            return true;
        } else {
            $this->form_validation->set_message('validate_credentials', 'Incorrect username/password.');
            return false;
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url().'Review/login');
    }
}