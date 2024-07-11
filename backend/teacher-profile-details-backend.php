<?php
    $user_id = $_GET["user_id"];
    $_SESSION["teacher_id"] = $_GET["user_id"];

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM new_staff WHERE ID = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $response = $stmt->get_result();

    if ($response->num_rows > 0) {
        while ($row = $response->fetch_assoc()) {
            $_SESSION["username"] = $row["NAME"];
            $_SESSION["user_email"] = $row["EMAIL"];
            $_SESSION["user_pass"] = $row["PASSWORD"];
            $_SESSION["user_phone"] = $row["PHONE"];
            $_SESSION["user_dob"] = $row["DOB"];
            $_SESSION["user_gender"] = $row["GENDER"];
            $_SESSION["senior_qual"] = $row["SENIOR_QUAL"];
            $_SESSION["higher_qual"] = $row["HIGHER_QUAL"];
            $_SESSION["add_1"] = $row["ADRESS_1"];
            $_SESSION["add_2"] = $row["ADRESS_2"];
            $_SESSION["country"] = $row["COUNTRY"];
            $_SESSION["city"] = $row["CITY"];
            $_SESSION["region"] = $row["REGION"];
            $_SESSION["pincode"] = $row["PINCODE"];

            // Decode the JSON-encoded subjects field
            $subjects = json_decode($row['SUBJECTS'], true);
        }
    }
    mysqli_close($conn);
?>