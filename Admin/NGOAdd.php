<?php
require_once("Config.php");

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

if (isset($_POST["btnSave"])) {
    $Name = $_POST["txtName"];
    $About = $_POST["txtAbout"];
    $Email = $_POST["txtEmail"];
    $Address = $_POST["txtAddress"];
    $PhoneNumber = $_POST["txtPhoneNumber"];
    $SocialMedia = $_POST["txtSocialMedia"];
    $Password = $_POST["txtPassword"];
    $isValid = true;

    if ($Name == "") {
        $NameError = "Enter a valid Name";
        $isValid = false;
    } else
        $NameError = "";

    if ($_FILES["fileLogo"]["error"] == 0) {
        $Logo = $_FILES["fileLogo"]["name"];
        move_uploaded_file($_FILES["fileLogo"]["tmp_name"], "../uploads/" . $Logo);
    } elseif ($_FILES["fileLogo"]["error"] == 4) {
        // No file uploaded, keep the current Logo
    } else {
        $LogoError = "Error uploading Logo";
        $isValid = false;
    }

    if ($About == "") {
        $AboutError = "Enter a valid About";
        $isValid = false;
    } else
        $AboutError = "";

    if ($Email == "") {
        $EmailError = "Enter a valid Email";
        $isValid = false;
    } else
        $LocationError = "";

    if ($Address == "") {
        $AddressError = "Enter a valid Address";
        $isValid = false;
    } else
        $AddressError = "";

    if ($PhoneNumber == "") {
        $PhoneNumberError = "Enter a valid Phone Number";
        $isValid = false;
    } else
        $PhoneNumberError = "";

    if ($SocialMedia == "") {
        $SocialMediaError = "Enter a valid Social Media Links";
        $isValid = false;
    } else
        $PhoneNumberError = "";

    if ($Password == "") {
        $PasswordError = "Enter a valid password";
        $isValid = false;
    } else
        $PasswordError = "";

    if ($isValid) {
        // Hash the password
        $hashedPassword = password_hash($Password, PASSWORD_BCRYPT);

        // Insert the NGO into the ngo table
        $query = "INSERT INTO ngo (Logo, Name, About, Email, Address, PhoneNumber, SocialMediaLinks) 
                  VALUES ('$Logo', '$Name', '$About', '$Email', '$Address', '$PhoneNumber', '$SocialMedia')";
        $result = mysqli_query($con, $query);

        // Get the NGO's ID
        $ngoId = mysqli_insert_id($con);

        // Insert the NGO into the users table
        $insertUserQuery = "INSERT INTO users (Username, Password, RoleId) 
                            VALUES ('$Name', '$hashedPassword', 2)";
        $insertUserResult = mysqli_query($con, $insertUserQuery);

        if (!$result || !$insertUserResult) {
            $_SESSION["ERROR_NGO"] = "Error adding NGO";
        } else {
            $_SESSION["SUCCESS_NGO"] = "NGO added successfully";
        }
        header("Location: NGO.php"); // return to list page
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add NGO</title>
    <link rel="icon" type="image/png" href="../images/image-removebg-preview (22).png" />
</head>

<body>
    <h1>Add NGO</h1>
    <?php
    if (isset($_SESSION["ERROR_NGO"])) {
        echo '<div style="color:red">' . $_SESSION["ERROR_NGO"] . '</div>';
        unset($_SESSION["ERROR_NGO"]);
    }
    if (isset($_SESSION["SUCCESS_NGO"])) {
        echo '<div style="color:green">' . $_SESSION["SUCCESS_NGO"] . '</div>';
        unset($_SESSION["SUCCESS_NGO"]);
    }
    ?>
    <form method="post" action="" enctype="multipart/form-data">
        NGO Name <input type="text" name="txtName" value="<?php echo $Name; ?>" />
        <label style="color:red"><?php echo $NameError; ?></label> <br />

        NGO About <textarea name="txtAbout"><?php echo $About; ?></textarea>
        <label style="color:red"><?php echo $AboutError; ?></label> <br />

        NGO Logo <input type="file" name="fileLogo" />
        <label style="color:red"><?php echo $LogoError; ?></label> <br />

        NGO Email <br><input type="email" name="txtEmail" value="<?php echo $Email; ?>" />
        <label style="color:red"><?php echo $EmailError; ?></label> <br />

        NGO Address <input type="text" name="txtAddress" value="<?php echo $Address; ?>" />
        <label style="color:red"><?php echo $AddressError; ?></label> <br />

        NGO Phone Number <input type="text" name="txtPhoneNumber" value="<?php echo $PhoneNumber; ?>" />
        <label style="color:red"><?php echo $PhoneNumberError; ?></label> <br />

        NGO Social Media Links <input type="text" name="txtSocialMedia" value="<?php echo $SocialMedia; ?>" />
        <label style="color:red"><?php echo $SocialMediaError; ?></label> <br />

        NGO Password <input type="password" name="txtPassword" value="<?php echo $Password; ?>" />
        <label style="color:red"><?php echo $PasswordError; ?></label> <br />
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