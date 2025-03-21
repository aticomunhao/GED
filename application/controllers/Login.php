<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
         $this->load->model('login_model', 'login');
    }

    public function index() {
       
        add_css(array('bootstrap-material-design.css', 'ripples.css','login.css'));
        add_js(array('material.js','ripples.min.js', 'login_validacao.js'));
        $this->load->view('template/html.php', array('load_css' => put_css_headers(), 'load_js' => put_js_headers()));
        $this->load->view('logar');
        $this->load->view('template/footer.php');
    }

    public function logar() {
       
       
        $config = array(
            array(
                'field' => 'cpf',
                'label' => 'CPF',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required'
            )
        );

 
        $this->form_validation->set_rules($config);
        
       
        if ($this->form_validation->run() == FALSE) {
           
             redirect(base_url());
        } else {
             
            $voluntario = preg_replace("/[^0-9]/", "", htmlentities($this->input->post("cpf"), ENT_QUOTES));
            $senha = $this->input->post("password");
            
            $query = $this->login->obterDadosUsuario($voluntario);

            $this->load->model('mensagens_model','mensagens');

            if ($query->num_rows() > 0) {
   
                if ($this->login->isBValidSenha($senha, $query)) {
                    $this->login->gravaDadosNaSessao($voluntario, $query);
                    $this->login->gravarSenhaHashBanco($senha, $query);
                    
                    if($senha == "Brasilia604"){ 
                            //senha default senha padrão
                            //obriga alterar a senha e realizar novo login
                            //mudar tb no senha_model
                        \redirect(base_url('senha/alterar/' . $this->session->userdata('id')));
                    }else{
                        \redirect(base_url('sistema/inicio'));
                    }
                    
                    
                } else {
                    
                    $this->mensagens->defineMesagens(2);
                }
            } else {
                
                $this->mensagens->defineMesagens(1);
            }
  
            redirect(base_url());
        }
    }

    public function logout() {
        $this->load->model('login_model','login');
        $this->login->logout();
       
        redirect(base_url());
    }

}
