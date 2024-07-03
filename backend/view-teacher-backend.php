<?php
    // Fetch student data
    $sql = "SELECT ID, NAME, GENDER, EMAIL FROM new_staff LIMIT 10";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='table-row'>
                <div class='table-col'>" . $row["ID"] . "</div>
                <div class='table-col'>" . $row["NAME"] . "</div>
                <div class='table-col'>" . "TEACHER" . "</div>
                <div class='table-col'>" . $row["GENDER"] . "</div>
                <div class='table-col'>" . $row["EMAIL"] . "</div>
                <div class='table-col'><i class='fa-regular fa-eye'></i></div>
            </div>";
        }
    } else {
        echo "<div class='table-row'><div class='table-col' colspan='6'>No students found</div></div>";
    }
    $conn->close();
?>