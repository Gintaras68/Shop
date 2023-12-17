<?php
    
    //? atėjus į pagrindinį - perveda į už kategorijų atvaizdavimą atsakingą puslapį.
    
    header("Location: ./views/categories");    
    die;
    
?>

<?php
// $servername = "localhost";          //* naudojames vietiniu serveriu ...
// $username = "root";                 //* tai vartotojas "pagal nutylėjimą"
// $password = "";                     //*  ir jo slaptažodis "pagal nutylėjimą"
// $dbname = "web_11_23_shop";      //* pavadinimas duomenų bazės, prie kurios jungsimės

// $conn = new MySQLi($servername, $username, $password, $dbname); //* sukuriame ryšio su duomenų baze kanalą - tai klasės  MySQLi egzempliorius

// $sql = "SELECT * FROM categories; ";   //* suformuojama užklausos eilutė
// $result = $conn->query($sql);       //* užklausa perduodama duomenų bazei (funkcija  query() ) ir ji grąžina darbo rezultatą - objektą (išsaugome kintamajame)
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
</head>
<body>
    <h1>Pirminis puslapis peradresavimui</h1>
    
    <?php
    //? duomenų bazė grąžino objektą. Jo funkcija  fetch_assoc()  ima sekančią masyvo eilutę ir ją priskiriam kintamajam $row
    // while ($row = $result->fetch_assoc()) {     //*  išveda gautą užklausos rezultatą į naršyklę kaip eilę pastraipų
    //     echo "<p>id: " . $row["id"] . " - Name: " . $row["name"] . " Aprašymas: " . $row["description"] . "</p>";
    // }

    // $conn->close();                              //* uždarome ryšio su duomenų baze kanalą - panaikname objektą.
    ?>
</body>
</html>