<?php
require_once("Config.php");
if (isset($_POST["submitApplication"]) && isset($_POST["volunteerType"])) {
    $volunteerType = $_POST["volunteerType"];
    $volunteerName = $_SESSION['Username'];
    // Retrieve volunteer ID
    $query = "SELECT VolunteerId FROM volunteer WHERE Name = '$volunteerName'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $volunteerId = $row["VolunteerId"];
    if ($volunteerType == "specificEvent") {
        $query = "INSERT INTO eventvolunteer (VolunteerId, EventId, Response) VALUES ($volunteerId, $EventId, 'Pending')";
    } else {
        // Retrieve NGOId
        $query = "SELECT NGOId FROM organizeevent WHERE EventId = $EventId";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        $NGOId = $row["NGOId"];
        $query = "INSERT INTO ngovolunteer (VolunteerId, NGOId, Response) VALUES ($volunteerId, $NGOId, 'Pending')";
    }
    $result = mysqli_query($con, $query);
    if (!$result) {
        echo "Error: " . mysqli_error($con);
    } else {
        echo "Record added successfully.";
        // Redirect to a success page or do something else
        header("Location: Details.php");
    }


    mysqli_close($con); // Close the database connection
}
