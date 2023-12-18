<?php 
  //* Klasė, skirta  prekės objektui saugoti

  class Item {
    public $id;
    public $title;
    public $price;
    public $description;
    public $photo;
    public $category_id;

    public function __construct($id = 0, $title = "", $price = 0, $description = "", $photo = "", $category_id = 0) {
      $this->id = $id;
      $this->title = $title;
      $this->price = $price;
      $this->description = $description;
      $this->photo = $photo;
      $this->category_id = $category_id;
    }

    //* STATINĖ f-ja , surenkanti iš bazės visas prekes
    public static function all() {
      $items = [];                                                                    //* masyve talpinsim objektus
      $db = new mysqli("localhost", "root", "", "web_11_23_shop");                    //* organizuojame ryšį su DB
      $result = $db->query("SELECT * from items");                                    //* gauname pagal užklausą duomenis 
      while ($row = $result->fetch_assoc()) {
        $items[] = new Item($row['id'], $row['title'], $row['price'], $row['description'], $row['photo'], $row['category_id']);  //* kuriam objektus ir dedam į masyvą
      }
      $db->close();                                                                   //* uždarome jungtį su DB
      return $items;                                                                  //* grąžinam masyvą užsakovui
    }

    //* STATINĖ f-ja , surenkanti iš bazės visas nurodytos kategorijos prekes
    public static function findAllByCategory($categoryId) {
      $items = [];                     
      $db = new mysqli("localhost", "root", "", "web_11_23_shop");
      $sql = "SELECT `id`, `title`, `price`, `description`, `photo`, `category_id`
              FROM   `items`
              WHERE  ";                 //* užklausos SQL
      
      if ($categoryId != 0) {
        $sql .= "category_id = ?;";
        $stmt = $db->prepare($sql);                         //* apsauga                          
        $stmt->bind_param("i", $categoryId);
        $stmt->execute();
      } else {
        $sql .= "1;";
        $stmt = $db->prepare($sql);                         //* apsauga                          
      }
      
      $stmt->execute();
      $result = $stmt->get_result();                      //* gautas iš DB rezultatas

      while ($row = $result->fetch_assoc()) {             
        $items[] = new Item($row['id'], $row['title'], $row['price'], $row['description'], $row['photo'], $row['category_id']);
      }
      $db->close(); 
      return $items;
    }

    //* STATINĖ f-ja , grąžinanti prekę pagal jos ID
    public static function findByID($id) {
      $item = new Item();                     
      $db = new mysqli("localhost", "root", "", "web_11_23_shop");
      $sql = "SELECT `id`, `title`, `price`, `description`, `photo`, `category_id`
              FROM   `items`
              WHERE  id = ?;";                 //* užklausos SQL
      $stmt = $db->prepare($sql);              //* apsauga                          
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();           //* gautas iš DB rezultatas - sąrašas įrašų, atitinkančių ID

      while ($row = $result->fetch_assoc()) {             
        $item = new Item($row['id'], $row['title'], $row['price'], $row['description'], $row['photo'], $row['category_id']);
      }
      $db->close(); 
      return $item;
    }    

    //* F-ja, atnaujinant `items` lentelės įrašą šio objekto duomenimis pagal ID (gali pasikeisti laukų duomenys)
    public function update() {
      $db = new mysqli("localhost", "root", "", "web_11_23_shop");
      $sql = "UPDATE `items` SET `title`= ?, `price`= ?, `description`= ?, `photo`= ?, `category_id`= ? 
              WHERE `id` = ?";
      $stmt = $db->prepare($sql);
      $stmt->bind_param("sissii", $this->title, $this->price, $this->description, $this->photo, $this->category_id, $this->id);
      $stmt->execute();
      $db->close();
    }
    
    //* F-ja, įterpianti į 'categories'lentelę naują įrašą (indeksas pridedamas automatiškai) su objekto duomenimis
    public function saveNew() {
      $db = new mysqli("localhost", "root", "", "web_11_23_shop");
      $sql = "INSERT INTO `items`(`title`, `price`, `description`, `photo`, `category_id`) VALUES (?, ?, ?, ?, ?)";
      $stmt = $db->prepare($sql);
      $stmt->bind_param("sissi", $this->title, $this->price, $this->description, $this->photo, $this->category_id);
      $stmt->execute();
      $db->close();
    }
    
    //* F-ja, pašalinanti iš lentelės `items` įrašą su duotu ID
    public static function destroy($id) {
      $db = new mysqli("localhost", "root", "", "web_11_23_shop");
      $sql = "DELETE FROM `items` WHERE `id` = ?";
      $stmt = $db->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $db->close();
    }
  }
?>