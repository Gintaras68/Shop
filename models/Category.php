<?php
 
  class Category {
    public $id;
    public $name;
    public $description;

    public function __construct($id = 0, $name = "", $description = "")
    {
      $this->id = $id;
      $this->name = $name;
      $this->description = $description;
    }

    //* STATINĖ f-ja , surenkanti iš bazės visas kategorijas
    public static function all() {
      $categories = [];                                                               //* masyve talpinsim objektus
      $db = new mysqli("localhost", "root", "", "web_11_23_shop");                    //* organizuojame ryšį su DB
      $result = $db->query("SELECT * from categories");                               //* gauname pagal užklausą duomenis 
      while ($row = $result->fetch_assoc()) {
        $categories[] = new Category($row['id'], $row['name'], $row['description']);  //* kuriam objektus ir dedam į masyvą
      }
      $db->close();                                                                   //* uždarome jungtį su DB
      return $categories;                                                             //* grąžinam masyvą užsakovui
    }

    //* STATINĖ f-ja, randanti bazėje konkrečią kategoriją pagal ID
    public static function find($id) {
      $author = new Category();                     //*  apsauga nuo klaidų  - atsarginis tuščias objektas
      $db = new mysqli("localhost", "root", "", "web_11_23_shop");
      $sql = "SELECT `id`, `name`, `description`    
              FROM `categories`
              WHERE id = ?;";
      $stmt = $db->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();

      while ($row = $result->fetch_assoc()) {
        $author = new Category($row['id'], $row['name'], $row['description']);
      }
      $db->close();

      return $author;
    }

    //* F-ja, atnaujinant `categories` lentelės įrašą pagal ID (gali pasikeisti laukų duomenys)
    public function update() {
      $db = new mysqli("localhost", "root", "", "web_11_23_shop");
      $sql = "UPDATE `categories` SET `name`= ?,`description`= ? WHERE id = ?";
      $stmt = $db->prepare($sql);
      $stmt->bind_param("ssi", $this->name, $this->description, $this->id);
      $stmt->execute();
      $db->close();
    }

    //* F-ja, įterpianti į 'categories'lentelę naują įrašą (indeksas pridedamas automatiškai)
    public function save() {
        $db = new mysqli("localhost", "root", "", "web_11_23_shop");
        $sql = "INSERT INTO `categories`(`name`, `description`) VALUES (?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ss", $this->name, $this->description);
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

  }
?>