<?php

require_once 'config/conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: index.php");
    exit;
}

$sql = "SELECT * FROM produtos WHERE id = :id";
$stmt = $conexao->prepare($sql);

$stmt->execute([
    ':id' => $id
]);

$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST['nome']);
    $fabricante = trim($_POST['fabricante']);
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
    exit;
}

require_once 'includes/header.php';

?>

<div class="form-container">

    <div class="card">

        <h2>Editar Produto</h2>

        <form method="POST">

            <label>Nome do Produto</label>
            <input
                type="text"
                name="nome"
                value="<?= htmlspecialchars($produto['nome']) ?>"
                required>

            <label>Fabricante</label>
            <input
                type="text"
                name="fabricante"
                value="<?= htmlspecialchars($produto['fabricante']) ?>"
                required>

            <label>Preço</label>
            <input
                type="number"
                step="0.01"
                min="0"
                name="preco"
                value="<?= $produto['preco'] ?>"
                required>

            <label>Estoque</label>
            <input
                type="number"
                min="0"
                name="estoque"
                value="<?= $produto['estoque'] ?>"
                required>

            <div class="acoes">

                <button type="submit" class="btn editar">
                    Salvar Alterações
                </button>

                <a href="index.php" class="btn excluir">
                    Cancelar
                </a>

            </div>

        </form>

    </div>

</div>

<?php require_once 'includes/footer.php'; ?>