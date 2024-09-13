<?php
require_once("Config.php");
require("../authentication.php");
include("header.php");
echo '<div id="result">';
// Check if NGOId is set in the session
if (!isset($_SESSION['UserId'])) {
    echo "NGOId not set in session. Please login again.";
    exit();
}
$username = $_SESSION['Username'];
$query = "SELECT * FROM ngo INNER JOIN users ON ngo.Name = users.Username WHERE users.Username = '$username'";
$result = mysqli_query($con, $query);
if (!$result) {
    // Log the error and display a generic message
    error_log("Error in NGO query: " . mysqli_error($con));
    echo "An error occurred. Please try again later.";
    exit();
}
if (mysqli_num_rows($result) == 0) {
    echo "No NGO found for the current user.";
    exit();
}
while ($row = mysqli_fetch_array($result)) {
    // Check if the NGOId is set in the fetched row
    if (isset($row['NGOId'])) {
        echo '<center>';
        echo '<div class="container mt-5">';
        echo '<div class="divider d-flex type" id="previous">';
        echo '<h3 class="mx-3 mb-0 or" id="previous">' . $row["Name"] . '</h3>';
        echo '</div><br>';
        echo '<div class="col-md-4">';
        echo '<div class="card" style="border-radius: 15px;">';
        echo '<div class="card-body text-center">';
        echo '<div class="mt-3 mb-4">';
        $imagePath = '../images/' . $row["Logo"];
        if (!file_exists($imagePath)) {
            $imagePath = '../uploads/' . $row["Logo"];
        }
        echo '<img src="' . $imagePath . '"  class="rounded-circle img-fluid" style="width: 100px;"><br><br>';
        echo '<h5 class="card-title">' . $row["Name"] . '</h5><br>';
        $id = base64_encode($row["NGOId"]);

        echo "<a href='NGOEdit.php?q=" . $id . "' class='btn btn-secondary' style='margin-right: 5px;'>Edit</a>";
        echo "<a href='NGODelete.php?id=" . $id . "' class='btn btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>";

        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</center><br>';
    } else {
        echo "NGOId not found in the fetched row.";
    }
    echo '</div>';
} ?>
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