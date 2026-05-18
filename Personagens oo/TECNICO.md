# 📚 Resumo Técnico - Conceitos de POO Implementados

## 🎯 Mapa Mental dos Conceitos

```
                          PROGRAMAÇÃO ORIENTADA A OBJETOS
                                      |
                 _________________________________________
                |         |          |         |         |
            ABSTRAÇÃO  HERANÇA  POLIMORFISMO ENCAPSUL.  INTERFACE
                |         |          |         |         |
            (Como?)   (Reutilizar)  (Flexível) (Proteção)(Contrato)
```

---

## 1. 🏗️ ABSTRAÇÃO

### O que é?
Focar apenas nos detalhes relevantes, ocultando a complexidade.

### Como foi implementado:
```php
abstract class Carta implements CartaInterface {
    abstract public function descreverHabilidade();
    abstract public function calcularPoder();
    
    public function exibir() {
        // Implementação concreta
    }
}
```

### Benefícios:
- ✅ Define interface clara para todas as cartas
- ✅ Força subclasses a implementarem métodos essenciais
- ✅ Reduz complexidade

### Exemplo no projeto:
- Classe abstrata `Carta` com dois métodos abstratos
- Força `Pokemon` e `CartaTrainer` a implementarem suas versões

---

## 2. 🧬 HERANÇA

### O que é?
Uma classe filha herda propriedades e métodos de uma classe pai.

### Como foi implementado:
```php
class Pokemon extends Carta {
    public function __construct(...) {
        parent::__construct($nome, $tipo, $raridade);
        // Inicializar propriedades específicas
    }
}
```

### Benefícios:
- ✅ Reutilização de código (DRY)
- ✅ Criação de hierarquias lógicas
- ✅ Facilita manutenção

### Hierarquia no projeto:
```
Carta (Pai)
├── Pokemon (Filho)
└── CartaTrainer (Filho)
```

### Exemplo no projeto:
- `Pokemon` e `CartaTrainer` herdam de `Carta`
- Usam `parent::__construct()` para inicializar o pai

---

## 3. 🔄 POLIMORFISMO

### O que é?
Objetos de diferentes tipos respondendo ao mesmo método de formas diferentes.

### Como foi implementado:
```php
// Classe pai
public function descreverHabilidade() {
    // abstrata
}

// Classe filha 1
public function descreverHabilidade() {
    return "Ataque Tipo " . $this->tipo . ": " . $this->ataque . " dano";
}

// Classe filha 2
public function descreverHabilidade() {
    return "Efeito Trainer: " . $this->efeito;
}
```

### Benefícios:
- ✅ Código mais flexível e extensível
- ✅ Fácil adicionar novos tipos
- ✅ Reduz duplicação de código

### Exemplo no projeto:
```php
// Mesmo método, comportamentos diferentes
$pikachu->descreverHabilidade();    // "Ataque Tipo ELÉTRICO: 55 dano"
$rareCandy->descreverHabilidade();  // "Efeito Trainer: Aumenta em 1 nível..."

// Todos têm método calcularPoder() mas com lógicas diferentes
$pikachu->calcularPoder();      // ATK + DEF + VEL + HP/2
$rareCandy->calcularPoder();    // Sempre 50
```

---

## 4. 🔒 ENCAPSULAMENTO

### O que é?
Proteger dados internos do objeto, permitindo acesso apenas através de métodos controlados.

### Como foi implementado:
```php
class Carta {
    // Propriedades PRIVADAS
    private $nome;
    private $hp;
    private $ataque;
    
    // GETTERS públicos (acesso protegido)
    public function getNome() {
        return $this->nome;
    }
    
    public function getAtaque() {
        return $this->ataque;
    }
    
    // Poderia ter SETTERS com validação
    public function setAtaque($novo) {
        if ($novo > 0 && $novo < 255) {
            $this->ataque = $novo;
        }
    }
}
```

### Benefícios:
- ✅ Proteção contra modificações indevidas
- ✅ Validação de dados
- ✅ Interface clara de uso
- ✅ Facilita refatoração interna

