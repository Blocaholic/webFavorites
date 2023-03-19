<?php
class DB {
  static function connect() {
    try {
      $user = $name = 'd03c79cf';
      $password = 'ZTsLMR9okcpMNqhM';

      $pdo = new PDO("mysql:dbname=$name;host=localhost", $user, $password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch (PDOException $e) {
      throw $e;
    }
  }

  public static function getLinks() {
    try {
      $pdo = DB::connect();
      $query = 'SELECT * FROM links;';
      $statement = $pdo->prepare($query);
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    } catch (PDOException $e) {
      throw $e;
    }
  }
}
?>
