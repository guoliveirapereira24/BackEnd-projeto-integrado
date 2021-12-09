<?php

class Connection{

    private $_dbHostName = "localhost";
    private $_dbName = "dbCem";
    private $_userName = "root";
    private $_dbPassword = "bcd127";
    private $_conexao;

    public function __construct(){
        
        try {
            
            //acesso ao atributo da classe
            $this->_conexao = new PDO("mysql:host =$this->_dbHostName;dbname=$this->_dbName;", 
                                    $this->_userName, 
                                    $this->_dbPassword);
            
            //configurações
            $this->_conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            
            echo "Connection error:" . $e->getMessage();

        }

    }

    public function returnConnection(){
        return $this->_conexao;
    } 

}

?>