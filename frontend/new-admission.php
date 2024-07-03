<?php
  session_start();
  include("../backend/connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management</title>
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/new-admission.css">
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
                <img src="./img/admin.png" alt="Administrator">
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
                <a href="#">
                    <i class="fa-sharp fa-solid fa-table-cells-large"></i>
                    <span class="nav-items">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li class="nav-links">
                <a href="#">
                    <i class="fa-solid fa-person-chalkboard"></i>
                    <span class="nav-items">Teahcers</span>
                </a>
                <span class="tooltip">Teahcers</span>
            </li>
            <li class="nav-links">
                <a href="#">
                    <i class="fa-solid fa-user-graduate"></i>
                    <span class="nav-items">Students</span>
                </a>
                <span class="tooltip">Students</span>
            </li>
            <li class="nav-links">
                <a href="#">
                    <i class="fa-regular fa-calendar-check"></i>
                    <span class="nav-items">
                        Events
                    </span>
                </a>
                <span class="tooltip">Events</span>
            </li>
            <li class="nav-links">
                <a href="#">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span class="nav-items">Calender</span>
                </a>
                <span class="tooltip">Calender</span>
            </li>
            <li class="nav-links">
                <a href="#">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span class="nav-items">Chart</span>
                </a>
                <span class="tooltip">Chart</span>
            </li>
            <li class="nav-links">
                <a href="#">
                    <i class="fa-solid fa-chart-line"></i>
                    <span class="nav-items">Finance</span>
                </a>
                <span class="tooltip">Finance</span>
            </li>
            <li class="nav-links">
                <a href="#">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span class="nav-items">Notifications</span>
                </a>
                <span class="tooltip">Notifications</span>
            </li>
            <li class="nav-links">
                <a href="#">
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
            <header>New Admission</header>
            <form action="./new-admission.php" method="post" class="form">
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
                <input type="password" placeholder="Enter  password" name="password" required />
              </div>
              <div class="column">
                <div class="input-box">
                  <label>Phone Number</label>
                  <input type="number" placeholder="Enter phone number" name="phone" required />
                </div>
                <div class="input-box">
                  <label>Birth Date</label>
                  <input type="date" name="dob" required />
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
                  <label>Senior Secondary Qualification</label>
                  <div class="select-box">
                    <select name="qual-1">
                      <option hidden>Senior Secondary</option>
                      <option value="10th">10th</option>
                      <option value="12th">12th</option>
                    </select>
                  </div>
                </div>
                <div class="input-box">
                  <label>Graduation Qualification</label>
                  <div class="select-box">
                    <select name="qual-2">
                      <option hidden>Graduation Qualification</option>
                      <option value="B.A">B.A</option>
                      <option value="B.Com">B.Com</option>
                      <option value="B.Sc">B.Sc</option>
                      <option value="BCA">BCA</option>
                      <option value="B-Tech">B-Tech</option>
                      <option value="None">None</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="input-box">
                <label>Which Programme would you like to take</label>
                <div class="select-box">
                    <select name="course">
                      <option hidden>Which one you like</option>
                      <option value="MDCE">MDCE -3 Years</option>
                      <option value="ADCE">ADCE -2.5 Years</option>
                      <option value="ADEA">ADEA -2 Years</option>
                      <option value="Graphic Design">Graphic Designing -1.5 Year</option>
                      <option value="Web Developement">Web Devlopement -1 Year</option>
                    </select>
                  </div>
              </div>
              <div class="input-box address">
                <label>Address</label>
                <input type="text" placeholder="Enter street address" name="address-1" required />
                <input type="text" placeholder="Enter street address line 2" name="address-2" required />
                <div class="column">
                  <div class="select-box">
                    <select name="country" required>
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
              <button type="submit">Submit Admission</button>
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
                <p>&copy; 2024 Developed & Managed by<span>Hemant Zuceed</span></p>
            </div>
        </div>
  </footer>

  <script src="./scripts/font.js"></script>
  <script src="./scripts/new-admission.js"></script>
</body>
</html>

<?php include("../backend/new-admission-backend.php")?>