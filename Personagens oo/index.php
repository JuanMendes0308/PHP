<?php
// ===== INTERFACES =====
interface CartaInterface {
    public function exibir();
    public function descreverHabilidade();
}

// ===== CLASSE ABSTRATA =====
abstract class Carta implements CartaInterface {
    // Propriedades privadas (Encapsulamento)
    private $nome;
    private $id;
    private $tipo;
    private $raridadeEmEstrelas;
    
    // Atributo estático (Encapsulamento + Estático)
    private static $totalCartas = 0;
    private static $cartasRegistradas = [];
    
    // Construct
    public function __construct($nome, $tipo, $raridadeEmEstrelas = 1) {
        $this->nome = $nome;
        $this->tipo = $tipo;
        $this->raridadeEmEstrelas = max(1, min(5, $raridadeEmEstrelas));
        $this->id = uniqid();
        
        self::$totalCartas++;
        self::$cartasRegistradas[] = $this;
        
        echo "[CONSTRUTOR] Carta '{$nome}' criada! Total: " . self::$totalCartas . "<br>";
    }
    
    // Destruct
    public function __destruct() {
        echo "[DESTRUTOR] Carta '{$this->nome}' destruída<br>";
    }
    
    // Getters (Encapsulamento)
    public function getNome() {
        return $this->nome;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getTipo() {
        return $this->tipo;
    }
    
    public function getRaridade() {
        return $this->raridadeEmEstrelas;
    }
    
    // Método estático
    public static function getTotalCartas() {
        return self::$totalCartas;
    }
    
    public static function listarTodasAsCartas() {
        return self::$cartasRegistradas;
    }
    
    // Método abstrato (Abstração)
    abstract public function descreverHabilidade();
    
    // Método abstrato (Abstração)
    abstract public function calcularPoder();
    
    // Método concreto
    public function exibir() {
        return sprintf(
            "📋 Nome: %s | Tipo: %s | Raridade: %s | ID: %s",
            $this->nome,
            $this->tipo,
            str_repeat("⭐", $this->raridadeEmEstrelas),
            substr($this->id, -6)
        );
    }
}

// ===== CLASSE FILHA COM HERANÇA =====
class Pokemon extends Carta {
    private $hp;
    private $ataque;
    private $defesa;
    private $velocidade;
    
    public function __construct($nome, $tipo, $raridadeEmEstrelas, $hp, $ataque, $defesa, $velocidade) {
        parent::__construct($nome, $tipo, $raridadeEmEstrelas);
        $this->hp = $hp;
        $this->ataque = $ataque;
        $this->defesa = $defesa;
        $this->velocidade = $velocidade;
    }
    
    // Getters
    public function getHp() { return $this->hp; }
    public function getAtaque() { return $this->ataque; }
    public function getDefesa() { return $this->defesa; }
    public function getVelocidade() { return $this->velocidade; }
    
    // Implementação do método abstrato (Polimorfismo)
    public function descreverHabilidade() {
        return "Ataque Tipo {$this->getTipo()}: Causa {$this->ataque} de dano";
    }
    
    // Implementação do método abstrato (Polimorfismo)
    public function calcularPoder() {
        return ($this->ataque + $this->defesa + $this->velocidade + ($this->hp / 2));
    }
    
    // Método sobrescrito (Polimorfismo)
    public function exibir() {
        return parent::exibir() . " | HP: {$this->hp} | ATK: {$this->ataque} | DEF: {$this->defesa} | VEL: {$this->velocidade}";
    }
}

// ===== CLASSE FILHA COM HERANÇA =====
class CartaTrainer extends Carta {
    private $efeito;
    
    public function __construct($nome, $efeito, $raridadeEmEstrelas = 2) {
        parent::__construct($nome, "TRAINER", $raridadeEmEstrelas);
        $this->efeito = $efeito;
    }
    
    public function getEfeito() {
        return $this->efeito;
    }
    
    // Implementação do método abstrato (Polimorfismo)
    public function descreverHabilidade() {
        return "Efeito Trainer: {$this->efeito}";
    }
    
    // Implementação do método abstrato (Polimorfismo)
    public function calcularPoder() {
        return 50;
    }
    
