<?php
    session_start();
    include("../backend/connection.php");

    //checks if admin logged in else redirects to login page
    if (!isset($_SESSION['admin_logged_in'])) {
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
    <title><?php $file_name  = basename($_SERVER["PHP_SELF"]);echo strtoupper(pathinfo($file_name,PATHINFO_FILENAME));?></title>
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/responsive.css">
    <script type="text/javascript" src="./scripts/googleCharts.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawStuff);
      google.charts.setOnLoadCallback(drawChart);

      function drawStuff() {
        var chartDiv = document.getElementById('chart_div');

        var data = google.visualization.arrayToDataTable([
          ['School Finance', 'Total Income', 'Total Expense'],
          ['July', 400, 300],
          ['June', 300, 100],
          ['May', 120, 140],
          ['April', 400, 320],
          ['March', 400, 300]
        ]);

        var options = {
            colors: ['#4221B0', '#F59120']
        };
        var materialChart = new google.charts.Bar(chartDiv);
        materialChart.draw(data,options);
    };

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Sales', 'Expenses'],
          ['July',  18,      15],
          ['June',  58,      77],
          ['May',  65,       70],
          ['April',  25,      30],
          ['March',  50,      85]
        ]);

        var options = {
          curveType: 'function',
          legend: { position: 'none' }
        };
        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);
      }
    </script>
