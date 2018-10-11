<?php
require_once("../service/ConexaoDB.php");
require_once("../controller/UsuarioController.php");

$controller = new UsuarioController();
$controller->deletarAluno($_GET["id"]);