<?php

// Use same config file in external folder
require("../Config.php");

//check if there is a logged in user and if the role is 3 
if (!isset($_SESSION["LoggedIN_Volunteer"]) || $_SESSION["LoggedIN_Volunteer"] != 1)
    header("Location: ../index.php");
