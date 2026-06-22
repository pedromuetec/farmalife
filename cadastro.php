<?php

require_once 'config/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST['nome']);
    $fabricante = trim($_POST['fabricante']);
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];

    $sql = "INSERT INTO produtos
            (nome, fabricante, preco, estoque)
            VALUES
            (:nome, :fabricante, :preco, :estoque)";

    $stmt = $conexao->prepare($sql);

    $stmt->execute([
        ':nome' => $nome,
        ':fabricante' => $fabricante,
        ':preco' => $preco,
        ':estoque' => $estoque
    ]);

    header("Location: index.php");
    exit;
}

require_once 'includes/header.php';

?>

<div class="form-container">

    <div class="card">

        <h2>Cadastrar Produto</h2>

        <form method="POST">

            <label>Nome do Produto</label>
            <input
                type="text"
                name="nome"
                placeholder="Digite o nome do produto"
                required>

            <label>Fabricante</label>
            <input
                type="text"
                name="fabricante"
                placeholder="Digite o fabricante"
                required>

            <label>Preço</label>
            <input
                type="number"
                step="0.01"
                min="0"
                name="preco"
                placeholder="0,00"
                required>

            <label>Estoque</label>
            <input
                type="number"
                min="0"
                name="estoque"
                placeholder="Quantidade em estoque"
                required>

            <div class="acoes">

                <button type="submit"style="background:#28a745;color:white;border:none;padding:12px 25px;border-radius:10px;font-size:16px;font-weight:bold;cursor:pointer;box-shadow:0 0 12px rgba(255,20,147,.5);transition:.3s;">
                    Cadastrar
                </button>

                <a href="index.php" class="btn excluir">
                    Cancelar
                </a>

            </div>

        </form>

    </div>

</div>

<?php require_once 'includes/footer.php'; ?>