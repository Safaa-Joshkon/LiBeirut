<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta Title="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit spaces</title>
    <link rel="icon" type="image/png" href="../images/image-removebg-preview (22).png" />
</head>

<body>
    <?php require_once("Config.php"); ?>
    <div class="container">
        <h1>Edit spaces</h1>
        <?php
        $Name = "";
        $NameError = "";
        $Location = "";
        $LocationError = "";
        $Description = "";
        $DescriptionError = "";
        $Image = "";
        $ImageError = "";

        $idToEdit = base64_decode($_GET["q"]);
        $query = "SELECT M.MediaId, M.Image, S.spaceId, S.Name, S.Location, S.Description FROM mediaImage M 
        INNER JOIN spaces S ON M.SId=S.spaceId WHERE spaceId = $idToEdit";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
            $Name = $row["Name"];
            $Location = $row["Location"];
            $Description = $row["Description"];
        }

        if (isset($_POST["btnSave"])) {
            // the user clicks save
            // check validation:
            $Name = $_POST["txtName"];
            $Location = $_POST["txtLocation"];
            $Description = $_POST["txtDescription"];
            $Image = $_POST["fileImage"];
            $isValid = true;
            // check textbox Name
            if ($Name == "") {
                $NameError = "Enter a valid Name";
                $isValid = false;
            } else
                $NameError = "";

            // check file Image
            if ($_FILES["fileImage"]["error"] == 0) {
                $Image = $_FILES["fileImage"]["name"];
                move_uploaded_file($_FILES["fileImage"]["tmp_name"], "../uploads/" . $Image);
            } elseif ($_FILES["fileImage"]["error"] == 4) {
                // No file uploaded, keep the current Logo
            } else {
                $ImageError = "Error uploading Image";
                $isValid = false;
            }

            // check textbox Location
            if ($Location == "") {
                $LocationError = "Enter a valid Location";
                $isValid = false;
            } else
                $LocationError = "";
            // check textbox Description
            if ($Description == "") {
                $DescriptionError = "Enter a valid Description";
                $isValid = false;
            } else
                $DescriptionError = "";

            if ($isValid) {
                //Update table mediaimage
                $query1 = "UPDATE mediaimage SET Image = '$Image', SId = '$idToEdit' WHERE SId = $idToEdit";

                $result1 = mysqli_query($con, $query1);
                //Update table spaces
                $Description = mysqli_real_escape_string($con, $_POST["txtDescription"]);
                $query = "UPDATE spaces SET Name = '$Name', Description = '$Description', Location = '$Location' WHERE spaceId = $idToEdit";

                $result = mysqli_query($con, $query);
                header("Location: Space.php"); // return to list page
            }
        }

        ?>
        <form method="post" action="" enctype="multipart/form-data">
            Space Name <input type="text" name="txtName" value="<?php echo $Name; ?>" />
            <label style="color:red"><?php echo $NameError; ?></label> <br />

            Space Description <textarea name="txtDescription"><?php echo $Description; ?></textarea>
            <label style="color:red"><?php echo $DescriptionError; ?></label> <br />

            Space Image <input type="file" name="fileImage" />
            <label style="color:red"><?php echo $ImageError; ?></label> <br />

            Space Location <input type="text" name="txtLocation" value="<?php echo $Location; ?>" />
            <label style="color:red"><?php echo $LocationError; ?></label> <br />

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