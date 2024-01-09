<?php
class DbCon
{
    private $user = "root";
    Private $pass = "massimo";
    public $dbCon;
    public function __construct(){
        $user = $this->user;
        $pass = $this->pass;

        try {
            $this->dbCon = new PDO('mysql:host=localhost:3307;dbname=gamewebshop;charset=utf8', $user, $pass);
            return $this->dbCon;
        } catch (PDOException $err) {
            echo "Error!: " . $err->getMessage() . "<br/>";
            die();
        }}

    public function DBClose(){
        $this->dbCon = null;
    }
}