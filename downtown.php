<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Downtown Beirut</title>
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
    <div class="divider d-flex type">
        <h3 class="mx-3 mb-0 or">Downtown, Beirut</h3>
    </div><br>
    <div class="accordion accordion-flush" id="accordionFlush">
        <?php
        $sql = "SELECT M.MediaId, M.image, S.spaceId, S.Name, S.Description
                FROM mediaimage M
                INNER JOIN spaces S ON M.SId=S.spaceId
                WHERE S.Location = 'Downtown'";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="accordion-item">';
            echo '<h2 class="accordion-header" id="flush-heading' . $row["spaceId"] . '">';
            echo '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse' . $row["spaceId"] . '" aria-expanded="false" aria-controls="flush-collapse' . $row["spaceId"] . '">';
            echo '<img src="images/' . $row["image"] . '" alt="' . $row["Name"] . '" style="height: 350px; width: 50%;">';
            echo '</button>';
            echo '</h2>';
            echo '<div id="flush-collapse' . $row["spaceId"] . '" class="accordion-collapse collapse" aria-labelledby="flush-heading' . $row["spaceId"] . '" data-bs-parent="#accordionFlush">';
            echo '<div class="accordion-body">';
            echo '<h3>' . $row["Name"] . '</h3>';
            echo $row["Description"];
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div><br><br>
    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>

</html>