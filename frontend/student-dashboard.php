<?php
    session_start();
    include("../backend/connection.php");

    //checks if student logged in else redirects to login page
    if (!isset($_SESSION['student_logged_in'])) {
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
    <title>Student Dashboard</title>
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./styles/stu-dash.css">
</head>
<body>
    <header>
        <h1>Student Dashboard</h1>
        <form action="../backend/user-log-out.php" method="post">
            <button type="submit">Log Out</button>
        </form>
    </header>
    <main>
        <section class="personal">
            <h3>Hi, <?php echo $_SESSION["user_name"];?>, Welcome</h3>
            <h3>Your Email: <?php echo $_SESSION["user_email"];?></h3>
        </section>
        <article>
            <section class="announcements">
                <h2>Announcements</h2>
                <ul>
                    <li>Important message from the Principal...</li>
                    <li>Upcoming school play rehearsals on Fridays.</li>
                </ul>
                <button onclick="showMoreAnnouncements()">See More</button>
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
                        <!-- Table data will be inserted here from js below -->
                    </tbody>
                </table>
            </section>
        </article>
        <section class="course">
            <h2>Course: <?php echo $_SESSION["user_course"];?></h2>
            <div class="column-box">
                <div class="column">
                    <h3>Module 1</h3>
                    <ul id="module1">
                        <!-- Module 1 content here -->
                    </ul>
                </div>
                <div class="column">
                    <h3>Module 2</h3>
                    <ul id="module2">
                        <!-- Module 2 content here -->
                    </ul>
                </div>
                <div class="column">
                    <h3>Module 3</h3>
                    <ul id="module3">
                        <!-- Module 3 content here -->
                    </ul>
                </div>
            </div>
        </section>
        <section class="progress">
            <?php
                $student_id = $_SESSION["user_id"];
                $sql = "SELECT STATUS FROM new_admission WHERE ID = '$student_id'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);

                     // Store the status in a variable
                    $status = $row['STATUS'];
                    if($status == NULL){
                        $status = 0;
                    }
                }else{
                    echo "<script>alert('Error: " . mysqli_error($conn). "');</script>";
                }
            ?>
            <h2>Progress Tracker</h2>
            <div class="progress-bar">
                <div class="progress-fill" style="width:<?php echo($status);?>%"></div>
            </div>
            <p>Overall Progress</p>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const course = "<?php echo $_SESSION['user_course']; ?>";

        const modules = {
            'MDCE 3 YEARS': {
                module1: ['Web Design', 'IOT', 'Python', 'SSAD'],
                module2: ['DBMS', 'PHP', 'C++', 'Linux'],
                module3: ['Java', 'Dot Net', 'Advance Java', 'No Records']
            },
            'ADEA 2 YEARS': {
                module1: ['Tally ERP', 'Advance Excel'],
                module2: ['DBMS', 'Python'],
                module3: ['Linux', 'No Records']
            },
            'ADCE 2.5 YEARS': {
                module1: ['Web Design', 'IOT', 'Python'],
                module2: ['DBMS', 'PHP', 'SSAD'],
                module3: ['C++','Java', 'Linux']
            },
            'Graphic Design 1.5 YEARS': {
                module1: ['Web Design', 'IOT', 'Dot Net'],
                module2: ['No Records', 'No Records', 'No Records'],
                module3: ['No Records', 'No Records', 'No Records']
            },
            'Web Design 1 YEAR': {
                module1: ['Web Design', 'DBMS'],
                module2: ['PHP', 'SSAD'],
                module3: ['No Records', 'No Records']
            }
        };

        function populateModules(courseModules) {
            document.getElementById('module1').innerHTML = courseModules.module1.map(item => '<li>' + item + '</li>').join('');
            document.getElementById('module2').innerHTML = courseModules.module2.map(item => '<li>' + item + '</li>').join('');
            document.getElementById('module3').innerHTML = courseModules.module3.map(item => '<li>' + item + '</li>').join('');
        }

        if (modules[course]) {
            populateModules(modules[course]);
        } else {
            document.getElementById('module1').innerHTML = '<li>No data available</li>';
            document.getElementById('module2').innerHTML = '<li>No data available</li>';
            document.getElementById('module3').innerHTML = '<li>No data available</li>';
        }

        // time table section
        const schedules = {
            'MDCE 3 YEARS': [
                { day: 'Tuesday', subject: 'Java', time: '07:30 AM - 09:00 AM' },
                { day: 'Thursday', subject: 'Linux', time: '09:00 AM - 10:30 AM' },
                { day: 'Saturday', subject: 'C++', time: '07:30 AM - 09:00 AM' },
            ],
            'ADEA 2 YEARS': [
                { day: 'Monday', subject: 'Advance Excel', time: '9:00 AM - 10:30 AM' },
                { day: 'Wednesday', subject: 'Tally ERP', time: '10:30 AM - 12:00 PM' },
                { day: 'Friday', subject: 'DBMS', time: '07:30 AM - 09:00 AM' },
            ],
            'ADCE 2.5 YEARS': [
                { day: 'Monday', subject: 'Linux', time: '9:00 AM - 10:30 AM' },
                { day: 'Wednesday', subject: 'C++', time: '07:30 AM - 09:00 AM' },
                { day: 'Friday', subject: 'Java', time: '07:30 AM - 09:00 AM' },
            ],
            'Graphic Design 1.5 YEARS': [
                { day: 'Tuesday', subject: 'Web Design', time: '9:00 AM - 10:30 AM' },
                { day: 'Thursday', subject: 'IOT', time: '10:30 AM - 12:00 PM' },
                { day: 'Saturday', subject: 'Dot Net', time: '07:30 AM - 09:00 AM' },
            ],
            'Web Design 1 YEAR': [
                { day: 'Monday', subject: 'Web Design', time: '07:30 AM - 09:00 AM' },
                { day: 'Wednesday', subject: 'DBMS', time: '07:30 AM - 09:00 AM' },
                { day: 'Friday', subject: 'PHP', time: '09:00 AM - 10:30 AM' },
            ]
        };

        function populateSchedule(courseSchedule) {
            let tbody = document.getElementById('scheduleTable').getElementsByTagName('tbody')[0];

            courseSchedule.forEach(function(schedule) {
                let row = tbody.insertRow();
                let cellDay = row.insertCell(0);
                let cellSubject = row.insertCell(1);
                let cellTime = row.insertCell(2);
                    
                cellDay.textContent = schedule.day;
                cellSubject.textContent = schedule.subject;
                cellTime.textContent = schedule.time;
            });
        }

        if (schedules[course]) {
            populateSchedule(schedules[course]);
        } else {
            let tbody = document.getElementById('scheduleTable').getElementsByTagName('tbody')[0];
            tbody.innerHTML = '<tr><td colspan="3">No data available</td></tr>';
        }
    });
</script>
</html>