<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Time Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        fieldset {
            border: none;
            margin: 0;
            padding: 0;
        }

        legend {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .success {
            color: #28a745;
            margin-top: 20px;
            text-align: center;
        }

        .error {
            color: #dc3545;
            margin-top: 20px;
            text-align: center;
        }
    </style>
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

    // Check if appointment already exists for this date
    $existingAppointment = $conn->query("SELECT * FROM `123` WHERE `date` = '$date'")->fetch_assoc();

    if ($existingAppointment) {
        // Update existing appointment
        $updateColumns = [];
        foreach ($selectedTimeSlots as $slot) {
            $updateColumns[] = "`$slot` = 'yes'";
        }

        $updateQuery = "UPDATE `123` SET " . implode(",", $updateColumns) . " WHERE `date` = '$date'";

        if ($conn->query($updateQuery) === TRUE) {
            echo "<p class='success'>Appointment updated successfully!</p>";
        } else {
            echo "<p class='error'>Error updating appointment: " . $conn->error . "</p>";
        }
    } else {
        // Insert new appointment
        $sqlColumns = "`date`," . implode(",", array_map(function ($slot) {
            return "`$slot`";
        }, $selectedTimeSlots));

        $sqlValues = "'$date'," . implode(",", array_fill(0, count($selectedTimeSlots), "'yes'"));

        $insertQuery = "INSERT INTO `123` ($sqlColumns) VALUES ($sqlValues)";

        if ($conn->query($insertQuery) === TRUE) {
            echo "<p class='success'>Appointment scheduled successfully!</p>";
        } else {
            echo "<p class='error'>Error scheduling appointment: " . $conn->error . "</p>";
        }
    }

    // Close connection
    $conn->close();
}
?>


</body>
</html>
