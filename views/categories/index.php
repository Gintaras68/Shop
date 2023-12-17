<?php
  include "../../controllers/CategoryController.php";
  
  if($_SERVER['REQUEST_METHOD'] == "POST"){       //* trynimui grįžtame iš formos su POST
    CategoryController::destroy($_POST['id']);
    header("Location: ./index.php");
  }
  
  $categories = CategoryController::getAll();   //* iš duomenų bazės paimamos visos kategorijos
  
  $categoriesNotEmpty = Category::notEmptyCategory();

  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/main.css">
  <title>Prekiu kategorijos</title>
</head>
<body>
  <div class="container">
    <h1>Prekių kategorijos</h1>

    <table class="table">
      <tr class="row">
        <th class="row__name">Kategorija</th>
        <th class="row__photo"></th>
        <th class="row__descript">Aprašymas</th>
        <th class="row__controll"> </th>
      </tr>

      <?php foreach ($categories as $key => $category) { ?>     

        <?php $isEmpty = " disabled"; 
          foreach ($categoriesNotEmpty as $value) {
            if (implode($value) == $category->id) {
              $isEmpty = "";
            } ;
          }
        ?>
       
        <tr class="row">
          <td class="row__name"> <?= $category->name ?></td>
          <td class="row__photo">
            <?php ($category->photo != "") ? $photo = $category->photo : $photo = "https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-15.png" ; ?>
            <img src="<?= $photo ?>" alt="photo" class="category-image">
          </td>
          <td class="row__descript"> <?= $category->description ?></td>
          <td class="row__controll controlls">

            <div class="controlls__item">
              <a href="./show.php?id=<?= $category->id ?>" class="btn btn--show">go to</a>
            </div>

            <div class="controlls__item">
              <form action="./edit.php" method="get">
                <input type="hidden" name="id" value="<?= $category->id ?>">
                <button class="btn btn--edit" type="submit">edit</button>
              </form>
            </div>

            <div class="controlls__item">
              <form action="./index.php" method="post">
              <input type="hidden" name="id" value="<?= $category->id ?>">
              <button class="btn btn--delete"<?= $isEmpty?>>delete</button>
            </form>
            </div>
          </td>
        </tr>
      <?php } ?>
        
    </table>
    
    <div class="create">
      <a href="./create.php" class="btn btn--create">Create new category</a>
    </div>
  </div>
</body>
</html>