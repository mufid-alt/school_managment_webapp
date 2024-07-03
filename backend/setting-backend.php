<?php
    // Ensure the user is logged in
    if (!isset($_SESSION["db_userid"])) {
        // Redirect to login page or handle the error
        header("Location: ./index.php");
        exit();
    }

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

    $user_email = $_SESSION["user_email"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $password = $_POST["password"];
        $folder = 'img/';
        $file = $_FILES["image"]["tmp_name"];
        $file_name = $_FILES["image"]["name"];
        $file_name_array = explode(".", $file_name);
        $extension = end($file_name_array);
        $allowed_extensions = ["jpg", "jpeg", "png", "gif"]; // Add allowed file types

        if ($file != "" && in_array($extension, $allowed_extensions)) {
            // Prepare statement to fetch current image
            $stmt = $conn->prepare("SELECT IMAGE FROM admin_credentials WHERE EMAIL = ?");
            $stmt->bind_param("s", $user_email);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row) {
                $delete_img = $row["IMAGE"];
                unlink($folder.$delete_img);
                $new_img_name = 'profile_' . rand() . '.' . $extension;
                move_uploaded_file($file, $folder.$new_img_name);

                // Prepare statement to update image
                $stmt = $conn->prepare("UPDATE admin_credentials SET IMAGE = ? WHERE EMAIL = ?");
                $stmt->bind_param("ss", $new_img_name, $user_email);
                $stmt->execute();
            }
        }

        // Prepare statement to update user details
        $stmt = $conn->prepare("UPDATE admin_credentials SET NAME = ?, PASSWORD = ? WHERE EMAIL = ?");
        $stmt->bind_param("sss", $name, $password, $user_email);
        $result = $stmt->execute();

        if ($result) {
            $success = "Changes Saved";
        } else {
            $success = "Something went wrong.";
        }

        // =====Success msg pop up
        if(isset($success)) {
            echo "<script>
            document.querySelector('.success').style.opacity = '1';
            document.querySelector('.success').innerText = '$success';
            </script>";
        }
    }

    mysqli_close($conn);
?>