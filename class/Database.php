<?php
class Database
{

    private $host       = "";
    private $username   = "lucas";
    private $password   = "$Askdp198ds90QD8Lndl01@";
    private $dbname     = "gbd";

    
  private static $instance = null;  // connection instance

  /**
    * make a connection to the database and return only one instance (singleton)
    *
    * @return mixed
    */
  private function getDb()
  {
      if(self::$instance === null){
          $conn = new PDO("mysql:host=$this->host;
                          dbname=$this->dbname;charset=utf8;",
                          $this->username,
                          $this->password,
                          array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            
          if($conn){
              self::$instance = $conn;
              return self::$instance;
          }else{
              die('connexion impossible !');
          }
      }   else{
              return self::$instance;
        }
    }

    
    /**
     * Execute a query (prepared or direct)
     *
     * @param  string $sql query to execute
     * @param  array $params parameters for inclusion in the query
     * @return mixed result of the query
     */
    protected function executeQuery($sql, $params = null)
    {
      if ($params == null) {
        $result = $this->getDb()->query($sql);    // quick query
      }
      else {
        $result = $this->getDb()->prepare($sql);  // prepared query
        $result->execute($params);
      }
      return $result;
    }   
}
