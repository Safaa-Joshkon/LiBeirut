<?php
require_once("Config.php");

$idToDelete = base64_decode($_GET["id"]);

// Get the NGO name before deleting the record
$nameQuery = "SELECT Name FROM volunteer WHERE VolunteerId = $idToDelete";
$nameResult = mysqli_query($con, $nameQuery);
$nameRow = mysqli_fetch_assoc($nameResult);
$volName = $nameRow['Name'];

$query = "DELETE FROM volunteer WHERE VolunteerId = $idToDelete";
$query2 = "DELETE FROM users WHERE Username = '$volName'";

try {
    $result = mysqli_query($con, $query);
    $result2 = mysqli_query($con, $query2);
    if (!$result || !$result2) {
        echo "Unable to delete Volunteer! <br/><a href='Volunteers.php'>Back to NGO List</a>";
    } else {
        header("Location: Volunteers.php");
    }
} catch (Exception $e) {
    echo "<a href='Volunteers.php'>Back to NGO List</a>";
}
