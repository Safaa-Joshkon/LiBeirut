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
    <nav class="navbar navbar-expand-sm bg-white sticky-top custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="../images/لبيروت___5_-removebg-preview.png" alt="" style="width: 150px; height: auto;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="Events.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Events
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="Events.php">View Events</a></li>
                            <li><a class="dropdown-item" href="EventAdd.php">Add Events</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="NGO.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Volunteers
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="Volunteers.php">View Volunteers</a></li>
                            <li><a class="dropdown-item" href="VolunteerAdd.php">Add Volunteers</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Requests.php">Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Logout.php">Logout</a>
                    </li>
                </ul>
                <form class="form-inline">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1" id="txtSearch">
                        <div class="input-group-prepend">
                            <i class="fa fa-search input-group-text" aria-hidden="true" id="basic-addon1"></i>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </nav>
    <style>
        .custom-navbar {
            height: 130px !important;
        }
    </style>
</body>

</html>