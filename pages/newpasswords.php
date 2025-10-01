<head>
    <title>EnKrypto - Senhas</title>
</head>

<?php
require_once "connection.php";
$connection = newConnection();
$records_f = [];

if (count($_POST) > 0) {
    $dados = $_POST;

    require_once "connection.php";

    $sql = "INSERT INTO passwords (name, url, username, email, pass, idFolder, idUser) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $connection = newConnection();
    $stmt = $connection->prepare($sql);

    $params = [
        $dados['name'],
        $dados['url'],
        $dados['username'],
        $dados['email'],
        $dados['pass'],
        $dados['idFolder'],
        $_SESSION['idUser']
    ];

    $stmt->bind_param("sssssii", ...$params);

    if ($stmt->execute()) {
        unset($dados);
    }
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

?>

<div class="d-flex rounded bg-dark p-3 mb-2">
    <div class="css-h2-size container-fluid d-flex justify-content-start">
        <span class="css-h2-size mx-2 my-1 fs-5">Nova Senha</span>
    </div>
    <div class="container-fluid d-flex justify-content-end wrap align-items-center">
        <a class="css-h4-size btn btn-outline-light mx-2" href="base.php?dir=pages&file=passwords" role="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.25vw, 10vh)" height="clamp(0.15vh, 1.25vw, 10vh)" fill="currentColor" class="bi bi-key" viewBox="0 0 18 18">
                <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
            </svg> Cofre</a>
    </div>
</div>

<div class="container-fluid rounded bg-dark p-3 mb-2">
    <form class="text-bg-dark" action="#" method="post">
        <div class="mb-3">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nome" maxlength="20" name="name" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="URL" maxlength="100" name="url">
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nome de Usuário" maxlength="30" name="username">
            </div>
            <div class="col-md-6">
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Endereço de E-mail" maxlength="60" name="email">
            </div>
        </div>
        <div class="mb-3 row">
            <div class="input-group col-12 align-middle">
                <input type="password" class="form-control password w-25" placeholder="Senha" aria-label="Recipient's username with two button addons" maxlength="40" name="pass" required>
                <!-- <input type="password" class="form-control password" placeholder="Confirm Password" aria-label="Recipient's username with two button addons"> -->
                <button type="button" value="hide" class="btn btn-outline-light showPassword" data-bs-toggle="button">
                    <div class="olhinho">
                        <svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.5vw, 10vh)" height="clamp(0.15vh, 1.5vw, 10vh)" fill="currentColor" class="bi bi-eye" viewBox="0 0 18 18">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                        </svg>
                    </div>
                </button>
                <a class="btn btn-outline-light passShuffle" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.5vw, 10vh)" height="clamp(0.15vh, 1.5vw, 10vh)" fill="currentColor" class="bi bi-shuffle" viewBox="0 0 18 18">
                        <path fill-rule="evenodd" d="M0 3.5A.5.5 0 0 1 .5 3H1c2.202 0 3.827 1.24 4.874 2.418.49.552.865 1.102 1.126 1.532.26-.43.636-.98 1.126-1.532C9.173 4.24 10.798 3 13 3v1c-1.798 0-3.173 1.01-4.126 2.082A9.624 9.624 0 0 0 7.556 8a9.624 9.624 0 0 0 1.317 1.918C9.828 10.99 11.204 12 13 12v1c-2.202 0-3.827-1.24-4.874-2.418A10.595 10.595 0 0 1 7 9.05c-.26.43-.636.98-1.126 1.532C4.827 11.76 3.202 13 1 13H.5a.5.5 0 0 1 0-1H1c1.798 0 3.173-1.01 4.126-2.082A9.624 9.624 0 0 0 6.444 8a9.624 9.624 0 0 0-1.317-1.918C4.172 5.01 2.796 4 1 4H.5a.5.5 0 0 1-.5-.5z" />
                        <path d="M13 5.466V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192zm0 9v-3.932a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192z" />
                    </svg> Gerar
                </a>
                <p class="css-text-size mx-2 my-2" for="range">Tamanho: <output id="range"></output> </p>
                <input type="range" class="me-2" min="4" max="30" id="range-inp" name="range">

                <select class="form-select" name="idFolder">
                    <option selected>Selecionar pasta</option>
                    <?php foreach ($records_f as $record) : ?>
                        <option value="<?= $record['idFolders'] ?>"><?= $record['name'] ?></option>
                    <?php endforeach ?>
                </select>

                <button type="submit" value="enviar" class="btn btn-outline-success">Enviar</button>
            </div>
        </div>
    </form>
</div>