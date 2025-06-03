<?php

/**
 *   
 *
 * @author Israel Eduardo Zebulon Martins de Souza 02/2016
 */
class Estoque_model extends CI_Model {

    public function __construct() {
        try {
            parent::__construct();
              $this->load->model('datas_model', 'data');
        } catch (Exception $e) {
            $this->session->set_flashdata('erro', 'Erro acessar base de dados');
            log_message('debug', ' Erro ao instanciar estoque ' . $e);
            redirect(base_url());
        }
    }

    public function inserir($idProduto,$quantidade,$obs) {
       
        $dados = array(
            "id_produto" => $idProduto,
            "qtde" => $quantidade,
            "id_ci_sessions" => $this->session->session_id,
            "observacao" => $obs,
            "id_voluntario_cadastro" => $this->session->userdata('id'),
            "data_entrada" => $this->data->obterDateTime()
        );

        $this->db->trans_start();
        $this->db->insert('entrada_produto', $dados);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('debug', "Erro ao cadastrar entrada_produtos $idProduto");
            return 4;
        }

        return 5;
    }

    public function desativarProduto($id) {

        try {

            $dados = array(
                'status' => 'I',
                'id_voluntario_cadastro' => $this->session->userdata('id'),
                'data_cadastro' => $this->data->obterDateTime()
            );

            $this->db->trans_start();
            $this->db->where('id', $id);
            $this->db->update('produtos', $dados);
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

    public function listagem() {
        return $this->db->query("SELECT * FROM  produtos where status = 'A' order by nome ASC");
    }

    public function buscarProdutoPorId($id) {
        return $this->db->query("SELECT id,status, nome, estoque_minimo as minimo, "
                        . "estoque_maximo as maximo, descricao as obs FROM  produtos where id=$id");
    }

    public function atualizar($nome, $minimo, $maximo, $obs, $id) {
        $dados = array(
            "nome" => $nome,
            "estoque_minimo" => $minimo,
            "estoque_maximo" => $maximo,
            "descricao" => $obs,
            "id_voluntario_cadastro" => $this->session->userdata('id'),
            'data_cadastro' => $this->data->obterDateTime()
        );

        if ($this->session->userdata('tipoVoluntario') != 1) {
            return 7;
        } else {
            $this->db->trans_start();
            $this->db->where('id', $id);
            $this->db->update('produtos', $dados);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                log_message('debug', "Erro ao cadastrar produto $nome");
                return 7;
            }
        }



        return 6;
    }
    
    public function inserirRetirada($idProduto,$quantidade,$obs,$idUsuario,$data,$tipoRetirada = 1) {

        $dados = array(
            "id_produto" => $idProduto,
            "qtde" => $quantidade,
            "id_usuario" => $idUsuario,
            "id_ci_sessions" => $this->session->session_id,
            "observacao" => $obs,
            "id_voluntario_cadastro" => $this->session->userdata('id'),
            "data_saida" => $data,
            "data_alteracao" => $data,
            "tipo_retirada" =>$tipoRetirada
        );

        $this->db->trans_start();

        $this->db->insert('saida_produto', $dados);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('debug', "Erro ao cadastrar entrada_produtos $idProduto");

            return 4;
        }

        return 15;
    
    }
    
    public function checaQuantidadeProdutoDisponivel($id) {
         $query = $this->db->query("SELECT qtde FROM  estoque where id_produto = $id");
         $row = $query->row();
         return $row->qtde;
    }
    
    public function listar() {
         return $this->db->query("SELECT * FROM  v_estoque ORDER BY nome ASC");
         
    }
    
     public function historicoRetiradas($condicao,$tipoRetirada=1) {
         return $this->db->query("SELECT * FROM  saida_produto where 1=1 and tipo_retirada = $tipoRetirada $condicao ORDER BY data_saida DESC");
    }

}
