<?php

class API{

  public $servername = "127.0.0.1";
  public $username = "root";
  public $password = "";
  public $db = "test";
  
  
  function getUf(){  
    try{
      $conn = new PDO("mysql:host=$this->servername;dbname=$this->db", $this->username, $this->password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT id, nome, sigla FROM estados ORDER BY sigla";
      $stmt = $conn->query($sql);
      $rows = $stmt->fetchAll();

      return json_encode($rows);
    }catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
  }

  function getCidades($id){  
    try{
      $conn = new PDO("mysql:host=$this->servername;dbname=$this->db", $this->username, $this->password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT id, nome FROM cidades WHERE estado_id = ".$id." ORDER BY nome";
      $stmt = $conn->query($sql);
      $rows = $stmt->fetchAll();

      return json_encode($rows);
    }catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
  }


  function insertPrespect($data){ 
    try{
      $conn = new PDO("mysql:host=$this->servername;dbname=$this->db", $this->username, $this->password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO `test`.`tb_prospect`(`nome`,`documento`,`email`,`telefone`,`estado`,`cidade`,`endereco`,`numero`,`complemento`)
      VALUES(
        '".$data[0]->nome."',"
        .$data[9]->documento.",
        '".$data[1]->email."',"
        .$data[2]->telefone.",
        '".$data[7]->uf."',
        '".$data[8]->cidades."',
        '".$data[4]->endereco."',
        '".$data[5]->numero."',
        '".$data[6]->comp."' )";
      $stmt = $conn->exec($sql);
      return $stmt;
    }catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
  }


  function getClientes(){  
    try{
      $conn = new PDO("mysql:host=$this->servername;dbname=$this->db", $this->username, $this->password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT * FROM tb_prospect ORDER BY nome";
      $stmt = $conn->query($sql);
      $rows = $stmt->fetchAll();

      return json_encode($rows);
    }catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
  }


  function updateDados($id){  
    try{
      $conn = new PDO("mysql:host=$this->servername;dbname=$this->db", $this->username, $this->password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT * FROM tb_prospect WHERE id = ".$id;
      $stmt = $conn->query($sql);
      $rows = $stmt->fetchAll();

      return json_encode($rows[0]);
    }catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
  }


  function alterarDados($data){ 
    print_r($data);
    try{
      $conn = new PDO("mysql:host=$this->servername;dbname=$this->db", $this->username, $this->password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo $sql = "UPDATE tb_prospect 
        SET nome = '".$data[1]->nome."'
        , documento = ".$data[10]->documento."
        ,email = '".$data[2]->email."'
        ,telefone = ".$data[3]->telefone."
        ,estado = '".$data[8]->uf."'
        ,cidade = '".$data[9]->cidades."'
        ,endereco = '".$data[5]->endereco."'
        ,numero = '".$data[6]->numero."'
        ,complemento = '".$data[7]->comp."'
        WHERE id = ".$data[0]->id;
      $stmt = $conn->exec($sql);
      return $stmt;
    }catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
  }

  function deleteCliente($id){ 
    try{
      $conn = new PDO("mysql:host=$this->servername;dbname=$this->db", $this->username, $this->password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "DELETE FROM tb_prospect WHERE id = ".$id;
      $stmt = $conn->exec($sql);
      return $stmt;
    }catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
  }

}