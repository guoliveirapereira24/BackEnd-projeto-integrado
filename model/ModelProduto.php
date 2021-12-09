<?php

class ModelProduto{

    private $_conexao;

    private $_idProduto;
    private $_nome;
    private $_descricao;
    private $_preco;
    private $_imagem;
    private $_desconto;
    private $_qtdParcela;

    public function __construct($conexao){

        $json = file_get_contents("php://input");
        $dadosProduto = json_decode($json);

        $this->_idProduto = $dadosProduto->idProduto ?? null;
        $this->_nome = $dadosProduto->nome ?? null;
        $this->_descricao = $dadosProduto->descricao ?? null;
        $this->_preco = $dadosProduto->preco ?? null;
        $this->_imagem = $dadosProduto->imagem ?? null;
        $this->_desconto = $dadosProduto->desconto ?? null;
        $this->_qtdParcela = $dadosProduto->qtdParcela ?? null;


        $this->_conexao = $conexao;

}
public function findAll(){

    //instrução sql
    $sql = "SELECT * FROM tblProduto";

    //prepara o processo de execução da instrução sql
    $stm = $this->_conexao->prepare($sql);

    //executa a instrução sql
    $stm->execute();
    
    //devolve os valores da select para serem utilizados
    return $stm->fetchAll(\PDO::FETCH_ASSOC);
}

public function create(){

    $sql = "INSERT INTO tblProduto (nome, descricao, preco, desconto, imagem, qtdParcela)
        VALUES (?, ?, ?, ?, ?, ?)";

    $extensao = pathinfo($this->_imagem, PATHINFO_EXTENSION);
    $novoNomeArquivo = md5(microtime()) . ".$extensao";

    move_uploaded_file($_FILES["imagem"]["tmp_name"], "../upload/$novoNomeArquivo");

    $stm = $this->_conn->prepare($sql);

    $stm->bindValue(1, $this->_nome);
    $stm->bindValue(2, $this->_descricao);
    $stm->bindValue(3, $this->_preco);
    $stm->bindValue(4, $this->_desconto);
    $stm->bindValue(5, $novoNomeArquivo);
    $stm->bindValue(6, $this->_qtdParcela);


    if ($stm->execute()) {
        return "Success";
        
    } else {
        return "Error";
    }
}
    public function delete(){

        $sql = "DELETE FROM tblProduto WHERE idPessoa = ?";

        $stmt = $this->_conexao->prepare($sql);

        $stmt->bindValue(1, $this->_idProduto);

        if ($stmt->execute()) {
            return "Dados excluídos com sucesso!";
        }

    }
    public function update(){

        $sql = "UPDATE tblproduto SET 
        nome = ?,
        descricao = ?,
        preco = ?,
        desconto = ?,
        imagem = ?,
        qtdParcela = ?,
        WHERE idProduto = ?";

        $stmt = $this->_conn->prepare($sql);

        $stmt->bindValue(1, $this->_nome);
        $stmt->bindValue(2, $this->_descricao);
        $stmt->bindValue(3, $this->_preco);
        $stmt->bindValue(4, $this->_desconto);
        $stmt->bindValue(5, $this->_imagem);
        $stmt->bindValue(6, $this->_qtdParcela);

        $stmt->bindValue(7, $this->_idProduto);

        if ($stmt->execute()) {
            return "Dados alterados com sucesso!";
        }

    }



?>