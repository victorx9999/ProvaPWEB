<?php

session_start();
$login = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;

if(logarUsuario($login, $password)){
  $_SESSION['auth'] = true;
  header('Location: home.php');
} else {
  header('Location: login.html');
  exit();
}

function logarUsuario($login, $password){
  try{
  $pdo = new PDO('mysql:host=mysql;dbname=egressos;port=3306','root','123');
  $result = $pdo->prepare('SELECT * FROM usuario WHERE user = :usuario AND pass = :senha');
  $result->bindValue(":usuario", $login);
  $result->bindValue(":senha", $password);
  $result->execute();
  $linhas = $result->rowCount();
  
  return $linhas;


  }catch(Exception $e){
    echo 'Erro', $e->getMessage();
  }

}

