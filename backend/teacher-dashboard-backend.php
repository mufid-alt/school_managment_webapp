<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["student_id"]) && isset($_POST["course_status"])) {
        $student_id = $_POST["student_id"];
        $course_status = $_POST["course_status"];

        // Sanitize inputs
        $student_id = mysqli_real_escape_string($conn, $student_id);
        $course_status = mysqli_real_escape_string($conn, $course_status);

        $stmt = $conn->prepare("UPDATE new_admission SET STATUS = ? WHERE ID = ?");
        $stmt->bind_param("ss", $course_status, $student_id);

        if ($stmt->execute()) {
            echo "<script>alert('Updated Successfully...');</script>";
            echo "<script>location.href = './teacher-dashboard.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
    } else {
        $missing_field = !isset($_POST["student_id"]) ? 'Student ID' : 'Course Status';
        echo "<script>alert('Missing $missing_field in form submission.');</script>";
    }
}

mysqli_close($conn);
?>