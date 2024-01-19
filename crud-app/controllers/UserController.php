<?php

require_once(__DIR__ . '/../models/User.php');
require_once(__DIR__ . '/../config.php');

class UserController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUsers() {
        $users = [];

        $result = $this->conn->query("SELECT * FROM users");

        while ($row = $result->fetch_assoc()) {
            $users[] = new User($row['id'], $row['name'], $row['email']);
        }

        return $users;
    }

    public function getUserById($userId) {
        $result = $this->conn->query("SELECT * FROM users WHERE id = $userId");

        if ($row = $result->fetch_assoc()) {
            return new User($row['id'], $row['name'], $row['email']);
        }

        return null;
    }

    public function createUser($name, $email) {
        $stmt = $this->conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $email);
        $stmt->execute();
        $stmt->close();
    }

    public function updateUser($userId, $name, $email) {
        $stmt = $this->conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $email, $userId);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteUser($userId) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->close();
    }
}

?>
