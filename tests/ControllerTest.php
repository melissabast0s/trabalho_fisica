<?php

use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    private Controller $controller;

    protected function setUp(): void
    {
        $this->controller = new Controller();
    }

    public function testPhValido(): void
    {
        $this->assertEquals('Potável', $this->controller->classificarPh(7.0));
    }

    public function testPhNoLimite(): void
    {
        $this->assertEquals('Potável', $this->controller->classificarPh(6.0)); 
        $this->assertEquals('Potável', $this->controller->classificarPh(9.5)); 
    }

    public function testPhForaDaFaixa(): void
    {
        $this->assertEquals('Não Potável', $this->controller->classificarPh(5.9));
        $this->assertEquals('Não Potável', $this->controller->classificarPh(9.6));
    }

    public function testPhInvalidoExcecao(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->controller->classificarPh(-1.0);
    }

    public function testTurbidezValida(): void
    {
        $this->assertEquals('Potável', $this->controller->classificarTurbidez(2.5));
    }

    public function testTurbidezNoLimite(): void
    {
        $this->assertEquals('Potável', $this->controller->classificarTurbidez(5.0));
    }

    public function testTurbidezAcimaDoLimite(): void
    {
        $this->assertEquals('Não Potável', $this->controller->classificarTurbidez(5.1));
    }

    public function testTurbidezNegativaExcecao(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->controller->classificarTurbidez(-3.0);
    }

    public function testCloroValido(): void
    {
        $this->assertEquals('Potável', $this->controller->classificarCloro(2.0));
    }

    public function testCloroNoLimite(): void
    {
        $this->assertEquals('Potável', $this->controller->classificarCloro(0.2));
        $this->assertEquals('Potável', $this->controller->classificarCloro(5.0));
    }

    public function testCloroForaDoLimite(): void
    {
        $this->assertEquals('Não Potável', $this->controller->classificarCloro(0.1));
        $this->assertEquals('Não Potável', $this->controller->classificarCloro(5.1));
    }

    public function testCloroInvalidoExcecao(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->controller->classificarCloro(-0.5);
    }

    public function testDurezaValida(): void
    {
        $this->assertEquals('Potável', $this->controller->classificarDureza(150.0));
    }

    public function testDurezaNoLimite(): void
    {
        $this->assertEquals('Potável', $this->controller->classificarDureza(500.0));
    }

    public function testDurezaAcimaDoLimite(): void
    {
        $this->assertEquals('Não Potável', $this->controller->classificarDureza(500.1));
    }

    public function testDurezaInvalidaExcecao(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->controller->classificarDureza(-10.0);
    }

    public function testCalculoEficienciaComValoresConhecidos(): void
    {
        $eficiencia = $this->controller->calcularEficiencia(20.0, 4.0);
        $this->assertEquals(80.0, $eficiencia);
    }

    public function testErroDivisaoPorZeroEficiencia(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->controller->calcularEficiencia(0.0, 2.0);
    }


    public function testParecerFinalIntegracao(): void
    {
        $parecerAprovado = $this->controller->gerarParecerFinal(['Potável', 'Potável', 'Potável', 'Potável']);
        $this->assertStringContainsString('própria para consumo', $parecerAprovado);

        $parecerReprovado = $this->controller->gerarParecerFinal(['Potável', 'Não Potável', 'Potável', 'Potável']);
        $this->assertStringContainsString('imprópria para consumo', $parecerReprovado);
    }
}