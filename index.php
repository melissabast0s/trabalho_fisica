<?php
require_once 'funcoes.php';

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
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratório da Água</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-4">
<div class="container" style="max-width: 650px;">
    <h3 class="text-center mb-3">Laboratório da Água</h3>


    <div class="card p-3 mb-3 shadow-sm">
        <label class="form-label fw-bold">Carregar Amostras do Relatório:</label>
        <form method="GET">
            <select name="amostra" class="form-select" onchange="this.form.submit()">
                <option value="">-- Escolha uma Amostra --</option>
                <?php foreach ($amostras as $nome => $dados): ?>
                    <option value="<?= $nome ?>" <?= (isset($_GET['amostra']) && $_GET['amostra'] === $nome) ? 'selected' : '' ?>>
                        <?= $nome ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <form method="POST" action="index.php" class="card p-4 shadow-sm mb-3">
        <div class="row">
            <div class="col-6 mb-3">
                <label class="form-label">pH (6.0 a 9.5):</label>
                <input type="number" step="0.1" name="ph" value="<?= $ph ?>" class="form-control">
            </div>
            <div class="col-6 mb-3">
                <label class="form-label">Cloro (0.2 a 5.0 mg/L):</label>
                <input type="number" step="0.1" name="cloro" value="<?= $cloro ?>" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-6 mb-3">
                <label class="form-label">Turbidez Bruta (UNT):</label>
                <input type="number" step="0.1" name="bruta" value="<?= $bruta ?>" class="form-control">
            </div>
            <div class="col-6 mb-3">
                <label class="form-label">Turbidez Filtrada (UNT):</label>
                <input type="number" step="0.1" name="filtrada" value="<?= $filtrada ?>" class="form-control">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Dureza (Até 500 mg/L):</label>
            <input type="number" step="0.1" name="dureza" value="<?= $dureza ?>" class="form-control">
        </div>
        <button class="btn btn-primary w-100">Analisar Amostra</button>
    </form>


    <?php if ($analisado): ?>
        <div class="card p-4 shadow-sm border-primary">
            <h5 class="mb-3">Resultado da Análise</h5>
            <p><strong>pH:</strong> <?= classificarPh($ph) ?></p>
            <p><strong>Turbidez Filtrada:</strong> <?= classificarTurbidez($filtrada) ?></p>
            <p><strong>Cloro:</strong> <?= classificarCloro($cloro) ?></p>
            <p><strong>Dureza:</strong> <?= classificarDureza($dureza) ?></p>
            <p><strong>Eficiência do Biofiltro:</strong> <?= calcularEficiencia((float)$bruta, (float)$filtrada) ?>%</p>
            <hr>
            <?php $res = resultadoFinal($ph, $filtrada, $cloro, $dureza); ?>
            <div class="alert <?= $res === 'POTÁVEL' ? 'alert-success' : 'alert-danger' ?> text-center fw-bold mb-0">
                RESULTADO FINAL: <?= $res ?>
            </div>
        </div>
    <?php endif; ?>
</div>
</body>
</html>