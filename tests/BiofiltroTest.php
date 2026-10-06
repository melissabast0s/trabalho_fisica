<?php

use PHPUnit\Framework\TestCase;

require_once "Controller/LabAguaController.php";

class BiofiltroTest extends TestCase
{

    public function testEficiencia()
    {
        $controller = new LabAguaController();

        $resultado =
            $controller->eficiencia(100, 20);

        $this->assertEquals(80, $resultado);
    }


    public function testEficiencia50()
    {
        $controller = new LabAguaController();

        $resultado =
            $controller->eficiencia(100, 50);

        $this->assertEquals(50, $resultado);
    }


    public function testDivisaoPorZero()
    {
        $controller = new LabAguaController();

        $resultado =
            $controller->eficiencia(0, 0);

        $this->assertEquals(0, $resultado);
    }

}