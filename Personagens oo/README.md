# 🎴 Pokémon Trading Card Game - POO em PHP

Aplicação completa de gerenciamento de cartas Pokémon desenvolvida em PHP com implementação de todos os conceitos fundamentais de Programação Orientada a Objetos.

## 📋 Conceitos de POO Implementados

### 1. **Abstração** 🏗️
- **Classe Abstrata:** `Carta` é uma classe abstrata que define a estrutura geral de todas as cartas
- **Métodos Abstratos:** `descreverHabilidade()` e `calcularPoder()` obrigam as classes filhas a implementarem sua própria versão
- **Interface:** `CartaInterface` define o contrato que todas as cartas devem seguir

```php
abstract class Carta implements CartaInterface {
    abstract public function descreverHabilidade();
    abstract public function calcularPoder();
}
```

### 2. **Herança** 🧬
- **Classe Filha 1:** `Pokemon` herda de `Carta`
- **Classe Filha 2:** `CartaTrainer` herda de `Carta`
- Ambas herdam propriedades e métodos da classe pai usando `parent::`

```php
class Pokemon extends Carta {
    public function __construct($nome, $tipo, $raridadeEmEstrelas, $hp, $ataque, $defesa, $velocidade) {
        parent::__construct($nome, $tipo, $raridadeEmEstrelas);
        // Propriedades específicas de Pokemon
    }
}
```

### 3. **Polimorfismo** 🔄
- Métodos sobrescritos com comportamentos diferentes em cada subclasse
- `descreverHabilidade()`: Pokemon descreve ataque, Trainer descreve efeito
- `calcularPoder()`: Cada tipo calcula poder de forma diferente
- `exibir()`: Cada classe personaliza a exibição

```php
// Pokemon
public function descreverHabilidade() {
    return "Ataque Tipo {$this->getTipo()}: Causa {$this->ataque} de dano";
}

// CartaTrainer
public function descreverHabilidade() {
    return "Efeito Trainer: {$this->efeito}";
}
```

### 4. **Encapsulamento** 🔒
- Todas as propriedades são **privadas**
- Acesso controlado através de **getters públicos**
- Dados protegidos contra modificações indevidas

```php
private $nome;
private $hp;
private $ataque;

public function getNome() { return $this->nome; }
public function getHp() { return $this->hp; }
public function getAtaque() { return $this->ataque; }
```

### 5. **Interface** 📋
- Interface `CartaInterface` define os métodos que toda carta deve implementar
- Garante contrato entre diferentes tipos de cartas
- Implementada pela classe abstrata `Carta`

```php
interface CartaInterface {
    public function exibir();
    public function descreverHabilidade();
}
```

### 6. **Membros Estáticos** ⚙️
- **Atributo Estático:** `$totalCartas` conta o número total de cartas criadas
- **Método Estático:** `getTotalCartas()` retorna o contador
- Compartilhado por todas as instâncias da classe

```php
private static $totalCartas = 0;
private static $cartasRegistradas = [];

public static function getTotalCartas() {
    return self::$totalCartas;
}
```

### 7. **Construtor (Constructor)** 🆕
- Inicializa as propriedades de cada objeto
- Incrementa o contador estático
- Registra a carta na lista estática
- Exibe mensagem de criação no console

```php
public function __construct($nome, $tipo, $raridadeEmEstrelas = 1) {
    $this->nome = $nome;
    $this->tipo = $tipo;
    $this->raridadeEmEstrelas = max(1, min(5, $raridadeEmEstrelas));
    
    self::$totalCartas++;
    self::$cartasRegistradas[] = $this;
}
```

### 8. **Destrutor (Destructor)** 🗑️
- Executado quando um objeto é destruído
- Libera recursos e exibe mensagem de finalização
- Útil para logging e limpeza de dados

```php
public function __destruct() {
    echo "[DESTRUTOR] Carta '{$this->nome}' destruída<br>";
}
```

## 📁 Estrutura do Projeto

