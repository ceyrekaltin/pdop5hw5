<?php

class Database {
    public $pdo;

    public function __construct($db = "school_ROC", $user = "root", $pwd = "", $host = "localhost") {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected to database $db<br>";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function insertData($name, $age, $email) {
        $sql = "INSERT INTO students (name, age, email) VALUES (:name, :age, :email)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            echo "Student succesvol toegevoegd!<br>";
        } else {
            echo "Fout bij het toevoegen van de student.<br>";
        }
    }

    public function selectData() {
        $sql = "SELECT * FROM students";
        $stmt = $this->pdo->query($sql);
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($students) {
            foreach ($students as $student) {
                echo "ID: " . $student['student_id'] . " - Naam: " . $student['name'] . " - Leeftijd: " . $student['age'] . " - Email: " . $student['email'] . "<br>";
            }
        } else {
            echo "Geen studenten gevonden.<br>";
        }
    }

    public function getStudentById($student_id) {
        $sql = "SELECT * FROM students WHERE student_id = :student_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':student_id', $student_id);
        $stmt->execute();

        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($student) {
            echo "ID: " . $student['student_id'] . " - Naam: " . $student['name'] . " - Leeftijd: " . $student['age'] . " - Email: " . $student['email'] . "<br>";
        } else {
            echo "Geen student gevonden met ID: $student_id<br>";
        }
    }
}

?>