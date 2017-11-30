<?php
require_once 'lib/Repository.php';

class UserRepository extends Repository {

  protected $tableName = 'user';

  public function existEmail($email) {
    $query = "SELECT COUNT(*) AS emails FROM {$this->tableName} WHERE email=?";
    $statement = Database::getConnection()->prepare($query);
    $statement->bind_param('s', $email);
    $statement->execute();
    $result = $statement->get_result();
    if (!$result) {
        return false;
    }
    $row = $result->fetch_object();
    $result->close();
    return $row->emails != 0;
  }

  public function register($email, $name, $password) {
    $password = md5($password);

    $query = "INSERT INTO {$this->tableName} (email, name, password) VALUES (?, ?, ?)";
    $statement = Database::getConnection()->prepare($query);
    $statement->bind_param('sss', $email, $name, $password);
    return $statement->execute();
  }

}

 ?>
