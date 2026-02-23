<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Descrição de monstros</title>
</head>

<body>
    <main>
        <form action="index.php" method="GET">
        <div id="busca">
        <select name="monstros" id="monstros" required>
            <option value="" selected disabled>Escolha um monstro</option>
            <option value="it">It a coisa</option>
            <option value="jason">Jason</option>
            <option value="chuck">Chuck</option>
            <option value="mumia">Múmia</option>
            <option value="dracula">Dracula</option>
        </select>

        <button type="submit">Pesquisar</button>
        </div>
        <br><br>
        </form>
        <?php

        $monstros = $_GET['monstros'] ?? null;
        if($monstros == 'it'){
            echo '<br><img src="https://imgs.search.brave.com/7dRHRQwpd4yL8x9SALY0mrdGCCrBKCJJMTVu-Nnn1iI/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tLm1l/ZGlhLWFtYXpvbi5j/b20vaW1hZ2VzL00v/TVY1QlpHSTJZekJq/WkRndE5qWTBNUzAw/TkdJeUxUaGhaamN0/T0RFelptVmpaRGd6/TXpFM1hrRXlYa0Zx/Y0djQC5qcGc"alt="Palhaço segurando um balão"> <br><br>' .  '<p>It (A Coisa) é a entidade central do livro It, de Stephen King. Trata-se de uma criatura cósmica e ancestral que vive nos esgotos da cidade de Derry e desperta em ciclos (aproximadamente a cada 27 anos) para se alimentar, principalmente do medo das crianças.<br>
A forma mais conhecida que assume é a do palhaço Pennywise, que usa para atrair suas vítimas, mas sua verdadeira natureza é muito mais complexa e praticamente incompreensível para a mente humana.<br> Ele é um ser metamórfico, capaz de se transformar naquilo que causa mais medo em cada pessoa.
Além da força física e dos poderes sobrenaturais, It também influencia a mente dos habitantes de Derry, fazendo com que ignorem ou esqueçam os horrores que acontecem na cidade.</p>';
        }else if($monstros == 'jason'){
            echo '<br><img src="https://imgs.search.brave.com/4vpm4vSO_Q2O-ejpFnTraEqJ9zkZrVtNHwegDV7g8jE/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9ob3Jy/b3JwcmVzcy5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjMv/MDkvamFzb24tdm9v/cmhlZXMtMTAyNHg1/NzcuanBlZw" alt="Mascarado segurando um facão"> <br><br> <p>Jason era uma criança que se afogou no acampamento Crystal Lake devido à negligência dos monitores. Anos depois, ele retorna — inicialmente como um sobrevivente e depois como uma figura praticamente sobrenatural — buscando vingança contra qualquer pessoa que vá ao local.<br>
Sua marca registrada é a máscara de hóquei, além do uso de armas simples e da força física fora do comum. Ele não fala e aparece de forma implacável, sempre perseguindo suas vítimas. </p>';
        }else if($monstros == 'chuck'){
            echo '<br><img src="https://imgs.search.brave.com/xx72aJzAxJgfuFmHsMzapheCwpIHEC2ZT2MzDJ9CZ10/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9ici53/ZWIuaW1nMy5hY3N0/YS5uZXQvY180MDBf/MjI1L25ld3N2Ny8y/MC8wMS8xNC8wMC81/Ny81OTQ5MjQ4Lmpw/Zw" alt="Boneco com cicatrizes levantando a mão"> <br><br> <p>Ele é um boneco aparentemente inocente que, na verdade, está possuído pela alma do assassino em série Charles Lee Ray, transferida através de um ritual de vodu.<br>
Mesmo preso no corpo de um brinquedo, Chucky mantém sua personalidade violenta, sarcástica e cruel. Ele tem como principal objetivo voltar para um corpo humano, e para isso tenta possuir a primeira pessoa que revelou sua verdadeira identidade.<br>
Diferente de outros vilões do terror, ele fala bastante, faz piadas sombrias e age de forma inteligente e manipuladora, usando sua aparência de boneco para enganar as vítimas. </p>';
        }else if($monstros == 'mumia'){
            echo '<br><img src="https://imgs.search.brave.com/WUVSxbazjQa4vepGED1JLdjtfzTf80MSJdoFXl7QbUE/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pbWcu/ZnJlZXBpay5jb20v/Zm90b3MtcHJlbWl1/bS91bWEtbXVtaWEt/ZGUtaGFsbG93ZWVu/LWVudm9sdGEtZW0t/YmFuZGFnZW5zXzEw/MjI0NTYtMjg3ODM1/LmpwZz9zZW10PWFp/c19oeWJyaWQmdz03/NDA" alt"Um monstro enrolado de faixa so com os olhos para fora"> <br><br> <p>A Múmia possui poderes ligados a maldições, controle sobre forças místicas e, em algumas versões, a capacidade de trazer pragas ou controlar os mortos. Diferente de outros monstros, ela costuma agir de forma lenta, mas é praticamente imortal. </p>';
        }else if($monstros == 'dracula'){
            echo '<br> <img src="https://imgs.search.brave.com/X1hSXE-2MFyJZTprHz-Xv6XWUj2KXN2B2nQqs1WAsh0/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93d3cu/emVrZWZpbG0ub3Jn/L3dwLWNvbnRlbnQv/dXBsb2Fkcy8yMDE2/LzA2L2RyYWN1bGEt/My5qcGc" alt="Vampiro com os braços aberto"> <br><br> <p>Ele é um conde vampiro da Transilvânia que se alimenta de sangue humano para sobreviver e manter sua imortalidade. Drácula possui diversos poderes sobrenaturais, como força sobre-humana, capacidade de se transformar em morcego, lobo ou névoa, além de conseguir hipnotizar suas vítimas.<br>
Apesar de ser um monstro, ele também é retratado como elegante, inteligente e extremamente sedutor, usando seu charme para atrair suas presas. Suas fraquezas clássicas incluem a luz do sol, estacas no coração, alho, água benta e símbolos sagrados. </p>';
        }

        ?>
    </main>
</body>

</html>