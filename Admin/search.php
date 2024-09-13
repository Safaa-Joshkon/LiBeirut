<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-xxk2Lq/Y4J/gLHzgWSrgvPe3k9Kd/JzTndVuyF+iw7IjL5tQqMU1Gpe33VWlKk6P" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            $value = $_GET["name"]; // sent from ajax data
            require("Config.php");
            $query = "SELECT * FROM events
                WHERE Title LIKE '%$value%'
                ";

            $query2 = "SELECT * FROM ngo WHERE Name LIKE '%$value%'";
            $query3 = "SELECT * FROM volunteer WHERE Name LIKE '%$value%'";

            $result = mysqli_query($con, $query);

            while ($row = mysqli_fetch_array($result)) {
                $id = base64_encode($row["EventId"]);
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<img src="../images/' . $row["Poster"] . '" class="card-img-top" alt="Event Poster">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row["Title"] . '</h5>';
                echo '<a href="EventEdit.php?q=' . $id . '" class="btn btn-secondary">Edit</a>';
                echo '<a href="EventDelete.php?id=' . $id . '" class="btn btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }


            $result2 = mysqli_query($con, $query2);

            while ($row = mysqli_fetch_array($result2)) {
                $id = base64_encode($row["NGOId"]);
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<img src="../images/' . $row["Logo"] . '" class="card-img-top" alt="NGO Logo">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row["Name"] . '</h5>';
                echo '<a href="EventEdit.php?q=' . $id . '" class="btn btn-secondary">Edit</a>';
                echo '<a href="EventDelete.php?id=' . $id . '" class="btn btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }

            $result3 = mysqli_query($con, $query3);

            while ($row = mysqli_fetch_array($result3)) {
                $id = base64_encode($row["VolunteerId"]);
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                if ($row["Profile"] != "") {
                    echo '<img src="../uploads/' . $row["Profile"] . '" class="card-img-top rounded-circle img-fluid" style="width: 110px; height:120px">';
                } else {
                    echo '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bc/Unknown_person.jpg/925px-Unknown_person.jpg"  class="rounded-circle img-fluid" style="width: 110px; height:120px">';
                }
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row["Name"] . '</h5>';
                echo '<a href="EventEdit.php?q=' . $id . '" class="btn btn-secondary">Edit</a>';
                echo '<a href="EventDelete.php?id=' . $id . '" class="btn btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            // $result = mysqli_query($con, $query2);

            // while ($row = mysqli_fetch_assoc($result)) {
            //     echo '<div class="col-md-4">';
            //     echo '<div class="card h-100" style="border-radius: 15px;">';
            //     echo '<div class="card-body text-center">';
            //     echo '<div class="mt-3 mb-4">';
            //     echo '<img src="../images/' . $row["Logo"] . '" class="rounded-circle img-fluid" style="width: 100px;" />';
            //     echo '</div>';
            //     echo '<h4 class="mb-2">' . $row["Name"] . '</h4><br>';
            //     echo '<div class="mb-4 pb-2">';
            //     $socialMediaLinks = explode("\n", $row["SocialMediaLinks"]);
            //     foreach ($socialMediaLinks as $link) {
            //         list($platform, $url) = explode(":", $link, 2);
            //         echo '<a href="' . $url . '" target="_blank" class="btn btn-outline-primary btn-floating">';
            //         echo '<i class="fa fa-' . getSocialMediaIcon(trim($platform)) . ' fa-lg"></i>';
            //         echo '</a>';
            //     }
            //     echo '</div>';
            //     echo '<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#volunteerModal_' . $row["NGOId"] . '">';
            //     echo 'Volunteer now';
            //     echo '</button>';

            //     // Volunteer Modal
            //     echo '
            //     <div class="modal fade" id="volunteerModal_' . $row["NGOId"] . '" tabindex="-1" aria-labelledby="volunteerModalLabel_' . $row["NGOId"] . '" aria-hidden="true" style="text-align: left;">
            //         <div class="modal-dialog">
            //             <div class="modal-content">
            //                 <div class="modal-header">
            //                     <h5 class="modal-title" id="volunteerModalLabel_' . $row["NGOId"] . '">Volunteer Options</h5>
            //                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            //                 </div>
            //                 <div class="modal-body">
            //                     <p>Would you like to volunteer for the "' . $row["Name"] . '" NGO?</p>
            //                     <div class="form-check">
            //                         <input class="form-check-input" type="radio" name="volunteerType_' . $row["NGOId"] . '" id="organizingNGO_' . $row["NGOId"] . '" value="organizingNGO">
            //                         <label class="form-check-label" for="organizingNGO_' . $row["NGOId"] . '">' . $row["Name"] . '</label>
            //                     </div>
            //                 </div>
            //                 <div class="modal-footer">
            //                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            //                     <button type="button" class="btn btn-primary" data-ngoid="' . $row["NGOId"] . '" id="applyVolunteer_' . $row["NGOId"] . '">Apply</button>
            //                 </div>
            //             </div>
            //         </div>
            //     </div>';

            //     // Volunteer Form Modal
            //     echo '
            //     <div class="modal fade" id="volunteerFormModal_' . $row["NGOId"] . '" tabindex="-1" aria-labelledby="volunteerFormModalLabel_' . $row["NGOId"] . '" aria-hidden="true">
            //         <div class="modal-dialog">
            //             <div class="modal-content">
            //                 <div class="modal-header">
            //                     <h5 class="modal-title" id="volunteerFormModalLabel_' . $row["NGOId"] . '">Volunteer Application Form</h5>
            //                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            //                 </div>
            //                 <div class="modal-body" style="text-align: left;">
            //                     <form>
            //                         <!-- Form fields -->
            //                     </form>
            //                 </div>
            //                 <div class="modal-footer">
            //                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            //                     <button type="button" class="btn btn-primary" data-ngoid="' . $row["NGOId"] . '" id="submitApplication_' . $row["NGOId"] . '">Submit</button>
            //                 </div>
            //             </div>
            //         </div>
            //     </div>';

            //     // Count number of volunteers
            //     $volunteerQuery = "SELECT COUNT(*) AS volunteerCount FROM ngovolunteer WHERE NGOId = " . $row["NGOId"];
            //     $volunteerResult = mysqli_query($con, $volunteerQuery);
            //     $volunteerRow = mysqli_fetch_assoc($volunteerResult);
            //     $volunteerCount = $volunteerRow["volunteerCount"];

            //     // Count number of events
            //     $eventQuery = "SELECT COUNT(*) AS eventCount FROM organizeevent WHERE NGOId = " . $row["NGOId"];
            //     $eventResult = mysqli_query($con, $eventQuery);
            //     $eventRow = mysqli_fetch_assoc($eventResult);
            //     $eventCount = $eventRow["eventCount"];

            //     echo '<div class="d-flex justify-content-center text-center mt-5 mb-2">';
            //     echo '<div>';
            //     echo '<p class="mb-2 h5">' . $volunteerCount . '</p>';
            //     echo '<p class="text-muted mb-0">Volunteers</p>';
            //     echo '</div>';
            //     echo '<div class="px-3">';
            //     echo '<p class="mb-2 h5">' . $eventCount . '</p>';
            //     echo '<p class="text-muted mb-0">Events</p>';
            //     echo '</div>';
            //     echo '</div>';

            //     echo '</div></div></div>';
            // }

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
        </div>
    </div><br><br>
</body>

</html>