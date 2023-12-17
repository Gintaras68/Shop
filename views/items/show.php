<?php    
  // echo $_SERVER['REQUEST_METHOD']."<br>";
  
  if (!isset($_GET['id'])) {          //* čia galima patekti tik nurodant prekės indeksą !
    header("Location: ../categories/index.php");  //* priešingu atveju saugumo sumetimais nukelia į pradinį puslapį.
  }
  
  include "../../controllers/ItemController.php";
  // echo "GET id=".$_GET['id']." - item (prekės) ID.<br>";
  
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    ItemController::destroy($_POST['id']);
    $addr = "Location: ../categories/show.php?id=".$_POST['cat'];
    header($addr);
  }
  
  //* gauname pasirinktą prekę pagal su GET perduotu jos ID
  $item = ItemController::findItem($_GET['id']);
  // print_r($item);die;
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/main.css">
  <title>Preke</title>
</head>
<body>
  <div class="container">
    <a href="../../index.php" class="link-back">
      <img src="../../img/house-64.png" width="32" height="32" alt="">
    </a>
    <h1><?= $item->title ?></h1>

    <div class="present">
      <div class="present__image"><img src="<?= $item->photo ?>" alt="" class="image"></div>
      <div class="present__info">
        <p class="info__price">Kaina: <span><?= $item->price ?> &euro;</span></p>
        <p class="info__description"><?= $item->description ?></p>
      </div>
    </div>
    <div class="item-control">
    
      <div class="create">
        <a href="../categories/show.php?id=<?= $item->category_id ?>" class="btn btn--create"><  <  < Back to list</a>
      </div>

      <form action="./edit.php" method="get" class="item-control__form">
        <input type="hidden" name="id" value="<?= $item->id ?>">
        <button class="btn btn--edit" type="submit">edit</button>
      </form>

      <form action="<?= './show.php?id='. $item->id ?>" method="post" class="item-control__form">
        <input type="hidden" name="id" value="<?= $item->id ?>">
        <input type="hidden" name="cat" value="<?= $item->category_id ?>">
        <button class="btn btn--delete">delete</button>
      </form>

      <div class="create">
        <a href="./create.php?cat=<?=$item->category_id?>" class="btn btn--create">Add new item</a>
      </div>
    
    </div>
  </div>
  
  
</body>
</html>