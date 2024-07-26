<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{

    public function __construct() {

		parent::__construct();
		$this->load->helper(array('form', 'url', 'string'));
		$this->load->library(array('form_validation','session', 'upload', 'encryption', 'email'));
		$this->load->database();
                $this->load->model('upload_model'); 
                $this->load->model('User_model');
                $this->load->helper('download');
                $this->load->library('Google');


	}


}