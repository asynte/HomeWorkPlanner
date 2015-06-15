<?php


$json = $_GET['data'];

$obj = json_decode($json,true);


$CourseName = $obj['CourseName'];
$Content = $obj['Content'];
$Deadline = $obj['Deadline'];
$User = $obj['User'];



error_reporting(0);


$link = mysql_connect("hdm-139.hichina.com","hdm1390571","lcx411370939") or die("cannot connect!".mysql_error());
if(!($link))
{
    echo "Fail connecting!";
}

$db_selected = mysql_select_db("hdm1390571_db",$link);
if(!($db_selected))
{
    echo "Fail connecting to database!";
}


mysql_query("insert into hwLog(CourseName,Content,Deadline,User) values('$CourseName','$Content','$Deadline','$User')",$link);



