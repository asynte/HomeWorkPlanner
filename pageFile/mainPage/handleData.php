<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Demo</title>
</head>
<body>
<div id="InfoShow"></div>
<?php

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

$hmLogID = Array();
$hmLogID[3] = 4;
$i = 0;

$sql = mysql_query("select * from hwLog");

while($info = mysql_fetch_array($sql))
{
    $hmLogID[$i] = $info[0];
    $i = $i + 1;
}



$json = json_encode($hmLogID);

echo "$json";
//echo "$hmLogID[3]"
?>

<script type="text/javascript">
    // can use json_encode here to pass $ar to JavaScript array
    var ar = <?php echo json_encode($hmLogID) ?>;
    var hmLogIdValue = [0,0,0,1,0];

    xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("InfoShow").innerHTML = xmlhttp.responseText;
        }
    }

    var dataSent = [];
    var finalSent = "";
    for (var i = 0;i < hmLogIdValue.length;i++ )
    {
        if(i != 0) finalSent = finalSent + '&';

        dataSent[i] = ar[i] +'=' + hmLogIdValue[i];
        //alert(dataSent[i]);
        finalSent = finalSent + dataSent[i];
    }
    alert(finalSent);

    xmlhttp.open("GET","tick.php/?"+finalSent,true);
    xmlhttp.send();

</script>
</body>
</html>