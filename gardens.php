<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gardens in Beirut</title>
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
        <h3 class="mx-3 mb-0 or">Public Gardens in Beirut</h3>
    </div><br>
    <div class="container">
        <div class="row">
            <?php
            $query = "SELECT M.MediaId, M.image, S.spaceId, S.Name, S.Description
            FROM mediaimage M
            INNER JOIN spaces S ON M.SId=S.spaceId
            WHERE M.MediaId BETWEEN 11 AND 19";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-md-4">';
                echo '<div class="photo">';
                echo '<img src="images/' . $row["image"] . '" alt="' . $row["Name"] . '">';
                echo '<div class="title">' . $row["Name"] . '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
        <style>
            /* Custom CSS for photo gallery */
            .photo {
                position: relative;
                margin-bottom: 20px;
                height: 250px;
                /* Set a fixed height for the photo */
                overflow: hidden;
            }

            .photo img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                /* Maintain aspect ratio */
            }

            .photo .title {
                position: absolute;
                bottom: 15px;
                left: 50%;
                transform: translateX(-50%);
                background-color: rgba(0, 0, 0, 0.5);
                color: white;
                padding: 8px 10px;
                border-radius: 5px;
                width: 250px;
                text-align: center;
            }
        </style>
    </div>
    <!-- Footer -->
    <?php include 'footer.php'; ?>

</body>

</html>