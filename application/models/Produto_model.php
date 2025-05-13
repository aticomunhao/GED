<?php

/**
 *
 *
 * @author Israel Eduardo Zebulon Martins de Souza 02/2016
 */
class Produto_model extends CI_Model
{

    public function __construct()
    {
        try {
            parent::__construct();
            $this->load->model('datas_model', 'data');
        } catch (Exception $e) {
            $this->session->set_flashdata('erro', 'Erro acessar base de dados');
            log_message('debug', ' Erro ao cadastrar produto ' . $e);
            redirect(base_url());
        }
    }

    public function inserir($nome, $minimo, $maximo, $obs)
    {
        $dados = array(
            "nome" => $nome,
            "estoque_minimo" => $minimo,
            "estoque_maximo" => $maximo,
            "descricao" => $obs,
            "id_voluntario_cadastro" => $this->session->userdata('id'),
            "data_cadastro" => $this->data->obterDateTime()
        );

        $this->db->trans_start();
        $this->db->insert('produto', $dados);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('debug', "Erro ao cadastrar produto $nome");
            return 4;
        }

        return 5;
    }

    public function desativarProduto($id)
    {

        try {

            $dados = array(
                'status' => 'I',
                'id_voluntario_cadastro' => $this->session->userdata('id'),
                "data_cadastro" => $this->data->obterDateTime()
            );

            $this->db->trans_start();
            $this->db->where('id', $id);
            $this->db->update('produto', $dados);
            $retorno = $this->db->affected_rows();
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                log_message('debug', ' Erro ao excluir produto ' . $id);
            }
            return $retorno;
        } catch (Exception $e) {
            $this->session->set_flashdata('erro', 'Erro ao Excluir produto');
            log_message('debug', ' Erro ao excluir produto ' . $e);
            redirect('produto/listar');
        }
    }

    public function listagem()
    {
        return $this->db->query("SELECT * FROM  produto where status = 'A' order by nome ASC");
    }

    public function listagemGeral()
    {
        return $this->db->query("SELECT * FROM  produto  order by nome ASC");
    }

    public function listagemDisponiveis()
    {
        return $this->db->query("SELECT p.id as id , p.nome as nome from  produto as p inner join estoque as e on
                                p.id = e.id_produto where p.status = 'A'  and e.qtde > 0 order by p.nome ASC;
                                ");
    }

    public function buscarProdutoPorId($id)
    {
        return $this->db->query("SELECT id,status, nome, estoque_minimo as minimo, "
            . "estoque_maximo as maximo, descricao as obs FROM  produto where id=$id");
    }

    public function atualizar($nome, $minimo, $maximo, $obs, $id)
    {
        $dados = array(
            "nome" => $nome,
            "estoque_minimo" => $minimo,
            "estoque_maximo" => $maximo,
            "descricao" => $obs,
            "id_voluntario_cadastro" => $this->session->userdata('id'),
            "data_cadastro" => $this->data->obterDateTime()
        );

        if ($this->session->userdata('tipoVoluntario') != 1) {
            return 7;
        } else {
            $this->db->trans_start();
            $this->db->where('id', $id);
            $this->db->update('produto', $dados);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                log_message('debug', "Erro ao cadastrar produto $nome");
                return 7;
            }
        }


        return 6;
    }


    public function obterNome($id)
    {
        $query = $this->db->query("SELECT nome FROM  produto where id = $id");
        $row = $query->row();
        return $row->nome;
    }

    public function apuracaoDadosMes($ano, $mes, $dia, $retirada, $produto)
    {

        $query = $this->db->query("select f_DadosRelatorio($ano,$mes,$dia,$retirada,$produto) as qtde;");
        return $query->row()->qtde;
    }


    public function historicoRetiradasEntidades($datas)
    {
        return $this->db->query("SELECT sum(qtde) as qtde , p.nome as produto, u.nome as nome ,u.cpf as identificador
                                    FROM
                                        saida_produto AS s
                                            INNER JOIN
                                        produto AS p ON s.id_produto = p.id
                                            INNER JOIN
                                        usuarios AS u ON s.id_usuario = u.id
                                    WHERE

                                         s.tipo_retirada = 1
                                         and
                                         LENGTH(u.cpf)>11
                                         $datas
                                    group by s.id_produto,s.id_usuario
                                    order by u.nome ASC");
    }

}
