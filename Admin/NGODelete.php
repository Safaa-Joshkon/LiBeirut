<?php
require_once("Config.php");

$idToDelete = base64_decode($_GET["id"]);

// Get the NGO name before deleting the record
$nameQuery = "SELECT Name FROM ngo WHERE NGOId = $idToDelete";
$nameResult = mysqli_query($con, $nameQuery);
$nameRow = mysqli_fetch_assoc($nameResult);
$ngoName = $nameRow['Name'];

$query = "DELETE FROM ngo WHERE NGOId = $idToDelete";
$query2 = "DELETE FROM users WHERE Username = '$ngoName'"; // Notice the single quotes around $ngoName

try {
    $result = mysqli_query($con, $query);
    $result2 = mysqli_query($con, $query2);
    if (!$result || !$result2) {
        echo "Unable to delete NGO! <br/><a href='NGO.php'>Back to NGO List</a>";
    } else {
        header("Location: NGO.php");
    }
} catch (Exception $e) {
    echo "<h2 style='color:red'>Unable to delete NGO Since it have Volunteers! </h2><a href='NGO.php'>Back to NGO List</a>";
}
