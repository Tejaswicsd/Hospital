
<?php
session_start();
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'hospital_praj';
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit;
}
?>
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
        <i class="bi bi-phone"></i> Call us now 088162 21111
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
          <li><a class="nav-link scrollto" href="index.php#services">Services</a></li>
          <li><a class="nav-link scrollto" href="index.php#doctors">Doctors</a></li>
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="heart.php">cardiologist</a></li>
              <li><a href="teeth.php">Dentist</a></li>
              <li><a href="skin.php">Dermatologist </a></li>
              <li><a href="brain.php">Neurologist</a></li>
              <li><a href="bone.php">Orthopedic</a></li>
              <li><a href="ear.php">ENT </a></li>
              <li><a href="#"></a></li>
              
              <li><a href="#"> </a></li>
              <li><a href="#"></a></li>
              <li><a href="#"></a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="#"></a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">View </span> Appointment</a>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(assets/img/moon.jpg)">
          
        </div>

        <!-- Slide 2 -->
        

        <!-- Slide 3 -->
      

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section><!-- End Hero -->

  <main id="main">

 
    <section id="services" class="services services">
      <div class="container" data-aos="fade-up">
          <div class="section-title">
              <h2>OUR SPECIALIST</h2>
              <p>In this You can select the specialist according to your problem</p>
          </div>
  
          <div class="row">
              <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="100">
                  <div class="icon"><img src="assets/img/heart.jpg" alt="Heart Image" width="64" height="64"></div>
                  <h4 class="title"><a href="heart.php">cardiologist</a></h4>
                  <p class="description">Consult our Best and well Experienced cardiologist For Healthy Heart</p>
              </div>
              <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
                  <div class="icon"><img src="assets/img/girls.avif" alt="Pills Image" width="64" height="64"></div>
                  <h4 class="title"><a href="skin.php">Dermatologist </a></h4>
                  <p class="description">Consult our Best and well Experienced Gynecologist  For Healthy Skin</p>
              </div>
              <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
                <div class="icon"><img src="assets/img/brain.jpg" alt="Pills Image" width="64" height="64"></div>
                <h4 class="title"><a href="brain.php">Neurologist</a></h4>
                <p class="description">Consult our Best and well Experienced Neurologist For Healthy Brain </p>
            </div>
            <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
              <div class="icon"><img src="assets/img/heyy.jpeg" alt="Pills Image" width="64" height="64"></div>
              <h4 class="title"><a href="bone.php">Orthopedic </a></h4>
              <p class="description">Consult our Best and well Experienced Orthopedic  For Healthy Body</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon"><img src="assets/img/teeth.jpg" alt="Pills Image" width="64" height="64"></div>
            <h4 class="title"><a href="teeth.php">Dentist</a></h4>
            <p class="description">Consult our Best and well Experienced Dentist For Healthy Teeth</p>
        </div>
        <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
          <div class="icon"><img src="assets/img/ear.avif" alt="Pills Image" width="64" height="64"></div>
          <h4 class="title"><a href="ear.php">ENT</a></h4>
          <p class="description">Consult our Best and well Experienced ENT For Healthy Ear for Hearing</p>
      </div>
              <!-- Repeat the above structure for other services, replacing the img src attribute accordingly -->
          </div>
      </div>
  </section>
  
  


   

    

  

    <!-- ======= Appointment Section ======= -->
    <section id="appointment" class="appointment section-bg">
      <div class="container" data-aos="fade-up">
     
        <div class="section-title">
          <h2>Your  Appointment</h2>
          <p> Be on time to get your checkup.</p>
        </div>
        <?php

// Check if patient is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_praj";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Cancel slot if requested
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancel_booking_id'])) {
    $booking_id = $_POST['cancel_booking_id'];
    $delete_query = "DELETE FROM patient_booking WHERE booking_id = '$booking_id'";
    if ($conn->query($delete_query) === TRUE) {
        // Slot cancelled successfully
        exit; // Terminate script execution after redirection
    } else {
        echo "Error cancelling slot: " . $conn->error;
    }
}

// Fetch appointments booked by the patient with doctor's name
$patient_id = $_SESSION['user_id'];
$query = "SELECT pb.booking_id, pb.date, pb.time, d.full_name 
          FROM patient_booking pb
          JOIN doctors d ON pb.d_id = d.d_id
          WHERE pb.patient_id = '$patient_id'";
$result = $conn->query($query);
?>


    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>

    <h2>Your Appointments</h2>
    <table>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Doctor Name</th>
                <th>Cancel</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['booking_id'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['time'] . "</td>";
                    echo "<td>" . $row['full_name'] . "</td>";
                    echo "<td><form method='post'><input type='hidden' name='cancel_booking_id' value='" . $row['booking_id'] . "'><button type='submit' onclick='return confirmCancel()'>Cancel</button></form></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No appointments booked.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        function confirmCancel() {
            return confirm("Are you sure you want to cancel this appointment?");
        }
    </script>


<?php
// Close database connection
$conn->close();
?>



      </div>
    </section><!-- End Appointment Section -->

    <!-- ======= Departments Section ======= -->
    <section id="departments" class="departments">
      <div class="container" data-aos="fade-up">

       

      </div>
    </section><!-- End Departments Section -->

  

    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors section-bg">
      <div class="container" data-aos="fade-up">

       

      <section id="pricing" class="pricing">
    <div class="container" data-aos="fade-up">
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
            $sql = "SELECT * FROM doctors";
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
                                <li>Specialization: ' . $row["sp"] . '</li>
                                <li>Bhimavaram</li>
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
</section>


      </div>
    </section><!-- End Doctors Section -->

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Gallery</h2>
        </div>

        <div class="gallery-slider swiper">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-1.jpg"><img src="assets/img/gallery/gallery-1.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-2.jpg"><img src="assets/img/gallery/gallery-2.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-3.jpg"><img src="assets/img/gallery/gallery-3.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-4.jpg"><img src="assets/img/gallery/gallery-4.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-5.jpg"><img src="assets/img/gallery/gallery-5.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-6.jpg"><img src="assets/img/gallery/gallery-6.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-7.jpg"><img src="assets/img/gallery/gallery-7.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-8.jpg"><img src="assets/img/gallery/gallery-8.jpg" class="img-fluid" alt=""></a></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Gallery Section -->

  
   

   

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>Medicio</h3>
              <p>
                A108 Adam Street <br>
                NY 535022, USA<br><br>
                <strong>Phone:</strong> +1 5589 55488 55<br>
                <strong>Email:</strong> info@example.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Medicio</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/medicio-free-bootstrap-theme/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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