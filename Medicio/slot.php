<?php
session_start();

// Check if doctor is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if d_id is set in the URL
if (!isset($_GET['d_id'])) {
    // Handle the case when d_id is not provided
    echo "Doctor ID is missing.";
    exit;
}

// Retrieve d_id from the URL
$d_id = $_GET['d_id'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_praj";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission if POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $patient_id = $_SESSION['user_id'];

    // Check if the time slot is available
    $availability_query = "SELECT * FROM `patient_booking` WHERE `d_id` = '$d_id' AND `date` = '$date' AND `time` = '$time'";
    $availability_result = $conn->query($availability_query);
    if ($availability_result->num_rows > 0) {
        echo "This slot is already booked.";
        exit;
    }

    // Insert into patient_booking table
    $stmt = $conn->prepare("INSERT INTO patient_booking (patient_id, d_id, date, time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $patient_id, $d_id, $date, $time);
    if ($stmt->execute() === TRUE) {
        echo "Slot booked successfully!";
    } else {
        echo "Error booking slot: " . $conn->error;
    }
    $stmt->close();
}

// Fetch available slots for the selected date
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['date'])) {
    $date = $_GET['date'];
    $query = "SELECT * FROM `app` WHERE `d_id` = '$d_id' AND `date` = '$date'";
    $result = $conn->query($query);
    $timeSlots = [];
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        foreach ($row as $key => $value) {
            if ($key !== 'id' && $key !== 'date') {
                // Check if the slot is already booked
                $availability_query = "SELECT * FROM `patient_booking` WHERE `d_id` = '$d_id' AND `date` = '$date' AND `time` = '$key'";
                $availability_result = $conn->query($availability_query);
                if ($availability_result->num_rows == 0 && $value === 'yes') {
                    $timeSlots[] = ['time' => $key, 'status' => 'yes'];
                }
            }
        }
    }

    // Return time slots as JSON
    header('Content-Type: application/json');
    echo json_encode($timeSlots);
    exit; // Stop further execution
}

// Close database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>BHIMAVARAM HOSPITALS</title>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.0/main.min.css" integrity="sha512-Y9hw2QpVj8TgvWLj96U1WVfF3XOwXmCqgF3Oh0UgJyRPm7z5osjIFG8W8KuP3+9R6+voAGlSXd6RTMDdKggyKQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .available {
            background-color: lightgreen;
        }
        /* Additional CSS for the book button */
        button {
            background-color: green;
            color: white;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: darkgreen;
        }
    </style>
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
  </header>

   <section>
  
    <h1>Book Slot</h1>
    <div id='calendar'></div>
    
    <form id="bookingForm" method="post">
        <input id="datePicker" type="date" name="date" required>
        <button type="button" id="fetchSlotsButton">Get Time Slots</button>
    </form>

    <div id="timeSlotsTableContainer"></div>
    </section>
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('fetchSlotsButton').addEventListener('click', fetchTimeSlots);

          function fetchTimeSlots() {
    var selectedDate = document.getElementById('datePicker').value;
    var url = window.location.href.split('?')[0] + '?date=' + selectedDate + '&d_id=<?php echo $d_id; ?>';

    fetch(url)
        .then(response => response.json())
        .then(data => {
            displayTimeSlots(data);
        })
        .catch(error => {
            console.error('Error fetching time slots:', error);
        });
}

            function displayTimeSlots(slotsData) {
                var container = document.getElementById('timeSlotsTableContainer');
                container.innerHTML = ''; // Clear previous content

                if (slotsData.length === 0) {
                    container.textContent = 'No available time slots for selected date.';
                    return;
                }

                var table = document.createElement('table');
                var headerRow = table.insertRow();
                headerRow.innerHTML = '<th>Time Slot</th><th>Click Book to Get Appointment</th>';

                slotsData.forEach(slot => {
                    var row = table.insertRow();
                    var timeSlotCell = row.insertCell();
                    timeSlotCell.textContent = slot.time;
                    var actionCell = row.insertCell();
                    if (slot.status === 'yes') {
                        var bookButton = document.createElement('button');
                        bookButton.textContent = 'Book';
                        bookButton.addEventListener('click', function() {
                            bookSlot(slot.time);
                        });
                        actionCell.appendChild(bookButton);
                    } else {
                        actionCell.textContent = 'Not available';
                    }
                });

                container.appendChild(table);
            }

            function bookSlot(time) {
                var date = document.getElementById('datePicker').value;
                var formData = new FormData();
                formData.append('date', date);
                formData.append('time', time);

                fetch(window.location.href, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    if (data.includes('successfully')) {
                        alert('Slot booked successfully!');
                        // Redirect to index.php after clicking OK
                        window.location.href = 'index.php';
                    } else {
                        alert(data);
                    }
                    fetchTimeSlots(); // Refresh time slots after booking
                })
                .catch(error => {
                    console.error('Error booking slot:', error);
                });
            }
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('fetchSlotsButton').addEventListener('click', fetchTimeSlots);

        function fetchTimeSlots() {
            var selectedDate = document.getElementById('datePicker').value;
            var url = window.location.href + '?date=' + selectedDate;
            
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    displayTimeSlots(data);
                })
                .catch(error => {
                    console.error('Error fetching time slots:', error);
                });
        }

        function displayTimeSlots(slotsData) {
            var container = document.getElementById('timeSlotsTableContainer');
            container.innerHTML = ''; // Clear previous content

            if (slotsData.length === 0) {
                container.textContent = 'No available time slots for selected date.';
                return;
            }

            var table = document.createElement('table');
            var headerRow = table.insertRow();
            headerRow.innerHTML = '<th>Time Slot</th><th>Action</th>';

            slotsData.forEach(slot => {
                var row = table.insertRow();
                var timeSlotCell = row.insertCell();
                timeSlotCell.textContent = slot.time;
                var actionCell = row.insertCell();
                if (slot.status === 'yes') {
                    var bookButton = document.createElement('button');
                    bookButton.textContent = 'Book';
                    bookButton.addEventListener('click', function() {
                        bookSlot(slot.time);
                    });
                    actionCell.appendChild(bookButton);
                } else {
                    actionCell.textContent = 'Not available';
                }
            });

            container.appendChild(table);
        }

        function bookSlot(time) {
            var date = document.getElementById('datePicker').value;
            var formData = new FormData();
            formData.append('date', date);
            formData.append('time', time);

            fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes('successfully')) {
                    alert('Slot booked successfully!');
                    // Redirect to index.php after clicking OK
                    window.location.href = 'index.php';
                } else {
                    alert(data);
                }
                fetchTimeSlots(); // Refresh time slots after booking
            })
            .catch(error => {
                console.error('Error booking slot:', error);
            });
        }
    });
</script>

</body>
</html>

