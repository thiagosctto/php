<?php

require_once("config.php");

//$sql = new Sql();
//$usuarios = $sql->select("SELECT * FROM users");
//echo json_encode($usuarios);

//carrega 1 usuario
//$jose = new Usuario();
//$jose->loadById(2);
//echo $jose;

//carrega uma lista de usuarios
//$lista = Usuario::getList();
//echo json_encode($lista);

//Carrega uma lista de usuarios buscando por login
//$search = Usuario::search("J");
//echo json_encode($search);

//Carrega um usuario com login e senha
//$usuario = new Usuario();
//$usuario->login("Tigas", "qqHouve");
//echo $usuario;

//Criando novo usuario
//$aluno = new Usuario("Persona21", "789U");
//$aluno->insert();
//echo $aluno;


//Alterar usuario
//$usuario = new Usuario();
//$usuario->loadById(11);
//$usuario->update("professor", "prof159");
//echo $usuario;

//Deletar usuario
$usuario = new Usuario();
$usuario->loadById(8);
$usuario->delete();
echo $usuario;
?>