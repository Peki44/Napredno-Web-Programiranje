<?php
// učitavanje XML datoteke
$xml = simplexml_load_file('LV2.xml');

// iteracija kroz svaku osobu u datoteci
foreach ($xml->record as $osoba) {
    // prikazivanje podataka o osobi
    echo '<div class="profil">';
    echo '<img src="' . $osoba->slika . '" alt="' . $osoba->ime . ' ' . $osoba->prezime . '">';
    echo '<h2>' . $osoba->ime . ' ' . $osoba->prezime . '</h2>';
    echo '<p><strong>ID:</strong> ' . $osoba->id . '</p>';
    echo '<p><strong>Email:</strong> ' . $osoba->email . '</p>';
    echo '<p><strong>Spol:</strong> ' . $osoba->spol . '</p>';
    echo '<p><strong>Životopis:</strong> ' . $osoba->zivotopis . '</p>';
    echo '</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
     div{
        margin:auto;
        width:70%;
        text-align: center;
        border: 3px solid black;
        padding:3%;
        margin-bottom: 50px;
     }
    </style>
</head>
<body>
    
</body>
</html>