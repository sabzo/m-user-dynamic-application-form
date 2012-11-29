<?php
//Transfers me back to the page I need
$location = $_POST['back_to'];
header("Location: ../include/".$location);

?>