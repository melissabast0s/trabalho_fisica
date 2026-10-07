<?php

use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    private Controller $controller;

    protected function setUp(): void
    {
        $this->controller = new Controller();
    }

    public function testCalculoEficienciaBiofiltro(): void
    {
        $resultado = $this->controller->calcularEficiencia(10.0, 2.0);
        $this->assertEquals(80.0, $resultado);
    }

    public function testClassificacaoPhPotavel(): void
    {
        $this->assertEquals('Potável', $this->controller->classificarPh(7.0));
        $this->assertEquals('Não Potável', $this->controller->classificarPh(5.0));
    }

    public function testClassificacaoTurbidezPotavel(): void
    {
        $this->assertEquals('Potável', $this->controller->classificarTurbidez(3.0));
        $this->assertEquals('Não Potável', $this->controller->classificarTurbidez(8.0));
    }

    public function testClassificacaoCloroPotavel(): void
    {
        $this->assertEquals('Potável', $this->controller->classificarCloro(1.5));
        $this->assertEquals('Não Potável', $this->controller->classificarCloro(0.1));
    }
}