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
        <input class="edit-name" type="text" name="name" id="edit-name" tabindex="2">
      </div>

      <div class="edit-form__items">
        <label for="edit-descr">Nuotraukos adresas</label>
        <input class="edit-descr" type="text" name="photo" id="edit-descr"></input>
      </div>

      <div class="edit-form__items">
        <label for="edit-descr">Kategorijos aprašymas</label>
        <textarea class="edit-descr" name="description" id="edit-desc" cols="60" rows="5"></textarea>
      </div>
      
      <div class="edit-form__controls">
        <button type="submit" class="btn edit-form__button">Create category</button>
        <a href="./index.php" class="btn">Back</a>
      </div>
      
    </form>
  </div>
</body>
</html>