<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>LabÁgua</title>

    <link rel="stylesheet" href="templates/css/index.css">

</head>

<body>

<div class="container">

    <h1>LabÁgua</h1>

    <p>Laboratório Digital de Qualidade da Água</p>


    <form method="POST">

        <label>pH:</label>
        <input
            type="number"
            name="ph"
            step="0.1"
            required
        >


        <label>Turbidez:</label>
        <input
            type="number"
            name="turbidez"
            step="0.1"
            required
        >


        <label>Cloro residual:</label>
        <input
            type="number"
            name="cloro"
            step="0.1"
            required
        >


        <label>Dureza:</label>
        <input
            type="number"
            name="dureza"
            step="0.1"
            required
        >


        <button type="submit">
            Analisar água
        </button>

    </form>


    <?php if ($resultado != null): ?>

        <h2>Resultado</h2>

        <p>
            <strong>pH:</strong>
            <?= $resultado["ph"] ?>
        </p>

        <p>
            <strong>Turbidez:</strong>
            <?= $resultado["turbidez"] ?>
        </p>

        <p>
            <strong>Cloro:</strong>
            <?= $resultado["cloro"] ?>
        </p>

        <p>
            <strong>Dureza:</strong>
            <?= $resultado["dureza"] ?>
        </p>


        <h3>
            <?= $controller->parecer($resultado) ?>
        </h3>

    <?php endif; ?>

</div>

</body>

</html>