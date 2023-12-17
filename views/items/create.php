<?php 
  //  echo $_SERVER['REQUEST_METHOD']."<br>";                                          //!  laikina informacija apie įėjimo būdą
  //* perduodamas indeksas atitinka kategoriją, ...

  include "../../controllers/ItemController.php";
  
  //* grįžus į puslapį su POST užklausa (po mygtuko "išsaugoti" paspaudimo), mes :
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    ItemController::storeNew();               //* - siunčiam duomenis į DB (pdate) panaudojant modelio statinę funkciją ir POST, o po to 
    $key= $_POST['category_id'];
    header("Location: ../categories/show.php?id=".$key);          //* - pereinam į pagrindinį puslapį
  }
  
  // echo var_dump($_GET);       //! laikina info apie GET turinį
  // echo "<br> GET cat=".$_GET['cat']." - kategorijos, kuriai priklausys nauja prekė, ID.<br>"; //!  laikina info. apie priimtą GET parametrą  

  include "../../controllers/CategoryController.php";   //* prireiks jei norime perrinkti kategorijas
  $categories = CategoryController::getAll();           //* iš duomenų bazės paimamos visos kategorijos

  $category = CategoryController::find($_GET['cat']); 
  //  print_r($category);die;
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/main.css">
  <title>Prekės sukūrimas</title>
</head>
<body>
  <div class="container">
    <h1>Naujos Prekės sukūrimas</h1>
    <form action="./create.php" method="post" class="edit-form">

      <div class="edit-form__items">
        <label for="edit-name">Pavadinimas</label>
        <input class="edit-name" type="text" name="title" id="edit-name">
      </div>

      <div class="edit-form__items">
        <label for="edit-price">Kaina</label>
        <input class="edit-name" type="text" name="price" id="edit-price">
      </div>

      <div class="edit-form__items">
        <label for="edit-descr">Aprašymas</label>
        <input class="edit-descr" type="text" name="description" id="edit-descr"></input>
      </div>

      <div class="edit-form__items">
        <label for="edit-descr">Nuotraukos adresas</label>
        <input class="edit-descr" type="text" name="photo" id="edit-descr" value="https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-15.png"></input>
      </div>

      <div class="edit-form__items">
        <label for="edit-category">Kategorija</label>
        <select class="form-select" name="category_id" id="edit-category">
          <?php foreach ($categories as $check) { ?>
            <?php ($check->id == $_GET['cat']) ? $atr = " selected" : $atr = "" ?>
            <option value="<?= $check->id ?>" <?= $atr ?>><?= $check->name ?></option>
          <?php } ?>
        </select>
      </div>


      <div class="edit-form__items">
        <button type="submit" class="btn edit-form__button">Create</button>
        <a href="../categories/show.php?id=<?= $_GET['cat'] ?>" class="btn">Back</a>
      </div>
      
    </form>
  </div>
</body>
</html>