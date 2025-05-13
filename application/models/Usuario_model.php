<?php

/**
 *   
 *
 * @author Israel Eduardo Zebulon Martins de Souza 02/2016
 */
class Usuario_model extends CI_Model {

    public function __construct() {
        try {
            parent::__construct();
             $this->load->model('datas_model', 'data');
        } catch (Exception $e) {
            $this->session->set_flashdata('erro', 'Erro acessar base de dados');
            log_message('debug', ' Erro ao cadastrar voluntario ' . $e);
            redirect(base_url());
        }
    }

    public function bolChecaCpfCadastrado($cpf, $requisicao = NULL, $id = NULL) {
        try {
            $str = NULL;
            if ($id) {
                $str = " and id != $id";
            }
            $query = $this->db->query(" 
                SELECT * from usuarios where cpf = '$cpf'
                 and status = 'A' $str limit 1");

            if ($requisicao) {
                if ($query->num_rows() > 0) {
                    echo json_encode([
                        'existe' => false,
                        'data' => TRUE
                    ]);
                } else {
                    echo json_encode([
                        'existe' => false
                    ]);
                }
            } else {
                if ($query->num_rows() > 0) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        } catch (Exception $e) {
            log_message('debug', ' Erro em bolChecaCpfCadastrado ' . $e);
            $this->session->set_flashdata('erro', 'Erro ao verificar existência'
                    . 'do cpf -  Contate Suporte');
            redirect('usuarios/listar/');
        }
    }

    public function inserir($nome, $cpf, $selCidade,$telefone,$nomeResponsavel) {

        if ($this->bolChecaCpfCadastrado($cpf, NULL)) {
            return 8;
        }
        $dados = array(
            "nome" => $nome,
            "cpf" => $cpf,
            "cod_cidades" => $selCidade,
            "telefone" => $telefone,
            "id_voluntario_cadastro" => $this->session->userdata('id'),
            "data_cadastro" => $this->data->obterDateTime(),
            "responsavel" => $nomeResponsavel
        );

        $this->db->trans_start();
        $this->db->insert('usuarios', $dados);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('debug', "Erro ao cadastrar usuario $nome");
            return 4;
        }

        return 5;
    }

    public function desativarUsuario($id) {

        try {

            $dados = array(
                'status' => 'I',
                'id_voluntario_cadastro' => $this->session->userdata('id')
            );

            $this->db->trans_start();
            $this->db->where('id', $id);
            $this->db->update('usuarios', $dados);
            $retorno = $this->db->affected_rows();

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                log_message('debug', ' Erro ao excluir usuario ' . $id);
            }
            return $retorno;
        } catch (Exception $e) {
            $this->session->set_flashdata('erro', 'Erro ao Excluir usuario');
            log_message('debug', ' Erro ao excluir usuario ' . $e);
            redirect('usuario/listar');
        }
    }

    public function listagem() {
        return $this->db->query("SELECT * FROM  v_usuarios  order by nome ASC");
    }

    public function buscarUsuarioPorId($id) {
        return $this->db->query("SELECT *  FROM  v_usuarios where id=$id");
    }

    public function atualizar($nome, $cpf, $selCidade,$telefone,$id,$nomeResponsavel) {

        if ($this->bolChecaCpfCadastrado($cpf, NULL, $id)) {
            return 8;
        }
        $dados = array(
            "nome" => $nome,
            "cpf" => $cpf,
            "cod_cidades" => $selCidade,
            "telefone" => $telefone,
            "id_voluntario_cadastro" => $this->session->userdata('id'),
            "responsavel" => $nomeResponsavel
        );

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('usuarios', $dados);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            log_message('debug', "Erro ao editar usuario $nome");
            return 4;
        }

        return 5;
    }

    public function listarEstados() {

        return $this->db->query("select cod_estados as id, sigla
 from estados  order by sigla ASC");
    }
    
    public function obterNome($id) {
        $query =  $this->db->query("SELECT nome FROM  usuarios where id = $id");
        $row = $query->row();
        return $row->nome;
    }

    public function listarCidades($id, $respostaAjax) {

        try {
            $str = NULL;
            if ($id) {
                $str = " and estados_cod_estados = $id ";
            }else{
                $str = " and 1=2"; //apenas para forçar devolver obj vazio
            }

            $cidades = $this->db->query(
                    " SELECT 
                            cod_cidades AS id, nome
                        FROM
                            cidades
                        WHERE
                            1 = 1 $str
                        ORDER BY nome ASC"
            );
             

            if ($respostaAjax) {
                $data = array();
                 
                foreach ($cidades->result() as $row) {
                    $cidades = array("id" => $row->id, "nome" => $row->nome);
                    array_push($data, $cidades);
                }
                echo json_encode([
                    'erro' => false,
                    'data' => $data
                ]);
            } else {
                return $cidades;
            }
        } catch (Exception $e) {
            log_message('debug', ' Erro ao carregar função listarcidades ' . $e);
            $this->session->set_flashdata('erro', 'Erro ao carregar dados -  Contate Suporte');
            redirect('usuario/listar/');
        }
    }

    public function burcarIdPorCpf($cpf) {
        return $this->db->query("SELECT nome,id  FROM  v_usuarios where cpf='$cpf' limit 1");
    }
    
    public function historico($id) {
         return $this->db->query("SELECT * FROM  saida_produto where id_usuario='$id' ORDER BY data_saida DESC");
    }
    
    public function formataDadosHistorico($query) {
        $this->load->model('produto_model', 'produto');
        $this->load->model('voluntario_model', 'voluntario');

        $dados = array();
        foreach ($query->result() as $row) {
            
            $data = new DateTime($row->data_saida);
            array_push($dados, array(
                "nomeProduto" => strtoupper($this->produto->obterNome($row->id_produto)),
                "quantidade" => $row->qtde,
                "obs" => $row->observacao,
                "nomeVoluntario" => strtoupper($this->voluntario->obterNome($row->id_voluntario_cadastro)),
                "data" => $data->format("d/m/Y h:i:s"),
                "nomeUsuario" => $this->obterNome($row->id_usuario)
                    )
            );
        }
        
        return $dados;
    }


    function Mask($mask, $str) {

        $str = str_replace(" ", "", $str);

        for ($i = 0; $i < strlen($str); $i++) {
            $mask[strpos($mask, "#")] = $str[$i];
        }

        return $mask;
    }


    public function formataDadosHistoricoEntidades($query) {

        $dados = array();
        foreach ($query->result() as $row) {

             array_push($dados, array(
                    "nomeProduto" => strtoupper($row->produto),
                    "quantidade" => $row->qtde,
                    "nomeEntidade" => strtoupper($row->nome),
                    "identificador" =>  $this->Mask("##.###.###/####-##", $row->identificador)
                )
            );
        }

        return $dados;
    }

}
