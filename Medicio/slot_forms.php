<?php
// Replace these values with your actual MySQL database details
$host = "localhost";
$username = "root";
$password = "";
$database = "hospitaltry"; // Corrected the database name

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch doctor names from the database
$doctorQuery = "SELECT D_id, D_name FROM doctors";
$doctorResult = $conn->query($doctorQuery);

// Check if there are doctors available
if ($doctorResult->num_rows > 0) {
    $doctors = $doctorResult->fetch_all(MYSQLI_ASSOC);
} else {
    $doctors = [];
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Appointment System</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
        }

        input, select {
            margin-bottom: 16px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Appointment Form</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> <!-- Corrected the form action -->
            <!-- Step 1: Select Doctor -->
            <div id="step1">
                <label for="doctor">Select Doctor:</label>
                <select name="doctor" id="doctor">
                    <?php
                        // Populate dropdown with doctor names
                        foreach ($doctors as $doctor) {
                            echo "<option value=\"" . htmlspecialchars($doctor['D_id']) . "\">" . htmlspecialchars($doctor['D_name']) . "</option>";
                        }
                    ?>
                </select>
                <button type="button" onclick="nextStep()">Next</button>
            </div>

            <!-- Step 2: Enter Patient Details -->
            <div id="step2" style="display: none;">
                <label for="patientName">Patient Name:</label>
                <input type="text" name="patientName" required><br>

                <label for="contactNumber">Contact Number:</label>
                <input type="text" name="contactNumber" required><br>

                <label for="date">Appointment Date:</label>
                <input type="date" name="date" required><br>

                <label for="time">Appointment Time:</label>
                <input type="time" name="time" required><br>

                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
  
    <?php
// Replace these values with your actual MySQL database details
$host = "localhost";
$username = "root";
$password = "";
$database = "hospitaltry";

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $doctorId = $conn->real_escape_string($_POST['doctor']);
    $patientName = $conn->real_escape_string($_POST['patientName']);
    $contactNumber = $conn->real_escape_string($_POST['contactNumber']);
    $appointmentDate = $conn->real_escape_string($_POST['date']);
    $appointmentTime = $conn->real_escape_string($_POST['time']);

    // Perform the database insert operations
    $conn->autocommit(FALSE);

    // Insert into Patient table
    $patientInsertSQL = "INSERT INTO Patient (PatientName, ContactNumber) VALUES ('$patientName', '$contactNumber')";
    $conn->query($patientInsertSQL);

    // Get the PatientID of the newly inserted patient
    $patientId = $conn->insert_id;

    // Insert into Slot table (assuming your appointment table is named 'slot')
    $slotInsertSQL = "INSERT INTO slot (D_id, Time, Date, P_number) 
                      VALUES ('$doctorId', '$appointmentTime', '$appointmentDate', '$patientId')";
    $conn->query($slotInsertSQL);

    // Commit the transaction
    $conn->commit();

    echo "Appointment successfully scheduled!";
}

// Close the connection
$conn->close();
?>

<script>
        function nextStep() {
            document.getElementById("step1").style.display = "none";
            document.getElementById("step2").style.display = "block";
        }
    </script>
</body>
</body>
</html>
