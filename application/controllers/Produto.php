<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Produto extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model', 'login');
        $this->login->logged();
        $this->load->model('produto_model', 'produto');
    }

    public function listar() {
        
      

        $this->load->view('template/html.php');
        $this->load->view('template/header.php');
        $this->load->view('template/navbar.php');
        $this->load->view('template/principal.php');

        $this->load->view('produtos/listar.php');
        $this->load->view('template/footer.php');
    }

    public function inserir() {

        $this->load->view('template/html.php');
        $this->load->view('template/header.php');
        $this->load->view('template/navbar.php');
        $this->load->view('template/principal.php');

        $this->load->view('produtos/inserir.php');
        $this->load->view('template/footer.php');
    }

    public function cadastrar() {

        $config = array(
            array(
                'field' => 'nomeProduto',
                'label' => 'Nome do Produto',
                'rules' => 'trim|required|min_length[5]'
            ),
            array(
                'field' => 'minimo',
                'label' => 'Quantidade mínima',
                'rules' => 'trim|required|integer'
            ),
            array(
                'field' => 'maximo',
                'label' => 'Quantidade máxima',
                'rules' => 'trim|required|integer'
            ),
            array(
                'field' => 'obs',
                'label' => 'Observações',
                'rules' => 'encode_php_tags'
            )
        );


        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div><p class="text-danger">', '</p></div>');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/html.php');
            $this->load->view('template/header.php');
            $this->load->view('template/navbar.php');
            $this->load->view('template/principal.php');

            $this->load->view('produtos/inserir.php');
            $this->load->view('template/footer.php');
        } else {

            $nome = $this->input->post('nomeProduto');
            $minimo = $this->input->post('minimo');
            $maximo = $this->input->post('maximo');
            $obs = $this->input->post('obs');


            $retorno = $this->produto->inserir($nome, $minimo, $maximo, $obs);



            $this->load->model('mensagens_model', 'mensagens');
            $this->mensagens->defineMesagens($retorno);

            redirect('produto/listar');
        }
    }

    
      public function editar($id) {

        $config = array(
            array(
                'field' => 'nomeProduto',
                'label' => 'Nome do Produto',
                'rules' => 'trim|required|min_length[5]'
            ),
            array(
                'field' => 'minimo',
                'label' => 'Quantidade mínima',
                'rules' => 'trim|required|integer'
            ),
            array(
                'field' => 'maximo',
                'label' => 'Quantidade máxima',
                'rules' => 'trim|required|integer'
            ),
            array(
                'field' => 'obs',
                'label' => 'Observações',
                'rules' => 'encode_php_tags'
            )
        );


        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div><p class="text-danger">', '</p></div>');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/html.php');
            $this->load->view('template/header.php');
            $this->load->view('template/navbar.php');
            $this->load->view('template/principal.php');
            $query = $this->produto->buscarProdutoPorId($id);
           
            $this->load->view('produtos/editar.php',array("produto" =>$query->row()));
            $this->load->view('template/footer.php');
        } else {

            $nome = $this->input->post('nomeProduto');
            $minimo = $this->input->post('minimo');
            $maximo = $this->input->post('maximo');
            $obs = $this->input->post('obs');


            $retorno = $this->produto->atualizar($nome, $minimo, $maximo, $obs,$id);



            $this->load->model('mensagens_model', 'mensagens');
            $this->mensagens->defineMesagens($retorno);

            redirect('produto/listar');
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
            
            $valor = json_decode($this->input->post('produto'));
            $retorno = $this->produto->desativarProduto($valor->id);


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
    
    
    
    public function relacionar() {
        
        
        $query = $this->produto->listagem();
         
        return json_encode($query->result());
    }

}
