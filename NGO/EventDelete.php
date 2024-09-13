<?php

require_once("Config.php");

$idToDelete = base64_decode($_GET["id"]);

// Delete corresponding records in the organizeevent table
$deleteOrganizeQuery = "DELETE FROM organizeevent WHERE EventId = $idToDelete";

// Delete the event from the events table
$deleteEventQuery = "DELETE FROM events WHERE EventId = $idToDelete";

try {
    // Perform the deletion in a transaction
    mysqli_autocommit($con, false);

    $result1 = mysqli_query($con, $deleteOrganizeQuery);
    $result2 = mysqli_query($con, $deleteEventQuery);

    if (!$result1 || !$result2) {
        mysqli_rollback($con);
        echo "Unable to delete Event! <br/><a href='index.php'>Back to Event List</a>";
    } else {
        mysqli_commit($con);
        header("Location: index.php");
    }
} catch (Exception $e) {
    mysqli_rollback($con);
    echo "<h2 style='color:red'>Unable to delete Event Since it have Volunteers! </h2><a href='index.php'>Back to Event List</a>";
}
