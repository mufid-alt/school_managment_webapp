<?php
    session_start();
    include("../backend/connection.php");
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
    <link rel="stylesheet" href="./styles/charts.css">
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
            <a href="#">
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
            </section>
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

    <script src="./scripts/charts.js"></script>
    <script src="./scripts/font.js"></script>
</body>
</html>