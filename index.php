<?php
session_start();
$token = $_SESSION['token'];
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://evaluation-technique.lundimatin.biz/api/clients",
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
    <title>Index Page</title>
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
            <h2>Rechercher un contact</h2>
        </div>
        <div class="search_box">
            <label for="search">Renseignez un nom ou une dénomination </label>
            <input type="text" name="search" placeholder="Rechercher un contact">
            <button name="submit-search" id="search">Rechercher</button>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Téléphone</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                foreach ($data as $item) {
                    echo "<tr>";
                    echo "<td>" . $item->id . "</td>";
                    echo "<td>" .  "</td>";
                    echo "<td>" .  "</td>";
                    echo "<td>" .  "</td>";
                    echo "<td>" .  "</td>";
                    echo "<td> <a href='detail.php?id=" . $item->id . "' type='button' class='btn btn-primary'>Voir</a></td>";
                    echo "<tr>";
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/search.js"></script>
</body>
</html>
