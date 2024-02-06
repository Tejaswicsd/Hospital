<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Time Form</title>
</head>
<body>
    <h1>Set Appointment Time</h1>

    <form action="" method="post">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <fieldset>
            <legend>Select Time Slot(s):</legend>

            <?php
            // Database connection details
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "hospitaltry";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to get available time slots from the database
            $result = $conn->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '123' AND COLUMN_NAME <> 'date'");

            // Display checkboxes for each available time slot
            while ($row = $result->fetch_assoc()) {
                $timeSlot = $row['COLUMN_NAME'];
            ?>
                <label>
                    <input type="checkbox" name="time_slot[]" value="<?php echo $timeSlot; ?>"><?php echo $timeSlot; ?>
                </label>
            <?php
            }

            // Close connection
            $conn->close();
            ?>

        </fieldset>

        <button type="submit">Submit</button>
    </form>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST["date"];
    $selectedTimeSlots = isset($_POST["time_slot"]) ? $_POST["time_slot"] : [];

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hospitaltry";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape user inputs to prevent SQL injection
    $date = mysqli_real_escape_string($conn, $date);

    // Generate the SQL query dynamically
    $sqlColumns = implode(",", array_map(function ($slot) {
        return "`$slot`";
    }, $selectedTimeSlots));

    $sqlValues = implode(",", array_fill(0, count($selectedTimeSlots), "'yes'"));

    $sql = "INSERT INTO `123` (`date`, $sqlColumns) VALUES ('$date', $sqlValues)";

    if ($conn->query($sql) === TRUE) {
        echo "Appointment scheduled successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>

</body>
</html>
