<?php

require_once 'config/conexao.php';
require_once 'includes/header.php';

$sql = "SELECT * FROM produtos ORDER BY nome ASC";

$stmt = $conexao->prepare($sql);
$stmt->execute();

$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="topo">
    <h2>Lista de Produtos</h2>

</div>

<div class="container">

<?php if(count($produtos) > 0): ?>

    <?php foreach($produtos as $produto): ?>

        <div class="card">

            <h3>
                <?= htmlspecialchars($produto['nome']) ?>
            </h3>

            <p>
                <strong>Fabricante:</strong>
                <?= htmlspecialchars($produto['fabricante']) ?>
            </p>

            <p>
                <strong>Preço:</strong>
                R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
            </p>

            <p>
                <strong>Estoque:</strong>
                <?= $produto['estoque'] ?>
            </p>

            <div class="acoes">

                <a class="btn editar"
                   href="editar.php?id=<?= $produto['id'] ?>">
                    Editar
                </a>

                <a class="btn excluir"
                   href="excluir.php?id=<?= $produto['id'] ?>"
                   onclick="return confirm('Deseja realmente excluir este produto?')">
                    Excluir
                </a>

            </div>

        </div>

    <?php endforeach; ?>

<?php else: ?>

    <div class="sem-produtos">
        <p>Nenhum produto cadastrado.</p>
    </div>

<?php endif; ?>

</div>

<?php require_once 'includes/footer.php'; ?>