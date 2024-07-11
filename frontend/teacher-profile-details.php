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
  <link rel="stylesheet" href="./styles/new-staff.css">
  <link rel="stylesheet" href="./styles/responsive.css">
  <link rel="stylesheet" href="./styles/teacher-profile-details.css">
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
        <?php 
          include("../backend/teacher-profile-details-backend.php");

          // Check if session variables are set and retrieve them
          $gender = isset($_SESSION['user_gender']) ? $_SESSION['user_gender'] : '';
        ?>

        <section class="form-container">
            <header>Teacher Personal Details</header>
            <form action="../backend/delete-teacher-profile.php" method="post" class="form" onsubmit="return confirmDeletion();">
              <div class="input-box">
                <label>Full Name</label>
                <input type="text" value="<?php echo $_SESSION["username"];?>" disabled/>
              </div>
              <div class="input-box">
                <label>Email Address</label>
                <input type="text" value="<?php echo $_SESSION["user_email"];?>" disabled/>
              </div>
              <div class="input-box">
                <label>Set Password</label>
                <input type="text" value="<?php echo $_SESSION["user_pass"];?>" disabled/>
              </div>
              <div class="column">
                <div class="input-box">
                  <label>Phone Number</label>
                  <input type="number" value="<?php echo $_SESSION["user_phone"];?>" disabled/>
                </div>
                <div class="input-box">
                  <label>Birth Date</label>
                  <input type="date" value="<?php echo $_SESSION["user_dob"];?>" disabled/>
                </div>
              </div>
              <div class="gender-box">
                <h3>Gender</h3>
                <div class="gender-option" value="<?php echo $_SESSION["user_gender"];?>">
                  <div class="gender">
                    <input type="radio" id="check-male" disabled <?php echo ($gender == 'Male') ? 'checked' : ''; ?>/>
                    <label for="check-male">Male</label>
                  </div>
                  <div class="gender">
                    <input type="radio" id="check-female" disabled <?php echo ($gender == 'Female') ? 'checked' : ''; ?>/>
                    <label for="check-female">Female</label>
                  </div>
                  <div class="gender">
                    <input type="radio" id="check-other" disabled <?php echo ($gender == 'Others') ? 'checked' : ''; ?>/>
                    <label for="check-other">Prefer not to say</label>
                  </div>
                </div>
              </div>
              <div class="column">
                <div class="input-box">
                  <label>Graduation Qualification</label>
                  <div class="select-box">
                    <select name="qual-1" disabled>
                      <option value="B.A" <?php echo ($_SESSION["senior_qual"] == 'B.A') ? 'selected' : '';?>>B.A</option>
                      <option value="B.Com" <?php echo ($_SESSION["senior_qual"] == 'B.Com') ? 'selected' : '';?>>B.Com</option>
                      <option value="B.Sc" <?php echo ($_SESSION["senior_qual"] == 'B.Sc') ? 'selected' : '';?>>B.Sc</option>
                      <option value="BCA" <?php echo ($_SESSION["senior_qual"] == 'BCA') ? 'selected' : '';?>>BCA</option>
                      <option value="B-Tech" <?php echo ($_SESSION["senior_qual"] == 'B-Tech') ? 'selected' : '';?>>B-Tech</option>
                    </select>
                  </div>
                </div>
                <div class="input-box">
                  <label>Post Graduation Qualification</label>
                  <div class="select-box">
                    <select name="qual-2" disabled>
                      <option value="M.A" <?php echo ($_SESSION["higher_qual"] == 'M.A') ? 'selected' : '';?>>M.A</option>
                      <option value="M.Com" <?php echo ($_SESSION["higher_qual"] == 'M.Com') ? 'selected' : '';?>>M.Com</option>
                      <option value="M.Sc" <?php echo ($_SESSION["higher_qual"] == 'M.Sc') ? 'selected' : '';?>>M.Sc</option>
                      <option value="MCA" <?php echo ($_SESSION["higher_qual"] == 'MCA') ? 'selected' : '';?>>MCA</option>
                      <option value="M-Tech" <?php echo ($_SESSION["higher_qual"] == 'M-Tech') ? 'selected' : '';?>>M-Tech</option>
                      <option value="None" <?php echo ($_SESSION["higher_qual"] == 'None') ? 'selected' : '';?>>None</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="gender-box">
                <h3>What technologies are you comfortable with ?</h3>
                <div class="gender-option">
                  <?php
                    $technologies = ['Web Design', 'DBMS', 'Python', 'C++', 'Java', 'PHP', 'IOT', 'SSAD', 'Linux', 'Dot Net', 'Graphic Design', 'Advance Java', 'Tally ERP', 'Advance Excel'];
                    foreach ($technologies as $tech) {
                      $checked = in_array($tech, $subjects) ? 'checked' : '';
                       echo "<div class='gender'>
                        <input type='checkbox' id='{$tech}' {$checked} disabled />
                        <label for='{$tech}'>{$tech}</label>
                      </div>";
                    }
                  ?>
              </div>
              </div>
              <div class="input-box address">
                <label>Address</label>
                <input type="text" value="<?php echo $_SESSION["add_1"];?>" disabled/>
                <input type="text" value="<?php echo $_SESSION["add_2"];?>" disabled/>
                <div class="column">
                  <div class="select-box">
                    <select name="country" disabled>
                      <option value="America" <?php echo ($_SESSION["country"] == 'America') ? 'selected' : ''; ?>>America</option>
                      <option value="Japan" <?php echo ($_SESSION["country"] == 'Japan') ? 'selected' : ''; ?>>Japan</option>
                      <option value="India" <?php echo ($_SESSION["country"] == 'India') ? 'selected' : ''; ?>>India</option>
                      <option value="Nepal" <?php echo ($_SESSION["country"] == 'Nepal') ? 'selected' : ''; ?>>Nepal</option>
                    </select>
                  </div>
                  <input type="text" value="<?php echo $_SESSION["city"];?>" disabled/>
                </div>
                <div class="column">
                  <input type="text" value="<?php echo $_SESSION["region"];?>" disabled/>
                  <input type="number" value="<?php echo $_SESSION["pincode"];?>" disabled/>
                </div>
              </div>
              <div class="input-box det-btn">
                <button type="submit">Delete Profile</button>
              </div>
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
  
  <script src="./scripts/new-staff.js"></script>
  <script src="./scripts/font.js"></script>
</body>
</html>