<?php
require_once("Config.php");

$username = $_SESSION['Username'];

// Get the Volunteer ID
$query = "SELECT VolunteerId FROM volunteer WHERE Name = '$username'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$idToDelete = $row['VolunteerId'];

// Get the NGO name before deleting the record (optional)
$nameQuery = "SELECT Name FROM volunteer WHERE VolunteerId = $idToDelete";
$nameResult = mysqli_query($con, $nameQuery);
$nameRow = mysqli_fetch_assoc($nameResult);
$volName = $nameRow['Name'];

// Confirmation message with options
$confirmationMessage = "Are you sure you want to delete your volunteer account? <br>This action cannot be undone.";

// Display confirmation message and options
echo "
<style>
    .confirmation {
        width: 300px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        text-align: center;
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
    }
    .confirmation p {
        font-size: 16px;
        color: #333;
    }
    .confirmation a {
        display: inline-block;
        margin: 10px;
        padding: 10px 20px;
        text-decoration: none;
        color: #fff;
        background-color: #007BFF;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    .confirmation a:hover {
        background-color: #0056b3;
    }
    .confirmation .cancel {
        background-color: #6c757d;
    }
    .confirmation .cancel:hover {
        background-color: #5a6268;
    }
</style>
<div class='confirmation'>
    <p>$confirmationMessage</p>
    <a href='?id=$idToDelete&confirm=yes'>Yes, Delete Account</a>
    <a href='index.php' class='cancel'>No, Keep Account</a>
</div>";

// Check for confirmation in the URL parameter (optional security measure)
if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
    // Delete volunteer and user accounts (if applicable)
    $query = "DELETE FROM volunteer WHERE VolunteerId = $idToDelete";
    $query2 = "DELETE FROM users WHERE Username = '$volName'";

    try {
        $result = mysqli_query($con, $query);
        $result2 = mysqli_query($con, $query2);
        if (!$result || !$result2) {
            echo "Unable to delete Volunteer! <br/><a href='index.php'>Back to Home page</a>";
        } else {
            header("Location: ../UserProfile.php");  // Redirect to logout page after deletion
        }
    } catch (Exception $e) {
        echo "<a href='index.php'>Back to Home page</a>";
    }
}
