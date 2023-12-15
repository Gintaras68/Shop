<?php 
  include "../../models/Category.php";    //* įsikelsime klasės kodą, kad galėtume pasinaudoti

  class CategoryController {              //*  tai klasė, kurioje tik statinės funkcijos ↓

    public static function getAll() {       //* grąžina masyvą su kategorijų objektais,
      return Category::all();               //*   (pasinaudojo statine kategorijų funkcija)
    }

    public static function find($id){       //* grąžina kategorijos su nurodytu ID objektą
      $category = Category::find($id);      //*   (pasinaudojo statine kategorijų funkcija)
      return $category;
    }

    public static function update($id) {    //* atnaujina įrašą pagal perduotą ID
      $category = Category::find($id);                //* 1.  surandame reikaimą įrašą DB `ėje (modelio stat. f-ja)
      $category->name = $_POST['name'];               //* 2.  suteikiame jo laukams naujas reikšmes
      $category->description = $_POST['description'];
      $category->photo = $_POST['photo'];
      $category->update();                            //* 3.  atnaujinam įrašą DB `ėje (modelio f-ja)
    }

    public static function store() {        //* sukuria naują įrašą suteikiant naują ID
      $category = new Category();                     //* 1.  formuojamas naujas egzempliorius
      $category->name = $_POST['name'];
      $category->photo = $_POST['photo'];
      $category->description = $_POST['description'];
      $category->save();                              //* 2.  su egzemplioriaus f-ja sukuriamas naujas įrašas
    }

    public static function destroy($id) {   //* panaikina įrašą su nurodytu ID
      Category::destroy($id);                         //* panaudojama Category klasės statinė f-ja
    }

  }
 ?>