```
Personagens oo/
├── index.php          # Front-end + Back-end PHP
├── style.css          # Estilos CSS
└── README.md          # Este arquivo
```

## 🎯 Classes Principais

### Classe Abstrata: Carta
**Responsabilidades:**
- Define a estrutura de todas as cartas
- Implementa métodos concretos (exibir)
- Força subclasses a implementarem métodos abstratos

**Propriedades:**
- `nome`: Nome da carta
- `id`: ID único
- `tipo`: Tipo de carta (POKÉMON, TRAINER, etc)
- `raridadeEmEstrelas`: Raridade de 1 a 5 estrelas

### Classe: Pokemon
**Herda de:** Carta

**Propriedades Adicionais:**
- `hp`: Pontos de vida
- `ataque`: Poder de ataque
- `defesa`: Poder de defesa
- `velocidade`: Velocidade

**Métodos Especiais:**
- `calcularPoder()`: Retorna valor calculado (ATK + DEF + VEL + HP/2)

### Classe: CartaTrainer
**Herda de:** Carta

**Propriedades Adicionais:**
- `efeito`: Descrição do efeito da carta trainer

**Métodos Especiais:**
- `calcularPoder()`: Sempre retorna 50

## 🎴 Cartas Disponíveis

### Pokémons
1. **Pikachu** - Tipo Elétrico, Raridade ⭐⭐⭐⭐
2. **Charizard** - Tipo Fogo, Raridade ⭐⭐⭐⭐⭐
3. **Blastoise** - Tipo Água, Raridade ⭐⭐⭐⭐⭐
4. **Venusaur** - Tipo Grama, Raridade ⭐⭐⭐⭐⭐

### Cartas Trainer
1. **Rare Candy** - Aumenta em 1 nível de evolução, Raridade ⭐⭐⭐
2. **Super Potion** - Recupera 20 de HP, Raridade ⭐

## 🌟 Recursos

- ✅ Design responsivo e moderno
- ✅ Cards com cores específicas por tipo
- ✅ Barra de poder visual
- ✅ Efeitos de hover interativos
- ✅ Console de saída mostrando constructor/destructor
- ✅ Documentação de conceitos POO integrada
- ✅ Animações suaves de entrada

## 🚀 Como Executar

1. Certifique-se de ter XAMPP/Apache instalado
2. Coloque os arquivos em `htdocs/juan/Personagens oo/`
3. Acesse no navegador: `http://localhost/juan/Personagens%20oo/`

## 💡 Diagramas de Relacionamento

```
┌─────────────────────┐
│  CartaInterface     │
│   - exibir()        │
│   - descrever...()  │
└──────────┬──────────┘
           │
           │ implements
           │
     ┌─────▼──────────┐
     │  Carta         │
     │  (Abstrata)    │
     ├────────────────┤
     │- nome          │
     │- id            │
     │- tipo          │
     │- raridade      │
     │+ getTotalCartas() (static)
     └──────┬─────────┘
            │ herança
            │
    ┌───────┴────────┐
    │                │
┌───▼────────┐  ┌───▼──────────┐
│  Pokemon   │  │ CartaTrainer │
│            │  │              │
│- hp        │  │- efeito      │
│- ataque    │  │              │
│- defesa    │  │+ descrever...│
│- velocidade│  │+ calcularPoder()
└────────────┘  └──────────────┘
```

## 📝 Notas Importantes

- O construtor é executado automaticamente ao criar uma nova instância
- O destrutor é executado automaticamente ao final do script (ou quando o objeto é destruído)
- Os membros estáticos são compartilhados entre todas as instâncias
- O encapsulamento protege os dados internos
- O polimorfismo permite comportamentos diferentes para métodos com mesmo nome
- A herança promove reutilização de código

## 👨‍💻 Autor

Desenvolvido como exemplo educativo de POO em PHP.

---

**Data:** 12 de maio de 2026  
**Linguagem:** PHP 7.4+  
**Conceitos:** POO Avançada
