<?php
    // Fetch student data
    $sql = "SELECT ID, NAME, GENDER, EMAIL FROM new_admission LIMIT 10";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='table-row'>
                <div class='table-col'>" . $row["ID"] . "</div>
                <div class='table-col'>" . $row["NAME"] . "</div>
                <div class='table-col'>" . "STUDENT" . "</div>
                <div class='table-col'>" . $row["GENDER"] . "</div>
                <div class='table-col'>" . $row["EMAIL"] . "</div>
                <div class='table-col'><i class='fa-regular fa-eye view-student-details' data-id='" . $row["ID"] . "'></i></div>
            </div>";

            // redirect user to view page
            echo "<script>
            eye_icons = document.querySelectorAll('.view-student-details');
            eye_icons.forEach(eye_icon => {
                eye_icon.addEventListener('click', (event) => {
                    let user_id = event.target.getAttribute('data-id');
                    location.href = '../frontend/student-profile-details.php?user_id=' +user_id;
                });
            });
            </script>";
        }
    } else {
        echo "<div class='table-row' style='grid-template-columns: 100%;font-size:1.5rem;margin-top:1rem;pointer-events:none;'><div class='table-col'>No Students found</div></div>";
    }
    $conn->close();
?>