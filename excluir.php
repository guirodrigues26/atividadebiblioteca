<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        $sql = "DELETE FROM livros WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        
        header("Location: index.php?msg=deleted");
        exit();
    } catch(PDOException $e) {
        header("Location: index.php?msg=error_delete");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>