<?php

class Controller
{
    public function index()
    {
        $resultado = null;
        $erro = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
             
                if (!isset($_POST['ph_antes'], $_POST['turbidez_antes'], $_POST['ph_depois'], $_POST['turbidez_depois'], $_POST['cloro_depois'], $_POST['dureza_depois']) ||
                    $_POST['ph_antes'] === '' || $_POST['turbidez_antes'] === '' || $_POST['ph_depois'] === '' || 
                    $_POST['turbidez_depois'] === '' || $_POST['cloro_depois'] === '' || $_POST['dureza_depois'] === '') {
                    throw new InvalidArgumentException("Todos os campos do formulário são obrigatórios.");
                }

                $phAntes = (float) $_POST['ph_antes'];
                $turbidezAntes = (float) $_POST['turbidez_antes'];
                $phDepois = (float) $_POST['ph_depois'];
                $turbidezDepois = (float) $_POST['turbidez_depois'];
                $cloroDepois = (float) $_POST['cloro_depois'];
                $durezaDepois = (float) $_POST['dureza_depois'];

                $eficienciaTurbidez = $this->calcularEficiencia($turbidezAntes, $turbidezDepois);
                $statusPh = $this->classificarPh($phDepois);
                $statusTurbidez = $this->classificarTurbidez($turbidezDepois);
                $statusCloro = $this->classificarCloro($cloroDepois);
                $statusDureza = $this->classificarDureza($durezaDepois);

                $parecerFinal = $this->gerarParecerFinal([$statusPh, $statusTurbidez, $statusCloro, $statusDureza]);
                $aguaAprovada = str_contains($parecerFinal, 'própria para consumo');

                $resultado = [
                    'phDepois' => $phDepois,
                    'turbidezDepois' => $turbidezDepois,
                    'cloroDepois' => $cloroDepois,
                    'durezaDepois' => $durezaDepois,
                    'eficienciaTurbidez' => $eficienciaTurbidez,
                    'statusPh' => $statusPh,
                    'statusTurbidez' => $statusTurbidez,
                    'statusCloro' => $statusCloro,
                    'statusDureza' => $statusDureza,
                    'aguaAprovada' => $aguaAprovada,
                    'parecerFinal' => $parecerFinal
                ];

            } catch (InvalidArgumentException $e) {
                $erro = $e->getMessage();
            }
        }

        require __DIR__ . '/../View/index.php';
    }

    public function calcularEficiencia(float $antes, float $depois): float
    {
        if ($antes <= 0) {
            throw new InvalidArgumentException("A turbidez inicial deve ser maior que zero (evita divisão por zero).");
        }
        if ($depois < 0) {
            throw new InvalidArgumentException("A turbidez final não pode ser negativa.");
        }
        return round((($antes - $depois) / $antes) * 100, 1);
    }

    public function classificarPh(float $ph): string
    {
        if ($ph < 0.0 || $ph > 14.0) {
            throw new InvalidArgumentException("O valor de pH deve estar entre 0 e 14.");
        }
        return ($ph >= 6.0 && $ph <= 9.5) ? 'Potável' : 'Não Potável';
    }

    public function classificarTurbidez(float $turbidez): string
    {
        if ($turbidez < 0.0) {
            throw new InvalidArgumentException("A turbidez não pode ser negativa.");
        }
        return ($turbidez <= 5.0) ? 'Potável' : 'Não Potável';
    }

    public function classificarCloro(float $cloro): string
    {
        if ($cloro < 0.0) {
            throw new InvalidArgumentException("O cloro residual não pode ser negativo.");
        }
        return ($cloro >= 0.2 && $cloro <= 5.0) ? 'Potável' : 'Não Potável';
    }

    public function classificarDureza(float $dureza): string
    {
        if ($dureza < 0.0) {
            throw new InvalidArgumentException("A dureza total não pode ser negativa.");
        }
     
        return ($dureza <= 500.0) ? 'Potável' : 'Não Potável';
    }

    public function gerarParecerFinal(array $statusList): string
    {
        foreach ($statusList as $status) {
            if ($status !== 'Potável') {
                return "Água imprópria para consumo humano (Não Potável). Um ou mais parâmetros violam a Portaria de Potabilidade.";
            }
        }
        return "Água própria para consumo humano (Potável). Atende aos padrões de potabilidade e ao ODS 6.";
    }
}