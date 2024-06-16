<?php
class DatabaseHandler {
    private $host = 'localhost';
    private $db_name = 'Course_Enrollment_portal';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }

    public function executeSelectQuery($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindParam($key, $val);
        }
        $stmt->execute();
        return $stmt;
        
    }

    // Added method for executing non-select queries like INSERT, UPDATE, DELETE
    public function executeQuery($sql, $params = []) {
        try {
            $stmt = $this->conn->prepare($sql);
            foreach ($params as $key => $val) {
                // Use bindValue() to accommodate both bound variables and literals
                $stmt->bindValue($key, $val);
            }
            $stmt->execute();
            return $stmt;
        } catch(PDOException $exception) {
            echo "Execution error: " . $exception->getMessage();
            return null;
        }
    }
}
?>

