<head>
    <title>EnKrypto - Senhas</title>
</head>

<?php

require_once 'connection.php';

$records = [];
$connection = newConnection();

if (isset($_GET['updpasswords'])) { //botão
    if (count($_POST) > 0) {
        $dados = $_POST;
        $updSQL = "UPDATE passwords SET name = ?, url = ?, username = ?, email = ?, pass = ? WHERE idPass = ?";
        $stmt = $connection->prepare($updSQL);
        $params = [
            $dados['name'],
            $dados['url'],
            $dados['username'],
            $dados['email'],
            $dados['pass'],
            $_GET['updpasswords']
        ];
        $stmt->bind_param("sssssi", ...$params);
        $stmt->execute();
    }
}

if (isset($_GET['updpasswords'])) { //botão
    $sql = "SELECT * FROM passwords WHERE idPass = " . $_GET['updpasswords'];
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
    } else {
        echo $connection->error;
    }
}

$connection->close();

?>

<div class="d-flex rounded bg-dark p-3 mb-2">
    <div class="container-fluid d-flex justify-content-start">
        <span class="mx-2 my-1 fs-5">Editar Senhas</span>
    </div>
    <div class="container-fluid d-flex justify-content-end">
        <a class="btn btn-outline-danger mx-2" href="base.php?dir=pages&file=passwords" role="button">Voltar</a>
    </div>
</div>

<div class="container-fluid rounded bg-dark p-3 mb-2">
    <form class="text-bg-dark" action="#" method="post">
        <?php foreach ($records as $record) : ?>
            <div class="mb-3">
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nome" maxlength="20" name="name" value="<?= $record['name'] ?>">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="URL" maxlength="100" name="url" value="<?= $record['url'] ?>">
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nome de Usuário" maxlength="30" name="username" value="<?= $record['username'] ?>">
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Endereço de E-mail" maxlength="60" name="email" value="<?= $record['email'] ?>">
                </div>
            </div>

            <div class="mb-3 row">
                <div class="input-group col-md-12">
                    <input type="text" class="form-control password" placeholder="Senha" aria-label="Recipient's username with two button addons" maxlength="30" name="pass" value="<?= $record['pass'] ?>">
                    <button type="submit" value="enviar" class="css-txt-size btn btn-outline-success">Salvar</button>
                </div>
            </div>
        <?php endforeach ?>
    </form>
</div>