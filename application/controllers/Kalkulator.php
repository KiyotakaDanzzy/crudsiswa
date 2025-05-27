<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kalkulator extends CI_Controller {
    public function index()
    {
        $this->load->view('page/header');
        $this->load->view('kalkulator/index');
        $this->load->view('page/footer');
    }
}
