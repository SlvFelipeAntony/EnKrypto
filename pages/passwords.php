<head>
    <title>EnKrypto - Cofre</title>
</head>

<?php

require_once 'connection.php';
$records_p = [];
$records_f = [];
$connection = newConnection();

if (isset($_GET['delpasswords'])) { //botão
    $delSQL = "DELETE FROM passwords WHERE idPass = ? and idUser = '" . $_SESSION["idUser"] . "'";
    $stmt = $connection->prepare($delSQL);
    $stmt->bind_param("i", $_GET['delpasswords']);
    $stmt->execute();
}

if (count($_POST) > 0) {
    $dados = $_POST;
    require_once "connection.php";

    $params = [];

    foreach ($dados as $i) {
        for ($j = 0; $j < 4; $j += 1) {
            array_push($params, $i);
        }
    }

    $sql_p = "SELECT * FROM `passwords` WHERE name = '" . $params[0] . "' OR url = '" . $params[1] . "' OR username = '" . $params[2] . "' OR email = '" . $params[3] . "' and idUser = '" . $_SESSION["idUser"] . "'";
    $sql_f = "SELECT * FROM `folders` WHERE name = '" . $params[0] . "' and idUser = '" . $_SESSION["idUser"] . "'";

    $result_p = $connection->query($sql_p);
    $result_f = $connection->query($sql_f);

    if ($result_p->num_rows > 0) {
        while ($row = $result_p->fetch_assoc()) {
            $records_p[] = $row;
        }
    } else {
        echo $connection->error;
    }

    if ($result_f->num_rows > 0) {
        while ($row = $result_f->fetch_assoc()) {
            $records_f[] = $row;
        }
    } else {
        echo $connection->error;
    }

    $connection->close();
} else {
    $sql_p = "SELECT * FROM passwords WHERE idFolder = 0 and idUser = '" . $_SESSION["idUser"] . "'";
    $result_p = $connection->query($sql_p);

    if ($result_p->num_rows > 0) {
        while ($row = $result_p->fetch_assoc()) {
            $records_p[] = $row;
        }
    } else {
        echo $connection->error;
    }

    
    $sql_f = "SELECT * FROM folders where idUser = '" . $_SESSION["idUser"] . "'";
    $result_f = $connection->query($sql_f);

    if ($result_f->num_rows > 0) {
        while ($row = $result_f->fetch_assoc()) {
            $records_f[] = $row;
        }
    } else {
        echo $connection->error;
    }

    $connection->close();
}

?>

<div class="d-flex rounded bg-dark p-3 mb-2">
    <div class="container-fluid d-flex justify-content-start w-50">
        <span class="css-h2-size mx-2 my-1 fs-5">Cofre</span>
    </div>
    <div class="container-fluid">
        <form class="d-flex" role="search" action="#" method="post">
            <input class="form-control me-2 w-75" type="search" placeholder="Search" aria-label="Search" name="search">
            <button class="css-txt-size btn btn-outline-primary" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.5vw, 10vh)" height="clamp(0.15vh, 1.5vw, 10vh)" fill="currentColor" class="bi bi-search" viewBox="0 0 18 18">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg> Search</button>
        </form>
    </div>
    <div class="container-fluid d-flex justify-content-end w-50 wrap align-items-center">
        <a class="css-txt-size btn btn-outline-success mx-2" href="base.php?dir=pages&file=newfolder" role="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.25vw, 10vh)" height="clamp(0.15vh, 1.25vw, 10vh)" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 18 18">
                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
            </svg> Nova Pasta</a>
        <a class="css-txt-size btn btn-outline-success mx-2" href="base.php?dir=pages&file=newpasswords" role="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.25vw, 10vh)" height="clamp(0.15vh, 1.25vw, 10vh)" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 18 18">
                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
            </svg> Nova Senha</a>
    </div>
</div>

<div class="container-fluid rounded bg-dark p-3 mb-2">
    <table class="table table-dark align-middle">
        <thead>
            <tr>
                <th scope="col">Pastas</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records_f as $record) : ?>
                <tr>
                    <th scope="css-row-folder">
                        <a class="css-h4-size css-btn-folder btn btn-outline-light py-3 w-100 text-start" href="base.php?dir=pages&file=folders&folders=<?= $record['idFolders'] ?>" role="button">
                            <?= $record['name'] ?></a>
                    </th>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<div class="container-fluid rounded bg-dark p-3 mb-2">
    <table class="table table-dark align-middle">
        <thead>
            <tr>
                <th scope="col">Senhas</th>
                <th scope="col">Endereço do Site</th>
                <th scope="col">Nome de Usuário</th>
                <th scope="col">Email</th>
                <th scope="col">Senha</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records_p as $record) : ?>
                <tr>
                    <td scope="row"><?= $record['name'] ?></td>
                    <td><?= $record['url'] ?></td>
                    <td><?= $record['username'] ?></td>
                    <td><?= $record['email'] ?></td>
                    <td class="flex-nowrap">
                        <input type="password" readonly class="password form-control-plaintext" id="staticEmail2" value="<?= $record['pass'] ?>">
                        <!-- <input type="password" class="" id="inputPassword2" placeholder="Password" value=""> -->
                    </td>
                    <td class="text-center d-flex wrap align-items-center justify-content-center">
                        <button type="button" value="hide" class="css-txt-size btn btn-outline-light showPassword" data-bs-toggle="button">
                            <div class="olhinho">
                                <svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.25vw, 10vh)" height="clamp(0.15vh, 1.25vw, 10vh)" fill="currentColor" class="bi bi-eye" viewBox="0 0 18 18">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                </svg>
                            </div>
                        </button>
                        <!-- Editar -->
                        <a href="base.php?dir=pages&file=updpasswords&updpasswords=<?= $record['idPass'] ?>" class="css-txt-size btn btn-outline-warning ms-2 my-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.25vw, 10vh)" height="clamp(0.15vh, 1.25vw, 10vh)" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 18 18">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg></a>
                        <!-- Excluir -->
                        <a href="base.php?dir=pages&file=passwords&delpasswords=<?= $record['idPass'] ?>" class="css-txt-size btn btn-outline-danger ms-2 my-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.25vw, 10vh)" height="clamp(0.15vh, 1.25vw, 10vh)" fill="currentColor" class="bi bi-trash" viewBox="0 0 18 18">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                            </svg></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>