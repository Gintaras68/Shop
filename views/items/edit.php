<?php 
//  echo $_SERVER['REQUEST_METHOD']."<br>";                                          //!  laikina informacija apie įėjimo būdą
  include "../../controllers/ItemController.php";
  include "../../controllers/CategoryController.php";
  
  //* duomenys svarbūs, todėl siunčiami POST metodu sau pačiam, taigi
  //* užėjus į puslapį su POST užklausa, mes :
  //*     - siunčiam duomenis į DB (pdate) panaudojant modelio statinę funkciją  ir 
  //*     - grįžtame atgal su GET (neužmirštame savo indekso!)
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    ItemController::update($_POST['id']);
    header("Location: ./../categories/show.php?id=".$_POST['category_id'].'"');
  }

  // echo var_dump($_GET);       //! laikina info apie GET turinį
  echo "<br> GET id=".$_GET['id']." - redaguojamos prekės indeksas ( ID ).<br>"; //!  laikina info. apie priimtą GET parametrą 

  //* jeigu atėjome per GET su perduotu indeksu - randame atitinkamą prekės įrašą
  $item = ItemController::findItem($_GET['id']);    

  //* iš duomenų bazės paimamos visos kategorijos (kategorijai pasirinkti)
  $categories = CategoryController::getAll();   
  // print_r($item);die;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/main.css">
  <title>Prekės redagavimas</title>
</head>
<body>
  <div class="container">
    <h1>Prekės "<?= $item->title ?>" redagavimas</h1>
    <form action="./edit.php?id=<?= $item->id ?>" method="post" class="edit-form">
      <div class="edit-form__items">
        <label for="edit-name">Pavadinimas</label>
        <input class="edit-name" type="text" name="title" id="edit-name" value="<?= $item->title ?>">
      </div>

      <div class="edit-form__items">
        <label for="edit-price">Kaina</label>
        <input class="edit-name" type="text" name="price" id="edit-price" value="<?= $item->price ?>">
      </div>

      <div class="edit-form__items">
        <label for="edit-descr">Aprašymas</label>
        <input class="edit-descr" type="text" name="description" id="edit-descr" value="<?= $item->description ?>"></input>
      </div>

      <div class="edit-form__items">
        <label for="edit-descr">Nuotraukos adresas</label>
        <input class="edit-descr" type="text" name="photo" id="edit-descr" value="<?= $item->photo ?>""></input>
      </div>

      <div class="edit-form__items">
        <label for="edit-category">Kategorija</label>
        <select class="form-select" name="category_id" id="edit-category">
          <?php foreach ($categories as $check) { ?>
            <?php ($check->id == $item->category_id) ? $atr = " selected" : $atr = "" ?>
            <option value="<?= $check->id ?>" <?= $atr ?>><?= $check->name ?></option>
          <?php } ?>
        </select>
      </div>      
      
      <div class="edit-form__items">
        <input type="hidden" name="id" value="<?=$item->id?>">
        <button type="submit" class="btn edit-form__button">Išsaugoti duomenis</button>
        <a href="./show.php?id=<?=$_GET['id']?>" class="btn">Back</a>
      </div>
    </form>
  </div>
</body>
</html>