<?php
/**
 * ===============================================================
 * CLASSES ADICIONAIS PARA EXPANDIR O SISTEMA
 * ===============================================================
 * 
 * Copie estas classes no seu index.php para adicionar novos tipos
 * de cartas ao sistema!
 * 
 * ===============================================================
 */

// ===== CLASSE ADICIONAL 1: CARTA DE ENERGIA =====
class CartaEnergia extends Carta {
    private $energiaTipo;
    private $quantidadeEnergia;
    
    public function __construct($nome, $energiaTipo, $quantidade = 1, $raridadeEmEstrelas = 1) {
        parent::__construct($nome, "ENERGIA", $raridadeEmEstrelas);
        $this->energiaTipo = $energiaTipo;
        $this->quantidadeEnergia = max(1, min(10, $quantidade));
    }
    
    public function getEnergiaTipo() {
        return $this->energiaTipo;
    }
    
    public function getQuantidadeEnergia() {
        return $this->quantidadeEnergia;
    }
    
    // Implementação do método abstrato (Polimorfismo)
    public function descreverHabilidade() {
        return "Fornece {$this->quantidadeEnergia} de energia {$this->energiaTipo}";
    }
    
    // Implementação do método abstrato (Polimorfismo)
    public function calcularPoder() {
        return $this->quantidadeEnergia * 15;
    }
    
    // Método sobrescrito (Polimorfismo)
    public function exibir() {
        return parent::exibir() . " | Energia: {$this->energiaTipo} ({$this->quantidadeEnergia})";
    }
}

// ===== CLASSE ADICIONAL 2: POKÉMON EVOLUÍDO =====
class PokemonEvoluido extends Pokemon {
    private $pokemonAnterior;
    private $evolucaoNivel;
    
    public function __construct($nome, $tipo, $raridadeEmEstrelas, $hp, $ataque, $defesa, $velocidade, $pokemonAnterior, $evolucaoNivel = 2) {
        parent::__construct($nome, $tipo, $raridadeEmEstrelas, $hp, $ataque, $defesa, $velocidade);
        $this->pokemonAnterior = $pokemonAnterior;
        $this->evolucaoNivel = $evolucaoNivel;
    }
    
    public function getPokemonAnterior() {
        return $this->pokemonAnterior;
    }
    
    public function getEvolucaoNivel() {
        return $this->evolucaoNivel;
    }
    
    // Método sobrescrito (Polimorfismo)
    public function descreverHabilidade() {
        return "[EVOLUÍDO] " . parent::descreverHabilidade();
    }
    
    // Método sobrescrito com cálculo especial (Polimorfismo)
    public function calcularPoder() {
        $poderBase = parent::calcularPoder();
        return $poderBase * 1.3; // Pokémon evoluído tem 30% mais poder
    }
}

// ===== CLASSE ADICIONAL 3: ITEM ESPECIAL =====
class ItemEspecial extends Carta {
    private $efeito;
    private $cooldown; // Turnos até poder usar novamente
    private $usoUnico;
    
    public function __construct($nome, $efeito, $cooldown = 0, $usoUnico = false, $raridadeEmEstrelas = 2) {
        parent::__construct($nome, "ITEM", $raridadeEmEstrelas);
        $this->efeito = $efeito;
        $this->cooldown = $cooldown;
        $this->usoUnico = $usoUnico;
    }
    
    public function getEfeito() {
        return $this->efeito;
    }
    
    public function getCooldown() {
        return $this->cooldown;
    }
    
    public function isUsoUnico() {
        return $this->usoUnico;
    }
    
    // Implementação do método abstrato (Polimorfismo)
    public function descreverHabilidade() {
        $uso = $this->usoUnico ? " [USO ÚNICO]" : "";
        $cd = $this->cooldown > 0 ? " [COOLDOWN: {$this->cooldown} turnos]" : "";
        return "Efeito Item: {$this->efeito}{$uso}{$cd}";
    }
    
    // Implementação do método abstrato (Polimorfismo)
    public function calcularPoder() {
        return 40 + ($this->cooldown * 5);
    }
    
