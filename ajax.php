<?php
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://evaluation-technique.lundimatin.biz/api/clients?nom=$name",
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
    echo json_encode($data);
}
