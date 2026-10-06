<?php

class LabAguaController
{
    public function analisar($ph, $turbidez, $cloro, $dureza)
    {
        $resultado = [];

        // PH
        if ($ph >= 6 && $ph <= 9.5) {
            $resultado["ph"] = "Dentro do padrão";
        } else {
            $resultado["ph"] = "Fora do padrão";
        }


        if ($turbidez <= 5) {
            $resultado["turbidez"] = "Dentro do padrão";
        } else {
            $resultado["turbidez"] = "Fora do padrão";
        }


        if ($cloro >= 0.2 && $cloro <= 5) {
            $resultado["cloro"] = "Dentro do padrão";
        } else {
            $resultado["cloro"] = "Fora do padrão";
        }


        if ($dureza <= 300) {
            $resultado["dureza"] = "Dentro do padrão";
        } else {
            $resultado["dureza"] = "Fora do padrão";
        }


        return $resultado;
    }


    public function eficiencia($antes, $depois)
    {
        if ($antes == 0) {
            return 0;
        }

        return (($antes - $depois) / $antes) * 100;
    }


    public function parecer($resultado)
    {
        if (
            $resultado["ph"] == "Dentro do padrão" &&
            $resultado["turbidez"] == "Dentro do padrão" &&
            $resultado["cloro"] == "Dentro do padrão" &&
            $resultado["dureza"] == "Dentro do padrão"
        ) {
            return "A água está dentro dos padrões analisados.";
        }

        return "A água está fora dos padrões analisados.";
    }
}
?>