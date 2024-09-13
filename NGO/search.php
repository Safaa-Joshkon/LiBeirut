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
            $username = $_SESSION['Username'];
            $query = "SELECT * FROM organizeevent O 
          INNER JOIN events E ON E.EventId = O.EventId 
          INNER JOIN ngo N ON N.NGOId = O.NGOId 
          WHERE N.Name = '$username' AND E.Title LIKE '%$value%'";

            $result = mysqli_query($con, $query);

            while ($row = mysqli_fetch_array($result)) {
                $id = base64_encode($row["EventId"]);
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<img src="../images/' . $row["Poster"] . '" class="card-img-top" alt="Event Poster">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row["Title"] . '</h5>';
                echo '<a href="EventEdit.php?q=' . $id . '" class="btn btn-secondary edit-delete-btn">Edit</a>';
                echo '<a href="EventDelete.php?id=' . $id . '" class="btn btn-danger edit-delete-btn" onclick="return confirm(\'Are you sure?\')">Delete</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            $username = $_SESSION['Username'];
            $query0 = "SELECT * FROM ngo INNER JOIN users ON ngo.Name = users.Username WHERE users.Username = '$username'";
            $result0 = mysqli_query($con, $query0);
            $row = mysqli_fetch_assoc($result0);
            $ngoId = $row["NGOId"];
            $query3 = "SELECT * FROM ngovolunteer NV 
            INNER JOIN volunteer V on V.VolunteerId= NV.VolunteerId 
            WHERE V.Name LIKE '%$value%' AND NV.NGOId = '$ngoId'";

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
                echo '<a href="VolunteerEdit.php?q=' . $id . '" class="btn btn-secondary edit-delete-btn">Edit</a>';
                echo '<a href="VolunteerDelete.php?id=' . $id . '" class="btn btn-danger edit-delete-btn" onclick="return confirm(\'Are you sure?\')">Delete</a>';

                echo '</div>';
                echo '</div>';
                echo '</div>';
            }



            $query4 = "SELECT * FROM eventvolunteer EV 
INNER JOIN volunteer V on V.VolunteerId= EV.VolunteerId 
INNER JOIN organizeevent O on O.EventId = EV.EventId
WHERE V.Name LIKE '%$value%' AND O.NGOId = '$ngoId'";
            $result4 = mysqli_query($con, $query4);

            while ($row = mysqli_fetch_array($result4)) {
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
                echo '<a href="VolunteerEdit.php?q=' . $id . '" class="btn btn-secondary edit-delete-btn">Edit</a>';
                echo '<a href="VolunteerDelete.php?id=' . $id . '" class="btn btn-danger edit-delete-btn" onclick="return confirm(\'Are you sure?\')">Delete</a>';

                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            mysqli_close($con);
            ?>
        </div>
    </div><br><br>
    <style>
        .edit-delete-btn {
            margin-right: 5px;
            /* Adjust the margin value as needed */
        }
    </style>
</body>

</html>