<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGO Details</title>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="icon" type="image/png" href="images/image-removebg-preview (22).png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js" language="javascript"></script>
</head>

<body>
    <?php require("Config.php");
    include 'navbar.php'; ?>
    <?php
    $NGOId = base64_decode($_GET["x"]);
    $query = "SELECT * FROM ngo 
    WHERE NGOId= $NGOId";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
        echo '<div class="row" style="max-width:100%">';
        echo '<div class="col-4">';
        $imagePath = 'images/' . $row["Logo"];
        if (!file_exists($imagePath)) {
            $imagePath = 'uploads/' . $row["Logo"];
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
        echo '<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#signInModal">Volunteer Now</button>';
        echo '</div>';
        echo '</div><br>';
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
    ?>
    <!-- Sign In Modal -->
    <div class="modal fade" id="signInModal" tabindex="-1" aria-labelledby="signInModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signInModalLabel">Sign In to Proceed</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Please sign in to volunteer or to view more details.</p>
                    <p>If you don't have an account, you can <a href="Register.php">Sign Up here</a>.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="Login.php" class="btn btn-primary">Sign In</a>
                </div>
            </div>
        </div>
    </div>

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
                            $imagePath = 'images/' . $row["Poster"];
                            if (!file_exists($imagePath)) {
                                $imagePath = 'uploads/' . $row["Poster"];
                            }
                            echo '<img src="' . $imagePath . '" class="card-img-top" alt="Event Poster" style="height: 390px;">';

                            echo '<div class="card-body" style="text-align: center; height:160px">';
                            echo '<h3 class="card-title" style="color: #991a1a;">' . $row["Title"] . '</h3>';
                            echo '<p class="card-text"><i class="fa fa-map-marker" aria-hidden="true"></i> ' . $row["Location"] . '</p>';
                            echo '<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#signInModal">More Details</button>';
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
                            $imagePath = 'images/' . $row["Poster"];
                            if (!file_exists($imagePath)) {
                                $imagePath = 'uploads/' . $row["Poster"];
                            }
                            echo '<img src="' . $imagePath . '" class="card-img-top" alt="Event Poster" style="height: 390px;">';

                            echo '<div class="card-body" style="text-align: center; height:160px">';
                            echo '<h3 class="card-title" style="color: #991a1a;">' . $row["Title"] . '</h3>';
                            echo '<p class="card-text"><i class="fa fa-map-marker" aria-hidden="true"></i> ' . $row["Location"] . '</p>';
                            echo '<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#signInModal">More Details</button>';
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
    <script>
        document.getElementById("applyVolunteer").addEventListener("click", function() {
            const specificEventRadio = document.getElementById("specificEvent");
            const organizingNGORadio = document.getElementById("organizingNGO");
            if (specificEventRadio.checked || organizingNGORadio.checked) {
                $("#volunteerModal").modal("hide");
                $("#volunteerFormModal").modal("show");
            } else if (organizingNGORadio.checked) {
                $("#volunteerModal").modal("hide");
                $("#volunteerFormModal").modal("show");
            } else {
                alert("Please select an option to volunteer.");
            }
        });
    </script>
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