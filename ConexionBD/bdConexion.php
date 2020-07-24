<?php

//include 'config.php';

$server="mysql:dbname=".DB.";host=".SERVER;


try{

  $pdo = new PDO($server, USER, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));

  echo "<script>alert('Se conecto a la BD!!')</script>";

}catch(PDOException $error){

  echo "<script>alert('No se pudo conectar a la BD: ')</script>" . $error->getMessage();
}



?>