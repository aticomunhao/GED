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

    public function inserir($dataInsert) {

        if ($this->bolChecaCpfCadastrado($dataInsert['cpfcnpj'], NULL)) {
            return 8;
        }

        if ($dataInsert['passaporte']) {
            $dataInsert['cpfcnpj'] = null;
        }

        $dados = array(
            "nome" => $dataInsert['nome'],
            "cpf" => $dataInsert['cpfcnpj'],
            "passaporte" => $dataInsert['passaporte'],
            "cod_cidades" => $dataInsert['selCidade'],
            "telefone" => $dataInsert['telefone'],
            "id_voluntario_cadastro" => $this->session->userdata('id'),
            "data_cadastro" => $this->data->obterDateTime(),
            "responsavel" => $dataInsert['nomeResponsavel'],
            "observacoes" => $dataInsert['observacoes'],
            "cep" => $dataInsert['cep'],
            "endereco" => $dataInsert['endereco'],
            "bairro" => $dataInsert['bairro']
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

    public function buscarCidadePorId($id) {
        return $this->db->query("SELECT 
                                    c.nome, 
                                    e.sigla
                                FROM cidades c
                                JOIN estados e ON e.cod_estados = c.estados_cod_estados
                                where c.cod_cidades=$id");
    }

    public function buscarEstadoPorId($id) {
        return $this->db->query("SELECT 
                                    e.sigla
                                FROM estados e 
                                where e.cod_estados=$id");
    }

    public function atualizar($dataUpdate, $id) {

        if ($this->bolChecaCpfCadastrado($dataUpdate['cpfcnpj'], NULL, $id)) {
            return 8;
        }

        if ($dataUpdate['passaporte']) {
            $dataUpdate['cpfcnpj'] = null;
        }

        $dados = array(
            "nome" => $dataUpdate['nome'],
            "cpf" => $dataUpdate['cpfcnpj'],
            "passaporte" => $dataUpdate['passaporte'],
            "cod_cidades" => $dataUpdate['selCidade'],
            "telefone" => $dataUpdate['telefone'],
            "id_voluntario_cadastro" => $this->session->userdata('id'),
            "responsavel" => $dataUpdate['nomeResponsavel'],
            "observacoes" => $dataUpdate['observacoes'],
            "cep" => $dataUpdate['cep'],
            "endereco" => $dataUpdate['endereco'],
            "bairro" => $dataUpdate['bairro']
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
                "data" => $data->format("d/m/Y H:i:s"),
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

            $dataSaida = new DateTime($row->data_saida);

             array_push($dados, array(
                    "nomeProduto" => strtoupper($row->produto),
                    "quantidade" => $row->qtde,
                    "nomeEntidade" => strtoupper($row->nome),
                    "cidade" => $row->cidade . " - " . $row->estado,
                    "identificador" =>  $this->Mask("##.###.###/####-##", $row->identificador),
                    "dataSaida" => $dataSaida->format("d/m/Y")
                )
            );
        }

        return $dados;
    }

}
