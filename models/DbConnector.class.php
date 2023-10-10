<?php
class DbConnector {
    protected $db;

    public function __construct() {
     $host = "localhost";
     $dbname = "module5";
     $user = "root";
     $password = "";

        // $host = "localhost";
        // $dbname = "module5";
        // $user = "h5326425";
        // $password = "Herzing12#$";

     try {
        $this->db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->db->exec("set names utf8");
    } catch (Exception $e) {
        die("Database Connection Error : " . $e->getmessage());
    }
}

}

?>
