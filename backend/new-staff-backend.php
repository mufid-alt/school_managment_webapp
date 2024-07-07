<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // Sanitize and assign input values
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $pass = htmlspecialchars($_POST["pass"]);
    $phone = $_POST["phone"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $qual_1 = $_POST["qual-1"];
    $qual_2 = $_POST["qual-2"];
    $add_1 = htmlspecialchars($_POST["add-1"]);
    $add_2 = htmlspecialchars($_POST["add-2"]);
    $country = $_POST["country"];
    $city = htmlspecialchars($_POST["city"]);
    $region = htmlspecialchars($_POST["region"]);
    $pincode = $_POST["pincode"];

    $subjects = json_encode($_POST["subjects"]); // Convert array to JSON

    // insert data into database
    $stmt = $conn->prepare("INSERT INTO new_staff (NAME,EMAIL,PASSWORD,PHONE,DOB,GENDER,SENIOR_QUAL,HIGHER_QUAL,SUBJECTS,ADRESS_1,ADRESS_2,COUNTRY,CITY,REGION,PINCODE) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssssssssss",$name,$email,$pass,$phone,$dob,$gender,$qual_1,$qual_2,$subjects,$add_1,$add_2,$country,$city,$region,$pincode);
    $stmt->execute();

    // Check if the query was successful
    if ($stmt->affected_rows > 0) {
      $success = "Teacher Added Successfully";
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