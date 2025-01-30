<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load URL helper
        $this->load->helper('url');
    }

    public function index() {
        $this->load->view('main_view');
    }
}
