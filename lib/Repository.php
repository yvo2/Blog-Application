<?php
require_once 'Database.php';

/**
 * Repository base class
 * comes with some helper methods
 */
class Repository {

  /**
   * TableName should be set by subclass
   */
   protected $tableName = null;

   /**
    * Read an entry by id and return all fields
    */
    public function getById($id) {
      $query = "SELECT * FROM {$this->tableName} WHERE id=?";
      $statement = Database::getConnection()->prepare($query);
      $statement->bind_param('i', $id);
      $statement->execute();
      $result = $statement->get_result();
      if (!$result) {
          throw new Exception($statement->error);
      }
      $row = $result->fetch_object();
      $result->close();
      return $row;
    }

    /**
     * Read all entries
     * @return result The ResultSet to iterate over.
     */
    public function getAll() {
     $query = "SELECT * FROM {$this->tableName}";
     $statement = Database::getConnection()->prepare($query);
     $statement->execute();
     $result = $statement->get_result();
     if (!$result) {
         throw new Exception($statement->error);
     }
     return $result;
    }

}

 ?>
