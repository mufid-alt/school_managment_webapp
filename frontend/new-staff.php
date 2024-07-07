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
</head>
<body>
  <!-- ======Success message pop up==== -->
  <div class="success"></div>

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
        <section class="form-container">
            <header>Hire New Teachers</header>
            <form action="./new-staff.php" method="post" class="form">
              <div class="input-box">
                <label>Full Name</label>
                <input type="text" placeholder="Enter full name" name="name" required />
              </div>
              <div class="input-box">
                <label>Email Address</label>
                <input type="text" placeholder="Enter  email address" name="email" required />
              </div>
              <div class="input-box">
                <label>Set Password</label>
                <input type="password" placeholder="Enter password" name="pass" required />
              </div>
              <div class="column">
                <div class="input-box">
                  <label>Phone Number</label>
                  <input type="number" placeholder="Enter phone number" name="phone" required />
                </div>
                <div class="input-box">
                  <label>Birth Date</label>
                  <input type="date" name="dob" />
                </div>
              </div>
              <div class="gender-box">
                <h3>Gender</h3>
                <div class="gender-option">
                  <div class="gender">
                    <input type="radio" id="check-male" name="gender" value="Male" />
                    <label for="check-male">Male</label>
                  </div>
                  <div class="gender">
                    <input type="radio" id="check-female" name="gender" value="Female" />
                    <label for="check-female">Female</label>
                  </div>
                  <div class="gender">
                    <input type="radio" id="check-other" name="gender" value="Others" />
                    <label for="check-other">Prefer not to say</label>
                  </div>
                </div>
              </div>
              <div class="column">
                <div class="input-box">
                  <label>Graduation Qualification</label>
                  <div class="select-box">
                    <select name="qual-1">
                      <option hidden>Graduation Qualification</option>
                      <option value="B.A">B.A</option>
                      <option value="B.Com">B.Com</option>
                      <option value="B.Sc">B.Sc</option>
                      <option value="BCA">BCA</option>
                      <option value="B-Tech">B-Tech</option>
                    </select>
                  </div>
                </div>
                <div class="input-box">
                  <label>Post Graduation Qualification</label>
                  <div class="select-box">
                    <select name="qual-2">
                      <option hidden>Graduation Qualification</option>
                      <option value="M.A">M.A</option>
                      <option value="M.Com">M.Com</option>
                      <option value="M.Sc">M.Sc</option>
                      <option value="MCA">MCA</option>
                      <option value="M-Tech">M-Tech</option>
                      <option value="None">None</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="gender-box">
                <h3>What technologies are you comfortable with ?</h3>
                <div class="gender-option">
                  <div class="gender">
                    <input type="checkbox" id="web" name="subjects[]" value="Web Design"/>
                    <label for="web">Web Design</label>
                  </div>
                  <div class="gender">
                    <input type="checkbox" id="dbms" name="subjects[]" value="DBMS"/>
                    <label for="dbms">DBMS</label>
                  </div>
                  <div class="gender">
                    <input type="checkbox" id="python" name="subjects[]" value="Python"/>
                    <label for="python">Python</label>
                  </div>
                  <div class="gender">
                    <input type="checkbox" id="c++" name="subjects[]" value="C++"/>
                    <label for="c++">C++</label>
                  </div>
                  <div class="gender">
                    <input type="checkbox" id="java" name="subjects[]" value="Java"/>
                    <label for="java">Java</label>
                  </div>
                  <div class="gender">
                    <input type="checkbox" id="php" name="subjects[]" value="PHP"/>
                    <label for="php">PHP</label>
                  </div>
                  <div class="gender">
                    <input type="checkbox" id="iot" name="subjects[]" value="IOT"/>
                    <label for="iot">IOT</label>
                  </div>
                  <div class="gender">
                    <input type="checkbox" id="ssad" name="subjects[]" value="SSAD"/>
                    <label for="ssad">SSAD</label>
                  </div>
                  <div class="gender">
                    <input type="checkbox" id="linux" name="subjects[]" value="Linux"/>
                    <label for="linux">Linux</label>
                  </div>
                  <div class="gender">
                    <input type="checkbox" id="net" name="subjects[]" value="Dot Net"/>
                    <label for="net">Dot Net</label>
                  </div>
                  <div class="gender">
                    <input type="checkbox" id="graphic" name="subjects[]" value="Graphic Design"/>
                    <label for="graphic">Graphic Design</label>
                  </div>
                  <div class="gender">
                    <input type="checkbox" id="ad-java" name="subjects[]" value="Advance Java"/>
                    <label for="ad-java">Advance Java</label>
                  </div>
                  <div class="gender">
                    <input type="checkbox" id="tally" name="subjects[]" value="Tally ERP"/>
                    <label for="tally">Tally ERP</label>
                  </div>
                  <div class="gender">
                    <input type="checkbox" id="excel" name="subjects[]" value="Advance Excel"/>
                    <label for="excel">Advance Excel</label>
                  </div>
                </div>
              </div>
              <div class="input-box address">
                <label>Address</label>
                <input type="text" placeholder="Enter street address" name="add-1" required />
                <input type="text" placeholder="Enter street address line 2" name="add-2" required />
                <div class="column">
                  <div class="select-box">
                    <select name="country">
                      <option hidden>Country</option>
                      <option value="America">America</option>
                      <option value="Japan">Japan</option>
                      <option value="India">India</option>
                      <option value="Nepal">Nepal</option>
                    </select>
                  </div>
                  <input type="text" placeholder="Enter your city" name="city" required />
                </div>
                <div class="column">
                  <input type="text" placeholder="Enter your region" name="region" required />
                  <input type="number" placeholder="Enter postal code" name="pincode" required />
                </div>
              </div>
              <button type="submit">Hire Teacher</button>
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

<?php include("../backend/new-staff-backend.php")?>