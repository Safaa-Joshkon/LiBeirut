<?php

require_once("Config.php");

$idToDelete = base64_decode($_GET["id"]);
$query = "DELETE FROM events WHERE EventId = $idToDelete";

try {
    $result = mysqli_query($con, $query);
    if (!$result) {
        echo "Unable to delete Event! <br/><a href='index.php'>Back to Event List</a>"; //. mysqli_error($con);
    } else
        header("Location: index.php");
} catch (Exception $e) {
    echo "<h2 style='color:red'>Unable to delete Event Since it have Volunteers! </h2><a href='index.php'>Back to Event List</a>"; //. mysqli_error($con);

}
