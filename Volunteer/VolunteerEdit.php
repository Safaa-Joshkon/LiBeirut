<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta Title="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Volunteer</title>
    <link rel="icon" type="image/png" href="../images/image-removebg-preview (22).png" />
</head>

<body>
    <?php require_once("Config.php"); ?>
    <div class="container">
        <h1>Edit Volunteer</h1>
        <?php
        $Name = "";
        $NameError = "";
        $Profile = "";
        $ProfileError = "";
        $Email = "";
        $EmailError = "";
        $Gender = "";
        $GenderError = "";
        $Address = "";
        $AddressError = "";
        $PhoneNumber = "";
        $PhoneNumberError = "";
        $Password = "";
        $PasswordError = "";

        $username = $_SESSION['Username'];
        $query = "SELECT VolunteerId FROM volunteer WHERE Name = '$username'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        $idToEdit = $row['VolunteerId'];

        $query = "SELECT * FROM Volunteer WHERE VolunteerId = $idToEdit";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
            $Name = $row["Name"];
            $Profile = $row["Profile"];
            $Email = $row["Email"];
            $Gender = $row["Gender"];
            $Address = $row["Address"];
            $PhoneNumber = $row["PhoneNumber"];
        }

        if (isset($_POST["btnSave"])) {
            // the user clicks save
            // check validation:
            $Name = $_POST["txtName"];
            $Email = $_POST["txtEmail"];
            $Gender = $_POST["txtGender"];
            $Address = $_POST["txtAddress"];
            $PhoneNumber = $_POST["txtPhoneNumber"];
            $Password = $_POST["txtPassword"];
            $isValid = true;
            // check textbox Name
            if ($Name == "") {
                $NameError = "Enter a valid Name";
                $isValid = false;
            } else
                $NameError = "";

            // check textbox Profile
            if ($_FILES["fileProfile"]["error"] == 0) {
                $Profile = $_FILES["fileProfile"]["name"];
                move_uploaded_file($_FILES["fileProfile"]["tmp_name"], "../uploads/" . $Profile);
            } elseif ($_FILES["fileProfile"]["error"] == 4) {
                // No file uploaded, keep the current poster
            } else {
                $ProfileError = "Error uploading profile";
                $isValid = false;
            }

            // check textbox Email
            if ($Email == "") {
                $EmailError = "Enter a valid About";
                $isValid = false;
            } else
                $EmailError = "";

            //check textbox Gender
            if ($Gender == "") {
                $GenderError = "Enter a valid Gender";
                $isValid = false;
            } else
                $GenderError = "";

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
            if ($Password == "") {
                $PasswordError = "Enter a valid password";
                $isValid = false;
            } else {
                $PasswordError = "";
                $hashedPassword = password_hash($Password, PASSWORD_BCRYPT);
            }

            if ($isValid) {
                $stmt = mysqli_prepare($con, "UPDATE volunteer SET Name = ?, Profile = ?, Email = ?, Gender = ?, Address = ?, PhoneNumber = ? WHERE VolunteerId = ?");
                mysqli_stmt_bind_param($stmt, "sssssss", $Name, $Profile, $Email, $Gender, $Address, $PhoneNumber, $idToEdit);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                $stmt = mysqli_prepare($con, "UPDATE users SET Username = ?, Password = ? WHERE Username = ?");
                mysqli_stmt_bind_param($stmt, "sss", $Name, $hashedPassword, $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);


                // Redirect to the list page after saving
                header("Location: index.php");
            }
        }

        ?>
        <form method="post" action="" enctype="multipart/form-data">
            Volunteer Name <input type="text" name="txtName" value="<?php echo $Name; ?>" />
            <label style="color:red"><?php echo $NameError; ?></label> <br />

            Volunteer Profile <input type="file" name="fileProfile" value="<?php echo $Profile; ?>" />
            <label style="color:red"><?php echo $ProfileError; ?></label> <br />

            Volunteer Email <textarea name="txtEmail"><?php echo $Email; ?></textarea>
            <label style="color:red"><?php echo $EmailError; ?></label> <br />

            Gender:
            <input type="radio" name="txtGender" value="Male" <?php if (isset($Gender) && $Gender == "Male") echo "checked"; ?>> Male
            <input type="radio" name="txtGender" value="Female" <?php if (isset($Gender) && $Gender == "Female") echo "checked"; ?>> Female
            <br /><br>

            Volunteer Address <input type="text" name="txtAddress" value="<?php echo $Address; ?>" />
            <label style="color:red"><?php echo $AddressError; ?></label> <br />

            Volunteer Phone Number <input type="text" name="txtPhoneNumber" value="<?php echo $PhoneNumber; ?>" />
            <label style="color:red"><?php echo $PhoneNumberError; ?></label> <br />

            Change Password <input type="password" name="txtPassword" value="<?php echo $Password; ?>" />
            <label style="color:red"><?php echo $PasswordError; ?></label> <br />

            <input type="Submit" name="btnSave" value="Save" />
            <input type="Reset" value="Clear" />
        </form>

        <script>
            // Function to show/hide the select elements based on the radio button selection
            function toggleSelects() {
                var eventSelect = document.getElementById("eventTitleSelect");
                var ngoSelect = document.getElementById("ngoNameSelect");
                if (document.getElementById("eventRadio").checked) {
                    eventSelect.style.display = "block";
                    ngoSelect.style.display = "none";
                } else if (document.getElementById("ngoRadio").checked) {
                    ngoSelect.style.display = "block";
                    eventSelect.style.display = "none";
                } else {
                    eventSelect.style.display = "none";
                    ngoSelect.style.display = "none";
                }
            }

            // Call the function initially to set the correct display
            toggleSelects();

            // Add event listeners to the radio buttons to toggle the display of select elements
            document.getElementById("eventRadio").addEventListener("change", toggleSelects);
            document.getElementById("ngoRadio").addEventListener("change", toggleSelects);
        </script>
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