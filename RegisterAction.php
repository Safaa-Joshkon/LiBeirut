<?php
session_start();
require("Config.php");

$name = mysqli_real_escape_string($con, $_POST["Username"]);
$email = mysqli_real_escape_string($con, $_POST["email"]);
$pass = mysqli_real_escape_string($con, $_POST["Pass"]);
$confirm = mysqli_real_escape_string($con, $_POST["Confirm"]);
$role = mysqli_real_escape_string($con, $_POST["role"]);

$query = "SELECT * FROM users WHERE Username = '" . $name . "'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    // username already exists
    $_SESSION["ERROR_Reg"] = "Username already exists";
    header("Location: Register.php");
} else {
    if ($pass != $confirm) {
        // password doesn't match
        $_SESSION["ERROR_Reg"] = "Your password doesn't match";
        header("Location: Register.php");
    } else {
        // Use a secure method for generating salt
        $salt = password_hash("", PASSWORD_BCRYPT); // Generate a random salt using BCRYPT algorithm

        // Hash the password with the generated salt
        $hashed_password = password_hash($pass, PASSWORD_BCRYPT, ["cost" => 12]); // Hash with BCRYPT and cost of 12

        // Determine RoleId based on the selected role
        $roleId = ($role == "NGO") ? 2 : 3;

        // Insert query for users table
        $insert_user_query = "INSERT INTO users(Username, Password, Salt, RoleId) 
                            VALUES('" . $name . "','" . $hashed_password . "','" . $salt . "','" . $roleId . "')";
        $insert_user_result = mysqli_query($con, $insert_user_query);

        if (!$insert_user_result) {
            // error inserting user
            $_SESSION["ERROR_Reg"] = "Error inserting user: " . mysqli_error($con);
            header("Location: Register.php");
        } else {
            // Get the user's ID from the users table
            $user_id = mysqli_insert_id($con);

            // Insert query for ngo or volunteer table based on role
            $insert_role_query = "";
            if ($role == "NGO") {
                $insert_role_query = "INSERT INTO ngo(Name, Email) 
                                    VALUES('" . $name . "','" . $email . "')";
            } elseif ($role == "volunteer") {
                $insert_role_query = "INSERT INTO volunteer(Name, Email) 
                                    VALUES('" . $name . "','" . $email . "')";
            }

            $insert_role_result = mysqli_query($con, $insert_role_query);

            if (!$insert_role_result) {
                // error inserting role
                $_SESSION["ERROR_Reg"] = "Error inserting user role: " . mysqli_error($con);
                header("Location: Register.php");
            } else {
                // user and role added successfully
                $_SESSION["SUCCESS_Reg"] = "User registered successfully";
                header("Location: Login.php");
            }
        }
    }
}
