<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Li Beirut</title>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="icon" type="image/png" href="images/image-removebg-preview (22).png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js" language="javascript"></script>
</head>

<body>
    <?php
    include 'Config.php';

    // Query to get the count of volunteers
    $volunteerQuery = "SELECT COUNT(*) as totalVolunteers FROM volunteer";
    $volunteerResult = mysqli_query($con, $volunteerQuery);
    $volunteerCount = mysqli_fetch_assoc($volunteerResult)['totalVolunteers'];

    // Query to get the count of NGOs
    $ngoQuery = "SELECT COUNT(*) as totalNGOs FROM ngo";
    $ngoResult = mysqli_query($con, $ngoQuery);
    $ngoCount = mysqli_fetch_assoc($ngoResult)['totalNGOs'];

    // Query to get the count of events
    $eventQuery = "SELECT COUNT(*) as totalEvents FROM events";
    $eventResult = mysqli_query($con, $eventQuery);
    $eventCount = mysqli_fetch_assoc($eventResult)['totalEvents'];

    $visitors = $volunteerCount + $ngoCount;
    ?>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <div class="divider d-flex type" id="about">
            <h3 class="mx-3 mb-0 or" id="about">About Us</h3>
        </div><br>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card h-100">
                    <img src="./images/mission2.png" class="card-img-top" alt="..." style="width:100px; height:100px">
                    <div class="card-body">
                        <h5 class="card-title">Our Mission</h5>
                        <p class="card-text">Li Beirut is dedicated to connecting volunteers with NGOs in Beirut, providing a platform for them to collaborate on impactful projects that enhance the community and promote social change.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="./images/vision2.png" class="card-img-top" alt="..." style="width:100px; height:100px">
                    <div class="card-body">
                        <h5 class="card-title">Our Vision</h5>
                        <p class="card-text">Our vision is to create a dynamic and inclusive environment in Beirut where individuals and organizations work together harmoniously, leveraging their collective skills and resources to address local challenges and foster sustainable development.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="./images/values.png" class="card-img-top" alt="..." style="width:100px; height:100px">
                    <div class="card-body">
                        <h5 class="card-title">Our Values</h5>
                        <p class="card-text">Li Beirut is driven by the values of integrity, empowerment, and collaboration. We believe in the importance of transparency, respect, and equity in all our interactions, striving to build a community that values diversity and promotes positive social change.</p>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="divider d-flex type" id="impact">
            <h3 class="mx-3 mb-0 or">Impact</h3>
        </div><br>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="counter c1">
                        <div class="counter-icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <span class="counter-value"><?php echo $volunteerCount; ?></span>
                        <h5>Volunteers</h5>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter c3">
                        <div class="counter-icon">
                            <i class="fa fa-handshake-o" aria-hidden="true"></i>
                        </div>
                        <span class="counter-value"><?php echo $ngoCount; ?></span>
                        <h5>NGOs</h5>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter c2">
                        <div class="counter-icon">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </div>
                        <span class="counter-value"><?php echo $eventCount; ?></span>
                        <h5>Events</h5>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter c4">
                        <div class="counter-icon">
                            <i class="fa fa-users" aria-hidden="true"></i>
                        </div>
                        <span class="counter-value"><?php echo $visitors; ?></span>
                        <h5>Visitors</h5>
                    </div>
                </div>
            </div>
        </div><br><br>
    </div>
    <br>
    <style>
        /* impact */
        .counter {
            font-family: "Open Sans", sans-serif;
            text-align: center;
            height: 185px;
            width: 190px;
            padding: 30px 25px 25px;
            margin: 0 auto;
            border-radius: 20px 20px;
            position: relative;
            z-index: 1;
        }

        .c1 {
            /* color: #b9156c;  7abbet l lon use it ba3den*/
            color: #991a1a;
            border: 3px solid #991a1a;
        }

        .c2 {
            color: black;
            border: 3px solid black;
        }

        .c3 {
            color: green;
            border: 3px solid green;
        }

        .c4 {
            color: darkblue;
            border: 3px solid darkblue;
        }

        .counter:before,
        .counter:after {
            content: "";
            background: #f3f3f3;
            border-radius: 20px;
            box-shadow: 4px 4px 2px rgba(0, 0, 0, 0.2);
            position: absolute;
            left: 15px;
            top: 15px;
            bottom: 15px;
            right: 15px;
            z-index: -1;
        }

        .counter:after {
            background: transparent;
            width: 100px;
            height: 100px;
            border: 15px solid;
            border-top: none;
            border-right: none;
            border-radius: 0 0 0 20px;
            box-shadow: none;
            top: auto;
            left: -10px;
            bottom: -10px;
            right: auto;
        }

        .counter .counter-icon {
            font-size: 35px;
            line-height: 35px;
            margin: 0 0 15px;
            transition: all 0.3s ease 0s;
        }

        .counter:hover .counter-icon {
            transform: rotateY(360deg);
        }

        .counter .counter-value {
            color: #555;
            font-size: 30px;
            font-weight: 600;
            line-height: 20px;
            margin: 0 0 20px;
            display: block;
            transition: all 0.3s ease 0s;
        }

        .counter:hover .counter-value {
            text-shadow: 2px 2px 0 #d1d8e0;
        }

        .counter h5 {
            font-size: 17px;
            font-weight: 700;
            text-transform: uppercase;
            margin: 0 0 15px;
        }

        @media screen and (max-width: 990px) {
            .counter {
                margin-bottom: 40px;
            }
        }
    </style>
    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>

</html>