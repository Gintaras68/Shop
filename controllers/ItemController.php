<?php 
  include "../../models/Item.php";    //* įsikelsime klasės kodą, kad galėtume pasinaudoti

  class ItemController {              //*  tai klasė, kurioje tik statinės funkcijos ↓

    public static function getAll() {       //* grąžina masyvą su kategorijų objektais,
      return Item::all();               //*   (pasinaudojo statine kategorijų funkcija)
    }


    public static function findItemsByCategory($id){       //* grąžina kategorijos su nurodytu ID prekių sąrašą
      $items = Item::findAllByCategory($id);      //*   (pasinaudojo statine Prekių funkcija)
      return $items;
    }

    public static function findItem($id) {                //* randa prekę pagal jos ID
      $item = Item::findByID($id);
      return $item;
    }

    public static function update($id) {    //* atnaujina įrašą pagal perduotą ID
      $item = Item::findByID($id);                  //* 1.  surandame reikaimą įrašą DB `ėje (modelio stat. f-ja)
      $item->title = $_POST['title'];               //* 2.  suteikiame jo laukams naujas reikšmes (jos gautos per POST)
      $item->price = $_POST['price'];
      $item->description = $_POST['description'];
      $item->photo = $_POST['photo'];
      $item->category_id = $_POST['category_id'];
      $item->update();                              //* 3.  atnaujinam įrašą DB `ėje (modelio f-ja)
    }

    public static function storeNew() {        //* sukuria naują įrašą suteikiant naują ID
      $item = new Item();                           //* 1.  formuojamas naujas egzempliorius
      $item->title = $_POST['title'];               //* 2.  suteikiame jo laukams naujas reikšmes
      $item->price = $_POST['price'];
      $item->description = $_POST['description'];
      $item->photo = $_POST['photo'];
      $item->category_id = $_POST['category_id'];
      $item->saveNew();                             //* 3.  su egzemplioriaus f-ja sukuriamas naujas įrašas
    }

    public static function destroy($id) {   //* panaikina įrašą su nurodytu ID
      Item::destroy($id);                         //* panaudojama Item klasės statinė f-ja
    }

  }
 ?>