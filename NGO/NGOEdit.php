<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta Title="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit NGO</title>
    <link rel="icon" type="image/png" href="../images/image-removebg-preview (22).png" />
</head>

<body>
    <?php require_once("Config.php"); ?>
    <div class="container">
        <h1>Edit NGO</h1>
        <?php
        $Name = "";
        $NameError = "";
        $Logo = "";
        $LogoError = "";
        $About = "";
        $AboutError = "";
        $Email = "";
        $EmailError = "";
        $Address = "";
        $AddressError = "";
        $PhoneNumber = "";
        $PhoneNumberError = "";
        $SocialMedia = "";
        $SocialMediaError = "";
        $Password = "";
        $PasswordError = "";

        $idToEdit = base64_decode($_GET["q"]);
        // Prepare the SQL statement with a placeholder
        $stmt = mysqli_prepare($con, "SELECT * FROM ngo WHERE NGOId = ?");
        mysqli_stmt_bind_param($stmt, "i", $idToEdit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Fetch the NGO information
        while ($row = mysqli_fetch_array($result)) {
            // Populate your variables here
            $Name = $row["Name"];
            $About = $row["About"];
            $Logo = $row["Logo"];
            $Email = $row["Email"];
            $Address = $row["Address"];
            $PhoneNumber = $row["PhoneNumber"];
            $SocialMedia = $row["SocialMediaLinks"];
        }


        if (isset($_POST["btnSave"])) {
            // the user clicks save
            // check validation:
            $Name = $_POST["txtName"];
            $About = $_POST["txtAbout"];
            $Email = $_POST["txtEmail"];
            $Address = $_POST["txtAddress"];
            $PhoneNumber = $_POST["txtPhoneNumber"];
            $SocialMedia = $_POST["txtSocialMedia"];
            $isValid = true;
            // check textbox Name
            if ($Name == "") {
                $NameError = "Enter a valid Name";
                $isValid = false;
            } else
                $NameError = "";
            // check file Logo
            if ($_FILES["fileLogo"]["error"] == 0) {
                $Logo = $_FILES["fileLogo"]["name"];
                move_uploaded_file($_FILES["fileLogo"]["tmp_name"], "../uploads/" . $Logo);
            } elseif ($_FILES["fileLogo"]["error"] == 4) {
                // No file uploaded, keep the current Logo
            } else {
                $LogoError = "Error uploading Logo";
                $isValid = false;
            }

            // check textbox About
            if ($About == "") {
                $AboutError = "Enter a valid About";
                $isValid = false;
            } else
                $AboutError = "";
            // check textbox Location
            if ($Email == "") {
                $EmailError = "Enter a valid Email";
                $isValid = false;
            } else
                $LocationError = "";
            // check textbox Address
            if ($Address == "") {
                $AddressError = "Enter a valid Address";
                $isValid = false;
            } else
                $AddressError = "";
            // check textbox PhoneNumber
            if ($PhoneNumber == "") {
                $PhoneNumberError = "Enter a valid Phone Number";
                $isValid = false;
            } else
                $PhoneNumberError = "";
            //check textbox SocialMedia
            if ($SocialMedia == "") {
                $SocialMediaError = "Enter a valid Social Media Links";
                $isValid = false;
            } else
                $PhoneNumberError = "";

            $Password = $_POST["txtPassword"]; // Retrieve the password from the form input

            if ($Password == "") {
                $PasswordError = "Enter a valid password";
                $isValid = false;
            } else {
                $PasswordError = "";
                $hashedPassword = password_hash($Password, PASSWORD_BCRYPT);
            }

            if ($isValid) {
                $escapedAbout = mysqli_real_escape_string($con, $About);

                $query = "UPDATE ngo SET Name = '$Name', Logo = '$Logo', About = '$escapedAbout', Email = '$Email', Address = '$Address', PhoneNumber = '$PhoneNumber', SocialMediaLinks = '$SocialMedia' WHERE NGOId = $idToEdit";
                $result = mysqli_query($con, $query);

                // Update the password in the users table
                $updatePasswordQuery = "UPDATE users SET Password = '$hashedPassword' WHERE Username = '$Name'";
                $updateResult = mysqli_query($con, $updatePasswordQuery);

                header("Location: index.php"); // return to list page
            }
        }

        ?>
        <form method="post" action="" enctype="multipart/form-data">
            NGO Name <input type="text" name="txtName" value="<?php echo $Name; ?>" />
            <label style="color:red"><?php echo $NameError; ?></label> <br />

            NGO About <textarea name="txtAbout"><?php echo $About; ?></textarea>
            <label style="color:red"><?php echo $AboutError; ?></label> <br />

            NGO Logo <input type="file" name="fileLogo" />
            <label style="color:red"><?php echo $LogoError; ?></label> <br />

            NGO Email <input type="email" name="txtEmail" value="<?php echo $Email; ?>" />
            <label style="color:red"><?php echo $EmailError; ?></label> <br />

            NGO Address <input type="text" name="txtAddress" value="<?php echo $Address; ?>" />
            <label style="color:red"><?php echo $AddressError; ?></label> <br />

            NGO Phone Number <input type="text" name="txtPhoneNumber" value="<?php echo $PhoneNumber; ?>" />
            <label style="color:red"><?php echo $PhoneNumberError; ?></label> <br />

            NGO Social Media Links <input type="text" name="txtSocialMedia" value="<?php echo $SocialMedia; ?>" />
            <label style="color:red"><?php echo $SocialMediaError; ?></label> <br />

            Change Password <input type="password" name="txtPassword" />
            <label style="color:red"><?php echo $PasswordError; ?></label> <br />

            <br />
            <input type="Submit" name="btnSave" value="Save" />
            <input type="Reset" value="Clear" />
        </form>
    </div>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="Address"],
        input[type="PhoneNumber"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-top: 10px;
        }

        label {
            color: red;
            display: block;
            margin-bottom: 5px;
        }

        input[type="submit"],
        input[type="reset"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #0056b3;
        }
    </style>
</body>

</html>