    // Método sobrescrito (Polimorfismo)
    public function exibir() {
        return parent::exibir() . " | Cooldown: {$this->cooldown}T";
    }
}

// ===== CLASSE ADICIONAL 4: SUPORTE DE DECK =====
interface DeckInterface {
    public function adicionarCarta($carta);
    public function removerCarta($nome);
    public function contarCartas();
    public function listarCartas();
    public function calcularPoderTotal();
}

class Deck implements DeckInterface {
    private $nome;
    private $cartas = [];
    private static $maxCartas = 60;
    
    public function __construct($nome) {
        $this->nome = $nome;
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function adicionarCarta($carta) {
        if (count($this->cartas) < self::$maxCartas) {
            $this->cartas[] = $carta;
            return true;
        }
        return false;
    }
    
    public function removerCarta($nome) {
        foreach ($this->cartas as $chave => $carta) {
            if ($carta->getNome() === $nome) {
                unset($this->cartas[$chave]);
                return true;
            }
        }
        return false;
    }
    
    public function contarCartas() {
        return count($this->cartas);
    }
    
    public function listarCartas() {
        return $this->cartas;
    }
    
    public function calcularPoderTotal() {
        $poderTotal = 0;
        foreach ($this->cartas as $carta) {
            $poderTotal += $carta->calcularPoder();
        }
        return $poderTotal;
    }
    
    public function estaCompleto() {
        return count($this->cartas) >= self::$maxCartas;
    }
}

// ===== CLASSE ADICIONAL 5: GERENCIADOR DE CARTAS ESTÁTICO =====
class GerenciadorCartas {
    private static $registroCartas = [];
    private static $contador = 0;
    
    // Método estático para registrar uma carta
    public static function registrarCarta($carta) {
        self::$registroCartas[] = [
            'nome' => $carta->getNome(),
            'tipo' => $carta->getTipo(),
            'poder' => $carta->calcularPoder(),
            'timestamp' => date('Y-m-d H:i:s')
        ];
        self::$contador++;
    }
    
    // Método estático para obter estatísticas
    public static function obterEstatisticas() {
        return [
            'total' => self::$contador,
            'cartas' => self::$registroCartas
        ];
    }
    
    // Método estático para encontrar a carta mais poderosa
    public static function encontrarMaisPoderosa() {
        if (empty(self::$registroCartas)) return null;
        
        return array_reduce(self::$registroCartas, function($max, $atual) {
            return ($atual['poder'] > ($max['poder'] ?? 0)) ? $atual : $max;
        }, null);
    }
    
    // Método estático para filtrar por tipo
    public static function filtrarPorTipo($tipo) {
        return array_filter(self::$registroCartas, function($carta) use ($tipo) {
            return $carta['tipo'] === $tipo;
        });
    }
}

/**
 * ===============================================================
 * COMO USAR ESTAS CLASSES
 * ===============================================================
 * 
 * 1. COPIE TODAS AS CLASSES ACIMA PARA SEU index.php
 * 2. CRIE INSTÂNCIAS COMO EXEMPLOS ABAIXO:
 * 
 * // Criar uma energia
 * $energiaFogo = new CartaEnergia("Energia Fogo", "FOGO", 2, 3);
 * 
 * // Criar um Pokémon evoluído
 * $charizardX = new PokemonEvoluido(
 *     "Charizard-X",
 *     "FOGO",
 *     5,
 *     90,
 *     110,
 *     95,
 *     120,
 *     "Charizard",
 *     2
 * );
 * 
 * // Criar um item especial
 * $pokaball = new ItemEspecial(
 *     "Poké Ball",
 *     "Capture um Pokémon selvagem",
 *     2,
 *     false,
 *     2
 * );
 * 
 * // Criar um deck
 * $meuDeck = new Deck("Deck Competitivo");
 * $meuDeck->adicionarCarta($pikachu);
 * $meuDeck->adicionarCarta($energiaFogo);
 * 
 * // Usar o gerenciador
 * GerenciadorCartas::registrarCarta($charizardX);
 * $stats = GerenciadorCartas::obterEstatisticas();
 * 
 * ===============================================================
 */
?>
