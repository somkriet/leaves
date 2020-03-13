<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
/**
* user
*/
class Testselect extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('login'))
        {
            redirect('login','refresh');
            exit();
        }
        else
        {
            $this->load->library("pagination");
            $this->load->model('user_model');
            $this->load->model('leave_model');
            $this->load->model('progression_model');
            $this->load->model('office_model');
            $this->load->model('acceptation_model');
            $this->load->model('position_model');
        }
    }
    function index()
    {
     
        $this->load->view('Testselect');

    }

}