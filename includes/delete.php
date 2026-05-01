<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $stmt = $pdo->prepare("DELETE FROM students WHERE id=?");
    $stmt->execute([$_POST['id']]);

    header("Location: ../public/index.php?status=deleted");
    exit();
}
?>