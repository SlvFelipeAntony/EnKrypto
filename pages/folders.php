<head>
    <title>EnKrypto - Pasta</title>
</head>

<?php

require_once 'connection.php';
$connection = newConnection();
$records = [];

if (isset($_GET['delpasswords'])) { //botão
    $delSQL = "DELETE FROM passwords WHERE idPass = ? and idUser = '" . $_SESSION["idUser"] . "'";
    $stmt = $connection->prepare($delSQL);
    $stmt->bind_param("i", $_GET['delpasswords']);
    $stmt->execute();
}

if (isset($_GET['delfolders'])) { //botão
    
    $delSQL2 = "DELETE FROM passwords WHERE idFolder = ? and idUser = '" . $_SESSION["idUser"] . "'";
    $stmt2 = $connection->prepare($delSQL2);
    $stmt2->bind_param("i", $_GET['delfolders']);
    $stmt2->execute();
    
    $delSQL = "DELETE FROM folders WHERE idFolders = ?";
    $stmt = $connection->prepare($delSQL);
    $stmt->bind_param("i", $_GET['delfolders']);
    $stmt->execute();

    ?>
    <script>
        window.location.href = "base.php?dir=pages&file=passwords";
    </script>
    <?php

}


if (isset($_GET['folders'])) { //botão
    $sql = "SELECT * FROM passwords WHERE idFolder = " . $_GET['folders'];
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
    } else {
        echo $connection->error;
    }

    $sql_f = "SELECT * FROM folders WHERE idFolders = " . $_GET['folders'];
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

<div class="container-fluid d-flex rounded bg-dark p-3 mb-2">
    <div class="container-fluid d-flex justify-content-start">
        <?php foreach ($records_f as $record) : ?>
            <span class="css-h2-size mx-2 my-1 fs-5"><?= $record['name'] ?></span>
    </div>
    <div class="container-fluid d-flex justify-content-end wrap align-items-center">
        <!-- Editar -->
        <a href="base.php?dir=pages&file=updfolders&updfolders=<?= $record['idFolders'] ?>" class="css-txt-size btn btn-outline-warning ms-2 my-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.25vw, 10vh)" height="clamp(0.15vh, 1.25vw, 10vh)" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 18 18">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
            </svg></a>
        <!-- Excluir -->
        <a href="base.php?dir=pages&file=folders&folders=<?= $record['idFolders'] ?>&delfolders=<?= $record['idFolders'] ?>" class="css-txt-size btn btn-outline-danger ms-2 me-5 my-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.25vw, 10vh)" height="clamp(0.15vh, 1.25vw, 10vh)" fill="currentColor" class="bi bi-trash" viewBox="0 0 18 18">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
            </svg></a>
        <?php endforeach ?>

        <a class="btn btn-outline-danger mx-2" href="base.php?dir=pages&file=passwords" role="button">Voltar</a>
    </div>
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
            <?php foreach ($records as $record) : ?>
                <tr>
                    <th scope="row"><?= $record['name'] ?></th>
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
                        <a href="base.php?dir=pages&file=folders&folders=<?= $record['idFolder'] ?>&delpasswords=<?= $record['idPass'] ?>" class="css-txt-size btn btn-outline-danger ms-2 my-1">
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