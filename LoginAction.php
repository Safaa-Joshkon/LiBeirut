<?php
require("Config.php");

// Prepare the SQL statement with placeholders
//echo "SELECT * FROM users WHERE Username like '" . $_POST["Username"] . "'";
//die();
$stmt = mysqli_prepare($con, "SELECT * FROM users WHERE Username like'" . $_POST["Username"] . "'");


// Execute the prepared statement
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    // Log the error and display a generic message
    error_log("Error in login query: " . mysqli_error($con));
    $_SESSION["ERROR"] = "Login failed. Please try again.";
    header("Location: Login.php");
    exit();
}

if (mysqli_num_rows($result) == 0) {
    $_SESSION["ERROR"] = "Invalid username";
    header("Location: Login.php");
    exit();
}

// Username exists => continue to check password
$row = mysqli_fetch_array($result);
// echo "pass: " . $row["Password"] . "<br>";
// echo "Username: " . $row["Username"] . "<br>";
$username = $row["Username"];

// die();

// Verify password using a secure hashing algorithm
if (password_verify($_POST["Pass"], $row["Password"])) {
    session_start();

    // Password matches, set session variables and redirect
    if ($row["RoleId"] == 1) {
        // Login as Admin
        $_SESSION["LoggedIN_Admin"] = 1;
        $_SESSION["LoggedIN_As"] = 1;
        $_SESSION["Username"] = $username;
        $_SESSION["UserId"] = $row["Id"];
        header("Location: Admin/index.php");
    } else if ($row["RoleId"] == 2) {
        // Login as NGO
        $_SESSION["LoggedIN_NGO"] = 1;
        $_SESSION["LoggedIN_As"] = 2;

        $_SESSION["Username"] = $username;
        $_SESSION["UserId"] = $row["Id"];
        header("Location: NGO/index.php");
    } else if ($row["RoleId"] == 3) {
        //Login as Volunteer
        $_SESSION["LoggedIN_Volunteer"] = 1;
        $_SESSION["LoggedIN_As"] = 3;

        $_SESSION["Username"] = $username;
        $_SESSION["UserId"] = $row["Id"];
        header("Location: Volunteer/index.php");
    } else {
        // Login as General user
        $_SESSION["LoggedIN"] = 1;
        $_SESSION["LoggedIN_As"] = 4;

        $_SESSION["Username"] = $username;
        $_SESSION["UserId"] = $row["Id"];
        header("Location: UserProfile.php");
    }
} else {
    // Password doesn't match, redirect with error message
    $_SESSION["ERROR"] = "Invalid Password";
    header("Location: Login.php");
}

// Close the prepared statement
mysqli_stmt_close($stmt);
