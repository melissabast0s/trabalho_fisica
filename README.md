Simulador de Qualidade da Água e Biofiltro

Projeto desenvolvido em PHP para simulação e análise da qualidade da água antes e depois da passagem por um sistema de biofiltração. O sistema avalia parâmetros de potabilidade e gera um relatório com foco em diretrizes ambientais.

Requisitos Prévios

Antes de iniciar, certifique-se de ter instalado em sua máquina:
PHP (versão 8.3 ou superior)
Composer (gerenciador de dependências do PHP)

Instruções de Instalação

1. Abra o terminal na pasta raiz do projeto (trabalho_fisica).
2. Instale as dependências do projeto (incluindo o PHPUnit):
   composer install

Lista de Algoritmos Implementados:
A aplicação utiliza a classe Controller para processar a lógica das análises físico-químicas:

Cálculo da Eficiência do Biofiltro (calcularEficiencia):
Objetivo: Avalia o percentual de remoção de sujeira (turbidez) comparando as medições antes e depois da filtragem.
Fórmula: Eficiência (%) = ((Turbidez Inicial - Turbidez Final) / Turbidez Inicial) * 100

Classificação do pH (classificarPh):
Objetivo: Verifica se o valor final do pH se encontra no intervalo seguro para água potável (entre 6.0 e 9.5).

Classificação da Turbidez (classificarTurbidez):
Objetivo: Avalia a transparência da água com base no limite máximo recomendado de 5.0 uNT.

Classificação do Cloro Residual (classificarCloro):
Objetivo: Garante que a concentração de cloro residual livre está dentro da faixa de desinfecção (entre 0.2 e 5.0 mg/L).


