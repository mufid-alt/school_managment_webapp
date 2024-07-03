<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and assign input values
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $pass = htmlspecialchars($_POST["password"]);
    $phone = $_POST["phone"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $qual_1 = $_POST["qual-1"];
    $qual_2 = $_POST["qual-2"];
    $course = $_POST["course"];
    $add_1 = htmlspecialchars($_POST["address-1"]);
    $add_2 = htmlspecialchars($_POST["address-2"]);
    $country = $_POST["country"];
    $city = htmlspecialchars($_POST["city"]);
    $region = htmlspecialchars($_POST["region"]);
    $pincode = $_POST["pincode"];

    // Prepare an SQL statement with placeholders
    $stmt = $conn->prepare("INSERT INTO new_admission (NAME, EMAIL, PASSWORD, PHONE, DOB, GENDER, SENIOR_QUAL, HIGHER_QUAL, COURSE, ADRESS_1, ADRESS_2, COUNTRY, CITY, REGION, PINCODE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind the actual values to the placeholders
    $stmt->bind_param("sssssssssssssss", $name, $email, $pass, $phone, $dob, $gender, $qual_1, $qual_2, $course, $add_1, $add_2, $country, $city, $region, $pincode);

    // Execute the prepared statement
    $stmt->execute();

    // Check if the query was successful
    if ($stmt->affected_rows > 0) {
      $success = "Admission successfull";
    } else {
      $success = "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();

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