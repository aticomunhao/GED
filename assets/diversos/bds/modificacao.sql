
-- ****************************SEGUIR ESSE ROTEIRO*****************************

-- 1) Criar um usuario com o nome SISTEMA colocar no campo cpf o número = 36238374667
-- 2) Após criar entre na tela de listagem de usuario e  excluia o usuario criado.
-- 3) acesse a tabela usuario no banco de dados veja qual o ID que o sistema deu pra esse usuario
-- 4) Entre no aquivo  controlador Estoque.php linha 230
-- $retorno = $this->estoque->inserirRetirada( valor->id, $valor->qtde, 'Excluído pelo Administrador(a) ' . strtoupper($this->session->userdata('nome')),/* SUBSTITUIR ESSE VALOR (2) PELO ID DO USUARIO*/ 2,$data_hora,2);

-- Colocar no campo antes da variavel $data_hora, o número do usuario desativado do sistema
-- para os casos de remocao do item do estoqe por um adminitrador
 
ALTER TABLE `cedpv`.`saida_produto` 
ADD COLUMN `tipo_retirada` CHAR(1) NOT NULL DEFAULT '1' COMMENT '1 - normal\n2 - via tela de estoque' AFTER `observacao`;

USE `cedpv`;
CREATE  OR REPLACE VIEW `v_retiradas` AS
SELECT p.nome, s.qtde, s.data_saida, s.id_usuario, ((TO_DAYS(NOW()) - TO_DAYS(`s`.`data_saida`)) - 1) AS `tempo` FROM  saida_produto as s inner join produto as p on
s.id_produto = p.id;

ALTER TABLE `cedpv`.`usuarios` 
ADD COLUMN `responsavel` VARCHAR(200) NULL AFTER `status`;


USE `cedpv`;
CREATE 
     OR REPLACE ALGORITHM = UNDEFINED 
    DEFINER = `root`@`localhost` 
    SQL SECURITY DEFINER
VIEW `v_usuarios` AS
    SELECT 
        `u`.`id` AS `id`,
        `u`.`nome` AS `nome`,
        `u`.`telefone` AS `telefone`,
        `u`.`cod_cidades` AS `cod_cidades`,
        `u`.`cpf` AS `cpf`,
        `u`.`data_cadastro` AS `data_cadastro`,
        `u`.`id_voluntario_cadastro` AS `id_voluntario_cadastro`,
        `u`.`status` AS `status`,
         `u`.`responsavel` AS `responsavel`,
        `c`.`nome` AS `nomeCidade`,
        `e`.`cod_estados` AS `idEstados`,
        `e`.`sigla` AS `sigla`,
        `e`.`nome` AS `nomeEstado`
    FROM
        ((`usuarios` `u`
        JOIN `cidades` `c` ON ((`c`.`cod_cidades` = `u`.`cod_cidades`)))
        JOIN `estados` `e` ON ((`c`.`estados_cod_estados` = `e`.`cod_estados`)))
    WHERE
        (`u`.`status` = 'A'); 
        
         -- rodar aquivo stp.sql para criar store procedure