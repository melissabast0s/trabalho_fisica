<?php

require_once 'Controller/LabAguaController.php';

$controller = new LabAguaController();

$resultado = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ph = $_POST["ph"];
    $turbidez = $_POST["turbidez"];
    $cloro = $_POST["cloro"];
    $dureza = $_POST["dureza"];

    $resultado = $controller->analisar(
        $ph,
        $turbidez,
        $cloro,
        $dureza
    );
}

include "View/home.php";
?>