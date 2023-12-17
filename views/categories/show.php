<?php  
  // echo $_SERVER['REQUEST_METHOD']."<br>";

  if (!isset($_GET['id'])) {          //* čia galima patekti tik nurodant kategorijos indeksą !
    header("Location: ./index.php");  //* priešingu atveju saugumo sumetimais nukelia į pradinį puslapį.
  }
  // echo "GET id=".$_GET['id']." - kategorijos ID.<br>";
  
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
    <a href="index.php" class="link-back">
      <img src="../../img/house-64.png" width="32" height="32" alt="">
    </a>
    <h1>Kategorija "<?= $category->name ?>" </h1>
    <p class="description"> <?= $category->description ?></p>

    <div class="products">
      <ul class="products__list">
        <?php foreach ($items as $key => $item) { ?>     
        
        <li class="products__item">
          <a class="products__link" href="../items/show.php<?='?id='.$item->id?>">
            <img src="<?=$item->photo ?>" alt="">
            <h2 class="products__title"><?= $item->title ?></h2>
          </a>
        </li>

        <?php } ?>
      </ul>
    </div>

    <div class="control">
      <div class="create">
          <a href="./../items/create.php?cat=<?=$item->category_id?>" class="btn btn--create">Add new item</a>
      </div>
    </div>
    
  </div>
</body>
</html>