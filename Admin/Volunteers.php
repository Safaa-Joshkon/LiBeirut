<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteers</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="icon" type="image/png" href="../images/image-removebg-preview (22).png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js" language="javascript"></script>
</head>

<body>
    <?php require_once("Config.php");
    include("header.php"); ?>
    <div class="container mt-5">
        <div class="divider d-flex type" id="previous">
            <h3 class="mx-3 mb-0 or" id="previous">Volunteers</h3>
        </div><br>
        <div id="ngos" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                $query = "SELECT * FROM volunteer";
                $result = mysqli_query($con, $query);
                $count = 0;
                $totalEvents = mysqli_num_rows($result);
                while ($row = mysqli_fetch_array($result)) {
                    if ($count % 3 == 0) {
                        $active = $count == 0 ? "active" : "";
                        echo "<div class='carousel-item $active'><div class='row'>";
                    }
                    $id = base64_encode($row["VolunteerId"]);
                ?>
                    <div class="col-md-4">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body text-center">
                                <div class="mt-3 mb-4">
                                    <?php
                                    if ($row["Profile"] != "") {
                                        echo '<img src="../uploads/' . $row["Profile"] . '" class="rounded-circle img-fluid" style="width: 110px; height:120px">';
                                    } else {
                                        echo '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bc/Unknown_person.jpg/925px-Unknown_person.jpg"  class="rounded-circle img-fluid" style="width: 110px; height:120px">';
                                    }
                                    ?><br><br>

                                    <h5 class="card-title"><?php echo $row["Name"]; ?></h5><br>
                                    <a href='VolunteerEdit.php?q=<?php echo $id; ?>' class="btn btn-secondary">Edit</a>
                                    <a href='VolunteerDelete.php?id=<?php echo $id; ?>' class="btn btn-danger" onclick='return confirm("Are you sure?")'>Delete</a>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    $count++;
                    if ($count % 3 == 0 || $count == $totalEvents) {
                        echo "</div></div>"; // Close row and carousel-item divs
                    }
                }
                ?>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#ngos" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#ngos" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    </div>
    <br>

    <script type="text/javascript">
        // bind on keyup event to the textbox search
        $(document).ready(function() { // on page load
            $('#txtSearch').keyup(function() {
                // alert(this.value);
                $.ajax({
                    type: "GET",
                    url: "search.php",
                    data: {
                        'name': this.value
                    },
                    success: function(response) {
                        // returned result
                        $('#result').html(response);
                    }
                });
            });
        });
    </script>
    <?php include('../footer.php'); ?>
</body>

</html>