<?php
require_once("Config.php");
include("header.php");

$ngoName = $_SESSION['Username'];

// Get the NGO ID based on the NGO name
$query = "SELECT NGOId FROM ngo WHERE Name = '$ngoName'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$ngoId = $row['NGOId'];

// Select general volunteers who are volunteering for the NGO
$generalVolunteersQuery = "SELECT v.* FROM volunteer v 
                          LEFT JOIN ngovolunteer nv ON v.VolunteerId = nv.VolunteerId 
                          WHERE nv.NGOId = $ngoId AND nv.Response = 'accept'";

$generalVolunteersResult = mysqli_query($con, $generalVolunteersQuery);
$totalGeneralVolunteers = mysqli_num_rows($generalVolunteersResult);

// Select volunteers who are volunteering for events organized by the NGO
$eventVolunteersQuery = "SELECT v.* FROM volunteer v 
                         LEFT JOIN eventvolunteer ev ON v.VolunteerId = ev.VolunteerId 
                         WHERE ev.EventId IN (SELECT EventId FROM organizeevent WHERE NGOId = $ngoId) 
                         AND ev.Response = 'accept'";

$eventVolunteersResult = mysqli_query($con, $eventVolunteersQuery);
$totalEventVolunteers = mysqli_num_rows($eventVolunteersResult);

function displayVolunteers($result)
{
    global $con;
    $count = 0;
    $totalVolunteers = mysqli_num_rows($result);

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
        if ($count % 3 == 0 || $count == $totalVolunteers) {
            echo "</div></div>"; // Close row and carousel-item divs
        }
    }
}
?>

<div class="container mt-5">
    <?php if ($totalGeneralVolunteers > 0) { ?>
        <div class="divider d-flex type" id="general-volunteers">
            <h3 class="mx-3 mb-0 or" id="general-volunteers">General Volunteers</h3>
        </div><br>
        <div id="generalVolunteersCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php displayVolunteers($generalVolunteersResult); ?>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#generalVolunteersCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#generalVolunteersCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    <?php } ?>
</div>
<br>

<div class="container mt-5">
    <?php if ($totalEventVolunteers > 0) { ?>
        <div class="divider d-flex type" id="event-volunteers">
            <h3 class="mx-3 mb-0 or" id="event-volunteers">Event Volunteers</h3>
        </div><br>
        <div id="eventVolunteersCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php displayVolunteers($eventVolunteersResult); ?>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#eventVolunteersCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#eventVolunteersCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    <?php } ?>
</div>
<br>

<?php if ($totalGeneralVolunteers == 0 && $totalEventVolunteers == 0) { ?>
    <div class="container mt-5">
        <div class="alert alert-warning" role="alert">
            No volunteers found for this NGO.
        </div>
    </div>
<?php } ?><br>

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