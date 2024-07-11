<?php
    session_start();
    include("./connection.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $stmt = $conn->prepare("DELETE FROM new_staff WHERE ID = ?");
        $stmt->bind_param("s", $_SESSION["teacher_id"]);

        if( $stmt->execute() ){
            unset($_SESSION["teacher_id"]);
            header('Location: ../frontend/view-teacher.php');
            exit();
        }

        $stmt->close();
    }

    $conn->close();
?>