### Exemplo no projeto:
```php
$pikachu = new Pokemon("Pikachu", ..., 55, ...);

// ✓ Correto
$ataque = $pikachu->getAtaque();

// ✗ Erro (propriedade é privada)
echo $pikachu->ataque;  // Fatal Error!
```

---

## 5. 📋 INTERFACE

### O que é?
Um contrato que define quais métodos uma classe DEVE implementar.

### Como foi implementado:
```php
interface CartaInterface {
    public function exibir();
    public function descreverHabilidade();
}

// Classe implementa a interface
class Carta implements CartaInterface {
    public function exibir() { ... }
    public function descreverHabilidade() { ... }
}
```

### Benefícios:
- ✅ Define contrato claro
- ✅ Garante consistência
- ✅ Facilita trabalho em equipe
- ✅ Permite type hinting

### Exemplo no projeto:
```php
// Interface garante que qualquer CartaInterface tem estes métodos
function exibirInformacoes(CartaInterface $carta) {
    echo $carta->exibir();
    echo $carta->descreverHabilidade();
}

// Funciona com qualquer classe que implemente CartaInterface
exibirInformacoes($pikachu);
exibirInformacoes($rareCandy);
```

---

## 6. ⚙️ MEMBROS ESTÁTICOS (Static)

### O que é?
Propriedades e métodos compartilhados por TODAS as instâncias da classe.

### Como foi implementado:
```php
class Carta {
    // Propriedade estática - compartilhada
    private static $totalCartas = 0;
    private static $cartasRegistradas = [];
    
    public function __construct() {
        // Incrementa contador global
        self::$totalCartas++;
        self::$cartasRegistradas[] = $this;
    }
    
    // Método estático - acessa dados compartilhados
    public static function getTotalCartas() {
        return self::$totalCartas;
    }
}
```

### Benefícios:
- ✅ Dados compartilhados entre instâncias
- ✅ Métodos utilitários sem instância
- ✅ Contadores e registros globais
- ✅ Melhor controle de recursos

### Exemplo no projeto:
```php
$carta1 = new Pokemon(...);  // $totalCartas = 1
$carta2 = new Pokemon(...);  // $totalCartas = 2
$carta3 = new Pokemon(...);  // $totalCartas = 3

// Acessar método estático sem instância
echo Carta::getTotalCartas(); // 3

// Cada instância compartilha o mesmo contador
```

---

## 7. 🆕 CONSTRUTOR (Constructor)

### O que é?
Método especial executado automaticamente quando um objeto é criado.

### Como foi implementado:
```php
class Carta {
    private $nome;
    private $tipo;
    
    // Construtor - executado em new Carta()
    public function __construct($nome, $tipo, $raridade = 1) {
        $this->nome = $nome;
        $this->tipo = $tipo;
        $this->raridadeEmEstrelas = $raridade;
        
        // Incrementar contador estático
        self::$totalCartas++;
        
        // Registrar carta
        self::$cartasRegistradas[] = $this;
        
        echo "[CONSTRUTOR] Carta criada!";
    }
}
```

### Benefícios:
- ✅ Inicialização automática
- ✅ Garante estado válido desde o início
- ✅ Registros automáticos
- ✅ Configuração padrão de valores

### Exemplo no projeto:
```php
// Construtor é chamado automaticamente
$pikachu = new Pokemon("Pikachu", "ELÉTRICO", 4, 35, 55, 40, 90);
// [CONSTRUTOR] Carta 'Pikachu' criada! Total: 1

// Todas as propriedades já estão inicializadas
echo $pikachu->getNome();     // "Pikachu"
echo $pikachu->getHp();       // 35
```

---

## 8. 🗑️ DESTRUTOR (Destructor)

### O que é?
Método especial executado automaticamente quando um objeto é destruído.

### Como foi implementado:
```php
class Carta {
    // Destrutor - executado quando objeto é destruído
    public function __destruct() {
        echo "[DESTRUTOR] Carta '{$this->nome}' destruída";
        // Liberar recursos se necessário
    }
}
```

### Benefícios:
- ✅ Limpeza automática de recursos
- ✅ Fechar conexões de banco de dados
- ✅ Registrar eventos de finalização
- ✅ Liberar memória

### Quando é executado:
- Fim do script PHP
- Quando variável é destruída: `unset($objeto)`
- Quando variável sai do escopo

