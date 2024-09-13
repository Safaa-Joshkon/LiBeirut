<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Li Beirut</title>
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
    <div id="result">
        <div class="container mt-5">

            <div class="divider d-flex type" id="upcoming-events">
                <h3 class="mx-3 mb-0 or">Upcoming Events</h3>
            </div><br>
            <div id="upcoming-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $username = $_SESSION['Username'];
                    $current_date = date("Y-m-d");
                    $query = "SELECT * FROM organizeevent O 
                    INNER JOIN events E ON E.EventId = O.EventId 
                    INNER JOIN ngo N ON N.NGOId = O.NGOId 
                    WHERE Date >= '$current_date' AND N.Name = '$username'";

                    $result = mysqli_query($con, $query);
                    $count = 0;
                    $totalEvents = mysqli_num_rows($result);
                    while ($row = mysqli_fetch_array($result)) {
                        if ($count % 3 == 0) {
                            $active = $count == 0 ? "active" : "";
                            echo "<div class='carousel-item $active'><div class='row'>";
                        }
                        $id = base64_encode($row["EventId"]);
                    ?>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mt-3 mb-4">
                                        <?php
                                        $imagePath = '../images/' . $row["Poster"];
                                        if (!file_exists($imagePath)) {
                                            $imagePath = '../uploads/' . $row["Poster"];
                                        }
                                        echo '<img src="' . $imagePath . '" class="card-img-top" alt="Event Poster" style="height: 400px;">';
                                        ?><br><br>

                                        <center>
                                            <h5 class="card-title"><?php echo $row["Title"]; ?></h5>
                                            <a href='EventEdit.php?q=<?php echo $id; ?>' class="btn btn-secondary">Edit</a>
                                            <a href='EventDelete.php?id=<?php echo $id; ?>' class="btn btn-danger" onclick='return confirm("Are you sure?")'>Delete</a>
                                        </center>

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
                <button class="carousel-control-prev" type="button" data-bs-target="#upcoming-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#upcoming-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="container mt-5">

            <div class="divider d-flex type" id="previous-events">
                <h3 class="mx-3 mb-0 or">Previous Events</h3>
            </div><br>
            <div id="previous-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $current_date = date("Y-m-d");
                    $query = "SELECT * FROM organizeevent O 
          INNER JOIN events E ON E.EventId = O.EventId 
          INNER JOIN ngo N ON N.NGOId = O.NGOId 
          WHERE Date <= '$current_date' AND N.Name = '$username'";

                    $result = mysqli_query($con, $query);
                    $count = 0;
                    $totalEvents = mysqli_num_rows($result);
                    while ($row = mysqli_fetch_array($result)) {
                        if ($count % 3 == 0) {
                            $active = $count == 0 ? "active" : "";
                            echo "<div class='carousel-item $active'><div class='row'>";
                        }
                        $id = base64_encode($row["EventId"]);
                    ?>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mt-3 mb-4">
                                        <?php
                                        $imagePath = '../images/' . $row["Poster"];
                                        if (!file_exists($imagePath)) {
                                            $imagePath = '../uploads/' . $row["Poster"];
                                        }
                                        echo '<img src="' . $imagePath . '" class="card-img-top" alt="Event Poster" style="height: 400px;">';
                                        ?><br><br>

                                        <center>
                                            <h5 class="card-title"><?php echo $row["Title"]; ?></h5>
                                            <a href='EventEdit.php?q=<?php echo $id; ?>' class="btn btn-secondary">Edit</a>
                                            <a href='EventDelete.php?id=<?php echo $id; ?>' class="btn btn-danger" onclick='return confirm("Are you sure?")'>Delete</a>
                                        </center>
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
                <button class="carousel-control-prev" type="button" data-bs-target="#previous-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#previous-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div><br>



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
    <?php include('footer.php'); ?>
</body>

</html>