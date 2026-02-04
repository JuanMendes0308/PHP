<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="imc.php" method="GET">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" placeholder="Ex: Juan">

        <label for="peso">Peso:</label>
        <input type="number" name="peso" id="peso" placeholder="Ex: 65.9" step="0.10">

        <label for="altura">Altura:</label>
        <input type="number" name="altura" id="altura" placeholder="Ex: 1,83" step="0.01">
        <button type="submit">Calcular</button>
    </form>

</body>
</html>