<?php    
  if (!isset($_GET['id'])) {          //* čia galima patekti tik nurodant kategorijos indeksą !
    header("Location: ./index.php");  //* priešingu atveju saugumo sumetimais nukelia į pradinį puslapį.
  }

  include "../../controllers/CategoryController.php";
  include "../../controllers/ItemController.php";

  //* gauname pasirinktą kategoriją atitinkančių prekių masyvą


 //* jeigu atėjosme per GET su perduotu indeksu - dirbsime su šia kategorija
 $category = CategoryController::find($_GET['id']);  //*  kategorijos pavadinimas  
 $items = ItemController::findItemsByCategory($_GET['id']);
//  print_r($items);die;

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/main.css">
  <title>Prekės</title>
</head>
<body>
  <div class="container">
    <h1>Kategorija "<?= $category->name ?>" </h1>
    <p class="description"> <?= $category->description ?></p>

    <div class="products">
      <ul class="products__list">
        <?php foreach ($items as $key => $item) { ?>     
        
        <li class="products__item">
          <a class="products__link" href="../items/index.php<?='?id='.$item->id?>">
            <img src="<?=$item->photo ?>" alt="">
            <h2 class="products__title"><?= $item->title ?></h2>
          </a>
        </li>

        <?php } ?>
      </ul>
    </div>
    
  </div>
</body>
</html>