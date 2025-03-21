<?php

/**
 *   
 *
 * @author Israel Eduardo Zebulon Martins de Souza 02/2016
 */
class Voluntario_model extends CI_Model {

    public function __construct() {
        try {
            parent::__construct();
            $this->load->model('senha_model', 'senha');
        } catch (Exception $e) {
            $this->session->set_flashdata('erro', 'Erro acessar base de dados' );
            log_message('debug', ' Erro ao cadastrar voluntario ' . $e);
            redirect(base_url());
        }
    }

    public function bolChecaCpfCadastrado($cpf, $requisicao = NULL, $id=NULL) {
        try {
            $str = NULL;
            if($id){
                $str = " and id != $id";
            }
            $query = $this->db->query(" 
                SELECT * from voluntarios where cpf = '$cpf'
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
            redirect('voluntario/listar/');
        }
    }

    public function inserir($nome, $cpf, $selPefil) {

        if ($this->bolChecaCpfCadastrado($cpf, NULL)) {
            return 8;
        } else if($this->checaPerfilAdm()){
            $dados = array(
                "nome" => $nome,
                "cpf" => $cpf,
                "id_tipo_voluntario" => $selPefil,
                "id_voluntario_inclusao" => $this->session->userdata('id')
            );

            $this->db->trans_start();
            $this->db->insert('voluntarios', $dados);
            $id = $this->db->insert_id();

            $this->senha->incluiSenha($id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                log_message('debug', "Erro ao cadastrar voluntario $nome");
                return 4;
            }

            return 5;
        }else{
            return 9;
        }
    }

    public function desativarVoluntario($id) {

        try {

            $tempo = new DateTime();

            $dados = array(
                'status' => 'I',
                'data_exclusao' => $tempo->format("Y-m-d H:i:s"),
                'id_voluntario_exclusao' => $this->session->userdata('id')
            );

            $this->db->trans_start();
            $this->db->where('id', $id);
            $this->db->update('voluntarios', $dados);
            $retorno = $this->db->affected_rows();
 
            $this->senha->localizarSenhas($id);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                log_message('debug', ' Erro ao excluir produto ' . $id);
            }
            return $retorno;
        } catch (Exception $e) {
            $this->session->set_flashdata('erro', 'Erro ao Excluir produto');
            log_message('debug', ' Erro ao excluir voluntario ' . $e);
            redirect('produto/listar');
        }
    }

    public function listagem() {
        $str = NULL;
        if(!$this->checaPerfilAdm()){
            $str = "and id = ".  $this->session->userdata('id');
        }
        return $this->db->query("SELECT * FROM  voluntarios where status = 'A' $str order by nome ASC");
    }

    public function buscarVoluntarioPorId($id) {
        return $this->db->query("SELECT *  FROM  voluntarios where id=$id");
    }

    public function atualizar($nome, $cpf, $selPefil,$id) {

        if ($this->bolChecaCpfCadastrado($cpf, NULL,$id)) {
            return 8;
        } else if($this->checaPerfilAdm() || $this->session->userdata('id') == $id) {
            $dados = array(
                "nome" => $nome,
                "cpf" => $cpf,
                "id_tipo_voluntario" => $selPefil,
                "id_voluntario_inclusao" => $this->session->userdata('id')
            );

            $this->db->trans_start();
            $this->db->where('id', $id);
            $this->db->update('voluntarios', $dados);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                log_message('debug', "Erro ao editar voluntario $nome");
                return 4;
            }

            return 5;
        }else{
            return 9;
        }
    }

    public function checaPerfilAdm() {
        return $this->session->userdata('tipoVoluntario') == 1;
    }

    
    public function obterNome($id) {
        $query =  $this->db->query("SELECT nome FROM  voluntarios where id = $id");
        $row = $query->row();
        return $row->nome;
    }
}
