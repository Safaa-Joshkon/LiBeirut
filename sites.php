<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Must See Sites</title>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="icon" type="image/png" href="images/image-removebg-preview (22).png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php require("Config.php");
    include 'navbar.php'; ?>
    <div class="divider d-flex type">
        <h3 class="mx-3 mb-0 or">Must See Sites in Beirut</h3>
    </div><br><br>
    <div class="container2">
        <?php

        $sql = "SELECT M.MediaId, M.image, S.spaceId, S.Name, S.Description
        FROM mediaimage M
        INNER JOIN spaces S ON M.SId=S.spaceId LIMIT 6";

        $result = mysqli_query($con, $sql);
        $rowCounter = 0; // Initialize counter before loop

        while ($row = mysqli_fetch_assoc($result)) {
            $imageFileName = $row["image"];
            $imageUrl = "images/{$imageFileName}";
            $isFirstElement = ($rowCounter === 0); // Check if it's the first element
        ?>
            <div class="element <?php echo $isFirstElement ? 'opened' : ''; ?>" style="background-image: url('<?php echo $imageUrl; ?>');" tabindex="-1">
                <div class="icon">
                    <i class=""></i>
                </div>
            </div>
        <?php
            $rowCounter++; // Increment counter for subsequent elements
        }
        ?>

    </div><br><br>
    <style>
        body {
            display: grid;
            place-content: center;
        }

        .container2 {
            max-width: 100vw;
            height: 100vh;
            max-height: 500px;
            overflow: hidden;
            display: flex;
            place-content: center;
            gap: 1rem;
        }


        @media screen and (max-width: 768px) {
            .container2 {
                flex-direction: column;
                max-height: none;
                max-width: 100%;
            }
        }

        .element {
            cursor: pointer;
            flex: 0 1 auto;
            overflow: hidden;
            max-width: 50px;
            border-radius: 4rem;
            padding: 0.5rem;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: flex-end;
            transition: 0.5s ease-in-out;
        }

        @media screen and (max-width: 768px) {
            .element {
                flex-direction: column;
                align-items: flex-start;
                max-width: none;
                max-height: 60px;
                background-size: 130% auto;
            }

            .element:first-child {
                /* Styles specific to first element on small screens */
                background-size: 120% auto;
                /* Adjust as needed */
                border-radius: 2rem;
                /* Adjust as needed */
            }
        }

        .element:focus {
            outline: none;
            transform: scale(1);
            flex-grow: 1000;
            max-width: 600px;
            border-radius: 1.75rem;
            background-size: auto 100%;
        }

        @media screen and (max-width: 768px) {
            .element:focus {
                flex-direction: column;
                align-items: flex-start;
                max-width: none;
                max-height: 600px;
                background-size: 130% auto;
            }
        }

        .element>.icon {
            width: 24px;
            aspect-ratio: 1/1;
            background-color: #fff;
            padding: 8px;
            border-radius: 50%;
            place-content: center;
            display: grid;
            border: 4px solid rgba(0, 0, 0, 0.5);
            background-clip: padding-box;
        }

        .opened {
            outline: none;
            transform: scale(1);
            flex-grow: 1000;
            max-width: 600px;
            border-radius: 1.75rem;
            background-size: auto 100%;
        }
    </style>

    <script>
        $(document).ready(function() {
            $(".element").click(function() {
                $(".element.opened").removeClass("opened");
                $(this).addClass("opened");
            });
        });
    </script>
    <?php include 'footer.php'; ?>
</body>

</html>