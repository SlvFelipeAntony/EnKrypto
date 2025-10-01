<head>
    <title>EnKrypto - Perfil</title>
</head>

<?php

require_once "connection.php";

$sql = "SELECT * FROM user where idUser = '" . $_SESSION['idUser'] . "'";

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

<div class="container-fluid d-flex rounded bg-dark p-3 mb-2">
    <div class="container-fluid d-flex justify-content-start">
        <span class="css-h2-size mx-2 my-1 fs-5">Perfil</span>
    </div>
</div>

<div class="container-fluid d-flex rounded bg-dark p-3 mb-2 flex-wrap">
    <?php foreach ($records as $record) : ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h3 for="staticEmail2" class="css-h3-size">Nome</h3>
                </div>
                <div class="col">
                    <h3 for="inputPassword2" class="css-h3-size">Nome de Usuário</h3>
                </div>
                <div class="col">
                    <h3 for="staticEmail2" class="css-h3-size">Email</h3>
                </div>
                <div class="col">
                    <h3 for="inputPassword2" class="css-h3-size">Password</h3>
                </div>
                <div class="col">
                    <h3 for="inputPassword2" class="css-h3-size"></h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="<?= $record['name'] ?>">
                </div>
                <div class="col">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="<?= $record['username'] ?>">
                </div>
                <div class="col">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="<?= $record['email'] ?>">
                </div>
                <div class="col">
                    <input type="password" readonly class="form-control-plaintext" id="staticEmail2" value="<?= $record['pass'] ?>">
                </div>
                <div class="col text-center">
                    <a href="base.php?dir=pages&file=updprofile&updprofile=<?= $record['idUser'] ?>" class="css-txt-size btn btn-outline-primary ms-2 my-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.5vw, 10vh)" height="clamp(0.15vh, 1.5vw, 10vh)" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 18 18">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                        </svg> Editar Perfil
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>