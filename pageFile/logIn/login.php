<?php
error_reporting(0);
session_start();

//connect to database
$con = mysql_connect("hdm-139.hichina.com","hdm1390571","lcx411370939");

if (!$con) {
    die('Error connecting: ' . mysql_error());
}
mysql_select_db("hdm1390571_db", $con);

//login
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(!mysql_num_rows(mysql_query("SELECT * FROM user WHERE acc='$_POST[acc]' "))) {
        echo "<script>alert('User does NOT exist'); history.go(-1);</script>";
    }
    else if(mysql_num_rows(mysql_query("SELECT * FROM user WHERE acc='$_POST[acc]' AND pw='$_POST[pw]' "))) {
        $_SESSION["acc"]=$_POST["acc"];
        echo "<script> alert('Success');parent.location.href='../mainPage/index.php'; </script>";
    }
    else {
        echo "<script>alert('Wrong password'); history.go(-1);</script>";
    }
}


