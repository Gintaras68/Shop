<?php 
  include "../../controllers/CategoryController.php";

  //* duomenys svarbūs, todėl siunčiami POST metodu sau pačiam, taigi
  //* užėjus į puslapį su POST užklausa, mes :
  //*     - siunčiam duomenis į DB (pdate) panaudojant modelio statinę funkciją  ir 
  //*     - pereinam į pagrindinį puslapį
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    CategoryController::update($_POST['id']);
    header("Location: ./index.php");
  }

  //* jeigu atėjosme per GET su perduotu indeksu - randame atitinkamą kategorijos įrašą
  $category = CategoryController::find($_GET['id']);    
  echo "Esu  edit.php faile...";
  // print_r($category);die;

  //!   kaip teksto lauką užpildyti jau esamais duomenimis TEXTAREA lauke ? ?
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/main.css">
  <title>Kategorijos redagavimas</title>
</head>
<body>
  <div class="container">
    <h1>Kategorijos <?= $category->name ?> redagavimas</h1>
    <form action="./edit.php" method="post" class="edit-form">


      <div class="edit-form__items">
        <label for="edit-name">Kategorijos pavadinimas</label>
        <input class="edit-name" type="text" name="name" id="edit-name" value="<?= $category->name ?>">
      </div>

      <div class="edit-form__items">
        <label for="edit-descr">Kategorijos aprašymas</label>
        <input class="edit-descr" type="text" name="description" id="edit-descr" value="<?= $category->description ?>"></input>
      </div>
      
      <div class="edit-form__items">
        <input type="hidden" name="id" value="<?=$category->id?>">
        <button type="submit" class="btn edit-form__button">Išsaugoti duomenis</button>
        <a href="./index.php" class="btn">Atgal</a>
      </div>
    </form>
  </div>
</body>
</html>