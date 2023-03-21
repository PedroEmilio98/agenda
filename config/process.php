<?php
session_start();

include_once("connection.php");
include_once("url.php");


$data = $_POST;

//Criacao e edicao
if (!empty($data)) {
//criar contato
     if($data["type"]==="create"){
         
          $name = $data['name'];  
          $phone = $data['phone'];
          $observations = $data['observations'];

          $query = "INSERT INTO contact (name, phone, observations) VALUES (:name, :phone, :observations)";
          $stmt = $conn->prepare($query);

          $stmt->bindParam(":name", $name);
          $stmt->bindParam(":phone", $phone);
          $stmt->bindParam(":observations", $observations);

          try{
               $stmt->execute();
               $_SESSION["msg"]= "Contato criado com sucesso!";

          }catch(PDOException $e){
               $error = $e->getMessage();
               echo "ERRO:  $error";
          }
     }
//editar contato
     if($data["type"]==="edit"){
          $name = $data['name'];  
          $phone = $data['phone'];
          $observations = $data['observations'];
          $contact_id = $data['contact_id'];

          $query = "UPDATE contact SET name= :name, phone= :phone, observations= :observations where id =:contact_id";
                   
          $stmt = $conn->prepare($query);

          $stmt->bindParam(":name", $name);
          $stmt->bindParam(":phone", $phone);
          $stmt->bindParam(":observations", $observations);
          $stmt->bindParam(":contact_id", $contact_id);

          try{
               $stmt->execute();
               $_SESSION["msg"]= "Contato editado com sucesso!";

          }catch(PDOException $e){
               $error = $e->getMessage();
               echo "ERRO:  $error";
          }
     }
//excluir contatp
     if($data["type"]==="delete"){
          $contact_id = $data['id'];

          $query = "DELETE from contact WHERE id= :contact_id";

          $stmt = $conn->prepare($query);
          
          $stmt->bindParam(":contact_id", $contact_id);

          try{
               $stmt->execute();
               $_SESSION["msg"]= "Contato excluido com sucesso!";

          }catch(PDOException $e){
               $error = $e->getMessage();
               echo "ERRO:  $error";
          }


     }
     //redireciona para home
     header("Location:" . $BASE_URL . "../index.php");
     
//selecao de dado
} else {


     //Retorna 1 contato
     $id;
     if (!empty($_GET)) {
          $id = $_GET['id'];
     }
     if (!empty($id)) {
          $query = "SELECT * FROM contact WHERE id = :id";
          $stmt = $conn->prepare($query);
          $stmt->bindParam(":id", $id);
          $stmt->execute();

          $contact = $stmt->fetch();
     } else {

          //Busca todos os dados de contato para pagina principal
          $contact = [];
          $query = "SELECT * FROM contact";
          $stmt = $conn->prepare($query);
          $stmt->execute();
          $contact = $stmt->fetchAll();
     }
}

//fechar conexao
$conn = null;