<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Museums</title>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="icon" type="image/png" href="images/image-removebg-preview (22).png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js" language="javascript"></script>
</head>

<body>
    <?php require("Config.php");
    include 'navbar.php'; ?>

    <style>
        .museum-img {
            height: 600px;
            object-fit: cover;
        }

        .carousel-caption {
            background-color: rgba(0, 0, 0, 0.5);
            /* Black with 50% opacity */
            color: white;
        }

        .list-group-item h5 {
            color: #991a1a;
        }
    </style>
    <div id="carouselCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <?php
            $query = "SELECT M.MediaId, M.image, S.spaceId, S.Name, S.Description
            FROM mediaimage M
            INNER JOIN spaces S ON M.SId=S.spaceId
            WHERE M.MediaId BETWEEN 21 AND 25";
            $result = mysqli_query($con, $query);
            $active = true;
            $counter = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="' . $counter . '"';
                if ($active) {
                    echo ' class="active" aria-current="true"';
                    $active = false;
                }
                echo ' aria-label="Slide ' . ($counter + 1) . '"></button>';
                $counter++;
            }
            ?>
        </div>
        <div class="carousel-inner">
            <?php
            $result = mysqli_query($con, $query);
            $active = true;
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="carousel-item';
                if ($active) {
                    echo ' active';
                    $active = false;
                }
                echo '">';
                echo '<img src="images/' . $row["image"] . '" class="d-block w-100 museum-img" alt="Museum Image">';
                echo '<div class="carousel-caption d-none d-md-block">';
                echo '<h5>' . $row["Name"] . '</h5>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <br><br>
    <div class="divider d-flex type">
        <h3 class="mx-3 mb-0 or">Museums in Beirut</h3>
    </div><br>
    <div class="container">
        <div class="row">
            <div class="col">
                <ul class="list-group">
                    <?php
                    $query = "SELECT S.spaceId, S.Name, S.Description, M.MediaId, M.image
                    FROM mediaimage M
                    INNER JOIN spaces S ON M.SId = S.spaceId 
                    WHERE M.MediaId BETWEEN 21 AND 25
                    ";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<li class="list-group-item">';
                        echo '<h5>' . $row["Name"] . '</h5>';
                        echo '<p>' . $row["Description"] . '</p>';
                        echo '</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <br><br>
    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>

</html>