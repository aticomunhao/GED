DELIMITER // 
	CREATE PROCEDURE `SP_AtualizaEstoque`( `id_prod` int, `qtde_comprada` int, valor_unit decimal(9,2))
		BEGIN 
			declare contador int(11); 
			SELECT count(*) into contador FROM estoque WHERE id_produto = id_prod; 
				IF contador > 0 THEN 
					UPDATE estoque SET qtde=qtde + qtde_comprada, valor_unitario= valor_unit WHERE id_produto = id_prod;
				ELSE 
					INSERT INTO estoque (id_produto, qtde, valor_unitario) values (id_prod, qtde_comprada, valor_unit); 
				END IF; 
		END // 
DELIMITER ;


DELIMITER //
CREATE TRIGGER `TRG_EntradaProduto_AI` AFTER INSERT ON `entrada_produto`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaEstoque (new.id_produto, new.qtde, new.valor_unitario);
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER `TRG_EntradaProduto_AU` AFTER UPDATE ON `entrada_produto`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaEstoque (new.id_produto, new.qtde - old.qtde, new.valor_unitario);
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER `TRG_EntradaProduto_AD` AFTER DELETE ON `entrada_produto`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaEstoque (old.id_produto, old.qtde * -1, old.valor_unitario);
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER `TRG_SaidaProduto_AI` AFTER INSERT ON `saida_produto`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaEstoque (new.id_produto, new.qtde * -1, new.valor_unitario);
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER `TRG_SaidaProduto_AU` AFTER UPDATE ON `saida_produto`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaEstoque (new.id_produto, old.qtde - new.qtde, new.valor_unitario);
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER `TRG_SaidaProduto_AD` AFTER DELETE ON `saida_produto`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaEstoque (old.id_produto, old.qtde, old.valor_unitario);
END //
DELIMITER ;