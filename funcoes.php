<?php

function classificarPh(?float $ph): string
{
    if ($ph === null) {
        return "Campo Vazio";
    }

    if ($ph < 0 || $ph > 14) {
        return "Valor Inválido";
    }

    if ($ph >= 6.0 && $ph <= 9.5) {
        return "Adequado";
    }

    return "Fora do Padrão";
}


function classificarTurbidez(?float $turbidez): string
{
    if ($turbidez === null) {
        return "Campo Vazio";
    }

    if ($turbidez < 0) {
        return "Valor Inválido";
    }

    if ($turbidez <= 5.0) {
        return "Adequado";
    }

    return "Fora do Padrão";
}


function classificarCloro(?float $cloro): string
{
    if ($cloro === null) {
        return "Campo Vazio";
    }

    if ($cloro < 0) {
        return "Valor Inválido";
    }

    if ($cloro >= 0.2 && $cloro <= 5.0) {
        return "Adequado";
    }

    return "Fora do Padrão";
}


function classificarDureza(?float $dureza): string
{
    if ($dureza === null) {
        return "Campo Vazio";
    }

    if ($dureza < 0) {
        return "Valor Inválido";
    }

    if ($dureza <= 500.0) {
        return "Adequado";
    }

    return "Fora do Padrão";
}


function calcularEficiencia(float $bruta, float $filtrada): float
{
    if ($bruta <= 0) {
        return 0;
    }

    if ($filtrada < 0) {
        return 0;
    }

    $eficiencia = (($bruta - $filtrada) / $bruta) * 100;

    return round($eficiencia, 1);
}


function resultadoFinal(
    ?float $ph,
    ?float $turbidez,
    ?float $cloro,
    ?float $dureza
): string {

    if (
        $ph === null ||
        $turbidez === null ||
        $cloro === null ||
        $dureza === null
    ) {
        return "ERRO: CAMPO VAZIO";
    }

    $stPh = classificarPh($ph);
    $stTurbidez = classificarTurbidez($turbidez);
    $stCloro = classificarCloro($cloro);
    $stDureza = classificarDureza($dureza);

    if (
        $stPh === "Adequado" &&
        $stTurbidez === "Adequado" &&
        $stCloro === "Adequado" &&
        $stDureza === "Adequado"
    ) {
        return "POTÁVEL";
    }

    return "NÃO POTÁVEL";
}


function obterAmostras(): array
{
    return [

        "Amostra 01 - Rio (Água Bruta)" => [
            "ph" => 5.8,
            "bruta" => 35.0,
            "filtrada" => 4.2,
            "cloro" => 0.1,
            "dureza" => 120.0
        ],

        "Amostra 02 - Água Tratada de Torneira" => [
            "ph" => 7.2,
            "bruta" => 4.5,
            "filtrada" => 1.1,
            "cloro" => 1.5,
            "dureza" => 80.0
        ],

        "Amostra 03 - Cisterna da Escola" => [
            "ph" => 6.8,
            "bruta" => 18.0,
            "filtrada" => 3.0,
            "cloro" => 0.5,
            "dureza" => 520.0
        ]

    ];
}