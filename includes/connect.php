<?php

$con=mysqli_connect('localhost','root','','mystore');

if(!$con){
    // echo "connected";
     die(mysqli_error($con));
}

?>