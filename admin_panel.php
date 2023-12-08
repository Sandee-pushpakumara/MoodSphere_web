<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

// Database connection setup
$conn = new mysqli('localhost', 'root', '', 'counsellingapp');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Query to count registered doctors
$sqlDoctors = "SELECT COUNT(*) AS doctor_count FROM Doctors";
$resultDoctors = mysqli_query($conn, $sqlDoctors);

if (!$resultDoctors) {
    die('Query failed: ' . mysqli_error($conn));
}

$rowDoctors = mysqli_fetch_assoc($resultDoctors);
$doctorCount = $rowDoctors['doctor_count'];

// Query to count all registered users
$sqlUsers = "SELECT COUNT(*) AS user_count FROM users";
$resultUsers = mysqli_query($conn, $sqlUsers);

if (!$resultUsers) {
    die('Query failed: ' . mysqli_error($conn));
}

$rowUsers = mysqli_fetch_assoc($resultUsers);
$userCount = $rowUsers['user_count'];

// Query to count all appointments
$sqlAppointments = "SELECT COUNT(*) AS appointment_count FROM appointments";
$resultAppointments = mysqli_query($conn, $sqlAppointments);

if (!$resultAppointments) {
    die('Query failed: ' . mysqli_error($conn));
}

$rowAppointments = mysqli_fetch_assoc($resultAppointments);
$appointmentCount = $rowAppointments['appointment_count'];
?>

<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsiive Admin Dashboard | CodingLab </title>
    <link rel="stylesheet" href="adminpanel.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://kit.fontawesome.com/9b6907c043.js" crossorigin="anonymous"></script>
     
    
   
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
    <box-icon name='user-circle' type='solid' color='#ffffff' ></box-icon>
      <span class="logo_name">Moodsphere</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="#" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
    </nav>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Counsillers</div>
            <div class="number">Count :<?php echo $doctorCount; ?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bx-plus-medical bx-md' style='color:#26c1e1' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Clients</div>
            <div class="number">Count :  <?php echo $userCount; ?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div >
          <i class='bx bxs-user bx-md' style='color:#2bc2d1; '  ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Appoitments</div>
            <div class="number">Count: <?php echo $appointmentCount; ?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bxs-calendar bx-md' style='color:#26c1e1'  ></i>
        </div>

      
  </section>

  

  <script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script>
 <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>
</html>
