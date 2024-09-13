<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Volunteer</title>
    <link rel="icon" type="image/png" href="../images/image-removebg-preview (22).png" />
</head>

<body>
    <?php require_once("Config.php"); ?>
    <h1>Add Volunteer</h1>
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

    if (isset($_POST["btnSave"])) {
        // the user clicks save
        // check validation:
        // check validation:
        $Name = $_POST["txtName"];
        $Email = $_POST["txtEmail"];
        $Gender = $_POST["txtGender"];
        $Address = $_POST["txtAddress"];
        $PhoneNumber = $_POST["txtPhoneNumber"];
        $isValid = true;
        // check textbox Name
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
        $Password = $_POST["txtPassword"]; // Retrieve the password from the form input

        if ($Password == "") {
            $PasswordError = "Enter a valid password";
            $isValid = false;
        } else {
            $PasswordError = "";
            $hashedPassword = password_hash($Password, PASSWORD_DEFAULT); // Hash the password
        }

        if ($isValid) {
            // insert to sql
            $query  = "INSERT INTO volunteer (Name, Profile, Email, Gender, Address, PhoneNumber) 
                            VALUES  ('" . mysqli_real_escape_string($con, $Name) . "', 
                                    '" . mysqli_real_escape_string($con, $Profile) . "', 
                                    '" . mysqli_real_escape_string($con, $Email) . "', 
                                    '" . mysqli_real_escape_string($con, $Gender) . "', 
                                    '" . mysqli_real_escape_string($con, $Address) . "', 
                                    '" . mysqli_real_escape_string($con, $PhoneNumber) . "')";
            $result = mysqli_query($con, $query);

            // Get the volunteer ID of the newly inserted volunteer
            $volunteerId = mysqli_insert_id($con);

            // Check if volunteering for an event
            if ($_POST["volunteerFor"] == "Event") {
                $eventTitle = $_POST["eventTitle"];
                // Get the EventId based on the selected event title
                $query = "SELECT EventId FROM events WHERE Title = '$eventTitle'";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                $eventId = $row["EventId"];

                // Insert the volunteer's selection into the eventvolunteer table
                $query = "INSERT INTO eventvolunteer (VolunteerId, EventId) 
                        VALUES ('$volunteerId', '$eventId')";
                mysqli_query($con, $query);
            } elseif ($_POST["volunteerFor"] == "NGO") {
                $ngoName = $_POST["ngoName"];
                // Get the NGOId based on the selected NGO name
                $query = "SELECT NGOId FROM ngo WHERE Name = '$ngoName'";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                $ngoId = $row["NGOId"];

                // Insert the volunteer's selection into the ngovolunteer table
                $query = "INSERT INTO ngovolunteer (VolunteerId, NGOId) 
                        VALUES ('$volunteerId', '$ngoId')";
                mysqli_query($con, $query);
            }

            // Insert the volunteer into the users table
            $insertUserQuery = "INSERT INTO users (Username, Password, RoleId) 
    VALUES ('$Name', '$hashedPassword', 3)";
            $insertUserResult = mysqli_query($con, $insertUserQuery);

            if (!$result || !$insertUserResult) {
                $_SESSION["ERROR_Volunteer"] = "Error adding Volunteer";
            } else {
                $_SESSION["SUCCESS_Volunteer"] = "Volunteer added successfully";
            }
            header("Location: Volunteers.php"); // return to list page

        }
    }
    ?>
    <form method="post" action="" enctype="multipart/form-data">
        Volunteer Name <input type="text" name="txtName" value="<?php echo $Name; ?>" />
        <label style="color:red"><?php echo $NameError; ?></label> <br />

        Volunteer Profile <input type="file" name="fileProfile" value="<?php echo $Profile; ?>" />
        <label style="color:red"><?php echo $ProfileError; ?></label> <br />

        Volunteer Email <input type="email" name="txtEmail" value="<?php echo $Email; ?>" />
        <label style="color:red"><?php echo $EmailError; ?></label> <br />

        Gender:
        <input type="radio" name="txtGender" value="Male" <?php if (isset($Gender) && $Gender == "Male") echo "checked"; ?>> Male
        <input type="radio" name="txtGender" value="Female" <?php if (isset($Gender) && $Gender == "Female") echo "checked"; ?>> Female
        <br /><br>

        Volunteer Address <input type="text" name="txtAddress" value="<?php echo $Address; ?>" />
        <label style="color:red"><?php echo $AddressError; ?></label> <br />

        Volunteer Phone Number <input type="text" name="txtPhoneNumber" value="<?php echo $PhoneNumber; ?>" />
        <label style="color:red"><?php echo $PhoneNumberError; ?></label> <br />
        <input type="radio" name="volunteerFor" value="Event" id="eventRadio"> Volunteer for Event
        <select name="eventTitle" id="eventTitleSelect" style="display:none;">
            <?php
            $ngoName = $_SESSION['Username'];
            // Get the NGO ID based on the NGO name
            $query = "SELECT NGOId FROM ngo WHERE Name = '$ngoName'";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $ngoId = $row['NGOId'];

            // Retrieve event titles from the database and populate the select options
            $query = "SELECT E.Title FROM organizeevent O
            INNER JOIN events E on E.EventId = O.EventId
            WHERE O.NGOId = '$ngoId'";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['Title']}'>{$row['Title']}</option>";
            }
            ?>
        </select>


        <input type="radio" name="volunteerFor" value="NGO" id="ngoRadio"> Volunteer for NGO
        <select name="ngoName" id="ngoNameSelect" style="display:none;">
            <?php
            echo "<option value='{$_SESSION['Username']}'>{$_SESSION['Username']}</option>";
            ?>
        </select><br><br>
        Volunteer Password <input type="password" name="txtPassword" value="<?php echo $Password; ?>" />
        <label style="color:red"><?php echo $PasswordError; ?></label> <br />
        <br>

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

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
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
            display: block;
            margin-bottom: 5px;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #007bff;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #0056b3;
        }
    </style>
</body>

</html>