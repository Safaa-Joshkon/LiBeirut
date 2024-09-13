<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ngos</title>
    <link rel="stylesheet" href="CSS/styles.css" />
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

    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <?php
                // Query to retrieve NGO information
                $query = "SELECT * FROM ngo";
                $result = mysqli_query($con, $query);

                echo '<div id="ngoCarousel" class="carousel slide" data-bs-ride="carousel">';
                echo '<div class="carousel-inner">';

                // Counter for tracking NGOs per carousel item
                $count = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    // Check if the counter is 0, indicating the start of a new carousel item
                    if ($count % 3 == 0) {
                        echo '<div class="carousel-item';
                        // Add 'active' class to the first item for proper carousel functionality
                        if ($count == 0) {
                            echo ' active';
                        }
                        echo '">';
                        echo '<div class="row">';
                    }

                    echo '<div class="col-md-4">';
                    echo '<div class="card" style="border-radius: 15px;">';
                    echo '<div class="card-body text-center">';
                    echo '<div class="mt-3 mb-4">';
                    echo '<img src="images/' . $row["Logo"] . '" class="rounded-circle img-fluid" style="width: 100px;" />';
                    echo '</div>';
                    echo '<h4 class="mb-2">' . $row["Name"] . '</h4><br>';
                    echo '<div class="social-media-links">'; // Added container for social media links
                    $socialMediaLinks = explode("\n", $row["SocialMediaLinks"]);
                    foreach ($socialMediaLinks as $link) {
                        list($platform, $url) = explode(":", $link, 2);
                        echo '<a href="' . $url . '" target="_blank" class="social-media-link">';
                        echo '<i class="fa fa-' . getSocialMediaIcon(trim($platform)) . ' fa-lg"></i>';
                        echo '</a>';
                    }
                    echo '</div><br>';
                    $id = $row["NGOId"]; // Item Id
                    $id = base64_encode($id);
                    echo "<div class='check'><a class='btn btn-secondary' href='NGODetails.php?x=$id'>More Details</a></div>";
                    // Count number of volunteers
                    $volunteerQuery = "SELECT COUNT(*) AS volunteerCount FROM ngovolunteer WHERE NGOId = " . $row["NGOId"];
                    $volunteerResult = mysqli_query($con, $volunteerQuery);
                    $volunteerRow = mysqli_fetch_assoc($volunteerResult);
                    $volunteerCount = $volunteerRow["volunteerCount"];

                    // Count number of events
                    $eventQuery = "SELECT COUNT(DISTINCT VolunteerId) AS eventVolunteerCount FROM eventvolunteer WHERE EventId IN (SELECT EventId FROM organizeevent WHERE NGOId = " . $row["NGOId"] . ")";
                    $eventResult = mysqli_query($con, $eventQuery);
                    $eventRow = mysqli_fetch_assoc($eventResult);
                    $eventVolunteerCount = $eventRow["eventVolunteerCount"];

                    // Total volunteer count is the sum of NGO volunteers and event volunteers
                    $totalVolunteerCount = $volunteerCount + $eventVolunteerCount;
                    $eventCount = 0; // Initialize eventCount

                    // Count number of events
                    $eventQuery = "SELECT COUNT(*) AS eventCount FROM organizeevent WHERE NGOId = " . $row["NGOId"];
                    $eventResult = mysqli_query($con, $eventQuery);

                    while ($row = mysqli_fetch_assoc($eventResult)) {
                        $eventCount += $row["eventCount"];
                    }
                    // Display total volunteer count
                    echo '<div class="d-flex justify-content-center text-center mt-5 mb-2">';
                    echo '<div>';
                    echo '<p class="mb-2 h5">' . $totalVolunteerCount . '</p>';
                    echo '<p class="text-muted mb-0">Volunteers</p>';
                    echo '</div>';
                    echo '<div class="px-3">';
                    echo '<p class="mb-2 h5">' . $eventCount . '</p>';
                    echo '<p class="text-muted mb-0">Events</p>';
                    echo '</div>';
                    echo '</div>';

                    echo '</div></div></div>';

                    // Check if the counter is at the end of a row, then close the row
                    if ($count % 3 == 2) {
                        echo '</div>'; // Close row
                        echo '</div>'; // Close carousel item
                    }

                    // Increment the counter
                    $count++;
                }

                // Close the last row and carousel item if it's not closed yet
                if ($count % 3 != 0) {
                    echo '</div>'; // Close row
                    echo '</div>'; // Close carousel item
                }

                // Close carousel inner and carousel
                echo '</div>'; // Close carousel-inner
                echo '<button class="carousel-control-prev" type="button" data-bs-target="#ngoCarousel" data-bs-slide="prev" style="margin-left: -45px;">';
                echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                echo '<span class="visually-hidden">Previous</span>';
                echo '</button>';
                echo '<button class="carousel-control-next" type="button" data-bs-target="#ngoCarousel" data-bs-slide="next" style="margin-right: -45px;">';
                echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                echo '<span class="visually-hidden">Next</span>';
                echo '</button>';
                echo '</div>'; // Close carousel

                // Close the database connection
                mysqli_close($con);

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
                <style>
                    .social-media-links {
                        margin-top: 10px;
                        /* Add margin above the social media icons */
                    }

                    .social-media-link {
                        margin-right: 10px;
                        /* Add margin between each social media icon */
                    }
                </style>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            // Apply button click event handler
            $("button[id^='applyVolunteer_']").click(function() {
                // Get the NGO ID from the button's data attribute
                var ngoId = $(this).data("ngoid");
                // Get the radio button value
                var volunteerType = $("input[name='volunteerType_" + ngoId + "']:checked").val();

                // Check if a radio button is selected
                if (volunteerType) {
                    // Hide the current modal
                    $("#volunteerModal_" + ngoId).modal("hide");
                    // Show the volunteer form modal
                    $("#volunteerFormModal_" + ngoId).modal("show");
                } else {
                    // Show an alert if no radio button is selected
                    alert("Please select an option to volunteer.");
                }
            });
        });
    </script>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>

</html>