### Exemplo no projeto:
```php
$pikachu = new Pokemon(...);
$charizard = new Pokemon(...);

echo "Fim do script";
// [DESTRUTOR] Carta 'Pikachu' destruída
// [DESTRUTOR] Carta 'Charizard' destruída
```

---

## 📊 Tabela Comparativa

| Conceito | Propósito | Nível | Implementação |
|----------|-----------|-------|----------------|
| **Abstração** | Ocultar complexidade | Alto | Classes abstratas + interfaces |
| **Herança** | Reutilizar código | Médio | `extends` |
| **Polimorfismo** | Flexibilidade | Médio | Métodos sobrescritos |
| **Encapsulamento** | Proteção de dados | Médio | `private` + getters/setters |
| **Interface** | Definir contrato | Médio | `implements` |
| **Estáticos** | Dados compartilhados | Baixo | `static` keyword |
| **Constructor** | Inicialização | Baixo | `__construct()` |
| **Destructor** | Limpeza | Baixo | `__destruct()` |

---

## 🔗 Relacionamentos no Projeto

```
┌─────────────────────────────────────────────────────────┐
│             CartaInterface (Interface)                  │
│  - exibir(): void                                       │
│  - descreverHabilidade(): string                        │
└──────────────────┬──────────────────────────────────────┘
                   │ implements
                   ↓
┌─────────────────────────────────────────────────────────┐
│           Carta (Classe Abstrata)                       │
│                                                         │
│  Propriedades (privadas):                               │
│  - nome: string                                         │
│  - id: string                                           │
│  - tipo: string                                         │
│  - raridade: int                                        │
│                                                         │
│  Estáticos:                                             │
│  - totalCartas: int                                     │
│  - cartasRegistradas: array                             │
│                                                         │
│  Métodos Abstratos:                                     │
│  - descreverHabilidade(): string                        │
│  - calcularPoder(): float                               │
│                                                         │
│  Métodos Concretos:                                     │
│  + __construct()                                        │
│  + __destruct()                                         │
│  + exibir(): string                                     │
│  + getTotalCartas(): int (static)                       │
└──────────┬──────────────────────────┬───────────────────┘
           │ extends                  │ extends
           ↓                          ↓
    ┌────────────────────┐    ┌─────────────────────┐
    │     Pokemon        │    │   CartaTrainer      │
    ├────────────────────┤    ├─────────────────────┤
    │- hp: int           │    │- efeito: string     │
    │- ataque: int       │    │                     │
    │- defesa: int       │    │Methods:             │
    │- velocidade: int   │    │+ descrever...()     │
    │                    │    │+ calcularPoder()    │
    │Methods:            │    │+ exibir()           │
    │+ descrever...()    │    └─────────────────────┘
    │+ calcularPoder()   │
    │+ exibir()          │
    └────────────────────┘
```

---

## 💡 Princípios SOLID Aplicados

### S - Single Responsibility
Cada classe tem uma única responsabilidade:
- `Carta`: Gerenciar dados comuns
- `Pokemon`: Gerenciar Pokémon específico
- `CartaTrainer`: Gerenciar cartas Trainer

### O - Open/Closed
Aberto para extensão, fechado para modificação:
- Classes abstratas definem contrato
- Novas classes herdam e estendem sem modificar o pai

### L - Liskov Substitution
Subclasses podem substituir a classe pai:
```php
function processar(Carta $carta) {
    // Funciona com Pokemon, CartaTrainer, etc
}
```

### I - Interface Segregation
Interfaces pequenas e específicas:
- `CartaInterface` com apenas 2 métodos essenciais

### D - Dependency Inversion
Depender de abstrações, não de implementações:
- Usamos `CartaInterface` em type hints
- Não acoplamos a tipos específicos

---

## 📚 Recursos para Aprender Mais

1. **POO em PHP** - Documentação oficial
2. **Design Patterns** - Padrões de design
3. **SOLID Principles** - Princípios de design
4. **UML Diagrams** - Diagramas de classe

---

**Desenvolvido em:** 12 de maio de 2026  
**Linguagem:** PHP 7.4+  
**Padrão:** PSR-12 (Style Guide)
