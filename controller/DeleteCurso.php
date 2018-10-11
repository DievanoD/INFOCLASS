<?php
require_once("../service/ConexaoDB.php");
require_once("../controller/CursoController.php");

$controller = new CursoController();
$controller->deletarCurso($_GET["id"]);