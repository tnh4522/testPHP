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
    <title>Edit Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/7a81e78580.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php
if (isset($_POST['submit-edit'])) {
    $curl = curl_init();
    $client_id = $_POST['id'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $adresse = $_POST['adresse'];
    $code_postal = $_POST['code_postal'];
    $ville = $_POST['ville'];
    $data = array(
        'nom' => $nom,
        'email' => $email,
        'tel' => $tel,
        'adresse' => $adresse,
        'code_postal' => $code_postal,
        'ville' => $ville,
    );
    $data_json = json_encode($data);
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://evaluation-technique.lundimatin.biz/api/clients/" . $client_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_HTTPHEADER => array(
            "Accept: application/api.rest.v1+json",
            "Authorization: Basic dGVzdF9hcGk6YXBpMTIzNDU2",
            "Content-Type: application/json",
        ),
        CURLOPT_POSTFIELDS => $data_json,
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        header('Location: detail.php?id=' . $client_id);
    }
}
?>
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
                    <p>Nom</p>
                    <p>Email</p>
                    <p>Telephone</p>
                    <p>Adresse</p>
                    <p>Code postal</p>
                    <p>Ville</p>
                </div>
                <div class="col-6">
                    <form class="form-edit" method="post">
                        <input type="hidden" name="id" value="<?php echo $data->id ?>">
                        <input type="text" name="nom" value="<?php echo $data->nom ?>">
                        <input type="text" name="email" value="<?php echo $data->email ?>">
                        <input type="text" name="tel" value="<?php echo $data->tel ?>">
                        <input type="text" name="adresse" value="<?php echo $data->adresse ?>">
                        <input type="text" name="code_postal" value="<?php echo $data->code_postal ?>">
                        <input type="text" name="ville" value="<?php echo $data->ville ?>">
                        <button type="button" onclick="window.location.href='index.php'">Retour</button>
                        <button type="submit" name="submit-edit">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
