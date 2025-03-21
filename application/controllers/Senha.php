<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Senha extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model', 'login');
        $this->login->logged();
    }

    public function reinicializar() {

        try {

            if (!$this->session->userdata('tipoVoluntario') == 1) {
                echo json_encode(array(
                    'error' => true,
                    'message' => "Ação não autorizada"
                        ), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
                die;
            }

            $valor = json_decode($this->input->post('voluntario'));

            $this->load->model('senha_model', 'senha');
            $retorno = $this->senha->incluiSenha($valor->id);

            if ($retorno) {
                echo json_encode(array(
                    'error' => false,
                    'id' => $valor->id
                        ), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);

                die;
            } else {
                throw new Exception("Erro ao reinicializar");
            }
        } catch (Exception $exc) {
            echo json_encode(array(
                'error' => true,
                'message' => $exc->getMessage()
                    ), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
            die;
        }
    }

    public function alterar($id) {
        $this->load->view('template/html.php');
        $this->load->view('template/header.php');
        $this->load->view('template/navbar.php');
        $this->load->model('voluntario_model', 'voluntario');
        $query = $this->voluntario->buscarVoluntarioPorId($id);

        $this->load->view('senha/alterar.php', array("voluntario" => $query->row()));
        $this->load->view('template/footer.php');
    }

    public function cadastrar($id) {
        $config = array(
            array(
                'field' => 'password',
                'label' => 'Nova Senha',
                'rules' => 'trim|required|min_length[8]|validar_senha'
            ),
            array(
                'field' => 'confirmPassword',
                'label' => 'Redigite a senha',
                'rules' => 'trim|required|min_length[8]|validar_senha'
            )
        );


        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div><p class="text-danger">', '</p></div>');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/html.php');
            $this->load->view('template/header.php');
            $this->load->view('template/navbar.php');
            $this->load->model('voluntario_model', 'voluntario');
            $query = $this->voluntario->buscarVoluntarioPorId($id);
            $this->load->view('senha/alterar.php', array("voluntario" => $query->row()));
            $this->load->view('template/footer.php');
        } else {

            $senha = preg_replace("/[^a-zA-Z0-9]/", "", htmlentities($this->input->post("password"), ENT_QUOTES));
            $confirmasenha = preg_replace("/[^a-zA-Z0-9]/", "", htmlentities($this->input->post("confirmPassword"), ENT_QUOTES));
            $this->load->model('senha_model', 'senha');
            
            if($senha == $confirmasenha){
                 $retorno = $this->senha->inserir($senha,$id);
            }else{
                $retorno = 13;
            }
           
            $this->load->model('mensagens_model', 'mensagens');
            $this->mensagens->defineMesagens($retorno);

            \redirect('sistema/inicio');
        }
    }

}
