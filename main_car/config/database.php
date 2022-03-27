<?php
class Database {

    // укажите свои собственные учетные данные для базы данных 
    private $host = "localhost";
    private $db_name = "cq82669_phpstorm";
    private $username = "cq82669_phpstorm";
    private $password = "HA7VYa81";
    public $conn;
	
	
    // получение соединения с базой данных 
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        } catch(PDOException $exception) {
            echo "Ошибка соединения: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>