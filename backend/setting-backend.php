<?php
    $user_id = $_SESSION["db_userid"];

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admin_credentials WHERE ID = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $response = $stmt->get_result();

    if ($response->num_rows > 0) {
        while ($row = $response->fetch_assoc()) {
            $_SESSION["username"] = $row["NAME"];
            $_SESSION["user_email"] = $row["EMAIL"];
            $_SESSION["user_pass"] = $row["PASSWORD"];
            $_SESSION["user_image"] = $row["IMAGE"];
        }
    }
?>