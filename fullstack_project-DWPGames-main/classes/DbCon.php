<?php
class DbCon
{
    private $user = "root";
    Private $pass = "1234";
    public $dbCon;
    public function __construct(){
        $user = $this->user;
        $pass = $this->pass;

        try {
            $this->dbCon = new PDO('mysql:host=localhost:3306;dbname=gamewebshop;charset=utf8', $user, $pass);
            return $this->dbCon;
        } catch (PDOException $err) {
            echo "Error!: " . $err->getMessage() . "<br/>";
            die();
        }}

    public function DBClose(){
        $this->dbCon = null;
    }
}