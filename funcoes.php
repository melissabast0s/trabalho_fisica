<?php

// IDs 1, 2, 3, 4 - Classificação do pH (Faixa ideal: 6.0 a 9.5)
function classificarPh(?float $ph): string {
    if ($ph === null) {
        return "Campo Vazio";
    }
    if ($ph < 0.0 || $ph > 14.0) {
        return "Valor Inválido";
    }
    if ($ph >= 6.0 && $ph <= 9.5) {
        return "Adequado";
    }
    return "Fora do Padrão";
}

// IDs 5, 6, 7, 8 - Classificação da Turbidez em UNT (Limite máximo: 5.0 UNT)
function classificarTurbidez(?float $turbidez): string {
    if ($turbidez === null) {
        return "Campo Vazio";
    }
    if ($turbidez < 0.0) {
        return "Valor Inválido";
    }
    if ($turbidez <= 5.0) {
        return "Adequado";
    }
    return "Fora do Padrão";
}

// IDs 9, 10, 11, 12 - Classificação do Cloro Residual (Faixa ideal: 0.2 a 5.0 mg/L)
function classificarCloro(?float $cloro): string {
    if ($cloro === null) {
        return "Campo Vazio";
    }
    if ($cloro < 0.0) {
        return "Valor Inválido";
    }
    if ($cloro >= 0.2 && $cloro <= 5.0) {
        return "Adequado";
    }
    return "Fora do Padrão";
}

// IDs 13, 14, 15, 16 - Classificação da Dureza (Limite máximo: 500.0 mg/L)
function classificarDureza(?float $dureza): string {
    if ($dureza === null) {
        return "Campo Vazio";
    }
    if ($dureza < 0.0) {
        return "Valor Inválido";
    }
    if ($dureza <= 500.0) {
        return "Adequado";
    }
    return "Fora do Padrão";
}

// Cálculo da Eficiência do Biofiltro com Tratamento de Divisão por Zero
function calcularEficiencia(float $bruta, float $filtrada): float {
    if ($bruta <= 0.0) {
        return 0.0; // Tratamento para evitar divisão por zero
    }
    if ($filtrada < 0.0) {
        return 0.0;
    }
    
    $eficiencia = (($bruta - $filtrada) / $bruta) * 100;
    return round($eficiencia, 1);
}

// Resultado final do parecer sobre a amostra de água
function resultadoFinal(?float $ph, ?float $turbidez, ?float $cloro, ?float $dureza): string {
    if ($ph === null || $turbidez === null || $cloro === null || $dureza === null) {
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

// Dataset com amostras de exemplo para carregar no sistema
function obterAmostras(): array {
    return [
        "Amostra 01 - Rio (Água Bruta)" => [
            "ph" => 5.8,
            "bruta" => 35.0,
            "filtrada" => 4.2,
            "cloro" => 0.1,
            "dureza" => 120.0
        ],
        "Amostra 02 - Água Trata de Torneira" => [
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