<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="icon" type="image/png" href="images/image-removebg-preview (22).png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js" language="javascript"></script>
</head>

<body>

    <?php
    require("Config.php");
    include 'navbar.php';
    $EventId = base64_decode($_GET["x"]);
    $query = "SELECT * FROM organizeevent O
            INNER JOIN ngo N ON O.NGOId = N.NGOId
            INNER JOIN events E ON O.EventId = E.EventId
    WHERE O.EventId= $EventId";
    $result = mysqli_query($con, $query);
    $current_date = date("Y-m-d");
    while ($row = mysqli_fetch_array($result)) {
        echo '<div class="row" style="max-width:100%">';
        echo '<div class="col-4">';
        $imagePath = 'images/' . $row["Poster"];
        if (!file_exists($imagePath)) {
            $imagePath = 'uploads/' . $row["Poster"];
        }
        echo '<img src="' . $imagePath . '" class="card-img-top" alt="Event Poster" style="width: 420px; height: 550px; margin-left:50px; margin-top: 20px; padding-left: 20px;">';

        echo '</div>';
        echo '<div class="col-8" style="margin-top: 20px;">';
        echo '<h4 class="card-title" style="color: #991a1a;"><b>' . $row["Title"] . '</b></h4><br>';

        echo '<div><span>';
        echo '<h5><b><i class="fa fa-calendar-o" aria-hidden="true"></i> Date:</b></h5>';
        echo '</span>';
        if ($row["Date"] < $current_date) {
            echo '<p>' . $row["Date"] . ' <span style="color: red;">Expired!</span></p>';
        } else {
            echo '<p>' . $row["Date"] . '</p>';
        }
        echo '</div>';

        echo '<div><span>';
        echo '<h5><b><i class="fa fa-clock-o" aria-hidden="true"></i> Time:</b></h5>';
        echo '</span>';
        $time = date("h:i a", strtotime($row["Time"]));
        echo '<p>' . $time . '</p>';
        echo ' </div>';

        echo '<div><span>';
        echo ' <h5><b><i class="fa fa-map-marker" aria-hidden="true"></i> Location:</b></h5>';
        echo '</span>';
        echo '<p>' . $row["Location"] . '</p>';
        echo '</div>';

        echo '<div><span>';
        echo ' <h5><b><i class="fa fa-home" aria-hidden="true"></i> Organizer:</b></h5>';
        echo '</span>';
        echo '<p>' . $row["Name"] . '</p>';
        echo '</div>';

        echo '<div><span>';
        echo ' <h5><b>Description: </b></h5>';
        echo '</span>';
        echo '<p>' . $row["Description"] . '</p>';
        echo '</div>';
        echo '<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#volunteerModal">';
        echo 'Volunteer Now';
        echo '</button>';
        echo '</div>';
        echo '</div><br>';

        $disabledSpecificEvent = ($row["Date"] < $current_date) ? 'disabled' : '';
        if ($disabledSpecificEvent) {
            echo '<!-- Volunteer Modal -->
        <div class="modal fade" id="volunteerModal" tabindex="-1" aria-labelledby="volunteerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="volunteerModalLabel">Volunteer Options</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Would you like to volunteer for the "' . $row["Name"] . '" NGO?</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="volunteerType" id="organizingNGO" value="organizingNGO">
                            <label class="form-check-label" for="organizingNGO">' . $row["Name"] . '</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="applyVolunteer">Apply</button>
                    </div>
                </div>
            </div>
        </div>';
        }

        echo '<!-- Volunteer Modal -->
        <div class="modal fade" id="volunteerModal" tabindex="-1" aria-labelledby="volunteerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="volunteerModalLabel">Volunteer Options</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Would you like to volunteer for the "' . $row["Title"] . '" event or for "' . $row["Name"] . '" NGO in general?</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="volunteerType" id="specificEvent" value="specificEvent" ' . $disabledSpecificEvent . '>
                            <label class="form-check-label" for="specificEvent">' . $row["Title"] . '</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="volunteerType" id="organizingNGO" value="organizingNGO">
                            <label class="form-check-label" for="organizingNGO">' . $row["Name"] . '</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="applyVolunteer">Apply</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Volunteer Form Modal -->
        <div class="modal fade" id="volunteerFormModal" tabindex="-1" aria-labelledby="volunteerFormModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="volunteerFormModalLabel">Volunteer Application Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form id="volunteerForm" action="requestAction.php" method="POST">
                            <!--First Name-->
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" required>
                            </div>
                            <!--Last Name-->
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" required>
                            </div>
                            <!--Gender-->
                            <div class="mb-3">
                                <label class="form-label">Gender: </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" required>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                            <!--Address-->
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" required></textarea>
                            </div>
                            <!--Phone Number-->
                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phoneNumber" required>
                            </div>
                            <!--Email-->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <!--Profile Picture-->
                            <div class="mb-3">
                                <label for="profilePicture" class="form-label">Profile Picture (Optional)</label>
                                <input type="file" class="form-control" id="profilePicture" name="profilePicture">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submitApplication" name="submitApplication">Submit</button>
                    </div>
                </div>
            </div>
        </div>';
    }
    ?>
    <script>
        document
            .getElementById("applyVolunteer")
            .addEventListener("click", function() {
                const specificEventRadio = document.getElementById("specificEvent");
                const organizingNGORadio = document.getElementById("organizingNGO");

                if (
                    !specificEventRadio.disabled &&
                    (specificEventRadio.checked || organizingNGORadio.checked)
                ) {
                    $("#volunteerModal").modal("hide");
                    $("#volunteerFormModal").modal("show");
                } else if (specificEventRadio.disabled && organizingNGORadio.checked) {
                    $("#volunteerModal").modal("hide");
                    $("#volunteerFormModal").modal("show");
                } else {
                    alert("Please select an option to volunteer.");
                }
            });
    </script>
    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>

</html>