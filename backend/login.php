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

                //checking user login state
                $_SESSION['admin_logged_in'] = true;
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
    }else if (isset($_POST["user-login"])) { // user login
        $email = $_POST["user-email"];
        $password = $_POST["user-password"];
        $error = ""; //reset error var
    
        if(!isset($_POST["teacher-login"])){ // student login
            $response = mysqli_query($conn, "SELECT * FROM new_admission WHERE EMAIL = '$email'");
            
            //fetch data from database
            if($response && mysqli_num_rows($response) > 0) {
                $row = mysqli_fetch_assoc($response);
            
                // Verify the password
                if($password == $row["PASSWORD"]) {
                    $_SESSION["user_id"] = $row["ID"];
                    $_SESSION["user_name"] = $row["NAME"];
                    $_SESSION["user_email"] = $row["EMAIL"];
                    $_SESSION["user_course"] = $row["COURSE"];

                    //checking user login state
                    $_SESSION['student_logged_in'] = true;
                    header("Location: ./student-dashboard.php");
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
        }else{ // staff login
            $error = ""; //reset var
            $response = mysqli_query($conn, "SELECT * FROM new_staff WHERE EMAIL = '$email'");
            
            //fetch data from database
            if($response && mysqli_num_rows($response) > 0) {
                $row = mysqli_fetch_assoc($response);
            
                // Verify the password
                if($password == $row["PASSWORD"]) {
                    $_SESSION["user_id"] = $row["ID"];
                    $_SESSION["user_name"] = $row["NAME"];
                    $_SESSION["user_email"] = $row["EMAIL"];
                    $_SESSION["user_subjects"] = $row["SUBJECTS"];

                    //checking user login state
                    $_SESSION['teacher_logged_in'] = true;
                    header("Location: ./teacher-dashboard.php");
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