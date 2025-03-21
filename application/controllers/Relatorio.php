<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Relatorio extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model', 'login');
        $this->login->logged();
        $this->login->logged();
        $this->load->model('produto_model', 'produtos');
    }

    public function relatorioMensal()
    {


        $config = array(
            array(
                'field' => 'ano',
                'label' => 'ANO',
                'rules' => 'trim|required|validarAno'
            ),
            array(
                'field' => 'selMes',
                'label' => 'Mês',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'selProduto',
                'label' => 'Nome do Produto',
                'rules' => 'trim|required'
            ),
        );


        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div><p class="text-danger">', '</p></div>');

        if ($this->form_validation->run() == false) {


            $produtos = $this->produtos->listagemGeral();

            $this->load->view('template/html.php');
            $this->load->view('template/header.php');
            $this->load->view('template/navbar.php');
            $this->load->view('template/principal.php');
            $this->load->view('relatorio/requisitos.php', array('produtos' => $produtos));
            $this->load->view('template/footer.php');
        } else {
            $this->load->view('template/html.php');
            $this->load->view('template/header.php');
            $this->load->view('template/navbar.php');
            $this->load->view('template/principal.php');


            $ano = $this->input->post('ano');
            $mes = $this->data->nomeMes($this->input->post('selMes'));
            $produto = $this->input->post('selProduto');
            $nomeProduto = $this->produtos->obterNome($produto);
            $total = array();
            $cont = 0;


            for ($dia = 1; $dia <= 31; $dia++) {
                $dados[$mes][$dia] = $this->produtos->apuracaoDadosMes($ano, $this->input->post('selMes'), $dia, 1, $produto);
                $cont += $dados[$mes][$dia];
            }

            $total[$mes] = $cont;

            $this->load->view('relatorio/historico_mensal.php', array("dados" => $dados, "nomeProduto" => strtoupper($nomeProduto), "mes" => $mes, "ano" => $ano, "total" => $total, "dia" => $dia));
            $this->load->view('template/footer.php');
        }
    }

    public function relatorioAnual()
    {


        $config = array(
            array(
                'field' => 'ano',
                'label' => 'ANO',
                'rules' => 'trim|required|validarAno'
            ),
            array(
                'field' => 'selProduto',
                'label' => 'Nome do Produto',
                'rules' => 'trim|required'
            ),
        );


        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div><p class="text-danger">', '</p></div>');

        if ($this->form_validation->run() == false) {


            $produtos = $this->produtos->listagemGeral();

            $this->load->view('template/html.php');
            $this->load->view('template/header.php');
            $this->load->view('template/navbar.php');
            $this->load->view('template/principal.php');
            $this->load->view('relatorio/requisitos_anual.php', array('produtos' => $produtos));
            $this->load->view('template/footer.php');
        } else {
            $this->load->view('template/html.php');
            $this->load->view('template/header.php');
            $this->load->view('template/navbar.php');
            $this->load->view('template/principal.php');


            $ano = $this->input->post('ano');
            $produto = $this->input->post('selProduto');
            $nomeProduto = $this->produtos->obterNome($produto);
            $total = array();
            $geral = 0;

            for ($m = 1; $m <= 12; $m++) {
                $cont = 0;
                $mes = $this->data->nomeMes($m);
                for ($dia = 1; $dia <= 31; $dia++) {
                    $dados[$mes][$dia] = $this->produtos->apuracaoDadosMes($ano, $m, $dia, 1, $produto);
                    $cont += $dados[$mes][$dia];
                }

                $total[$mes] = $cont;
                $geral += $cont;
            }

            $mes = array("", "Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");

            $this->load->view('relatorio/historico_anual.php', array("dados" => $dados,
                "nomeProduto" => strtoupper($nomeProduto), "mes" => $mes, "ano" => $ano, "total" => $total, "dia" => $dia,"geral"=>$geral));
            $this->load->view('template/footer.php');
        }
    }


    public function historicoEntidades() {


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
            $this->load->view('relatorio/filtro_relatorio_entidades.php');
            $this->load->view('template/footer.php');
        } else {

            $datas = array(
                "peridoInicial" => $this->input->post('peridoInicial'),
                "peridoFinal" => $this->input->post('peridoFinal')
            );

            $this->load->model('datas_model', 'datas');
            $dataFiltro = $this->datas->preparaCondicaoDatas($datas['peridoInicial'], $datas['peridoFinal'], ' s.data_saida');
            $query = $this->produtos->historicoRetiradasEntidades($dataFiltro);
            $this->load->model('usuario_model', 'usuario');
            $dados = $this->usuario->formataDadosHistoricoEntidades($query);

            $this->load->view('template/html.php');
            $this->load->view('template/header.php');
            $this->load->view('template/navbar.php');
            $this->load->view('template/principal.php');
            $this->load->view('relatorio/historico_retiradas_entidades.php',array("historico" => $dados, "dataI"=>$datas['peridoInicial'],"dataF"=>$datas['peridoFinal']));
            $this->load->view('template/footer.php');
        }
    }
}
