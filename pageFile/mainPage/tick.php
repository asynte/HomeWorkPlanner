<?php
/**
 * Created by PhpStorm.
 * User: KiwiDc
 * Date: 6/14/15
 * Time: 09:20
 */

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

$num = 0;
$tickID = [];
$tickValue = [];
for($i = 0;$i <= 100;$i++) {
    if (isset($_GET[$i])) {
        $tickID[$num] = $i;
        $tickValue[$num] = $_GET[$i];
        $num = $num + 1;
    }
}
for ($i = 0;$i<$num;$i++)
{
    echo "tickID=";
    echo $tickID[$i];
    echo "  ";
    echo "tickValue=";
    echo $tickValue[$i];
    echo "<br>";
    $sql = mysql_query("update hwLog set Tick = $tickValue[$i] where hwLogId = $tickID[$i]");
}



