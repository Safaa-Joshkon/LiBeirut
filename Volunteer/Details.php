<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="icon" type="image/png" href="../images/image-removebg-preview (22).png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/script.js" language="javascript"></script>
</head>

<body>
    <?php
    require("Config.php");
    include("header.php");
    // Include header after checking for "x" parameter
    if (isset($_POST["event_id"])) {
        $EventId = base64_decode($_POST["event_id"]);
    } else if (isset($_GET["x"])) {
        $EventId = base64_decode($_GET["x"]);
    } else {
        // Handle the case when "x" is not set
        exit("Event not found");
    }
    $query = "SELECT * FROM organizeevent O
    INNER JOIN ngo N ON O.NGOId = N.NGOId
    INNER JOIN events E ON O.EventId = E.EventId
    WHERE O.EventId= '$EventId'";
    $result = mysqli_query($con, $query);
    $current_date = date("Y-m-d");
    while ($row = mysqli_fetch_array($result)) {
        $ngoId = $row["NGOId"];
        $imagePath = '../images/' . $row["Poster"];
        if (!file_exists($imagePath)) {
            $imagePath = '../uploads/' . $row["Poster"];
        }
        echo '<div class="row" style="max-width:100%">';
        echo '<div class="col-4">';
        echo '<img src="' . $imagePath . '" class="card-img-top" alt="Event Poster" style="width: 420px; height: 550px; margin-left:50px; margin-top: 20px; padding-left: 20px;">';
        echo '</div>';
        echo '<div class="col-8" style="margin-top: 20px;">';
        echo '<h4 class="card-title" style="color: #991a1a;"><b>' . $row["Title"] . '</b></h4><br>';
        echo '<div><span>';
        echo '<h5><b><i class="fa fa-calendar-o" aria-hidden="true"></i> Date:</b></h5>';
        echo '</span>';
        echo '<p>' . (($row["Date"] < $current_date) ? $row["Date"] . '<span style="color: red;"> Expired!</span>' : $row["Date"]) . '</p>';
        echo '</div>';
        echo '<div><span>';
        echo '<h5><b><i class="fa fa-clock-o" aria-hidden="true"></i> Time:</b></h5>';
        echo '</span>';
        echo '<p>' . date("h:i a", strtotime($row["Time"])) . '</p>';
        echo '</div>';
        echo '<div><span>';
        echo '<h5><b><i class="fa fa-map-marker" aria-hidden="true"></i> Location:</b></h5>';
        echo '</span>';
        echo '<p>' . $row["Location"] . '</p>';
        echo '</div>';
        echo '<div><span>';
        echo '<h5><b><i class="fa fa-home" aria-hidden="true"></i> Organizer:</b></h5>';
        echo '</span>';
        echo '<p>' . $row["Name"] . '</p>';
        echo '</div>';
        echo '<div><span>';
        echo '<h5><b>Description: </b></h5>';
        echo '</span>';
        echo '<p>' . $row["Description"] . '</p>';
        echo '</div>';
        echo '<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#volunteerModal">';
        echo 'Volunteer Now';
        echo '</button>';
        echo '</div>';
        echo '</div><br>';
        if ($row["Date"] >= $current_date) {
            echo '<div class="modal fade" id="volunteerModal" tabindex="-1" aria-labelledby="volunteerModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content" style="background-color: #f7f9fa">';
            echo '<div class="modal-header" style="border-bottom: 1px solid #e2e2e2">';
            echo '<h5 class="modal-title" id="volunteerModalLabel" style="font-size: 18px; font-weight: 500">Volunteer Options</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
            echo '<input type="hidden" name="event_id" value="' . $_GET["x"] . '">';
            echo '<div class="form-check mb-3">';
            echo '<input class="form-check-input" type="radio" name="volunteerType" id="specificEvent" value="specificEvent">';
            echo '<label class="form-check-label" for="specificEvent">';
            echo '<i class="fa fa-calendar-o" aria-hidden="true"></i> ' . $row["Title"] . '</label>';
            echo '</div>';
            echo '<div class="form-check">';
            echo '<input class="form-check-input" type="radio" name="volunteerType" id="organizingNGO" value="organizingNGO">';
            echo '<label class="form-check-label" for="organizingNGO">';
            echo '<i class="fa fa-home" aria-hidden="true"></i> ' . $row["Name"] . '</label>';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary mt-3" id="applyVolunteer">Apply</button></form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        if ($row["Date"] <= $current_date) {
            echo '<div class="modal fade" id="volunteerModal" tabindex="-1" aria-labelledby="volunteerModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog modal-dialog-centered">';
            echo '<div class="modal-content" style="background-color: #f7f9fa">';
            echo '<div class="modal-header" style="border-bottom: 1px solid #e2e2e2">';
            echo '<h5 class="modal-title" id="volunteerModalLabel" style="font-size: 18px; font-weight: 500">Volunteer Options</h5>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';
            echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
            echo '<input type="hidden" name="event_id" value="' . $_GET["x"] . '">';
            echo '<div class="form-check">';
            echo '<input class="form-check-input" type="radio" name="volunteerType" id="organizingNGO" value="organizingNGO">';
            echo '<label class="form-check-label" for="organizingNGO">';
            echo '<i class="fa fa-home" aria-hidden="true"></i> ' . $row["Name"] . '</label>';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary mt-3" id="applyVolunteer">Apply</button></form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $volunteerType = $_POST["volunteerType"];
        $volunteerName = $_SESSION['Username'];
        // Retrieve volunteer ID with prepared statement
        $stmt = mysqli_prepare($con, "SELECT VolunteerId FROM volunteer WHERE Name = ?");
        mysqli_stmt_bind_param($stmt, "s", $volunteerName);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $volunteerId = $row["VolunteerId"];
            if ($volunteerType == "specificEvent") {
                $query = "INSERT INTO eventvolunteer (VolunteerId, EventId, Response) VALUES ($volunteerId, $EventId, 'Pending')";
            } else {
                // Retrieve NGOId
                $query = "SELECT NGOId FROM organizeevent WHERE EventId = $EventId";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                $NGOId = $row["NGOId"];
                $query = "INSERT INTO ngovolunteer (VolunteerId, NGOId, Response) VALUES ($volunteerId, $NGOId, 'Pending')";
            }
            $result = mysqli_query($con, $query);
            if (!$result) {
                echo "Error: " . mysqli_error($con);
            } else {
                echo 'Request Sent Successfully!';
            }
        } else {
            echo "Volunteer not found in the database.";
        }
        mysqli_stmt_close($stmt);
    }
    ?>
    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>

</html>