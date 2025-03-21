<?php

/**
 *  Responsável pelas funções ligadas aos dados de usuários para CRUD usuário
 *
 * @author Israel Eduardo Zebulon Martins de Souza 12/2014
 */
class Senha_model extends CI_Model {

    public function __construct() {
        try {
            parent::__construct();
            $this->load->model('datas_model', 'data');
        } catch (Exception $e) {
            $this->session->set_flashdata('erro', 'Erro acessar base de dados');
            log_message('debug', ' Erro ao carregar model senha ' . $e);
            redirect(base_url());
        }
    }

    public function localizarSenhas($id) {
        $param = array(
            'id_voluntario' => $id,
            'status' => 'A'
        );


        $query = $this->db->get_where('voluntario_senhas', $param);
        foreach ($query->result() as $row) {
            $this->desativarSenhas($row->id);
        }
    }

    public function desativarSenhas($id) {
        $dados = array(
            'status' => 'I',
            'id_voluntario_alteracao' => $this->session->userdata('id'),
            'data_alteracao' => $this->data->obterDateTime()
        );

        $this->db->where('id', $id);
        $this->db->update('voluntario_senhas', $dados);
    }

    public function incluiSenha($id, $senha = "Brasilia604") {

        try {
            $this->localizarSenhas($id);
            $this->load->model('login_model', 'login');
            $salt = $this->login->gerarSalt();
            $senhaEncriptada = $this->login->gerarHash($senha, $salt);



            $dados = array(
                'id_voluntario' => $id,
                'senha' => $senhaEncriptada,
                'salt' => $salt,
                'id_voluntario_alteracao' => $this->session->userdata("id"),
                'data_alteracao' => $this->data->obterDateTime()
            );

            $this->db->trans_start();
            $this->db->insert('voluntario_senhas', $dados);
            $this->db->trans_complete();


            if ($this->db->trans_status() === FALSE) {
                log_message('debug', ' Erro ao persistir senha no banco ' . $id);
                return false;
            }
            
            return true;

             
        } catch (Exception $e) {
            
            echo json_encode(array(
                'error' => true,
                'message' => $exc->getMessage()
                    ), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
            die;
        }
    }

    public function inserir($senha, $id) {

        $retorno = $this->incluiSenha($id, $senha);

        if ($retorno) {
            return 11;
        }

        return 12;
        
    }

}
