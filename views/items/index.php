<?php 
    include "../../controllers/CategoryController.php";
    include "../../controllers/ItemController.php";

    echo $_SERVER['REQUEST_METHOD']."<br>";  
    
    $categories = CategoryController::getAll();   //* iš duomenų bazės paimamos visos kategorijos
    // $postAddress = 0;
    
    if(isset($_GET['category-id'])){
      echo "Patekau į GET ";  
      print_r($_GET['category-id']);
      
      $activeCategory = $_GET['category-id'];
      $items = ItemController::findItemsByCategory($_GET['category-id']);
    } else {
      $activeCategory = "0";
       $items = ItemController::getAll();    //* atėjus per GET pirmiausia užkraunami VISI 'item' 
     }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="../../css/main.css">
  <title>Pekių sąrašas</title>
</head>
<body>
  <div class="container">
    <header class="header">
      <h1>Prekių sąrašas</h1>
      <div class="create">
        <a href="./../categories/index.php" class="btn btn--create">Prekių kategorijos</a>
      </div>
    </header>

    <div class="filter">
      <p class="filter__descr">Pasirinktos prekės iš:</p>
      
      <form action="./index.php" class="filter__form" method="get">

        <select class="filter__form-select" name="category-id" id="edit-category">
            <option value="0">Visas ...</option>
        <?php foreach ($categories as $check) { ?>
            <?php ($check->id == $_GET['category-id']) ? $atr = " selected" : $atr = "" ?>
            <option value="<?= $check->id ?>" <?= $atr ?>><?= $check->name ?></option>
          <?php } ?>
        </select>

        <button type="submit" class="btn edit-form__button">Filtruoti ...</button>
      </form>
    </div>

    <div class="products">
      <ul class="products__list">
      <?php foreach ($items as $key => $item) { ?>     
        
        <?php ($item->photo != "") ? $photo = $item->photo : $photo = "https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-15.png" ; ?>
        <li class="products__item">
          <a class="products__link" href="../items/show.php<?='?id='.$item->id?>">
            <img src="<?=$photo ?>" alt="">
            <h2 class="products__title"><?= $item->title ?></h2>
          </a>
        </li>
          
      <?php } ?>
      </ul>
    </div>
  </div>
</body>
</html>