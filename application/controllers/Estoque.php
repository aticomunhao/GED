<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Estoque extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model', 'login');
        $this->login->logged();
        $this->load->model('estoque_model', 'estoque');
        $this->load->model('mensagens_model', 'mensagens');
    }

    public function listar() {

        $this->load->view('template/html.php');
        $this->load->view('template/header.php');
        $this->load->view('template/navbar.php');
        $this->load->view('template/principal.php');
        $this->load->view('estoques/listar.php');
        $this->load->view('template/footer.php');
    }

    public function adicionar() {

        $config = array(
            array(
                'field' => 'selProduto',
                'label' => 'Nome do Produto',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'quantidade',
                'label' => 'Quantidade',
                'rules' => 'trim|required|greater_than[0]'
            )
        );


        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div><p class="text-danger">', '</p></div>');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/html.php');
            $this->load->view('template/header.php');
            $this->load->view('template/navbar.php');
            $this->load->view('template/principal.php');
            $this->load->model('produto_model', 'produtos');
            $produtos = $this->produtos->listagem();

            $this->load->view('estoques/inserir.php', array('produtos' => $produtos));
            $this->load->view('template/footer.php');
        } else {

            $idProduto = $this->input->post('selProduto');
            $quantidade = $this->input->post('quantidade');
            $obs = $this->input->post('obs');
            $retorno = $this->estoque->inserir($idProduto, $quantidade, $obs);

            $this->load->model('mensagens_model', 'mensagens');
            $this->mensagens->defineMesagens($retorno);

            redirect('estoque/listar');
        }
    }

    public function retirada() {

        $config = array(
            array(
                'field' => 'selProduto',
                'label' => 'Nome do Produto',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'quantidadeR',
                'label' => 'Quantidade',
                'rules' => 'trim|required|greater_than[0]'
            ),
            array(
                'field' => 'cpfcnpjRetirada',
                'label' => 'CPF/CNPJ do Usuário',
                'rules' => 'required|validaCPFCNPJ'
            )
        );


        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div><p class="text-danger">', '</p></div>');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/html.php');
            $this->load->view('template/header.php');
            $this->load->view('template/navbar.php');
            $this->load->view('template/principal.php');

            $this->load->model('produto_model', 'produtos');
            $produtos = $this->produtos->listagemDisponiveis();

            $this->load->view('estoques/retirada.php', array('produtos' => $produtos));

             $this->load->view('template/footer.php');
        } else {

            $idProduto = $this->input->post('selProduto');
            $quantidade = $this->input->post('quantidadeR');
            $obs = $this->input->post('obs');
            $idUsuario = $this->input->post('identUsuario');

            $this->load->model('produto_model', 'produto');
            $quantidadeDisponivel = $this->estoque->checaQuantidadeProdutoDisponivel($idProduto);

            if ($quantidade > $quantidadeDisponivel) {
                $retorno = 14;
                $this->mensagens->defineMesagens($retorno);
                redirect('sistema/inicio');
            } else {
                
                $this->load->model('datas_model', 'data');
                $data_hora = $this->data->obterDateTime();
                
                $retorno = $this->estoque->inserirRetirada($idProduto, $quantidade, $obs, $idUsuario,$data_hora);
                $this->load->view('template/html.php');
                $this->load->view('template/header.php');
                $this->load->view('template/navbar.php');
                $this->load->view('template/principal.php');

                $this->load->model('produto_model', 'produto');
                $this->load->model('usuario_model', 'usuario');

                $nomeProduto = $this->produto->obterNome($idProduto);
                $nomeUsuario = $this->usuario->obterNome($idUsuario);
                
                $dataImpressao = date_create($data_hora);
                  
                $this->mensagens->defineMesagens($retorno);
                $this->load->view('estoques/comprovante.php', array("nomeUsuario" => $nomeUsuario,
                    "nomeProduto" => $nomeProduto,
                    "quantidade" => $quantidade,
                    "data_hora" => date_format($dataImpressao, 'Y-m-d h:i:s'),
                    "obs" => $obs)
                );
                $this->load->view('template/footer.php');
            }
        }
    }

    public function demonstrativo() {
        $this->load->view('template/html.php');
        $this->load->view('template/header.php');
        $this->load->view('template/navbar.php');
        $this->load->view('template/principal.php');
        $query = $this->estoque->listar();

        $this->load->view('estoques/demonstrativo.php', array('estoque' => $query));
        $this->load->view('template/footer.php');
    }

    public function pesquisa() {


        $config = array(
            array(
                'field' => 'peridoInicial',
                'label' => 'Inicio',
                'rules' => 'trim|valid_date'
            ),
            array(
                'field' => 'peridoFinal',
                'label' => 'Fim',
                'rules' => 'trim|valid_date'
            )
        );


        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div><p class="text-danger">', '</p></div>');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/html.php');
            $this->load->view('template/header.php');
            $this->load->view('template/navbar.php');
            $this->load->view('template/principal.php');
            $this->load->view('estoques/filtroRelatorio.php');
            $this->load->view('template/footer.php');
        } else {

            $datas = array(
                "peridoInicial" => $this->input->post('peridoInicial'),
                "peridoFinal" => $this->input->post('peridoFinal')
            );
            
            $this->load->model('datas_model', 'datas');
            $dataFiltro = $this->datas->preparaCondicaoDatas($datas['peridoInicial'], $datas['peridoFinal'], ' data_saida');
            $query = $this->estoque->historicoRetiradas($dataFiltro);
            $this->load->model('usuario_model', 'usuario');
            $dados = $this->usuario->formataDadosHistorico($query);
 
            $this->load->view('template/html.php');
            $this->load->view('template/header.php');
            $this->load->view('template/navbar.php');
            $this->load->view('template/principal.php');
            $this->load->view('estoques/historico_retiradas.php',array("historico" => $dados));
            $this->load->view('template/footer.php');
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

            $valor = json_decode($this->input->post('estoque'));

            $this->load->model('datas_model', 'data');

            $data_hora = $this->data->obterDateTime();
            //Colocar no campo antes da variavel $data_hora, o número do usuario desativado do sistema
            //para os casos de remocao do item do estoqe por um adminitrador
                $retorno = $this->estoque->inserirRetirada($valor->id, $valor->qtde, 'Excluído pelo Administrador(a) ' . strtoupper($this->session->userdata('nome')),/* SUBSTITUIR ESSE VALOR PELO ID DO USUARIO*/ 2,$data_hora,2);


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
