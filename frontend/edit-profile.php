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
    <link rel="stylesheet" href="./styles/new-admission.css">
    <link rel="stylesheet" href="./styles/setting.css">
    <link rel="stylesheet" href="./styles/events.css">
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
        <?php include("../backend/setting-backend.php");?>
        <section class="form-container">
            <header>Update Profile</header>
            <form action="./edit-profile.php" method="post" enctype="multipart/form-data" class="form">
              <div class="input-box profile-pic">
                <div class="profile-dp">
                    <?php
                        $image = $_SESSION["user_image"];
                        if($image == NULL){
                            echo "<img src='./img/admin.png' style='width:100px;height:100px;border-radius:50%;object-fit:cover;'>";
                        }else{
                            echo '<img src="./img/'.$image.'" style="width:100px;height:100px;border-radius:50%;object-fit:cover;">';
                        }
                    ?>
                    <input type="file" name="image">
                </div>
              </div>
              <div class="input-box">
                <label>Change Name</label>
                <input type="text" name="username" placeholder="<?php echo $_SESSION["username"];?>"/>
              </div>
              <div class="input-box">
                <label>Email Address</label>
                <input type="text" value="<?php echo $_SESSION["user_email"];?>" disabled/>
              </div>
              <div class="input-box">
                <label>Change Password</label>
                <input type="text" name="user_pass" placeholder="<?php echo $_SESSION["user_pass"];?>"/>
              </div>
              <button type="submit">Update Profile</button>
            </form>
        </section>
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
     
    <script src="./scripts/setting.js"></script>
    <script src="./scripts/font.js"></script>
</body>
</html>

<?php include("../backend/edit-profile-backend.php");?>