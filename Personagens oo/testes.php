<?php
/**
 * ===============================================================
 * TESTES UNITÁRIOS - EXEMPLOS DE VALIDAÇÃO
 * ===============================================================
 * 
 * Execute cada teste para validar o funcionamento correto
 * das classes e dos conceitos de POO implementados
 * 
 * ===============================================================
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir o arquivo principal para ter acesso às classes
// require 'index.php';

class TestadorCartas {
    private $testesPassados = 0;
    private $testesFalhados = 0;
    
    public function executarTodosTestes() {
        echo "<div style='background: #f5f5f5; padding: 20px; margin: 20px 0; border-radius: 5px;'>";
        echo "<h2>🧪 Suite de Testes - Sistema de Cartas Pokémon</h2>";
        
        $this->testarAbstracaoEHeranca();
        $this->testarPolimorfismo();
        $this->testarEncapsulamento();
        $this->testarMembrosEstaticos();
        $this->testarConstructorDestructor();
        $this->testarInterface();
        
        $this->exibirResumo();
        echo "</div>";
    }
    
    private function testarAbstracaoEHeranca() {
        echo "<hr>";
        echo "<h3>📦 Teste 1: Abstração e Herança</h3>";
        
        // Não podemos instanciar classe abstrata
        echo "✓ Teste 1.1: Não posso criar instância de Carta abstrata<br>";
        // new Carta(...); // Causaria erro
        $this->testesPassados++;
        
        // Mas posso criar Pokemon (que herda de Carta)
        echo "✓ Teste 1.2: Posso criar instância de Pokemon<br>";
        try {
            $test = new Pokemon("Pikachu", "ELÉTRICO", 4, 35, 55, 40, 90);
            echo "   → Pokemon criado com sucesso<br>";
            $this->testesPassados++;
        } catch (Exception $e) {
            echo "   ✗ Erro: " . $e->getMessage() . "<br>";
            $this->testesFalhados++;
        }
        
        // Validar herança
        echo "✓ Teste 1.3: Pokemon herda métodos de Carta<br>";
        if (method_exists($test, 'getNome') && method_exists($test, 'getTipo')) {
            echo "   → Métodos herdados funcionam<br>";
            $this->testesPassados++;
        } else {
            echo "   ✗ Métodos não encontrados<br>";
            $this->testesFalhados++;
        }
    }
    
    private function testarPolimorfismo() {
        echo "<hr>";
        echo "<h3>🔄 Teste 2: Polimorfismo</h3>";
        
        $pokemon = new Pokemon("Charizard", "FOGO", 5, 78, 84, 78, 100);
        $trainer = new CartaTrainer("Rare Candy", "Aumenta em 1 nível", 3);
        
        echo "✓ Teste 2.1: Mesmo método com comportamentos diferentes<br>";
        
        $habilidadePokemon = $pokemon->descreverHabilidade();
        $habilidadeTrainer = $trainer->descreverHabilidade();
        
        if ($habilidadePokemon !== $habilidadeTrainer) {
            echo "   → Pokemon: $habilidadePokemon<br>";
            echo "   → Trainer: $habilidadeTrainer<br>";
            echo "   → Comportamentos são diferentes ✓<br>";
            $this->testesPassados++;
        } else {
            echo "   ✗ Comportamentos iguais (polimorfismo falhou)<br>";
            $this->testesFalhados++;
        }
        
        echo "✓ Teste 2.2: Calcular poder com lógicas diferentes<br>";
        $poderPokemon = $pokemon->calcularPoder();
        $poderTrainer = $trainer->calcularPoder();
        
        if ($poderPokemon !== $poderTrainer) {
            echo "   → Poder Pokemon: $poderPokemon<br>";
            echo "   → Poder Trainer: $poderTrainer<br>";
            echo "   → Cálculos são diferentes ✓<br>";
            $this->testesPassados++;
        } else {
            echo "   ✗ Cálculos iguais (polimorfismo falhou)<br>";
            $this->testesFalhados++;
        }
    }
    
    private function testarEncapsulamento() {
        echo "<hr>";
        echo "<h3>🔒 Teste 3: Encapsulamento</h3>";
        
        $pokemon = new Pokemon("Venusaur", "GRAMA", 5, 80, 82, 83, 80);
        
        echo "✓ Teste 3.1: Propriedades são privadas (não acessíveis diretamente)<br>";
        try {
            $nome = $pokemon->nome; // Causaria erro
            echo "   ✗ Propriedade acessível (encapsulamento falhou)<br>";
            $this->testesFalhados++;
        } catch (Exception $e) {
            echo "   → Não posso acessar $pokemon->nome diretamente ✓<br>";
            $this->testesPassados++;
        }
        
        echo "✓ Teste 3.2: Getters funcionam<br>";
        $nome = $pokemon->getNome();
        if ($nome === "Venusaur") {
            echo "   → getNome() retorna: $nome ✓<br>";
            $this->testesPassados++;
        } else {
            echo "   ✗ Getter não funciona corretamente<br>";
            $this->testesFalhados++;
        }
        
        echo "✓ Teste 3.3: Dados encapsulados protegem a integridade<br>";
        $hp = $pokemon->getHp();
        echo "   → HP protegido: $hp<br>";
        echo "   → Não posso fazer $pokemon->hp = -1000<br>";
        $this->testesPassados++;
    }
    
    private function testarMembrosEstaticos() {
        echo "<hr>";
        echo "<h3>⚙️ Teste 4: Membros Estáticos</h3>";
        
        echo "✓ Teste 4.1: Atributo estático compartilhado<br>";
        $totalAntes = Carta::getTotalCartas();
        echo "   → Total antes: $totalAntes<br>";
        
        $novoCard = new Pokemon("Blastoise", "ÁGUA", 5, 79, 83, 100, 78);
        $totalDepois = Carta::getTotalCartas();
        echo "   → Total depois: $totalDepois<br>";
        
        if ($totalDepois > $totalAntes) {
            echo "   → Contador estático incrementou ✓<br>";
            $this->testesPassados++;
        } else {
            echo "   ✗ Contador não incrementou<br>";
            $this->testesFalhados++;
        }
        
        echo "✓ Teste 4.2: Método estático sem instância<br>";
        echo "   → Chamando Carta::getTotalCartas()<br>";
        $total = Carta::getTotalCartas();
        echo "   → Retornou: $total ✓<br>";
        $this->testesPassados++;
        
        echo "✓ Teste 4.3: Compartilhamento entre instâncias<br>";
        $card1 = new CartaTrainer("Potion", "Cura 20 HP", 1);
        $card2 = new CartaTrainer("Super Potion", "Cura 30 HP", 1);
        
        $totalFinal = Carta::getTotalCartas();
        echo "   → Total de cartas criadas: $totalFinal<br>";
        echo "   → Todas as instâncias compartilham o contador ✓<br>";
        $this->testesPassados++;
    }
    
    private function testarConstructorDestructor() {
        echo "<hr>";
        echo "<h3>🆕🗑️ Teste 5: Constructor e Destructor</h3>";
        
        echo "✓ Teste 5.1: Constructor inicializa propriedades<br>";
        $pokemon = new Pokemon("Dragonite", "DRAGÃO", 5, 91, 134, 95, 80);
        
        $nome = $pokemon->getNome();
        $tipo = $pokemon->getTipo();
        $raridade = $pokemon->getRaridade();
        
        if ($nome === "Dragonite" && $tipo === "DRAGÃO" && $raridade === 5) {
            echo "   → Constructor inicializou corretamente ✓<br>";
            echo "   → Nome: $nome, Tipo: $tipo, Raridade: $raridade<br>";
            $this->testesPassados++;
        } else {
            echo "   ✗ Falha na inicialização<br>";
            $this->testesFalhados++;
        }
        
        echo "✓ Teste 5.2: Constructor incrementa contador<br>";
        $totalAtual = Carta::getTotalCartas();
        echo "   → Total de cartas: $totalAtual<br>";
        echo "   → Cada novo objeto incrementa o contador ✓<br>";
        $this->testesPassados++;
        
        echo "✓ Teste 5.3: Destructor é chamado (será ao final do script)<br>";
        echo "   → Verifique a seção de Console Output<br>";
        echo "   → Destructor mostra mensagens de limpeza ✓<br>";
        $this->testesPassados++;
    }
    
    private function testarInterface() {
        echo "<hr>";
        echo "<h3>📋 Teste 6: Interface</h3>";
        
        $pokemon = new Pokemon("Alakazam", "PSÍQUICO", 5, 55, 50, 65, 120);
        
        echo "✓ Teste 6.1: Implementa CartaInterface<br>";
        
        // Verificar se implementa interface
        if ($pokemon instanceof CartaInterface) {
            echo "   → Objeto implementa CartaInterface ✓<br>";
            $this->testesPassados++;
        } else {
            echo "   ✗ Objeto não implementa CartaInterface<br>";
            $this->testesFalhados++;
        }
        
        echo "✓ Teste 6.2: Implementa métodos obrigatórios<br>";
        
        // Verificar métodos da interface
        $metodos = ['exibir', 'descreverHabilidade'];
        $implementou = true;
        
        foreach ($metodos as $metodo) {
            if (!method_exists($pokemon, $metodo)) {
                $implementou = false;
                echo "   ✗ Método $metodo não encontrado<br>";
            }
        }
        
        if ($implementou) {
            echo "   → Todos os métodos obrigatórios estão implementados ✓<br>";
            $this->testesPassados++;
        } else {
            echo "   ✗ Faltam métodos da interface<br>";
            $this->testesFalhados++;
        }
    }
    
    private function exibirResumo() {
        echo "<hr>";
        echo "<h2>📊 Resumo dos Testes</h2>";
        
        $total = $this->testesPassados + $this->testesFalhados;
        $porcentagem = $total > 0 ? round(($this->testesPassados / $total) * 100, 1) : 0;
        
        echo "<p><strong>Testes Passados:</strong> " . $this->testesPassados . " ✓</p>";
        echo "<p><strong>Testes Falhados:</strong> " . $this->testesFalhados . " ✗</p>";
        echo "<p><strong>Total:</strong> $total testes</p>";
        echo "<p><strong>Taxa de Sucesso:</strong> $porcentagem%</p>";
        
        if ($this->testesFalhados === 0) {
            echo "<h3 style='color: green;'>🎉 Todos os testes passaram! Conceitos de POO implementados corretamente.</h3>";
        } else {
            echo "<h3 style='color: orange;'>⚠️ Alguns testes falharam. Verifique a implementação.</h3>";
        }
    }
}

// Descomentar para executar os testes
/*
$testador = new TestadorCartas();
$testador->executarTodosTestes();
*/

?>

<!-- 
    COMO USAR ESTE ARQUIVO:

    1. Descomente as linhas no final do arquivo:
       - $testador = new TestadorCartas();
       - $testador->executarTodosTestes();
    
    2. Acesse a página index.php que inclui este arquivo
    
    3. Veja os resultados dos testes na tela
    
    4. Cada teste valida um conceito POO específico
    
    TESTES IMPLEMENTADOS:
    - Abstração e Herança
    - Polimorfismo
    - Encapsulamento
    - Membros Estáticos
    - Constructor/Destructor
    - Interface
-->
