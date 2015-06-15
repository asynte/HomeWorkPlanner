<?php

//connect to database
$con = mysql_connect("hdm-139.hichina.com","hdm1390571","lcx411370939");
if (!$con)
  {
    die('Error connecting: ' . mysql_error());
  }

//create my database
if (mysql_query("CREATE DATABASE hdm1390571_db",$con))
  {
    echo "Database created";
  }
else
  {
    echo "Error creating database: " . mysql_error();
  }

//create table
mysql_select_db("hdm1390571_db", $con);
$sql = "CREATE TABLE user (
	    email varchar(30) not null,
        acc varchar(15) not null,
        pw varchar(15) not null,
        primary key(acc))";


$sql2 = "CREATE TABLE hwLog (
  hwLogId int NOT NULL AUTO_INCREMENT,
  CourseName varchar(32),
  Content varchar(200),
  Deadline varchar(32),
  Tick int(1) DEFAULT '0',
  PRIMARY KEY (hwLogId))";

mysql_query($sql,$con);
mysql_query($sql2,$con);

mysql_close($con);

?>