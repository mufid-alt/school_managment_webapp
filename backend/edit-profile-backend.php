<?php
// getting username to query db
$user_email = $_SESSION["user_email"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["username"];
    $password = $_POST["user_pass"];
    $folder = 'img/';
    $file = $_FILES["image"]["tmp_name"];
    $file_name = $_FILES["image"]["name"];
    $file_name_array = explode(".", $file_name);
    $extension = end($file_name_array);

    // Check if an image is uploaded
    if ($file != "") {
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
            $img_result = $stmt->execute();
        }
    }

    // Check if name or password is provided
    if (!empty($name) || !empty($password)) {
        // Prepare statement to update user details
        $stmt = $conn->prepare("UPDATE admin_credentials SET NAME = IF(? != '', ?, NAME), PASSWORD = IF(? != '', ?, PASSWORD) WHERE EMAIL = ?");
        $stmt->bind_param("sssss", $name, $name, $password, $password, $user_email);
        $result = $stmt->execute();
    }

    if (isset($img_result) || isset($result)) {
        $success = "Changes Saved";
        echo "<script>location.href = './setting.php';</script>";
    } else {
        $success = "Something went wrong...";
    }
}

mysqli_close($conn);
?>