<?php

require_once 'config/conexao.php';

$id = $_GET['id'];

$sql = "SELECT * FROM produtos WHERE id = :id";

$stmt = $conexao->prepare($sql);

$stmt->execute([
    ':id' => $id
]);

$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'];
    $fabricante = $_POST['fabricante'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];

    $update = "UPDATE produtos
    SET nome = :nome,
        fabricante = :fabricante,
        preco = :preco,
        estoque = :estoque
    WHERE id = :id";

    $stmt = $conexao->prepare($update);

    $stmt->execute([
        ':nome' => $nome,
        ':fabricante' => $fabricante,
        ':preco' => $preco,
        ':estoque' => $estoque,
        ':id' => $id
    ]);

    header("Location: index.php");
}

require_once 'includes/header.php';
?>

<h2>Editar Produto</h2>

<form method="POST">

<input type="text"
name="nome"
value="<?= $produto['nome'] ?>"
required>

<input type="text"
name="fabricante"
value="<?= $produto['fabricante'] ?>"
required>

<input type="number"
step="0.01"
name="preco"
value="<?= $produto['preco'] ?>"
required>

<input type="number"
name="estoque"
value="<?= $produto['estoque'] ?>"
required>

<button type="submit">Salvar</button>

</form>

<?php require_once 'includes/footer.php'; ?>