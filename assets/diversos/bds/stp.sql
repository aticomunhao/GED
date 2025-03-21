DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DadosRelatorio`(IN ano INT, IN mes INT, IN retirada INT, IN produto INT, 
OUT d1 INT,OUT d2 INT,OUT d3 INT,OUT d4 INT,OUT d5 INT,OUT d6 INT,OUT d7 INT,OUT d8 INT,OUT d9 INT,
OUT d10 INT,OUT d11 INT,OUT d12 INT,OUT d13 INT,OUT d14 INT,OUT d15 INT,OUT d16 INT,OUT d17 INT,OUT d18 INT,OUT d19 INT,
OUT d20 INT,OUT d21 INT,OUT d22 INT,OUT d23 INT,OUT d24 INT,OUT d25 INT,OUT d26 INT,OUT d27 INT,OUT d28 INT,OUT d29 INT,
OUT d30 INT,OUT d31 INT)
BEGIN
 SELECT 
	ifnull(sum(qtde),0) INTO d1
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 1
    and tipo_retirada = retirada
    and id_produto = produto;
 
-- 
SELECT 
	ifnull(sum(qtde),0) INTO d2
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 2
    and tipo_retirada = retirada
    and id_produto = produto;
    
     SELECT 
	ifnull(sum(qtde),0) INTO d3
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 3
    and tipo_retirada = retirada
    and id_produto = produto;
 
-- 
SELECT 
	ifnull(sum(qtde),0) INTO d4
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 4
    and tipo_retirada = retirada
    and id_produto = produto;
    
    
    SELECT 
	ifnull(sum(qtde),0) INTO d5
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 5
    and tipo_retirada = retirada
    and id_produto = produto;
    
     SELECT 
	ifnull(sum(qtde),0) INTO d6
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 6
    and tipo_retirada = retirada
    and id_produto = produto;
 
-- 
SELECT 
	ifnull(sum(qtde),0) INTO d7
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 7
    and tipo_retirada = retirada
    and id_produto = produto;
    -- 
SELECT 
	ifnull(sum(qtde),0) INTO d8
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 8
    and tipo_retirada = retirada
    and id_produto = produto;
    -- 
SELECT 
	ifnull(sum(qtde),0) INTO d9
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 9
    and tipo_retirada = retirada
    and id_produto = produto;
    -- 
SELECT 
	ifnull(sum(qtde),0) INTO d10
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 10
    and tipo_retirada = retirada
    and id_produto = produto;
    
    -- ------------------
    
    
     SELECT 
	ifnull(sum(qtde),0) INTO d11
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 11
    and tipo_retirada = retirada
    and id_produto = produto;
 
-- 
SELECT 
	ifnull(sum(qtde),0) INTO d12
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 12
    and tipo_retirada = retirada
    and id_produto = produto;
    
     SELECT 
	ifnull(sum(qtde),0) INTO d13
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 13
    and tipo_retirada = retirada
    and id_produto = produto;
 
-- 
SELECT 
	ifnull(sum(qtde),0) INTO d14
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 14
    and tipo_retirada = retirada
    and id_produto = produto;
    
    
    SELECT 
	ifnull(sum(qtde),0) INTO d15
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 15
    and tipo_retirada = retirada
    and id_produto = produto;
    
     SELECT 
	ifnull(sum(qtde),0) INTO d16
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 16
    and tipo_retirada = retirada
    and id_produto = produto;
 
-- 
SELECT 
	ifnull(sum(qtde),0) INTO d17
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 17
    and tipo_retirada = retirada
    and id_produto = produto;
    -- 
SELECT 
	ifnull(sum(qtde),0) INTO d18
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 18
    and tipo_retirada = retirada
    and id_produto = produto;
    -- 
SELECT 
	ifnull(sum(qtde),0) INTO d19
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 19
    and tipo_retirada = retirada
    and id_produto = produto;
    -- 
SELECT 
	ifnull(sum(qtde),0) INTO d20
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 20
    and tipo_retirada = retirada
    and id_produto = produto;
    
    SELECT 
	ifnull(sum(qtde),0) INTO d21
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 21
    and tipo_retirada = retirada
    and id_produto = produto;
 
-- 
SELECT 
	ifnull(sum(qtde),0) INTO d22
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 22
    and tipo_retirada = retirada
    and id_produto = produto;
    
     SELECT 
	ifnull(sum(qtde),0) INTO d23
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 23
    and tipo_retirada = retirada
    and id_produto = produto;
 
-- 
SELECT 
	ifnull(sum(qtde),0) INTO d24
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 24
    and tipo_retirada = retirada
    and id_produto = produto;
    
    
    SELECT 
	ifnull(sum(qtde),0) INTO d25
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 25
    and tipo_retirada = retirada
    and id_produto = produto;
    
     SELECT 
	ifnull(sum(qtde),0) INTO d26
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 26
    and tipo_retirada = retirada
    and id_produto = produto;
 
-- 
SELECT 
	ifnull(sum(qtde),0) INTO d27
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 27
    and tipo_retirada = retirada
    and id_produto = produto;
    -- 
SELECT 
	ifnull(sum(qtde),0) INTO d28
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 28
    and tipo_retirada = retirada
    and id_produto = produto;
    -- 
SELECT 
	ifnull(sum(qtde),0) INTO d29
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 29
    and tipo_retirada = retirada
    and id_produto = produto;
    -- 
SELECT 
	ifnull(sum(qtde),0) INTO d30
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 30
    and tipo_retirada = retirada
    and id_produto = produto;
    
    -- ------------------
    
    
     SELECT 
	ifnull(sum(qtde),0) INTO d31
FROM
    saida_produto 
WHERE EXTRACT(YEAR FROM data_saida) = ano
     and
    EXTRACT(MONTH FROM data_saida) = mes
    and
    EXTRACT(DAY FROM data_saida) = 31
    and tipo_retirada = retirada
    and id_produto = produto;
 
-- 
END ;;
DELIMITER ; 