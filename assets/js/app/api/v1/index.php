<?php

require '.././libs/Slim/Slim.php';
require_once 'dbHelper.php';

// Get Slim instance
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app = \Slim\Slim::getInstance();

// call our own dbHelper class
$db = new dbHelper();

/* * ********** This can be called via http://localhost/angularcode-megamenu/api/v1/categories
  List all categories where parent=0 and its sub categories *********** */

$app->get('/produtos', function() {
    global $db;
    $rows = $db->select("produto", "id,status, nome, estoque_minimo as minimo, estoque_maximo as maximo, descricao", array('status' => 'A'), "ORDER BY nome ASC");


    // parent categories node
    $categories = array();



    foreach ($rows["data"] as $row) {

        $category = array(); // temp array
        $category["id"] = $row["id"];
        $category["status"] = $row["status"];
        $category["nome"] = $row["nome"];
        $category["minimo"] = $row["minimo"];
        $category["maximo"] = $row["maximo"];
        $category["descricao"] = $row["descricao"];



        // pushing sinlge category into parent
        array_push($categories, $category);
    }

    echoResponse(200, $categories);
});

function Mask($mask, $str) {

    $str = str_replace(" ", "", $str);

    for ($i = 0; $i < strlen($str); $i++) {
        $mask[strpos($mask, "#")] = $str[$i];
    }

    return $mask;
}

function Telefone($str) {

    $tam = strlen($str);

    if ($tam == 10) {
        return Mask("(##) ####-####", $str);
    } else if ($tam == 11) {
        return Mask("(##) #####-####", $str);
    } else {
        return;
    }
}

$app->get('/voluntarios', function() {
    global $db;
    $rows = $db->select("v_voluntarios", "*", array('status' => 'A'), "ORDER BY nome ASC");
    $lista = array();



    foreach ($rows["data"] as $row) {

        $voluntario = array(); // temp array
        $voluntario["id"] = $row["id"];
        $voluntario["status"] = $row["status"];
        $voluntario["nome"] = $row["nome"];
        $voluntario["cpf"] = Mask("###.###.###-##", $row["cpf"]);
        $voluntario["descricao"] = $row["descricao"];



        array_push($lista, $voluntario);
    }

    echoResponse(200, $lista);
});

$app->get('/usuarios', function() {
    global $db;
    $rows = $db->select("v_usuarios", "*", array('status' => 'A'), "ORDER BY nome ASC");
    $lista = array();


    foreach ($rows["data"] as $row) {

        if(strlen($row["cpf"]) <= 11 ) {
            $num = Mask("###.###.###-##", $row["cpf"]);
        }else{
            $num = Mask("##.###.###/####-##", $row["cpf"]);

        }

        $usuario = array(); // temp array
        $usuario["id"] = $row["id"];
        $usuario["nome"] = $row["nome"];
        $usuario["telefone"] = Telefone($row["telefone"]);
        $usuario["cidade"] = $row["cod_cidades"];
        $usuario["cpf"] = $num;
        $usuario["idCadastro"] = $row["id_voluntario_cadastro"];
        $usuario["status"] = $row["status"];
        $usuario["nomeCidade"] = $row["nomeCidade"];
        $usuario["sigla"] = $row["sigla"];
        $usuario["nomeEstado"] = $row["nomeEstado"];
        $usuario["responsavel"] = strtoupper($row["responsavel"]);



        array_push($lista, $usuario);
    }

    echoResponse(200, $lista);
});

