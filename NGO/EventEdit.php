<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta Title="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="icon" type="image/png" href="../images/image-removebg-preview (22).png" />
</head>

<body>
    <?php require_once("Config.php"); ?>
    <div class="container">
        <h1>Edit Event</h1>
        <?php
        $Title = "";
        $TitleError = "";
        $Poster = "";
        $PosterError = "";
        $Description = "";
        $DescriptionError = "";
        $Location = "";
        $LocationError = "";
        $Date = "";
        $DateError = "";
        $Time = "";
        $TimeError = "";

        $idToEdit = base64_decode($_GET["q"]);
        $query = "SELECT * FROM events WHERE EventId = $idToEdit";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
            $Title = $row["Title"];
            $Description = $row["Description"];
            $Poster = $row["Poster"];
            $Location = $row["Location"];
            $Date = $row["Date"];
            $Time = $row["Time"];
        }

        if (isset($_POST["btnSave"])) {
            // the user clicks save
            // check validation:
            $Title = $_POST["txtTitle"];
            $Description = $_POST["txtDescription"];
            $Location = $_POST["txtLocation"];
            $Date = $_POST["txtDate"];
            $Time = $_POST["txtTime"];
            $ngo = $_POST["ngo"];
            $isValid = true;
            // check textbox Title
            if ($Title == "") {
                $TitleError = "Enter a valid Title";
                $isValid = false;
            } else
                $TitleError = "";
            // check file Poster
            if ($_FILES["filePoster"]["error"] == 0) {
                $Poster = $_FILES["filePoster"]["name"];
                move_uploaded_file($_FILES["filePoster"]["tmp_name"], "../uploads/" . $Poster);
            } elseif ($_FILES["filePoster"]["error"] == 4) {
                // No file uploaded, keep the current poster
            } else {
                $PosterError = "Error uploading poster";
                $isValid = false;
            }

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
            if ($isValid) {
                // Get NGO ID
                $username = $_SESSION['Username'];
                $queryNGO = "SELECT NGOId FROM ngo WHERE Name = '$username'";
                $resultNGO = mysqli_query($con, $queryNGO);
                $rowNGO = mysqli_fetch_array($resultNGO);
                $NGOId = $rowNGO["NGOId"];

                // Update organizeevent table
                $queryUpdateOrganize = "UPDATE organizeevent SET NGOId = '$NGOId' WHERE EventId = $idToEdit";
                $resultUpdateOrganize = mysqli_query($con, $queryUpdateOrganize);

                // Update events table
                $Title = mysqli_real_escape_string($con, $_POST["txtTitle"]);
                $Description = mysqli_real_escape_string($con, $_POST["txtDescription"]);
                $query = "UPDATE events SET Title = '$Title', Poster = '$Poster', Description = '$Description', Location = '$Location', Date = '$Date', Time = '$Time' WHERE EventId = $idToEdit";
                $result = mysqli_query($con, $query);
                header("Location: index.php"); // return to list page
            }
        }

        ?>
        <form method="post" action="" enctype="multipart/form-data">
            Event Title <input type="text" name="txtTitle" value="<?php echo $Title; ?>" />
            <label style="color:red"><?php echo $TitleError; ?></label> <br />

            Event Description <textarea name="txtDescription"><?php echo $Description; ?></textarea>
            <label style="color:red"><?php echo $DescriptionError; ?></label> <br />

            Event Poster <input type="file" name="filePoster" />
            <label style="color:red"><?php echo $PosterError; ?></label> <br />

            Event Location <input type="text" name="txtLocation" value="<?php echo $Location; ?>" />
            <label style="color:red"><?php echo $LocationError; ?></label> <br />

            Event Date <input type="date" name="txtDate" value="<?php echo $Date; ?>" />
            <label style="color:red"><?php echo $DateError; ?></label> <br />

            Event Time <input type="time" name="txtTime" value="<?php echo $Time; ?>" />
            <label style="color:red"><?php echo $TimeError; ?></label> <br />

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