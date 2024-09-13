<?php
// Use same config file in external folder
require("../Config.php");

//check if there is a logged in user and if the role is 2 
if (!isset($_SESSION["LoggedIN_NGO"]) || $_SESSION["LoggedIN_NGO"] != 1)
    header("Location: ../index.php");
