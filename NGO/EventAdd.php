<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <link rel="icon" type="image/png" href="../images/image-removebg-preview (22).png" />
</head>

<body>
    <?php require_once("Config.php"); ?>
    <h1>Add Event</h1>
    <?php
    $Title = "";
    $TitleError = "";
    $Description = "";
    $DescriptionError = "";
    $Location = "";
    $LocationError = "";
    $Date = "";
    $DateError = "";
    $Time = "";
    $TimeError = "";
    $Poster = "";
    $PosterError = "";

    if (isset($_POST["btnSave"])) {
        // the user clicks save
        // check validation:
        $Title = $_POST["txtTitle"];
        $Description = $_POST["txtDescription"];
        $Location = $_POST["txtLocation"];
        $Date = $_POST["txtDate"];
        $Time = $_POST["txtTime"];
        $Poster = $_FILES["filePoster"]["name"];
        $SpaceName = $_POST["space"];
        $isValid = true;
        // check textbox Title
        if ($Title == "") {
            $TitleError = "Enter a valid Title";
            $isValid = false;
        } else
            $TitleError = "";

        // check textbox Description
        if ($Description == "") {
            $DescriptionError = "Enter a valid Description";
            $isValid = false;
        } else
            $DescriptionError = "";

        // check textbox Location
        if ($Location == "") {
            $LocationError = "Enter a valid Location";
            $isValid = false;
        } else
            $LocationError = "";

        // check textbox Date
        if ($Date == "") {
            $DateError = "Enter a valid Date";
            $isValid = false;
        } else
            $DateError = "";

        // check textbox Time
        if ($Time == "") {
            $TimeError = "Enter a valid Time";
            $isValid = false;
        } else
            $TimeError = "";

        // check file Poster
        if ($_FILES["filePoster"]["error"] == 0) {
            $Poster = $_FILES["filePoster"]["name"];
            move_uploaded_file($_FILES["filePoster"]["tmp_name"], "../uploads/" . $Poster);
        } else {
            $PosterError = "Error uploading poster";
            $isValid = false;
        }

        if ($isValid) {
            // Get NGO ID
            $username = $_SESSION['Username'];
            $queryNGO = "SELECT NGOId FROM ngo WHERE Name = '$username'";
            $resultNGO = mysqli_query($con, $queryNGO);
            $rowNGO = mysqli_fetch_array($resultNGO);
            $NGOId = $rowNGO["NGOId"];
            // Get Space ID
            $querySpace = "SELECT spaceId FROM spaces WHERE Name = '$SpaceName'";
            $resultSpace = mysqli_query($con, $querySpace);
            $rowSpace = mysqli_fetch_array($resultSpace);
            $SId = $rowSpace["spaceId"];

            // insert to sql
            $query  = "INSERT INTO events (Poster, Title, Description, Location, Date, Time) 
                            VALUES ('" . mysqli_real_escape_string($con, $Poster) . "', 
                                    '" . mysqli_real_escape_string($con, $Title) . "', 
                                    '" . mysqli_real_escape_string($con, $Description) . "', 
                                    '" . mysqli_real_escape_string($con, $Location) . "', 
                                    '" . mysqli_real_escape_string($con, $Date) . "', 
                                    '" . mysqli_real_escape_string($con, $Time) . "')";

            $result = mysqli_query($con, $query);

            // Get the ID of the last inserted event
            $EventId = mysqli_insert_id($con);

            // Insert into organizeevent table
            $queryOrganize = "INSERT INTO organizeevent (NGOId, EventId, SId) 
                            VALUES ('$NGOId', '$EventId', '$SId')";
            $resultOrganize = mysqli_query($con, $queryOrganize);

            header("Location: index.php"); // return to list page
        }
    }
    ?>
    <form enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="txtTitle">Event Title</label>
        <input type="text" id="txtTitle" name="txtTitle" value="<?php echo $Title; ?>" />
        <label><?php echo $TitleError; ?></label> <br />

        <label for="txtDescription">Event Description</label>
        <textarea id="txtDescription" name="txtDescription"><?php echo $Description; ?></textarea>
        <label><?php echo $DescriptionError; ?></label> <br />

        <label for="txtLocation">Event Location</label>
        <input type="text" id="txtLocation" name="txtLocation" value="<?php echo $Location; ?>" />
        <label><?php echo $LocationError; ?></label> <br />

        <label for="txtDate">Event Date</label>
        <input type="date" id="txtDate" name="txtDate" value="<?php echo $Date; ?>" />
        <label><?php echo $DateError; ?></label> <br />

        <label for="txtTime">Event Time</label>
        <input type="time" id="txtTime" name="txtTime" value="<?php echo $Time; ?>" />
        <label><?php echo $TimeError; ?></label> <br />

        <label for="filePoster">Event Poster</label>
        <input type="file" id="filePoster" name="filePoster" />
        <label><?php echo $PosterError; ?></label> <br />

        <label for="space">Event Space</label>
        <select id="space" name="space">
            <?php
            $querySpace = "SELECT * FROM spaces";
            $resultSpace = mysqli_query($con, $querySpace);
            while ($rowSpace = mysqli_fetch_array($resultSpace)) {
                echo "<option value='" . $rowSpace["Name"] . "'>" . $rowSpace["Name"] . "</option>";
            }
            ?>
        </select>
        <br />

        <input type="Submit" name="btnSave" value="Save" />
        <input type="Reset" value="Clear" />
    </form>

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