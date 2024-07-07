<?php
    session_start();
    include("../backend/connection.php");

    //checks if teacher logged in else redirects to login page
    if (!isset($_SESSION['teacher_logged_in'])) {
        // Redirect the user to the login page
        header('Location: ./index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="./styles/stu-dash.css">
    <style>
        article.section{
            display: grid;
            grid-template-columns: repeat(3, 3fr);
        }
        .stu-data{
            width: 100%;
            border: 1px solid var(--border-color);
            border-collapse: collapse;
            text-align: center;
        }
        .stu-data th,td{
            border: 1px solid var(--border-color);
            padding: 0.75rem 0.95rem;
        }
        .stu-data input[type='text']{
            border: 1.5px solid var(--border-color);
            outline: none;
            padding: 0.55rem 0.75rem;
            width: 35px;
            border-radius: 5px;
        }
        .stu-data input[type='submit']{
            border: none;
            outline: none;
            padding: 0.55rem 0.75rem;
            width: 100px;
            background-color: var(--main-color);
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h1>Teacher Dashboard</h1>
        <form action="../backend/user-log-out.php" method="post">
            <button type="submit">Log Out</button>
        </form>
    </header>
    <main>
        <section class="personal">
            <h3>Hi, <?php echo $_SESSION["user_name"];?>, Welcome</h3>
            <h3>Your Email: <?php echo $_SESSION["user_email"];?></h3>
        </section>
        <article class="section">
            <section class="announcements">
                <h2>Announcements</h2>
                <ul>
                    <li>Important message from the Principal...</li>
                    <li>Upcoming school play rehearsals on Fridays.</li>
                </ul>
                <button onclick="showMoreAnnouncements()">See More</button>
            </section>
            <section class="course">
                <h2>Your Interest Areas</h2>
                <ul>
                <?php
                    $subjects = json_decode($_SESSION["user_subjects"]);
                    if (!empty($subjects)) {
                    foreach ($subjects as $subject) {
                        echo "<li>" . htmlspecialchars($subject) . "</li>";
                    }
                    } else {
                        echo "<li>No subjects available</li>";
                    }
                ?>
                </ul>
            </section>
            <section class="schedule">
                <h2>Class Schedule</h2>
                <table id="scheduleTable">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Subject</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Monday</td>
                            <td>MDCE</td>
                            <td>07:30 AM</td>
                        </tr>
                        <tr>
                            <td>Wednesday</td>
                            <td>ADCE</td>
                            <td>09:30 AM</td>
                        </tr>
                        <tr>
                            <td>Friday</td>
                            <td>ADEA</td>
                            <td>11:00 AM</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </article>
        <section class="students">
             <h2>Student Data</h2>
             <form action="#" method="post">
                <table class="stu-data">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>NAME</th>
                            <th>GENDER</th>
                            <th>EMAIL</th>
                            <th>COURSE</th>
                            <th>CITY</th>
                            <th>COUNTRY</th>
                            <th>COMPLETION STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // Query to fetch data
                        $sql = "SELECT * FROM new_admission";
                        $result = $conn->query($sql);

                        // Check if query was successful
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Initialize course status
                                $course_status = $row["STATUS"];
                                if ($course_status == NULL) {
                                    $course_status = 0;
                                }

                                echo "<tr>";
                                echo "<td>" . $row['ID'] . "</td>";
                                echo "<td>" . $row['NAME'] . "</td>";
                                echo "<td>" . $row['GENDER'] . "</td>";
                                echo "<td>" . $row['EMAIL'] . "</td>";
                                echo "<td>" . $row['COURSE'] . "</td>";
                                echo "<td>" . $row['CITY'] . "</td>";
                                echo "<td>" . $row['COUNTRY'] . "</td>";
                                echo "<td>";
                                echo "<form method='post' action='./teacher-dashboard.php'>";
                                echo "<input type='hidden' name='student_id' value='" . $row['ID'] . "'>";
                                echo "<input type='text' name='course_status' placeholder='$course_status%'>";
                                echo "<input type='submit' value='Update'>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "0 results";
                        }
                    ?>
                    </tbody>
                </table> 
             </form>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <p>&copy; <?php echo date("Y",time());?> Developed & Managed by <span>Hemant Zuceed</span></p>
        </div>
    </footer>
    <script src="./scripts/stu-dash.js"></script>
    <script src="./scripts/font.js"></script>
</body>
</html>

<?php include("../backend/teacher-dashboard-backend.php");?>