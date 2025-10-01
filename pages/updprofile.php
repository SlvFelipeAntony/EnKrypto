<head>
    <title>EnKrypto - Perfil</title>
</head>

<?php

require_once 'connection.php';

$records = [];
$connection = newConnection();


if (isset($_GET['updprofile'])) { //botão
    if (count($_POST) > 0) {
        $dados = $_POST;
        $updSQL = "UPDATE user SET name = ?, username = ?, email = ?, pass = ? WHERE idUser = ?";
        $stmt = $connection->prepare($updSQL);
        $params = [
            $dados['name'],
            $dados['username'],
            $dados['email'],
            $dados['pass'],
            $_GET['updprofile']
        ];
        $stmt->bind_param("ssssi", ...$params);
        $stmt->execute();

?>
        <script>
            window.location.href = "base.php?dir=pages&file=profile";
        </script>
<?php
    }
}

if (isset($_GET['updprofile'])) { //botão
    $sql = "SELECT * FROM user WHERE idUser = " . $_GET['updprofile'];
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

<div class="container-fluid d-flex rounded bg-dark p-3 mb-2">
    <div class="container-fluid d-flex justify-content-start">
        <span class="css-h2-size mx-2 my-1 fs-5">Editar Perfil</span>
    </div>
    <div class="container-fluid d-flex justify-content-end wrap align-items-center">
        <a class="btn btn-outline-danger mx-2" href="base.php?dir=pages&file=profile" role="button">Voltar</a>
    </div>
</div>

<div class="container-fluid rounded bg-dark p-3 mb-2">
    <form class="text-bg-dark" action="#" method="post">
        <?php foreach ($records as $record) : ?>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nome" maxlength="45" name="name" value="<?= $record['name'] ?>">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nome de Usuário" maxlength="20" name="username" value="<?= $record['username'] ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Endereço de E-mail" maxlength="60" name="email" value="<?= $record['email'] ?>">
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control password" placeholder="Senha" aria-label="Recipient's username with two button addons" maxlength="30" name="pass" value="<?= $record['pass'] ?>">
                </div>
                <div class="col-md-1 d-flex align-items-center">
                    <button type="submit" value="enviar" class="css-h4-size btn btn-outline-success">Salvar</button>
                </div>
            </div>
        <?php endforeach ?>
    </form>
</div>