<?php

 
class Perfil_model extends CI_Model {

    public function __construct() {
        try {
            parent::__construct();
        } catch (Exception $e) {
            $this->session->set_flashdata('erro', 'Erro acessar base de dados');
            log_message('debug', ' Erro ao carregar model perfil ' . $e);
            redirect(base_url());
        }
    }
    
    public function listarPerfis() {
         return $this->db->query("SELECT * FROM  tipo_voluntarios where status = 'A' order by descricao  ASC");
    }
 
}
