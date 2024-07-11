<?php
    session_start();
    include("./connection.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $stmt = $conn->prepare("DELETE FROM new_admission WHERE ID = ?");
        $stmt->bind_param("s", $_SESSION["student_id"]);

        if( $stmt->execute() ){
            unset($_SESSION["student_id"]);
            header('Location: ../frontend/view-student.php');
            exit();
        }

        $stmt->close();
    }

    $conn->close();
?>