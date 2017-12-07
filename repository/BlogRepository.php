<?php
require_once 'lib/Repository.php';

class BlogRepository extends Repository {

  protected $tableName = "blog";

  public function getByUserId($id) {
    $query = "SELECT * FROM {$this->tableName} WHERE userId=? ORDER BY id DESC";
    $statement = Database::getConnection()->prepare($query);
    $statement->bind_param('i', $id);
    $statement->execute();
    $result = $statement->get_result();
    if (!$result) {
        throw new Exception($statement->error);
    }
    return $result;
  }

  public function add($userId, $title, $content) {
    $query = "INSERT INTO {$this->tableName} (title, content, userId) VALUES (?, ?, ?)";
    $statement = Database::getConnection()->prepare($query);
    $statement->bind_param('ssi', $title, $content, $userId);
    return $statement->execute();
  }

  public function getLastInserted($userId) {
    $query = "SELECT id FROM {$this->tableName} WHERE userId = ? ORDER BY id DESC LIMIT 1";
    $statement = Database::getConnection()->prepare($query);
    $statement->bind_param('s', $userId);
    $statement->execute();
    $result = $statement->get_result();
    if (!$result) {
        throw new Exception($statement->error);
    }
    return $result->fetch_object()->id;
  }

}

 ?>
