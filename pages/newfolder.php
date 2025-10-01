<head>
    <title>EnKrypto - Pasta</title>
</head>

<?php

if (count($_POST) > 0) {
    $dados = $_POST;

    require_once "connection.php";

    $sql = "INSERT INTO folders (name, idUser) VALUES (?, ?)";

    $connection = newConnection();
    $stmt = $connection->prepare($sql);


    $params = [
        $dados['name'],
        $_SESSION['idUser']
    ];

    $stmt->bind_param("si", ...$params);

    if ($stmt->execute()) {
        unset($dados);
    }
}

?>

<div class="d-flex rounded bg-dark p-3 mb-2">
    <div class="container-fluid d-flex justify-content-start">
        <span class="css-h2-size mx-2 my-1 fs-5">Nova Pasta</span>
    </div>
    <div class="container-fluid d-flex justify-content-end wrap align-items-center">
        <a class="btn btn-outline-light mx-2" href="base.php?dir=pages&file=passwords" role="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-key" viewBox="0 0 18 18">
                <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
            </svg> Cofre</a>
    </div>
</div>

<div class="container-fluid rounded bg-dark p-3 mb-2">
    <form class="text-bg-dark" action="#" method="post">
        <div class="mb-3 row">
            <div class="input-group col-md-12">
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nome" maxlength="20" name="name">
                <button type="submit" value="enviar" class="btn btn-outline-success">Enviar</button>
            </div>
        </div>
    </form>
</div>