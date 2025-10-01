<head>
    <title>EnKrypto - Contato</title>
</head>

<?php
require_once 'connection.php';

$connection = newConnection();

$sql = "SELECT * FROM contact";

$result = $connection->query($sql);

$records = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
} else {
    echo $connection->error;
}

$connection->close();

if (count($_POST) > 0) {
    $dados = $_POST;

    require_once "connection.php";

    $sql = "INSERT INTO contact (username, name, email, message) VALUES (?, ?, ?, ?)";

    $connection = newConnection();
    $stmt = $connection->prepare($sql);

    // $data = DateTime::createFromFormat('d/m/Y', $dados['validade']);

    $params = [
        $dados['username'],
        // $data ? $data->format('Y-m-d') : null,
        $dados['name'],
        $dados['email'],
        $dados['message']
    ];

    $stmt->bind_param("ssss", ...$params);

    if ($stmt->execute()) {
        unset($dados);
        $sql = "SELECT * FROM contact";

        $result = $connection->query($sql);

        $records = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $records[] = $row;
            }
        } else {
            echo $connection->error;
        }
    }
}

?>

<div class="container-fluid d-flex rounded bg-dark p-3 mb-2">
    <div class="container-fluid d-flex justify-content-start">
        <span class="css-h2-size mx-2 my-1 fs-5">Contato</span>
    </div>
</div>

<div class="container-fluid rounded bg-dark p-3 mb-2">
    <form class="text-bg-dark" action="#" method="post">
        <div class="row">
            <div class="mb-3 col-md-6">
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nome de Usuário (opcional)" maxlength="30" name="username">
            </div>
            <div class="mb-3 col-md-6">
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nome e Sobrenome" maxlength="45" name="name">
            </div>
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Endereço de E-mail" maxlength="100" name="email">
        </div>
        <div class="row">
            <div class="col-md-11">
                <textarea type="text" class="form-control" id="exampleFormControlInput1" placeholder="Mensagem" name="message"></textarea>
            </div>
            <div class="col-md-1">
                <button type="submit" value="enviar" class="btn btn-outline-success" name="enviar">Enviar</button>
            </div>
        </div>
    </form>
</div>

<div class="container-fluid rounded bg-dark p-3 mb-2">
    <table class="table text-bg-dark align-middle">
        <thead>
            <tr>
                <th scope="col">Usuário</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Mensagem</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records as $record) : ?>
                <tr>
                    <th scope="row"><?= $record['username'] ?></th>
                    <td><?= $record['name'] ?></td>
                    <td><?= $record['email'] ?></td>
                    <td class="w-50">
                        <p class="text-break"><?= $record['message'] ?></p>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>