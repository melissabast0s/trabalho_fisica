<?php

namespace App\Controllers;

class LabAguaController
{
    public function index(): void
    {
        $amostras = obterAmostras();
        $ph = 7.0;
        $bruta = 20.0;
        $filtrada = 2.5;
        $cloro = 1.0;
        $dureza = 100.0;

        if (isset($_GET['amostra']) && isset($amostras[$_GET['amostra']])) {
            $a = $amostras[$_GET['amostra']];
            $ph = $a['ph'];
            $bruta = $a['bruta'];
            $filtrada = $a['filtrada'];
            $cloro = $a['cloro'];
            $dureza = $a['dureza'];
        }

        $analisado = $_SERVER['REQUEST_METHOD'] === 'POST' || isset($_GET['amostra']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ph = $_POST['ph'] !== '' ? (float) $_POST['ph'] : null;
            $bruta = $_POST['bruta'] !== '' ? (float) $_POST['bruta'] : null;
            $filtrada = $_POST['filtrada'] !== '' ? (float) $_POST['filtrada'] : null;
            $cloro = $_POST['cloro'] !== '' ? (float) $_POST['cloro'] : null;
            $dureza = $_POST['dureza'] !== '' ? (float) $_POST['dureza'] : null;
        }

        // Chama a View com o nome exclusivo laboratorio.php
        require_once __DIR__ . '/../../views/laboratorio.php';
    }
}