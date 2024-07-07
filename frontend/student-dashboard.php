<?php
    session_start();
    include("../backend/connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="./styles/stu-dash.css">
</head>
<body>
    <header>
        <h1>Student Dashboard</h1>
        <div class="log-out">
            <form action="#">
                <button type="submit">Change Password</button>
            </form>
            <form action="#">
                <button type="submit">Log Out</button>
            </form>
        </div>
    </header>
    <main>
        <section class="personal">
            <h3>Hi, Hemant Zuceed, Welcome</h3>
            <h3>Your Email: hemant@gmail.com</h3>
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
                    </tbody>
                </table>
            </section>
        </article>
        <section class="course">
            <h2>Course: MDCE (Master Diploma in Computer Engineering) "3 Years"</h2>
            <div class="column-box">
                <div class="column">
                    <h3>Module 1</h3>
                    <ul>
                        <li>Web Design (&#x2714;)</li>
                        <li>IOT (&#x2714;)</li>
                        <li>Python (&#x2714;)</li>
                        <li>SSAD (&#x2714;)</li>
                    </ul>
                </div>
                <div class="column">
                    <h3>Module 2</h3>
                    <ul>
                        <li>DBMS</li>
                        <li>PHP</li>
                        <li>C++</li>
                        <li>Linux</li>
                    </ul>
                </div>
                <div class="column">
                    <h3>Module 3</h3>
                    <ul>
                        <li>Java</li>
                        <li>Dot Net</li>
                        <li>Advance Java</li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="progress">
            <h2>Progress Tracker</h2>
            <div class="progress-bar">
                <div class="progress-fill" style="width:70%"></div>
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
</html>