<?php
session_start();
$token = $_SESSION['token'];
$curl = curl_init();
$client_id = $_GET['id'];
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://evaluation-technique.lundimatin.biz/api/clients/" . $client_id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Accept: application/api.rest.v1+json",
        "Authorization: Basic dGVzdF9hcGk6YXBpMTIzNDU2",
    ),
));
$data = json_decode(curl_exec($curl), false)->datas;
$err = curl_error($curl);
curl_close($curl);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detailed Page</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7a81e78580.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<header>
    <div class="header-title">
        <a class="header-link" href="index.php">Rechercher un contact</a>
    </div>
    <div class="header-login">
        <?php
        if (isset($_SESSION['token'])) {
            echo "<a class='header-link' href='logout.php'><i class='fa-solid fa-arrow-right-from-bracket'></i> Déconnexion</a>";
        } else {
            echo "<a class='header-link' href='login.php'>Connexion <i class='fa-regular fa-user'></i></a>";
        }
        ?>
    </div>
</header>
<main>
    <div class="container">
        <div class="title">
            <h2><?php echo $data->nom ?></h2>
            <a type="button" href="edit.php?id=<?php echo $data->id ?>" class="btn btn-primary">Modifier</a>
        </div>
        <div class="information">
            <div class="row">
                <div class="col-6 title-information">
                    <p>ID</p>
                    <p>Nom</p>
                    <p>Email</p>
                    <p>Telephone</p>
                    <p>Adresse</p>
                    <p>Code postal</p>
                    <p>Ville</p>
                    <p>Date de création</p>
                </div>
                <div class="col-6">
                    <?php
                    echo "<p>" . $data->id . "</p>";
                    echo "<p>" . $data->nom . "</p>";
                    echo "<p>" . $data->email . "</p>";
                    echo "<p>" . $data->tel . "</p>";
                    echo "<p>" . $data->adresse . "</p>";
                    echo "<p>" . $data->code_postal . "</p>";
                    echo "<p>" . $data->ville . "</p>";
                    echo "<p>" . $data->date_creation . "</p>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
