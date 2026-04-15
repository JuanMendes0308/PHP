<?php
class Pessoa{
    private $idade = '17';
    protected $sobrenome = 'Mendes ';
    public $nome = 'Juan';

    /*testando os metodos get e set normal para acessar e modificar os atributos*/ 
    // public function getIdade(){
    //     return $this->idade;
    // }

    // public function getSobrenome(){
    //     return $this->sobrenome;
    // }

    // public function setIdade($value){
    //     $this->idade = $value;
    // }

    // public function setSobrenome($value){
    //     $this->sobrenome = $value;
    // }

    /*Utilizando os métodos mágicos __get e __set para acessar e modificar os atributos mais facilmente*/
    //Sem o método get e set mágicos ou não dentro da classe, não é possível acessar os atributos private, apenas os publicos e protegidos.
    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    private function executarMania(){
        echo "Mexer no cabelo";
    }

    private function responder(){
        echo "Olá, tudo bem?";
    }

    public function executaracao(){
        $x = rand(1,10);
        if($x >= 1 && $x <= 8){
           echo $this->executarMania();
        } else {
           echo $this->responder();
        }
    }
}

/*Classe Filho que herda os atributos da classe Pessoa*/
class Filho extends Pessoa
{

    /*Exibindo todas as funções da classe pessoa + dela mesma*/
    public function __construct()
    {
        echo '<pre>';
        print_r(get_class_methods($this));
        echo '</pre>';
    }

    //O Método executarMania do Pai é privado, ou seja, não é trazido para a Classe Filha, porém podemos usar o Polimorfismo para criar um método com o mesmo nome na classe filha, e assim, quando chamarmos o método executarMania, ele irá executar o método da classe filha, e não da classe pai.
    private function executarMania()
    {
        echo 'Cantar';
    }

    public function x()
    {
        $this->executarMania();
    }

    protected function responder()
    {
        echo 'Olá';
    }


    public function getAtributo ($attr) {
        return $this->$attr;
    }

        public function setAtributo ($attr, $value) {
            $this->$attr = $value;
        }

    public function __get($atr) {
        return $this->$atr;
    }
    public function __set($atr, $value) {
       $this->$atr = $value;
    }
}

//Instanciando classe Filho
$filho = new Filho();

echo '<pre>';
//exibir os atributos do objeto (Até mesmo os privados e protegidos, pois estamos utilizando os métodos mágicos __get e __set)
//Porém não acessíveis para a aplicação, apenas para a classe e seus filhos, ou seja, para o objeto instanciado da classe filha.
print_r($filho);
echo '</pre>';

echo '</pre>';
//exibir os métodos do objeto que a aplicação tem acesso, ou seja, os métodos públicos, mas não os protegidos e privados, pois são apenas para a classe e seus filhos.
print_r(get_class_methods($filho));
echo '</pre>';

// echo $filho->getAtributo('nome');
// echo '<br />';
// $filho->setAtributo('nome', 'Pereira');
// echo '<pre>';
// print_r($filho);
// echo '</pre>';
// echo '<br />';
// echo $filho->getAtributo('nome');

// echo $filho->__get('nome');

/*Alterando o valor do atributo nome */
// $filho->__set('nome', 'Jamilton');
// echo '<br />';
// echo $filho->__get('nome');/*Exibindo o valor alterado */
?>