    // Método sobrescrito (Polimorfismo)
    public function exibir() {
        return parent::exibir() . " | Efeito: {$this->efeito}";
    }
}

// ===== BACK-END: CRIANDO INSTÂNCIAS =====
// Criar alguns Pokémons
$pikachu = new Pokemon("Pikachu", "ELÉTRICO", 4, 35, 55, 40, 90);
$charizard = new Pokemon("Charizard", "FOGO", 5, 78, 84, 78, 100);
$blastoise = new Pokemon("Blastoise", "ÁGUA", 5, 79, 83, 100, 78);
$venusaur = new Pokemon("Venusaur", "GRAMA", 5, 80, 82, 83, 80);

// Criar Cartas Trainer
$rare_candy = new CartaTrainer("Rare Candy", "Aumenta em 1 nível de evolução", 3);
$potion = new CartaTrainer("Super Potion", "Recupera 20 de HP", 1);

// Coleta de cartas para exibição
$cartas = [
    $pikachu,
    $charizard,
    $blastoise,
    $venusaur,
    $rare_candy,
    $potion
];

$cartasData = [];
foreach ($cartas as $carta) {
    $cartasData[] = [
        'nome' => $carta->getNome(),
        'tipo' => $carta->getTipo(),
        'raridade' => $carta->getRaridade(),
        'exibicao' => $carta->exibir(),
        'habilidade' => $carta->descreverHabilidade(),
        'poder' => $carta->calcularPoder()
    ];
}

$selectedIndex = isset($_GET['selected']) ? intval($_GET['selected']) : null;
$selectedCard = null;
if ($selectedIndex !== null && array_key_exists($selectedIndex, $cartas)) {
    $selectedCard = $cartas[$selectedIndex];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon TCG - POO em PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1>🎴 Pokémon Trading Card Game</h1>
            <p>Programação Orientada a Objetos em PHP</p>
            <div class="stats">
                <span>Total de Cartas: <?php echo Carta::getTotalCartas(); ?></span>
            </div>
        </div>
    </header>

    <main class="container">
        
        <section class="selected-card">
            <h2>🎯 Carta Selecionada</h2>
            <?php if ($selectedCard): ?>
                <p><strong>Nome:</strong> <?php echo $selectedCard->getNome(); ?></p>
                <p><strong>Tipo:</strong> <?php echo $selectedCard->getTipo(); ?></p>
                <p><strong>Raridade:</strong> <?php echo str_repeat("⭐", $selectedCard->getRaridade()); ?></p>
                <p><strong>Poder:</strong> <?php echo round($selectedCard->calcularPoder(), 1); ?></p>
                <p><strong>Habilidade:</strong> <?php echo $selectedCard->descreverHabilidade(); ?></p>
                <p><a href="?" class="reset-selection">Escolher outra carta</a></p>
            <?php else: ?>
                <p>Escolha uma carta abaixo clicando no card.</p>
            <?php endif; ?>
        </section>

        <section class="cartas-container">
            <h2>🎴 Cartas Disponíveis</h2>
            <div class="cartas-grid">
                <?php foreach ($cartasData as $idx => $carta): ?>
                    <a href="?selected=<?php echo $idx; ?>" class="card-link">
                        <div class="carta <?php echo strtolower($carta['tipo']); ?><?php echo ($selectedIndex === $idx ? ' selected' : ''); ?>">
                            <div class="carta-header">
                                <h3><?php echo $carta['nome']; ?></h3>
                                <span class="tipo-badge"><?php echo $carta['tipo']; ?></span>
                            </div>
                            
                            <div class="carta-content">
                                <div class="raridade">
                                    <?php echo str_repeat("⭐", $carta['raridade']); ?>
                                </div>
                                
                                <div class="poder-meter">
                                    <label>Poder: </label>
                                    <div class="meter-bar">
                                        <div class="meter-fill" style="width: <?php echo min(100, ($carta['poder'] / 200) * 100); ?>%"></div>
                                    </div>
                                    <span><?php echo round($carta['poder'], 1); ?></span>
                                </div>
                                
                                <div class="habilidade">
                                    <strong>Habilidade:</strong>
                                    <p><?php echo $carta['habilidade']; ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>

    </main>

    <footer class="footer">
        <p>Desenvolvido com 🎴 PHP POO</p>
    </footer></body>
</html>