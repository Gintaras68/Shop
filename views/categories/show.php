//* skirtas parodyti konkrečios kategorijos prekes
<?php    
  if (!isset($_GET['id'])) {          //* čia galima patekti tik nurodant kategorijos indeksą !
    header("Location: ./index.php");  //* priešingu atveju saugumo sumetimais nukreilia į pradinį puslapį.
  }

  //* gauname pasirinktą kategoriją atitinkančių prekių masyvą


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
    <h1> ... kategorijos ...  prekės</h1>

  </div>
</body>
</html>