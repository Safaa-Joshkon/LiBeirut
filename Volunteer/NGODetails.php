<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGO Details</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="icon" type="image/png" href="../images/image-removebg-preview (22).png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js" language="javascript"></script>
</head>

<body>
    <?php require("Config.php");
    include 'header.php'; ?>
    <?php
    if (isset($_POST["ngo_id"])) {
        $NGOId = base64_decode($_POST["ngo_id"]);
    } else if (isset($_GET["x"])) {
        $NGOId = base64_decode($_GET["x"]);
    } else {
        // Handle the case when "x" is not set
        exit("NGO not found");
    }
    $query = "SELECT * FROM ngo 
    WHERE NGOId= $NGOId";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
        echo '<div class="row" style="max-width:100%">';
        echo '<div class="col-4">';
        $imagePath = '../images/' . $row["Logo"];
        if (!file_exists($imagePath)) {
            $imagePath = '../uploads/' . $row["Logo"];
        }
        echo '<img src="' . $imagePath . '" class="card-img-top" alt="Event Poster" style="width: 420px; height: 550px; margin-left:50px; margin-top: 20px; padding-left: 20px;">';

        echo '</div>';
        echo '<div class="col-8" style="margin-top: 20px;">';

        echo '<div class="divider d-flex type">
        <h3 class="mx-3 mb-0 or">' . $row["Name"] . '</h3>';
        echo '</div>';
        echo '<div><span>';
        echo '<h5><b>About:</b></h5>';
        echo '</span>';

        echo '<p>' . $row["About"];
        echo '</div>';

        echo '<div><span>';
        echo '<h5><b><i class="fa fa-map-marker" aria-hidden="true"></i> Address:</b></h5>';
        echo '</span>';
        echo '<p>' . $row["Address"] . '</p>';
        echo ' </div>';

        echo '<div><span>';
        echo ' <h5><b><i class="fa fa-phone" aria-hidden="true"></i> Phone Number:</b></h5>';
        echo '</span>';
        echo '<p>' . $row["PhoneNumber"] . '</p>';
        echo '</div>';

        echo '<div><span>';
        echo ' <h5><b><i class="fa fa-envelope" aria-hidden="true"></i> Email:</b></h5>';
        echo '</span>';
        echo '<p>' . $row["Email"] . '</p>';
        echo '</div>';

        echo '<div class="mb-4 pb-2">';
        // Display social media links if available
        $socialMediaLinks = explode("\n", $row["SocialMediaLinks"]);
        foreach ($socialMediaLinks as $link) {
            list($platform, $url) = explode(":", $link, 2);
            echo '<a href="' . $url . '" target="_blank" class="social-media-link">';
            echo '<i class="fa fa-' . getSocialMediaIcon(trim($platform)) . ' fa-lg"></i>';
            echo '</a>';
        }
        echo '</div>';

        echo '<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#volunteerModal">';
        echo 'Volunteer Now';
        echo '</button>';
        echo '</div>';
        echo '</div><br>';

        echo '<div class="modal fade" id="volunteerModal" tabindex="-1" aria-labelledby="volunteerModalLabel" aria-hidden="true">';
        echo '<div class="modal-dialog modal-dialog-centered">';
        echo '<div class="modal-content" style="background-color: #f7f9fa">';
        echo '<div class="modal-header" style="border-bottom: 1px solid #e2e2e2">';
        echo '<h5 class="modal-title" id="volunteerModalLabel" style="font-size: 18px; font-weight: 500">Volunteer Options</h5>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '</div>';
        echo '<div class="modal-body">';
        echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
        echo '<input type="hidden" name="ngo_id" value="' . $_GET["x"] . '">';
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
    function getSocialMediaIcon($platform)
    {
        switch ($platform) {
            case 'Facebook':
                return 'facebook-f';
            case 'Instagram':
                return 'instagram';
            case 'Website':
                return 'globe';
            default:
                return '';
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $volunteerName = $_SESSION['Username'];
        // Retrieve volunteer ID with prepared statement
        $stmt = mysqli_prepare($con, "SELECT VolunteerId FROM volunteer WHERE Name = ?");
        mysqli_stmt_bind_param($stmt, "s", $volunteerName);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $volunteerId = $row["VolunteerId"];
            // Retrieve NGOId from the form input
            $NGOId = base64_decode($_POST["ngo_id"]);
            $query = "INSERT INTO ngovolunteer (VolunteerId, NGOId, Response) VALUES ($volunteerId, $NGOId, 'Pending')";
            $result = mysqli_query($con, $query);
            if (!$result) {
                echo "Error: " . mysqli_error($con);
            } else {
                echo '<p style="text-align:center">Request Sent Successfully!</p>';
            }
        } else {
            echo "Volunteer not found in the database.";
        }
        mysqli_stmt_close($stmt);
    }
    ?>
    <div class="container" id="result">
        <div class="row justify-content-center">
            <div id="result">
                <div class="divider d-flex type" id="upcoming">
                    <h3 class="mx-3 mb-0 or" id="upcoming">Upcoming Events</h3>
                </div>
                <br>
                <div id="event1Carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $current_date = date("Y-m-d");
                        $query = "SELECT * FROM organizeevent O
                        INNER JOIN ngo N ON O.NGOId = N.NGOId
                        INNER JOIN events E ON O.EventId = E.EventId
                        WHERE O.NGOId= $NGOId && E.Date >= '$current_date'";
                        $result = mysqli_query($con, $query);
                        $count = 0;
                        $active = 'active'; // Set the first item as active
                        while ($row = mysqli_fetch_array($result)) {
                            if ($count % 3 == 0) {
                                // Start a new carousel item for every 3 events
                                echo '<div class="carousel-item ' . $active . '">';
                                echo '<div class="row">';
                                $active = ''; // Remove active class after the first item
                            }
                            echo '<div class="col-md-4">';
                            echo '<div class="card" style="margin: 10px; border: 1px solid #ddd;">';
                            $imagePath = '../images/' . $row["Poster"];
                            if (!file_exists($imagePath)) {
                                $imagePath = '../uploads/' . $row["Poster"];
                            }
                            echo '<img src="' . $imagePath . '" class="card-img-top" alt="Event Poster" style="height: 390px;">';

                            echo '<div class="card-body" style="text-align: center; height:160px">';
                            echo '<h3 class="card-title" style="color: #991a1a;">' . $row["Title"] . '</h3>';
                            echo '<p class="card-text"><i class="fa fa-map-marker" aria-hidden="true"></i> ' . $row["Location"] . '</p>';
                            $id = $row["EventId"]; // Item Id
                            $id = base64_encode($id);
                            echo "<div class='check'><a class='btn btn-secondary' href='Details.php?x=$id'>More Details</a></div><br>";
                            echo '</div></div>';
                            echo '</div>';
                            $count++;
                            if ($count % 3 == 0) {
                                // Close the row and carousel item after every 3 events
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                        // Close the last row and carousel item if the total number of events is not a multiple of 3
                        if ($count % 3 != 0) {
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#event1Carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#event1Carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <br>

                <div class="divider d-flex type" id="previous">
                    <h3 class="mx-3 mb-0 or" id="previous">Previous Events</h3>
                </div>
                <br>
                <div id="event2Carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $current_date = date("Y-m-d");
                        $query = "SELECT * FROM organizeevent O
                        INNER JOIN ngo N ON O.NGOId = N.NGOId
                        INNER JOIN events E ON O.EventId = E.EventId
                        WHERE O.NGOId= $NGOId && E.Date <= '$current_date'";
                        $result = mysqli_query($con, $query);

                        $count = 0;
                        $active = 'active'; // Set the first item as active
                        while ($row = mysqli_fetch_array($result)) {
                            if ($count % 3 == 0) {
                                // Start a new carousel item for every 3 events
                                echo '<div class="carousel-item ' . $active . '">';
                                echo '<div class="row">';
                                $active = ''; // Remove active class after the first item
                            }
                            echo '<div class="col-md-4">';
                            echo '<div class="card" style="margin: 10px; border: 1px solid #ddd;">';
                            $imagePath = '../images/' . $row["Poster"];
                            if (!file_exists($imagePath)) {
                                $imagePath = '../uploads/' . $row["Poster"];
                            }
                            echo '<img src="' . $imagePath . '" class="card-img-top" alt="Event Poster" style="height: 390px;">';

                            echo '<div class="card-body" style="text-align: center; height:160px">';
                            echo '<h3 class="card-title" style="color: #991a1a;">' . $row["Title"] . '</h3>';
                            echo '<p class="card-text"><i class="fa fa-map-marker" aria-hidden="true"></i> ' . $row["Location"] . '</p>';
                            $id = $row["EventId"]; // Item Id
                            $id = base64_encode($id);
                            echo "<div class='check'><a class='btn btn-secondary' href='Details.php?x=$id'>More Details</a></div><br>";
                            echo '</div></div>';
                            echo '</div>';
                            $count++;
                            if ($count % 3 == 0) {
                                // Close the row and carousel item after every 3 events
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                        // Close the last row and carousel item if the total number of events is not a multiple of 3
                        if ($count % 3 != 0) {
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#event2Carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#event2Carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div><br>
    <style>
        /* Style for social media links container */
        .social-media-links {
            margin-top: 10px;
            /* Add top margin */
            text-align: center;
            /* Center links */
        }

        /* Style for social media links */
        .social-media-link {
            display: inline-block;
            /* Display links inline */
            margin: 0 5px;
            /* Add horizontal margin */
        }
    </style>
    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>

</html>