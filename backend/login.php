<?php
    if(isset($_POST["admin-login"])){ //Admin Login
        $email = $_POST["admin-email"];
        $password = $_POST["admin-pass"];

        $response = mysqli_query($conn, "SELECT * FROM admin_credentials WHERE EMAIL = '$email'");
        
        //fetch data from database
        if($response && mysqli_num_rows($response) > 0) {
            $row = mysqli_fetch_assoc($response);
    
            // Verify the password
            if($password == $row["PASSWORD"]) {
                $_SESSION["db_userid"] = $row["ID"];
                $_SESSION["db_username"] = $row["NAME"];
                $_SESSION["user_image"] = $row["IMAGE"];
                header("Location: ./dashboard.php");
                exit();
            } else {
                // Handle invalid password
                $error = "Incorrect Password....";
            }
        }else if(empty($email) && empty($password)){
            $error = "Please fill both fields";
        }else {
            // Handle invalid email
            $error = "User does not exist....";
        }

        // =====Error msg pop up
        if(isset($error)) {
            echo "<script>
            document.querySelector('.error').style.opacity = '1';
            document.querySelector('.error').innerText = '$error';
            </script>";
        }
    }

    mysqli_close($conn);
?>