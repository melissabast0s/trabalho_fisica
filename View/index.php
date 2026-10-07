<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Laboratório Digital - Biofiltro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Simulador de Biofiltro e Qualidade da Água</h3>
                </div>
                <div class="card-body">
                    <form action="index.php" method="POST">
                        <h5 class="text-secondary mb-3">1. Água Bruta (Antes do Biofiltro)</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">pH Inicial</label>
                                <input type="number" step="0.1" name="ph_antes" class="form-control" placeholder="Ex: 5.5" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Turbidez Inicial (uNT)</label>
                                <input type="number" step="0.1" name="turbidez_antes" class="form-control" placeholder="Ex: 15.0" required>
                            </div>
                        </div>

                        <h5 class="text-secondary mb-3">2. Água Filtrada (Depois do Biofiltro)</h5>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label class="form-label">pH Final</label>
                                <input type="number" step="0.1" name="ph_depois" class="form-control" placeholder="Ex: 7.2" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Turbidez Final (uNT)</label>
                                <input type="number" step="0.1" name="turbidez_depois" class="form-control" placeholder="Ex: 2.0" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Cloro Final (mg/L)</label>
                                <input type="number" step="0.1" name="cloro_depois" class="form-control" placeholder="Ex: 1.5" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100 fw-bold">Analisar Água</button>
                    </form>
                </div>
            </div>

            <?php if ($resultado): ?>
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Relatório da Análise</h4>
                    </div>
                    <div class="card-body">
                        <h5>Eficiência do Biofiltro</h5>
                        <p>Remoção de Turbidez: <strong><?= $resultado['eficienciaTurbidez'] ?>%</strong></p>
                        
                        <hr>

                        <h5>Classificação dos Parâmetros</h5>
                        <ul class="list-group mb-4">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                pH Final: <?= $resultado['phDepois'] ?>
                                <span class="badge <?= $resultado['statusPh'] === 'Potável' ? 'bg-success' : 'bg-danger' ?>"><?= $resultado['statusPh'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Turbidez Final: <?= $resultado['turbidezDepois'] ?> uNT
                                <span class="badge <?= $resultado['statusTurbidez'] === 'Potável' ? 'bg-success' : 'bg-danger' ?>"><?= $resultado['statusTurbidez'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Cloro Residual: <?= $resultado['cloroDepois'] ?> mg/L
                                <span class="badge <?= $resultado['statusCloro'] === 'Potável' ? 'bg-success' : 'bg-danger' ?>"><?= $resultado['statusCloro'] ?></span>
                            </li>
                        </ul>

                        <div class="alert <?= $resultado['aguaAprovada'] ? 'alert-success' : 'alert-danger' ?> mb-0">
                            <h5 class="alert-heading">Parecer Final:</h5>
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