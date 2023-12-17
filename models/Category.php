<?php
 
  class Category {
    public $id;
    public $name;
    public $description;
    public $photo;

    public function __construct($id = 0, $name = "", $description = "", $photo = "")
    {
      $this->id = $id;
      $this->name = $name;
      $this->description = $description;
      $this->photo = $photo;
    }

    //* STATINĖ f-ja , surenkanti iš bazės visas kategorijas
    public static function all() {
      $categories = [];                                                               //* masyve talpinsim objektus
      $db = new mysqli("localhost", "root", "", "web_11_23_shop");                    //* organizuojame ryšį su DB
      $result = $db->query("SELECT * from categories");                               //* gauname pagal užklausą duomenis 
      while ($row = $result->fetch_assoc()) {
        $categories[] = new Category($row['id'], $row['name'], $row['description'], $row['photo']);  //* kuriam objektus ir dedam į masyvą
      }
      $db->close();                                                                   //* uždarome jungtį su DB
      return $categories;                                                             //* grąžinam masyvą užsakovui
    }

    //* STATINĖ f-ja, randanti bazėje konkrečią kategoriją pagal ID
    public static function find($id) {
      $author = new Category();                     //*  apsauga nuo klaidų  - atsarginis tuščias objektas
      $db = new mysqli("localhost", "root", "", "web_11_23_shop");
      $sql = "SELECT `id`, `name`, `description`, `photo`    
              FROM `categories`
              WHERE id = ?;";
      $stmt = $db->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();

      while ($row = $result->fetch_assoc()) {
        $author = new Category($row['id'], $row['name'], $row['description'], $row['photo']);
      }
      $db->close();

      return $author;
    }

    //* F-ja, atnaujinant `categories` lentelės įrašą pagal ID (gali pasikeisti laukų duomenys)
    public function update() {
      $db = new mysqli("localhost", "root", "", "web_11_23_shop");
      $sql = "UPDATE `categories` SET `name`= ?,`description`= ?, `photo`= ? WHERE id = ?";
      $stmt = $db->prepare($sql);
      $stmt->bind_param("sssi", $this->name, $this->description, $this->photo, $this->id);
      $stmt->execute();
      $db->close();
    }

    //* F-ja, įterpianti į 'categories'lentelę naują įrašą (indeksas pridedamas automatiškai)
    public function save() {
        $db = new mysqli("localhost", "root", "", "web_11_23_shop");
        $sql = "INSERT INTO `categories`(`name`, `description`, `photo`) VALUES (?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sss", $this->name, $this->description, $this->photo);
        $stmt->execute();
        $db->close();
    }

    //* F-ja, pašalinanti iš lentelės `categories` įrašą su duotu ID
    public static function destroy($id) {
        $db = new mysqli("localhost", "root", "", "web_11_23_shop");
        $sql = "DELETE FROM `categories` WHERE `id` = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $db->close();
    }

    public static function notEmptyCategory() {
      $db = new mysqli("localhost", "root", "", "web_11_23_shop");
      $result = $db->query("SELECT `categories`.id
                            FROM `categories` JOIN `items`
                            ON `categories`.id = `items`.`category_id`
                            GROUP BY `categories`.`id`");
      while ($row = $result->fetch_assoc()) {
        $categories[] = ($row);  //* kuriam objektus ir dedam į masyvą
      }
 
      $db->close();
      return $categories;
    }

  }
?>