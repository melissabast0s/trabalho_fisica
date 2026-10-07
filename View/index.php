<?php

$datasetReal = [
    'poco' => [
        'nome' => 'Amostra 1: Poço Artesiano (Camaçari/BA)',
        'ph_antes' => 5.2,
        'turbidez_antes' => 14.5,
        'ph_depois' => 6.8,
        'turbidez_depois' => 2.1,
        'cloro_depois' => 1.2,
        'dureza_depois' => 120.0
    ],
    'chuva' => [
        'nome' => 'Amostra 2: Água de Chuva Armazenada',
        'ph_antes' => 5.8,
        'turbidez_antes' => 8.2,
        'ph_depois' => 7.1,
        'turbidez_depois' => 1.5,
        'cloro_depois' => 0.8,
        'dureza_depois' => 45.0
    ],
    'rio' => [
        'nome' => 'Amostra 3: Água do Rio Camaçari',
        'ph_antes' => 6.2,
        'turbidez_antes' => 28.0,
        'ph_depois' => 6.9,
        'turbidez_depois' => 4.2,
        'cloro_depois' => 2.0,
        'dureza_depois' => 210.0
    ]
];

$amostraSelecionada = $_GET['amostra'] ?? null;
$valores = [
    'ph_antes' => '',
    'turbidez_antes' => '',
    'ph_depois' => '',
    'turbidez_depois' => '',
    'cloro_depois' => '',
    'dureza_depois' => ''
];

if ($amostraSelecionada && isset($datasetReal[$amostraSelecionada])) {
    $valores = $datasetReal[$amostraSelecionada];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Laboratório da Água - Testes de Qualidade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9">

           
            <?php if (isset($erro) && $erro): ?>
                <div class="alert alert-danger shadow-sm mb-4">
                    <strong>Erro de Validação:</strong> <?= htmlspecialchars($erro) ?>
                </div>
            <?php endif; ?>

       
            <div class="card border-info mb-4 shadow-sm">
                <div class="card-header bg-info text-white fw-bold">
                    Dataset Real Coletado em Campo (Clique para preencher)
                </div>
                <div class="card-body">
                    <p class="mb-2 text-muted small">Selecione uma amostra real para carregar os parâmetros coletados:</p>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="index.php?amostra=poco" class="btn btn-outline-info btn-sm fw-bold">Poço Artesiano</a>
                        <a href="index.php?amostra=chuva" class="btn btn-outline-info btn-sm fw-bold">Água de Chuva</a>
                        <a href="index.php?amostra=rio" class="btn btn-outline-info btn-sm fw-bold">Rio Camaçari</a>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Laboratório Digital da Água & Biofiltro</h3>
                </div>
                <div class="card-body">
                    <form action="index.php" method="POST">
                        <h5 class="text-secondary mb-3">1. Água Bruta (Antes do Biofiltro)</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">pH Inicial</label>
                                <input type="number" step="0.1" name="ph_antes" class="form-control" value="<?= $valores['ph_antes'] ?>" placeholder="Ex: 5.2" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Turbidez Inicial (uNT)</label>
                                <input type="number" step="0.1" name="turbidez_antes" class="form-control" value="<?= $valores['turbidez_antes'] ?>" placeholder="Ex: 14.5" required>
                            </div>
                        </div>

                        <h5 class="text-secondary mb-3">2. Água Filtrada (Depois do Biofiltro)</h5>
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label class="form-label">pH Final</label>
                                <input type="number" step="0.1" name="ph_depois" class="form-control" value="<?= $valores['ph_depois'] ?>" placeholder="Ex: 6.8" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Turbidez Final (uNT)</label>
                                <input type="number" step="0.1" name="turbidez_depois" class="form-control" value="<?= $valores['turbidez_depois'] ?>" placeholder="Ex: 2.1" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Cloro (mg/L)</label>
                                <input type="number" step="0.1" name="cloro_depois" class="form-control" value="<?= $valores['cloro_depois'] ?>" placeholder="Ex: 1.2" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Dureza (mg/L)</label>
                                <input type="number" step="0.1" name="dureza_depois" class="form-control" value="<?= $valores['dureza_depois'] ?>" placeholder="Ex: 120.0" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100 fw-bold">Analisar Amostra de Água</button>
                    </form>
                </div>
            </div>

            <?php if (isset($resultado) && $resultado): ?>
                <div class="card shadow-sm mb-5">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Relatório Técnico da Amostra</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="text-primary">Eficiência de Filtragem do Biofiltro</h5>
                        <p>Remoção de Turbidez: <strong><?= $resultado['eficienciaTurbidez'] ?>%</strong></p>
                        
                        <hr>

                        <h5 class="text-primary">Classificação por Parâmetro</h5>
                        <ul class="list-group mb-4">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                pH Final: <?= $resultado['phDepois'] ?> (Faixa: 6.0 a 9.5)
                                <span class="badge <?= $resultado['statusPh'] === 'Potável' ? 'bg-success' : 'bg-danger' ?>"><?= $resultado['statusPh'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Turbidez Final: <?= $resultado['turbidezDepois'] ?> uNT (Máx: 5.0 uNT)
                                <span class="badge <?= $resultado['statusTurbidez'] === 'Potável' ? 'bg-success' : 'bg-danger' ?>"><?= $resultado['statusTurbidez'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Cloro Residual: <?= $resultado['cloroDepois'] ?> mg/L (Faixa: 0.2 a 5.0 mg/L)
                                <span class="badge <?= $resultado['statusCloro'] === 'Potável' ? 'bg-success' : 'bg-danger' ?>"><?= $resultado['statusCloro'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Dureza Total: <?= $resultado['durezaDepois'] ?> mg/L (Máx: 500.0 mg/L)
                                <span class="badge <?= $resultado['statusDureza'] === 'Potável' ? 'bg-success' : 'bg-danger' ?>"><?= $resultado['statusDureza'] ?></span>
                            </li>
                        </ul>

                        <div class="alert <?= $resultado['aguaAprovada'] ? 'alert-success' : 'alert-danger' ?> mb-0">
                            <h5 class="alert-heading">Parecer Final de Potabilidade:</h5>
                            <p class="mb-0"><?= $resultado['parecerFinal'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

</body>
</html>