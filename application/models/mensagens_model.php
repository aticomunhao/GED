<?php

/**
 *
 * @author Israel Eduardo Zebulon Martins de Souza 12/2014
 */
class Mensagens_model extends CI_Model {

    public function defineMesagens($retorno) {
        try {

            switch ($retorno) {
                case 1: {
                        $this->session->set_flashdata('erro', 'CPF não cadastrado');
                        break;
                    }
                case 2: {
                        $this->session->set_flashdata('erro', 'CPF ou Senha inválidos');
                        break;
                    }
                case 3: {
                        $this->session->set_flashdata('logado', 'Necessário realizar novo login');
                        break;
                    }
                case 4: {
                        $this->session->set_flashdata('erro', 'Erro ao Cadastrar, tente novamente');
                        break;
                    }
                case 5: {
                        $this->session->set_flashdata('acerto', 'Cadastrado com sucesso');
                        break;
                    }
                case 6: {
                        $this->session->set_flashdata('acerto', 'Atualização realizada com sucesso');
                        break;
                    }
                case 7: {
                        $this->session->set_flashdata('erro', 'Atualização não realizada');
                        break;
                    }
                case 8: {
                        $this->session->set_flashdata('erro', 'CPF/CNPJ já cadastrado');
                        break;
                    }
                case 9: {
                        $this->session->set_flashdata('erro', 'Ação não permitida');
                        break;
                    }
                case 10: {
                        $this->session->set_flashdata('acerto', 'Senha altarada. Senha padrão temporária: Brasilia604');
                        break;
                    }
                case 11: {
                        $this->session->set_flashdata('acerto', 'Senha altarada com sucesso');
                        break;
                    }
                case 12: {
                        $this->session->set_flashdata('erro', 'Senha não altarada');
                        break;
                    }
                case 13: {
                        $this->session->set_flashdata('erro', 'Senha não altarada pois não eram iguais');
                        break;
                    }
                case 14: {
                        $this->session->set_flashdata('erro', 'Retirada não efetuada. Quantidade solicitada é maior do que existe em estoque');
                        break;
                    }
case 15: {
                        $this->session->set_flashdata('acerto', 'Retirada efetuada com sucesso');
                        break;
                    }

                default:
                    $this->session->set_flashdata('erro', 'Ação não realizada - contatar suporte');

                    break;
            }
        } catch (Exception $e) {
            $this->session->set_flashdata('erro', 'Erro ao selecionar mensagem para cadastro de usuário');
            log_message('debug', 'Erro ao selecionar mensagem para cadastro de usuário' . $e);
            redirect('usuario/listar/');
        }
    }

}
