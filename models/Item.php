<?php 
  //* Klasė, skirta  prekės objektui saugoti

  class Item {
    public $id;
    public $title;
    public $price;
    public $description;
    public $photo;
    public $categoryId;

    public function __construct($id = 0, $title = "", $price = 0, $description = "", $photo = "", $categoryId = 0) {
      $this->id = $id;
      $this->title = $title;
      $this->price = $price;
      $this->price = $description;
      $this->price = $photo;
    }
  }
?>