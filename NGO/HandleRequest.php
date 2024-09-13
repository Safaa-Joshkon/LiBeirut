<?php
require_once("Config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $volunteerId = $_POST["volunteer_id"];
    $action = $_POST["action"];

    // Debugging
    echo "Volunteer ID: " . $volunteerId . "<br>";
    echo "Action: " . $action . "<br>";

    // Update ngovolunteer table
    $query1 = "UPDATE ngovolunteer SET Response = '$action' WHERE VolunteerId = $volunteerId";
    $result1 = mysqli_query($con, $query1);

    // Update eventvolunteer table
    $query2 = "UPDATE eventvolunteer SET Response = '$action' WHERE VolunteerId = $volunteerId";
    $result2 = mysqli_query($con, $query2);

    if ($result1 && $result2) {
        echo "Request $action successfully!";
        // Redirect to Volunteers.php
        header("Location: Volunteers.php");
        exit;
    } else {
        echo "Error updating request!";
    }
} else {
    header("Location: Requests.php");
    exit;
}
