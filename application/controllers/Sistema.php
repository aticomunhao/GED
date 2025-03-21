<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Sistema extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('login_model', 'login');
         $this->login->logged();
    }

     
    public function inicio() {
        
        $this->load->view('template/html.php');
        $this->load->view('template/header.php');
        $this->load->view('template/navbar.php');
        $this->load->view('template/principal.php');
        $this->load->view('telaInicial.php');
        $this->load->view('template/footer.php');
    }

}
