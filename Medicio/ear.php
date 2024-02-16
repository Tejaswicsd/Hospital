<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Hospital</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medicio
  * Updated: Jan 09 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/medicio-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
      <div class="align-items-center d-none d-md-flex">
        <i class="bi bi-clock"></i> Monday - Saturday, 8AM to 10PM
      </div>
      <div class="d-flex align-items-center">
        <i class="bi bi-phone"></i> Call us now 088162 21111
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <a href="index.php" class="logo me-auto"><img src="assets/img/fix.jpg" alt=""></a>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <h1 class="logo me-auto"><a href="index.php">Medicio</a></h1> -->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto " href="index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="index.php#about">About</a></li>
          <li><a class="nav-link scrollto" href="index.php#services">Services</a></li>
          <li><a class="nav-link scrollto" href="index.php#departments">Departments</a></li>
          <li><a class="nav-link scrollto" href="index.php#doctors">Doctors</a></li>
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="heart.php">Cardiologist</a></li>
              <li><a href="teeth.php">Dentist</a></li>
              <li><a href="skin.php">Gynecologist</a></li>
              <li><a href="brain.php">Neurologist</a></li>
              <li><a href="bone.php">Physician</a></li>
              <li><a href="ear.php">Audiologist</a></li>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="index.php#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">View</span> Appointment</a>

    </div>
  </header><!-- End Header -->

  <section id="pricing" class="pricing">
    <div class="container" data-aos="fade-up">
      <br>
      <br>
      <br>
      <br>

      <div class="section-title">
        <h2>ENT </h2>
        <p></p>
      </div>

      <div class="row">
      <div class="row">
  <?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "hospital_praj";

  // Create connection
  $connection = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
  }

  // Fetch doctors' data from the database
  $sql = "SELECT * FROM doctors where sp='ENT'";
  $result = $connection->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Output HTML dynamically with data from the database
        echo '
        <div class="col-lg-3 col-md-6">
            <div class="box" data-aos="fade-up" data-aos-delay="100">
                <img src="assets/img/doctor.jpg" alt="Doctor Image" style="width: 100px; height: 100px;">
                <h3>' . $row["full_name"] . '</h3>
                <h4><sup>' . $row["full_name"] . '</sup><span></span></h4>
                <ul>
                    <li></li>
                    <li>Bhimavaram</li>
                    <li>Specialization: ' . $row["sp"] . '</li>

                    <li class="na"></li>
                    <li class="na"></li>
                </ul>
                <div class="btn-wrap">
                <a href="slot.php?d_id=' . $row["d_id"] . '" class="btn-buy">Book Slot</a>

                </div>
            </div>
        </div>';
    }
} else {
    echo "0 results found";
}


  // Close connection
  $connection->close();
  ?>
</div>

       
      </div>
    </div>
  </section><!-- End Pricing Section -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>
