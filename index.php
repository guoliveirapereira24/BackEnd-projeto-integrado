<?php 

require("./Connection.php");
require("./model/ModelProduto.php");

//conexão criada
$conexao = new Connection();

//objeto de model criado
$modelProduto = new ModelProduto($conexao->returnConnection());

$dados = $modelProduto->findAll();

echo '<pre>';
var_dump($dados);
echo '</pre>';



?>