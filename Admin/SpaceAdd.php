<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Spaces</title>
    <link rel="icon" type="image/png" href="../images/image-removebg-preview (22).png" />
</head>

<body>
    <?php require_once("Config.php"); ?>
    <h1>Add Spaces</h1>
    <?php
    $Name = "";
    $NameError = "";
    $Location = "";
    $LocationError = "";
    $Description = "";
    $DescriptionError = "";
    $ImageError = "";

    if (isset($_POST["btnSave"])) {
        // the user clicks save
        // check validation:
        $Name = $_POST["txtName"];
        $Location = $_POST["txtLocation"];
        $Description = $_POST["txtDescription"];
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
        } elseif ($_FILES["fileImage"]["error"] != 4) {
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
            // insert to spaces
            $query  = "INSERT INTO spaces (Name, Description, Location) 
                            VALUES ('$Name', '$Description', '$Location')";
            $result = mysqli_query($con, $query);
            $spaceId = mysqli_insert_id($con); // Get the last inserted ID

            if ($result) {
                // insert to mediaimage
                $query1  = "INSERT INTO mediaimage (Image, SId) 
                                VALUES ('$Image', '$spaceId')";
                $result1 = mysqli_query($con, $query1);

                if ($result1) {
                    header("Location: Space.php"); // return to list page
                    exit;
                } else {
                    echo "Error inserting image: " . mysqli_error($con);
                }
            } else {
                echo "Error inserting space: " . mysqli_error($con);
            }
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