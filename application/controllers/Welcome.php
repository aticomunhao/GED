<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

   
    public function index() {
        
        add_css(array('bootstrap-material-design.css', 'ripples.css','login.css'));
        add_js(array('material.js','ripples.min.js','CPF.js', 'login_validacao.js'));
        $this->load->view('template/html.php', array('load_css' => put_css_headers(), 'load_js' => put_js_headers()));
        $this->load->view('logar');
        $this->load->view('template/footer.php');
    }

}
