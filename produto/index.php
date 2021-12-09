<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Content-Type: aplication/json");

include('../Connection.php');
include('../model/ModelProduto.php');
include('../controller/ControllerProduto.php');

$conexao = new Connection();

$model = new ModelProduto($conn->returnConnection());

$controller = new ControllerProduto($model);

$dados = $controller->router();

echo json_encode(array("status"=>"Success","data"=>$dados))

?>