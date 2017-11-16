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

}

 ?>
