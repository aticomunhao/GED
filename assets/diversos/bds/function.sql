 DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `f_DadosRelatorio`(ano INTEGER,mes INTEGER,dia INTEGER, retirada INTEGER, produto INTEGER) RETURNS int(11)
    DETERMINISTIC
BEGIN

DECLARE d1 INT;
 SET d1 = 0;
 SELECT 
	 ifnull(sum(qtde),0)   INTO d1
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = dia
    and tipo_retirada = retirada
    and id_produto = produto;
    
     
RETURN d1;
END ;;
DELIMITER ; 