<?php

use PHPUnit\Framework\TestCase;

require_once "Controller/LabAguaController.php";

class LabAguaTest extends TestCase
{

    public function testPhNormal()
    {
        $controller = new LabAguaController();

        $resultado = $controller->analisar(
            7,
            2,
            1,
            100
        );

        $this->assertEquals(
            "Dentro do padrão",
            $resultado["ph"]
        );
    }


    public function testPhLimite()
    {
        $controller = new LabAguaController();

        $resultado = $controller->analisar(
            6,
            2,
            1,
            100
        );

        $this->assertEquals(
            "Dentro do padrão",
            $resultado["ph"]
        );
    }


    public function testTurbidezFora()
    {
        $controller = new LabAguaController();

        $resultado = $controller->analisar(
            7,
            6,
            1,
            100
        );

        $this->assertEquals(
            "Fora do padrão",
            $resultado["turbidez"]
        );
    }


    public function testCloroNormal()
    {
        $controller = new LabAguaController();

        $resultado = $controller->analisar(
            7,
            2,
            1,
            100
        );

        $this->assertEquals(
            "Dentro do padrão",
            $resultado["cloro"]
        );
    }


    public function testDurezaFora()
    {
        $controller = new LabAguaController();

        $resultado = $controller->analisar(
            7,
            2,
            1,
            400
        );

        $this->assertEquals(
            "Fora do padrão",
            $resultado["dureza"]
        );
    }

}