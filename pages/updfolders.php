<head>
    <title>EnKrypto - Senhas</title>
</head>

<?php

require_once 'connection.php';

$records = [];
$connection = newConnection();


if (isset($_GET['updfolders'])) { //botão
    if (count($_POST) > 0) {
        $dados = $_POST;
        $updSQL = "UPDATE folders SET name = ? WHERE idFolders = ? and idUser = '" . $_SESSION['idUser'] . "'";
        $stmt = $connection->prepare($updSQL);
        $params = [
            $dados['name'],
            $_GET['updfolders']
        ];
        $stmt->bind_param("si", ...$params);
        $stmt->execute();
    }
}

if (isset($_GET['updfolders'])) { //botão
    $sql = "SELECT * FROM folders WHERE idFolders = " . $_GET['updfolders'];
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
        <a class="btn btn-outline-danger mx-2" href="base.php?dir=pages&file=folders&folders=<?= $_GET['updfolders'] ?>" role="button">Voltar</a>
    </div>
</div>

<div class="container-fluid rounded bg-dark p-3 mb-2">
    <form class="text-bg-dark" action="#" method="post">
        <?php foreach ($records as $record) : ?>
            <div class="mb-3 row">
                <div class="input-group col-md-12">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nome" maxlength="20" name="name" value="<?= $record['name'] ?>">
                    <button type="submit" value="enviar" class="btn btn-outline-success">Enviar</button>
                </div>
            </div>
        <?php endforeach ?>
    </form>
</div>