<?php

require_once 'connection.php';
$connection = newConnection();

session_start();

if (time() > $_SESSION['time'] + (15 * 60) or isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location:index.php");
}

$sql = "SELECT * FROM user WHERE idUser = " . $_SESSION['idUser'];
$result = $connection->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
} else {
    echo $connection->error;
}

?>

<!doctype html>
<html lang="pt-BR">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="photos/logo.png">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>

<body class="css-body" data-bs-theme=dark>
    <header class="css-header container-fluid">
        <nav class="css-nav rounded d-flex flex-column p-3 text-bg-dark offcanvas-body">
            <a href="base.php?dir=pages&file=home" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <img class="bi pe-none me-2" src="photos/logo.ico" alt="Home" width="40" height="40">
                <span class="css-h1-size fs-4">EnKrypto</span>
            </a>

            <hr>

            <ul class="nav nav-pills navbar-nav flex-grow-1">
                <!-- navbar-nav justify-content-end flex-grow-1 -->
                <li class="nav-item">
                    <a href="base.php?dir=pages&file=home" class="nav-link text-white" aria-current="home">
                        <!-- <img class="bi " src="bootstrap/icons/house.svg" alt="Inicio" width="16" height="16"> -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.5vw, 10vh)" height="clamp(0.15vh, 1.5vw, 10vh)" fill="currentColor" class="bi bi-house ms-3" viewBox="0 0 20 20">
                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
                        </svg>
                        Inicio
                    </a>
                </li>

                <li class="nav-item">
                    <a href="base.php?dir=pages&file=passwords" class="nav-link text-white " aria-current="passwords">
                        <!-- <img class="bi " src="bootstrap/icons/house.svg" alt="Inicio" width="16" height="16"> -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.5vw, 10vh)" height="clamp(0.15vh, 1.5vw, 10vh)" fill="currentColor" class="bi bi-shield-lock ms-3" viewBox="0 0 20 20">
                            <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                            <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z" />
                        </svg>
                        Cofre
                    </a>
                </li>

                <li>
                    <a href="base.php?dir=pages&file=config" class="nav-link text-white" aria-current="config">
                        <svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.5vw, 10vh)" height="clamp(0.15vh, 1.5vw, 10vh)" fill="currentColor" class="bi bi-gear ms-3" viewBox="0 0 20 20">
                            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                        </svg>
                        Configurações
                    </a>
                </li>

                <li>
                    <a href="base.php?dir=pages&file=contact" class="nav-link text-white" aria-current="contact">
                        <svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.5vw, 10vh)" height="clamp(0.15vh, 1.5vw, 10vh)" fill="currentColor" class="bi bi-envelope ms-3" viewBox="0 0 20 20">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                        </svg>
                        Contato
                    </a>
                </li>
            </ul>

            <hr>

            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="css-img-profile rounded-circle me-2" src="photos/img-profile.jpg" alt="" width="32" height="32" class="rounded-circle me-2">
                    <?php foreach ($records as $record) : ?>
                        <strong><?= $record['name'] ?></strong>
                    <?php endforeach ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="base.php?dir=pages&file=profile">Perfil</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="post">
                            <input type="submit" class="dropdown-item" name="logout" value="Sair">
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="css-main">

        <?php
        if (isset($_GET['dir']) && isset($_GET['file'])) {
            include(__DIR__ . "/{$_GET['dir']}/{$_GET['file']}.php");
        } else {
            include(__DIR__ . "/pages/home.php");
        }
        ?>

        <footer class="d-flex flex-wrap justify-content-between align-items-center p-3 mb-2 border-top bg-dark rounded">
            <!-- container-fluid rounded bg-dark p-3 mb-2 -->
            <div class="col-md-4 d-flex align-items-center">
                <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                    <img class="bi pe-none" src="photos/logo.ico" alt="Home" width="35" height="35">
                </a>
                <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2023 EnKrypto, Inc</span>
            </div>

            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                <li class="ms-2">
                    <a class="text-body-secondary" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.5vw, 10vh)" height="clamp(0.15vh, 1.5vw, 10vh)" fill="currentColor" class="bi bi-facebook" viewBox="0 0 20 20">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                        </svg>
                    </a>
                </li>
                <li class="ms-2">
                    <a class="text-body-secondary" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="clamp(0.15vh, 1.5vw, 10vh)" height="clamp(0.15vh, 1.5vw, 10vh)" fill="currentColor" class="bi bi-instagram" viewBox="0 0 20 20">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                        </svg>
                    </a>
                </li>
            </ul>
        </footer>
    </main>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="js.js"></script>

    <script src="bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>