$app->get('/usuariocpf', function() {
	global $db;
    $rows = $db->select("v_usuarios", "*", array('cpf' =>preg_replace("/[^0-9]/", "", $_GET['cpf'])), "ORDER BY nome ASC");
	$dataFormatada   = "Não houve retirada anteriormente" ;
    $qtde = $tempo=0;
    $id = null;
    $produto = "";
    $flags = true;
    $arrRetiradas = array();
    foreach ($rows["data"] as $row) {
        $id = $row["id"];
    }
    if($id){
        $retirada = $db->select("v_retiradas", "*", array('id_usuario' => $id), "ORDER BY data_saida DESC");


        foreach ($retirada["data"] as $row) {

            if($flags){
                $data = new DateTime($row["data_saida"]);
                $dataFormatada = $data->format("d/m/Y h:i:s");
                $qtde = $row["qtde"];
                $produto = strtoupper($row["nome"]);

                $tempo = $row["tempo"];
                $flags = false;
                array_push($arrRetiradas,array("data"=>$dataFormatada,"qtde"=>$qtde,"nome"=>$produto,"tempo"=>$tempo));
            }else{
                $data2 = new DateTime($row["data_saida"]);
                $dataFormatada2 = $data2->format("d/m/Y h:i:s");
                $qtde2 = $row["qtde"];
                $produto2 = strtoupper($row["nome"]);
                $tempo2 = $row["tempo"];
                $flags = false;
                array_push($arrRetiradas,array("data"=>$dataFormatada2,"qtde"=>$qtde2,"nome"=>$produto2,"tempo"=>$tempo2));
            }

        }


    }

    $lista = array();

    foreach ($rows["data"] as $row) {

        if(strlen($row["cpf"]) <= 11 ) {
            $num = Mask("###.###.###-##", $row["cpf"]);
        }else{
            $num = Mask("##.###.###/####-##", $row["cpf"]);

        }

        $usuario = array(); // temp array
        $usuario["id"] = $row["id"];
        $usuario["nome"] = $row["nome"];
        $usuario["telefone"] = Telefone($row["telefone"]);
        $usuario["cidade"] = $row["cod_cidades"];
        $usuario["cpf"] = $num;
        $usuario["idCadastro"] = $row["id_voluntario_cadastro"];
        $usuario["status"] = $row["status"];
        $usuario["nomeCidade"] = $row["nomeCidade"];
        $usuario["sigla"] = $row["sigla"];
        $usuario["nomeEstado"] = $row["nomeEstado"];
        $usuario["dataRetirada"] = $dataFormatada;
        $usuario["qtde"] = $qtde;
        $usuario["nomeProduto"] = $produto;
        $usuario["retiradas"] = $arrRetiradas;
        $usuario["responsavel"] = strtoupper($row["responsavel"]);
        $usuario["tempo"] = $tempo;




        array_push($lista, $usuario);
    }


    echoResponse(200, $lista);
});

$app->get('/quantidade', function() {
    global $db;
    $rows = $db->select("estoque", "qtde", array('id_produto' =>$_GET['id']), "");
    $lista = array();


    foreach ($rows["data"] as $row) {

        $produto = array(); // temp array
        $produto["qtde"] = $row["qtde"];
      
        array_push($lista, $produto);
    }

    echoResponse(200, $lista);
});



$app->get('/cidades', function() {

    global $db;
    $rows = $db->select("cidades", " cod_cidades AS id, nome ", array('estados_cod_estados' => $_GET['estado']), "ORDER BY nome ASC");
    $lista = array();

    foreach ($rows["data"] as $row) {

        $cidade = array(); // temp array
        $cidade["id"] = $row["id"];
        $cidade["nome"] = $row["nome"];

        array_push($lista, $cidade);
    }

    echoResponse(200, $lista);
});
 




$app->get('/estoque', function() {

    global $db;
    $rows = $db->select("v_estoque", " * ", array(), "ORDER BY nome ASC");
    $lista = array();

    foreach ($rows["data"] as $row) {

        $estoque = array(); // temp array
        $estoque["id"] = $row["id"];
        $estoque["nome"] = $row["nome"];
        $estoque["qtde"] = $row["qtde"];
        $estoque["minimo"] = $row["minimo"];
        $estoque["maximo"] = $row["maximo"];



        array_push($lista, $estoque);
    }

    echoResponse(200, $lista);
});

function echoResponse($status_code, $response) {
    global $app;
    $app->status($status_code);
    $app->contentType('application/json');

    echo json_encode($response);
}

$app->run();
?>