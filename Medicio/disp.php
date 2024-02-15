<?php
session_start();

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
        header("Refresh:0"); // Refresh the page to reflect the changes
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

    <h2>Appointments</h2>
    <table>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Doctor Name</th>
                <th>Action</th>
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
