<?php
class Connect
{
    protected $dbhost = "localhost";
    protected $dbuser = "root";
    protected $dbpass = "1234";

    public function getDb($dbname='') {
        $db = null;
        $connectStr = "mysql:host=$this->dbhost;";
        if (!empty($dbname)) {
          $connectStr .= "dbname=$dbname;";
        }

        try
        {
            $db = new PDO($connectStr, $this->dbuser, $this->dbpass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
            catch(PDOException $e) {
            echo $e->getMessage()."\n";
        }

        return $db;
    }
}
?>
