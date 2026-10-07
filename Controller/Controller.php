<?php

class Controller
{
    public function index()
    {
        $resultado = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $phAntes = (float) ($_POST['ph_antes'] ?? 0);
            $turbidezAntes = (float) ($_POST['turbidez_antes'] ?? 0);

            $phDepois = (float) ($_POST['ph_depois'] ?? 0);
            $turbidezDepois = (float) ($_POST['turbidez_depois'] ?? 0);
            $cloroDepois = (float) ($_POST['cloro_depois'] ?? 0);

            $eficienciaTurbidez = $this->calcularEficiencia($turbidezAntes, $turbidezDepois);
            $statusPh = $this->classificarPh($phDepois);
            $statusTurbidez = $this->classificarTurbidez($turbidezDepois);
            $statusCloro = $this->classificarCloro($cloroDepois);

            $aguaAprovada = ($statusPh === 'Potável' && $statusTurbidez === 'Potável' && $statusCloro === 'Potável');

            $resultado = [
                'phDepois' => $phDepois,
                'turbidezDepois' => $turbidezDepois,
                'cloroDepois' => $cloroDepois,
                'eficienciaTurbidez' => $eficienciaTurbidez,
                'statusPh' => $statusPh,
                'statusTurbidez' => $statusTurbidez,
                'statusCloro' => $statusCloro,
                'aguaAprovada' => $aguaAprovada,
                'parecerFinal' => $aguaAprovada 
                    ? "Água própria para consumo humano (Potável). Atende às diretrizes do ODS 6."
                    : "Água imprópria para consumo humano. Requer tratamento adicional."
            ];
        }

        require __DIR__ . '/../View/index.php';
    }

    public function calcularEficiencia(float $antes, float $depois): float
    {
        if ($antes <= 0) return 0.0;
        return round((($antes - $depois) / $antes) * 100, 1);
    }

    public function classificarPh(float $ph): string
    {
        return ($ph >= 6.0 && $ph <= 9.5) ? 'Potável' : 'Não Potável';
    }

    public function classificarTurbidez(float $turbidez): string
    {
        return ($turbidez <= 5.0) ? 'Potável' : 'Não Potável';
    }

    public function classificarCloro(float $cloro): string
    {
        return ($cloro >= 0.2 && $cloro <= 5.0) ? 'Potável' : 'Não Potável';
    }
}