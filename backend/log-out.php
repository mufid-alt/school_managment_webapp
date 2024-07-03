<?php
    if(isset($_POST["log-out"])){
        session_destroy();
        header("Location: ../frontend/index.php");
        exit();
    }
?>