</head>
<body>
    <header class="container">
        <div class="logo">
            <div class="menu">
                <i class="fa-solid fa-bars"></i>
            </div>
            <a href="./dashboard.php">
                <img src="./img/logo.png" alt="Logo">
            </a>
        </div>

        <div class="search">
            <div>
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" placeholder="Search....">
            </div>
        </div>

        <div class="admin">
            <div class="icons">
                <div class="message">
                    <div class="dot"></div>
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="notify">
                    <div class="dot"></div>
                    <i class="fa-solid fa-bell"></i>
                </div>
            </div>
            <div class="person">
                <?php
                    $image = $_SESSION["user_image"];
                    if($image == NULL){
                        echo "<img src='./img/admin.png' style='width:69px;height:69px;border-radius:50%;object-fit:cover;'>";
                    }else{
                        echo '<img src="./img/'.$image.'" style="width:69px;height:69px;border-radius:50%;object-fit:cover;">';
                    }
                ?>
                <h3>
                    <?php
                        if(isset($_SESSION["db_username"])){
                            echo $_SESSION["db_username"];
                        }
                    ?><br>
                    <span>School Administrator</span>
                </h3>
                <div class="overflow-log-out">
                    <form action="../backend/log-out.php" method="post">
                        <button type="submit" name="log-out">Log Out</button>
                    </form>
                </div>
            </div>
            <div class="mode"><i class="fa-solid fa-moon"></i></div>
        </div>
    </header>

    <nav class="sidebar">
        <ul>
            <li class="nav-links">
                <a href="./dashboard.php">
                    <i class="fa-sharp fa-solid fa-table-cells-large"></i>
                    <span class="nav-items">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li class="nav-links">
                <a href="./view-teacher.php">
                    <i class="fa-solid fa-person-chalkboard"></i>
                    <span class="nav-items">Teahcers</span>
                </a>
                <span class="tooltip">Teahcers</span>
            </li>
            <li class="nav-links">
                <a href="./view-student.php">
                    <i class="fa-solid fa-user-graduate"></i>
                    <span class="nav-items">Students</span>
                </a>
                <span class="tooltip">Students</span>
            </li>
            <li class="nav-links">
                <a href="./events.php">
                    <i class="fa-regular fa-calendar-check"></i>
                    <span class="nav-items">
                        Events
                    </span>
                </a>
                <span class="tooltip">Events</span>
            </li>
            <li class="nav-links">
                <a href="./calendar.php">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span class="nav-items">Calender</span>
                </a>
                <span class="tooltip">Calender</span>
            </li>
            <li class="nav-links">
                <a href="./charts.php">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span class="nav-items">Chart</span>
                </a>
                <span class="tooltip">Chart</span>
            </li>
            <li class="nav-links">
                <a href="./finance.php">
                    <i class="fa-solid fa-chart-line"></i>
                    <span class="nav-items">Finance</span>
                </a>
                <span class="tooltip">Finance</span>
            </li>
            <li class="nav-links">
                <a href="./setting.php">
                    <i class="fa-solid fa-gear"></i>
                    <span class="nav-items">Setting</span>
                </a>
                <span class="tooltip">Setting</span>
            </li>
            <li class="nav-links nav-img">
                <img src="./img/nav-img.png" alt="Navbar Image">
            </li>
        </ul>
    </nav>

    <main class="main">
        <div class="main-container">
            <div class="greet">
                <h1>Good Morning, 
                    <?php
                        // Split the full name to get the first name
                        $first_name = explode(" ", $_SESSION["db_username"])[0];
                        echo $first_name;
                    ?>
                </h1>
                <span>How are you feeling today ?</span>
            </div>
            <div class="buttons">
                <div class="left">
                    <a href="./new-staff.php">
                        <i class="fa-solid fa-people-group"></i>
                        Add Staff
                    </a>
                </div>
                <div class="right">
                    <a href="./new-admission.php">
                        <i class="fa-solid fa-user-check"></i>
                        New Admission
                    </a>
                </div>
            </div>
        </div>

        <section class="card-container">
            <div class="cards">
                <div class="card-items">
                    <div class="circle-container">
                        <div class="outer">
                            <div class="inner">
                                <div class="shadow">
                                    <i class="fa-solid fa-user-graduate"></i>
                                </div>
                            </div>
                            <div class="circle"></div>
                        </div>
                    </div>
                    <div class="content">
                        <h2>STUDENTS</h2><br>
                        <div class="percentage">
                            <div class="male">
                                <div class="blue-box"></div>
                                MALE (61%)
                            </div>
                            <div class="female">
                                <div class="orange-box"></div>
                                FEMALE (39%)
                            </div>
                        </div>
                        <p>TOTAL: <span>1,108</span></p>
                    </div>
                </div>

                <div class="card-items">
                    <div class="circle-container">
                        <div class="outer">
                            <div class="inner">
                                <div class="shadow">
                                    <i class="fa-solid fa-people-carry-box"></i>
                                </div>
                            </div>
                            <div class="circle"></div>
                        </div>
                    </div>
                    <div class="content">
                        <h2>STAFF</h2><br>
                        <div class="percentage">
                            <div class="male">
                                <div class="blue-box"></div>
                                MALE (55%)
                            </div>
                            <div class="female">
                                <div class="orange-box"></div>
                                FEMALE (45%)
                            </div>
                        </div>
                        <p>TOTAL: <span>106</span></p>
                    </div>
                </div>

                <div class="card-items">
                    <div class="circle-container">
                        <div class="outer">
                            <div class="inner">
                                <div class="shadow">
                                    <i class="fa-solid fa-person-chalkboard"></i>
                                </div>
                            </div>
                            <div class="circle"></div>
                        </div>
                    </div>
                    <div class="content">
                        <h2>SUBJECTS</h2><br>
                        <div class="percentage">
                            <div class="male">
                                <div class="blue-box"></div>
                                SCIENCE (55%)
                            </div>
                            <div class="female">
                                <div class="orange-box"></div>
                                ARTS (45%)
                            </div>
                        </div>
                        <p>TOTAL: <span>48</span></p>
                    </div>
                </div>

                <div class="card-items">
                    <div class="circle-container">
                        <div class="outer">
                            <div class="inner">
                                <div class="shadow">
                                    <i class="fa-solid fa-chalkboard-user"></i>
                                </div>
                            </div>
                            <div class="circle"></div>
                        </div>
                    </div>
                    <div class="content">
                        <h2>EVENTS</h2><br>
                        <div class="percentage">
                            <div class="male">
                                <div class="blue-box"></div>
                                INDOOR (70%)
                            </div>
                            <div class="female">
                                <div class="orange-box"></div>
                                OUTDOOR (30%)
                            </div>
                        </div>
                        <p>TOTAL: <span>86</span></p>
                    </div>
                </div>
            </div>
        </section>

        <article class="data-container">
            <section class="chart-container">
                <div class="finance">
                    <div class="heading">School Finance</div>
                    <div class="stats">
                        <div class="income">
                            <div class="left">
                                <div class="outer-circle">
                                    <div class="inner-circle">
                                        <i class="fa-solid fa-chart-line"></i>
                                    </div>
                                    <div class="circle-income"></div>
                                </div>
                            </div>
                            <div class="right">
                                <h3><span>&#8377;</span>7,20,925.00</h3>
                                <p>Total Income</p>
                            </div>
                        </div>
    
                        <div class="income">
                            <div class="left">
                                <div class="outer-circle">
                                    <div class="inner-circle">
                                        <i class="fa-solid fa-chart-line"></i>
                                    </div>
                                    <div class="circle-income"></div>
                                </div>
                            </div>
                            <div class="right">
                                <h3><span>&#8377;</span>2,78,393.58</h3>
                                <p>Total Expenses</p>
                            </div>
                        </div>
    
                        <div class="income">
                            <div class="right">
                                <h3>59 Projects</h3>
                                <p>As @ 16th July 2024</p>
                            </div>
                        </div>
                    </div>
                    <div id="bar-graph">
                        <div id="chart_div" style="height: 300px!important;width: 100%!important;font-size: 0.80rem;"></div>
                    </div>
                </div>
    
                <div class="finance attendance">
                    <div class="heading">School Attendance</div>
                    <div class="buttons">
                        <div class="students">
                            Students
                            <div class="outer-box"><div class="inner-box"></div></div>
                        </div>
                        <div class="teachers">
                            Teachers
                            <div class="outer-box"><div class="inner-box"></div></div>
                        </div>
                    </div>
                    <div id="bar-graph">
                        <div id="curve_chart" style="width: 100%!important; height: 100%!important;"></div>
                    </div>
                </div>
            </section>
    
            <section class="event-container">
                <div class="calendar">
                    <header>
                        <div class="heading">
                            <h3>School Event Calendar</h3>
                            <span>You have 89 pending events</span>
                        </div>
                        <div class="buttons">
                            <i class="fa-solid fa-caret-up" id="prev"></i>
                            <span class="today-time">June, 2024</span>
                            <i class="fa-solid fa-caret-down" id="next"></i>
                        </div>
                    </header>
                    <div class="custom-calendar">
                        <section>
                            <div id="holiday"></div>
                            <ul class="days">
                                <li>Sun</li>
                                <li>Mon</li>
                                <li>Tue</li>
                                <li>Wed</li>
                                <li>Thu</li>
                                <li>Fri</li>
                                <li>Sat</li>
                            </ul>
                            <ul class="dates"></ul>
                        </section>
                    </div>
                </div>
                <div class="event">
                    <div class="navbar-heading">
                        Upcoming Events
                        <div class="sort-buttons">
                            <button class="card-btn active-btn" data-filter="all">ALL</button>
                            <button class="card-btn" data-filter=".staffs">Staffs</button>
                            <button class="card-btn" data-filter=".students">Students</button>
                            <button class="card-btn" data-filter=".school">School</button>
                            <button class="card-btn" data-filter=".outside">Outside</button>
                        </div>
                    </div>
                    <div class="cards-wrapper">
                        <div class="mix card-slide staffs">
                            <h1>Annual School Staff Programme<br>Sport,2024</h1>
                            <h4>Start- <span>Tomorrow,15th July 2024</span></h4>
                            <h5>Duration- <span>7 Days</span></h5>
                            <h6>Venue- <span>National Stadium, New Delhi</span></h6>
                        </div>
                        <div class="mix card-slide staffs">
                            <h1>Annual School Staff Committee<br>Meeting,2024</h1>
                            <h4>Start- <span>On, 1th July 2024</span></h4>
                            <h5>Duration- <span>2 Days</span></h5>
                            <h6>Venue- <span>School Hall, New Delhi</span></h6>
                        </div>
                        <div class="mix card-slide students">
                            <h1>Annual School Students Developement<br>Mela,2024</h1>
                            <h4>Start- <span>On, 19th Jult, 2024</span></h4>
                            <h5>Duration- <span>6 Days</span></h5>
                            <h6>Venue- <span>National Stadium, New Delhi</span></h6>
                        </div>
                        <div class="mix card-slide students">
                            <h1>Annual School Students Competition<br>Sport,2024</h1>
                            <h4>Start- <span>On, 28th July, 2024</span></h4>
                            <h5>Duration- <span>7 Days</span></h5>
                            <h6>Venue- <span>Pragati Maidan, New Delhi</span></h6>
                        </div>
                        <div class="mix card-slide school">
                            <h1>Annual School Inter-house<br>Sport,2024</h1>
                            <h4>Start- <span>On,15th August 2024</span></h4>
                            <h5>Duration- <span>12 Days</span></h5>
                            <h6>Venue- <span>Bharat Mandapam,New Delhi</span></h6>
                        </div>
                        <div class="mix card-slide school">
                            <h1>Annual School Developement<br>Wellbeing,2024</h1>
                            <h4>Start- <span>Tomorrow,15th July 2024</span></h4>
                            <h5>Duration- <span>7 Days</span></h5>
                            <h6>Venue- <span>National Stadium,New Delhi</span></h6>
                        </div>
                        <div class="mix card-slide outside">
                            <h1>Digital Wellbeing Programme<br>Meditation,2024</h1>
                            <h4>Start- <span>On ,5th August 2024</span></h4>
                            <h5>Duration- <span>7 Days</span></h5>
                            <h6>Venue- <span>Noida Stadium, Uttar Pradesh</span></h6>
                        </div>
                        <div class="mix card-slide outside">
                            <h1>Know yourself Better<br>Mind Calmness,2024</h1>
                            <h4>Start- <span>On ,25th August 2024</span></h4>
                            <h5>Duration- <span>1 Days</span></h5>
                            <h6>Venue- <span>Fun n Food Village,NOIDA</span></h6>
                        </div>
                    </div>
                </div>
            </section>
        </article>

        <article class="reg-users">
            <div class="user-container">
                <header>Recently Registered Users</header>
                <div class="table-section">
                    <div class="table-row table-heading">
                        <div class="table-col">#ID</div>
                        <div class="table-col">Name</div>
                        <div class="table-col">Role</div>
                        <div class="table-col">Gender</div>
                        <div class="table-col">Email</div>
                        <div class="table-col">Action</div>
                    </div>
                    <?php include("../backend/dashboard-backend.php");?>
                </div>
            </div>
        </article>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-icons">
                <i class="fa-brands fa-facebook-f"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-youtube"></i>
                <i class="fa-brands fa-x-twitter"></i>
                <i class="fa-brands fa-linkedin"></i>
                <i class="fa-brands fa-threads"></i>
                <i class="fa-brands fa-whatsapp"></i>
            </div>
            <hr>
            <div class="contents">
                <p>&copy; <?php echo date("Y",time());?> Developed & Managed by<span>Hemant Zuceed</span></p>
            </div>
        </div>
    </footer>

    <script src="./scripts/mixitup.min.js"></script>
    <script src="./scripts/font.js"></script>
    <script src="./scripts/main.js" defer></script>
</body>
</html>