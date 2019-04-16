<?php

try {

    $db = new PDO('mysql:host=localhost;dbname=actunews', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,//active les erreurs SQL.
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

    ]);

} catch (Exception $e) {
    echo 'Echec de connecion :' . $e->getMessage();
    exit;

}