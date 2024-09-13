<?php
require_once("Config.php");
include("header.php");

$ngoName = $_SESSION['Username'];

// Get the NGO ID based on the NGO name
$query = "SELECT NGOId FROM ngo WHERE Name = '$ngoName'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$ngoId = $row['NGOId'];

// Queries to get event volunteers and general volunteers separately
$eventVolunteerQuery = "SELECT v.*, ev.EventId, e.Title AS EventTitle 
          FROM volunteer v 
          INNER JOIN eventvolunteer ev ON v.VolunteerId = ev.VolunteerId 
          INNER JOIN events e ON ev.EventId = e.EventId 
          WHERE e.EventId IN (SELECT EventId FROM organizeevent WHERE NGOId = $ngoId) 
          AND ev.Response = 'Pending'";

$generalVolunteerQuery = "SELECT * FROM volunteer v 
          INNER JOIN ngovolunteer nv ON v.VolunteerId = nv.VolunteerId 
          WHERE nv.NGOId = $ngoId AND nv.Response = 'Pending'";

// Execute the queries
$eventVolunteerResult = mysqli_query($con, $eventVolunteerQuery);
$generalVolunteerResult = mysqli_query($con, $generalVolunteerQuery);

function displayVolunteers($result, $isEventVolunteer = false)
{
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
                        <?php if ($isEventVolunteer) { ?>
                            <p class="card-text"><strong>Event:</strong> <?php echo $row["EventTitle"]; ?></p><br>
                        <?php } ?>
                        <form action="HandleRequest.php" method="post" class="d-flex justify-content-center">
                            <input type="hidden" name="volunteer_id" value="<?php echo $row["VolunteerId"]; ?>">
                            <button type="submit" name="action" value="accept" class="btn btn-success me-2">Accept</button>
                            <button type="submit" name="action" value="reject" class="btn btn-danger">Reject</button>
                        </form>
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
    <?php if (mysqli_num_rows($eventVolunteerResult) > 0) { ?>
        <div class="divider d-flex type" id="event-requests">
            <h3 class="mx-3 mb-0 or" id="event-requests">Event Volunteer Requests</h3>
        </div><br>
        <div id="eventVolunteersCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php displayVolunteers($eventVolunteerResult, true); ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#eventVolunteersCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#eventVolunteersCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    <?php } ?>
</div>

<br>

<div class="container mt-5">
    <?php if (mysqli_num_rows($generalVolunteerResult) > 0) { ?>
        <div class="divider d-flex type" id="general-requests">
            <h3 class="mx-3 mb-0 or" id="general-requests">General Volunteer Requests</h3>
        </div><br>
        <div id="generalVolunteersCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php displayVolunteers($generalVolunteerResult); ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#generalVolunteersCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#generalVolunteersCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    <?php } ?>
    <?php if (mysqli_num_rows($eventVolunteerResult) == 0 && mysqli_num_rows($generalVolunteerResult) == 0) { ?>
        <div class="container mt-5">
            <div class="alert alert-warning" role="alert">
                No volunteers Requests found for this NGO.
            </div>
        </div>
    <?php } ?>
</div>
<br>

<script type="text/javascript">
    $(document).ready(function() {
        $('#txtSearch').keyup(function() {
            $.ajax({
                type: "GET",
                url: "search.php",
                data: {
                    'name': this.value
                },
                success: function(response) {
                    $('#result').html(response);
                }
            });
        });
    });
</script>
<?php include('../footer.php'); ?>