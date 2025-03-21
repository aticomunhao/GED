<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Voluntario extends CI_Controller {

    public function __construct() {
        parent::__construct();
         
        $this->load->model('login_model', 'login');
        $this->login->logged();
        $this->load->model('voluntario_model', 'voluntario');
        $this->load->model('perfil_model', 'perfil');
    }

    public function listar() {
        
      

        $this->load->view('template/html.php');
        $this->load->view('template/header.php');
        $this->load->view('template/navbar.php');
        $this->load->view('template/principal.php');
        #$perfis = $this->perfil->listarPerfis();
        $this->load->view('voluntarios/listar.php');
        $this->load->view('template/footer.php');
    }

    public function inserir() {

        $this->load->view('template/html.php');
        $this->load->view('template/header.php');
        $this->load->view('template/navbar.php');
        $this->load->view('template/principal.php');
        $perfis = $this->perfil->listarPerfis();
        $this->load->view('voluntarios/inserir.php',array('perfis'=>$perfis));
        $this->load->view('template/footer.php');
    }

    public function cadastrar() {

        $config = array(
            array(
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'trim|required|min_length[5]'
            ),
            array(
                'field' => 'cpf',
                'label' => 'cpf',
                'rules' => 'required|validaCPFCNPJ'
            ),
            array(
                'field' => 'selPefil',
                'label' => 'Perfil',
                'rules' => 'required'
            ) 
        );


        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div><p class="text-danger">', '</p></div>');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/html.php');
            $this->load->view('template/header.php');
            $this->load->view('template/navbar.php');
            $this->load->view('template/principal.php');
            $perfis = $this->perfil->listarPerfis();
            $this->load->view('voluntarios/inserir.php',array('perfis'=>$perfis));
            $this->load->view('template/footer.php');
        } else {

            $nome = $this->input->post('nome');
            $cpf = preg_replace("/[^0-9]/", "", htmlentities($this->input->post('cpf'), ENT_QUOTES));
            $selPefil = $this->input->post('selPefil');
            $retorno = $this->voluntario->inserir($nome, $cpf, $selPefil);
            $this->load->model('mensagens_model', 'mensagens');
            $this->mensagens->defineMesagens($retorno);

            redirect('voluntario/listar');
        }
    }

    
      public function editar($id) {

        $config = array(
            array(
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'trim|required|min_length[5]'
            ),
            array(
                'field' => 'cpf',
                'label' => 'cpf',
                'rules' => 'required|validaCPFCNPJ'
            ),
            array(
                'field' => 'selPefil',
                'label' => 'Perfil',
                'rules' => 'trim|required'
            ) 
        );


        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div><p class="text-danger">', '</p></div>');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/html.php');
            $this->load->view('template/header.php');
            $this->load->view('template/navbar.php');
            $this->load->view('template/principal.php');
            $query = $this->voluntario->buscarVoluntarioPorId($id);
            $perfis = $this->perfil->listarPerfis();
            
            $this->load->view('voluntarios/editar.php',array("voluntario" =>$query->row(), 'perfis'=>$perfis));
            $this->load->view('template/footer.php');
        } else {

            
            $nome = $this->input->post('nome');
            $cpf = preg_replace("/[^0-9]/", "", htmlentities($this->input->post('cpf'), ENT_QUOTES));
            $selPefil = $this->input->post('selPefil');
            $retorno = $this->voluntario->atualizar($nome, $cpf, $selPefil,$id);

            

            $this->load->model('mensagens_model', 'mensagens');
            $this->mensagens->defineMesagens($retorno);

            redirect('voluntario/listar');
        }
    }
    
    public function deletar() {

        try {

            if (!$this->session->userdata('tipoVoluntario') == 1) {
                echo json_encode(array(
                    'error' => true,
                    'message' => "Ação não autorizada"
                        ), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
                die;
            }
            
            $valor = json_decode($this->input->post('voluntario'));
            $retorno = $this->voluntario->desativarVoluntario($valor->id);


            if ($retorno) {
                echo json_encode(array(
                    'error' => false,
                    'id' => $valor->id
                        ), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);

                die;
            } else {
                throw new Exception("Erro ao deletar");
            }
        } catch (Exception $exc) {
            echo json_encode(array(
                'error' => true,
                'message' => $exc->getMessage()
                    ), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
            die;
        }
    }
    
    

}
