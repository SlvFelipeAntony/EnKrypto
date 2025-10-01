<head>
    <title>EnKrypto - Senhas</title>
</head>

<?php

require_once "connection.php";

$sql = "SELECT * FROM passwords";

$connection = newConnection();
$result = $connection->query($sql);

$records = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { // fetch assoc verifica chave e valor (atributo e registro)
        $records[] = $row;
    }
} else {
    echo $connection->error;
}

$connection->close();

?>

<div class="d-flex rounded bg-dark p-3 mb-2">
    <div class="container-fluid d-flex justify-content-start">
        <span class="mx-2 my-1 fs-5">Senhas</span>
    </div>
    <div class="container-fluid d-flex justify-content-end">
        <a class="btn btn-outline-success mx-2" href="base.php?dir=pages&file=newpasswords" role="button">Nova Senha</a>
        <a class="btn btn-outline-danger mx-2" href="base.php?dir=pages&file=delpasswords" role="button">Excluir Senha</a>
    </div>
</div>

<div class="container-fluid rounded bg-dark p-3 mb-2">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Endereço do Site</th>
                <th scope="col">Nome de Usuário</th>
                <th scope="col">Endereço de Email</th>
                <th scope="col">Senha</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records as $record) : ?>
                <tr>
                    <th scope="row"><?= $record['name'] ?></th>
                    <td><?= $record['url'] ?></td>
                    <td><?= $record['username'] ?></td>
                    <td><?= $record['email'] ?></td>
                    <td><?= $record['pass'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>