<?php 
  include "../../controllers/CategoryController.php";

  //* užėjus į puslapį su POST užklausa (po mygtuko "išsaugoti" paspaudimo), mes :
  //*     - siunčiam duomenis į DB (pdate) panaudojant modelio statinę funkciją  ir 
  //*     - pereinam į pagrindinį puslapį
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    CategoryController::store();
    header("Location: ./index.php");
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/main.css">
  <title>Kategorijos sukūrimas</title>
</head>
<body>
  <div class="container">
    <h1>Naujos Kategorijos sukūrimas</h1>
    <form action="./create.php" method="post" class="edit-form">

      <div class="edit-form__items">
        <label for="edit-name">Kategorijos pavadinimas</label>
        <input class="edit-name" type="text" name="name" id="edit-name">
      </div>

      <div class="edit-form__items">
        <label for="edit-descr">Nuotraukos adresas</label>
        <input class="edit-descr" type="text" name="photo" id="edit-descr" value="https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-15.png"></input>
      </div>

      <div class="edit-form__items">
        <label for="edit-descr">Kategorijos aprašymas</label>
        <input class="edit-descr" type="text" name="description" id="edit-descr"></input>
      </div>
      
      <div class="edit-form__items">
        <button type="submit" class="btn edit-form__button">Create</button>
        <a href="./index.php" class="btn">Back</a>
      </div>
      
    </form>
  </div>
</body>
</html>