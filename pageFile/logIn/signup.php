<?php
error_reporting(0);
$con = mysql_connect("hdm-139.hichina.com","hdm1390571","lcx411370939");
if (!$con) {
    die('Error connecting: ' . mysql_error());
}
mysql_select_db("hdm1390571_db", $con);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        echo "<script>alert('E-mail is required'); history.go(-1);</script>";
    }
    else if (strlen($_POST["acc"])<6 | strlen($_POST["acc"])>15) {
        echo "<script>alert('Username lengh must NOT be less than 6 or more than 15'); history.go(-1);</script>";
    }
    else if (!preg_match("/^[a-zA-Z0-9_]*$/",$_POST["acc"])) {
        echo "<script>alert('Only letters, numbers and _ are available'); history.go(-1);</script>";
    }
    else if(mysql_num_rows(mysql_query("SELECT * FROM user WHERE acc='$_POST[acc]' "))) {
        echo "<script>alert('Unavailable username'); history.go(-1);</script>";
    }

    else if (strlen($_POST["pw"])<6 | strlen($_POST["pw"])>16) {
        echo "<script>alert('Password lengh must NOT be less than 6 or more than 15'); history.go(-1);</script>";
    } else if (!preg_match("/^[a-zA-Z0-9_]*$/",$_POST["pw"])) {
        echo "<script>alert('Only letters, numbers and _ are available'); history.go(-1);</script>";
    }

    else if($_POST["pw"]!=$_POST["repw"]) {
        echo "<script>alert('Passwords do NOT match'); history.go(-1);</script>";
    }

    else {
        $email=$_POST["email"];
        $acc=$_POST["acc"];
        $pw=$_POST["pw"];
        mysql_query("INSERT INTO user(email, acc, pw)
                 VALUES('$email','$acc','$pw')");
        echo "<script> alert('Success'); history.go(-1);</script>";
    }
}

