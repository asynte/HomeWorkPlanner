<?php
error_reporting(0);
$order = $_GET['q'];
$user = $_GET['user'];

$json;
$i;



if(strnatcmp($order,"getParaA") == 0)
{
    $link = mysql_connect("hdm-139.hichina.com","hdm1390571","lcx411370939") or die("cannot connect!" . mysql_error());
    if (!($link)) {
        echo "Fail connecting!";
    }

    $db_selected = mysql_select_db("hdm1390571_db", $link);
    if (!($db_selected)) {
        echo "Fail connecting to database!";
    }

    $sqlMod = mysql_query("select * from hwLog where user = '$user'");
    $hmLogID = array();
    $i = 0;

    while ($info2 = mysql_fetch_array($sqlMod)) {
        $hmLogID[$i] = $info2[0];
        $i = $i + 1;
    }


    $json = json_encode($hmLogID);
    echo $json;

}


if(strnatcmp($order,"info") == 0) {
    $link = mysql_connect("hdm-139.hichina.com","hdm1390571","lcx411370939") or die("cannot connect!" . mysql_error());
    if (!($link)) {
        echo "Fail connecting!";
    }

    $db_selected = mysql_select_db("hdm1390571_db", $link);
    if (!($db_selected)) {
        echo "Fail connecting to database!";
    }

    $sql = mysql_query("select * from hwLog where user='$user'");
    $sqlMod = mysql_query("select * from hwLog where user='$user'");
    $hmLogID = array();
    $i = 0;

    $sql = mysql_query("select * from hwLog where user='$user'");

    while ($info2 = mysql_fetch_array($sqlMod)) {
        $hmLogID[$i] = $info2[0];
        $i = $i + 1;
    }


    $json = json_encode($hmLogID);

    echo '<script src="http://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>';

    while ($info = mysql_fetch_array($sql)) {
        echo <<<EOF
          <div class="panel-heading" role="tab" id="heading$info[0]">
               <h4 class="panel-title">
                    <div class="wrapper">
                        <button class="btn btn-success homework_content_brief" data-toggle="collapse" data-parent="#accordion" href="#collapse$info[0]" aria-expanded="false" aria-controls="collapse$info[0]">
EOF;

        if ($info[4] == 1)
            echo "<div class='pull-left'><input type='checkbox' id='check$info[0]' name='check$info[0]' checked></div>";
        else
            echo "<div class='pull-left'><input type='checkbox' id='check$info[0]' name='check$info[0]'></div>";


        echo <<<EOF


                            $info[1] $info[3]
                            <span class="glyphicon glyphicon-chevron-down pull-right" aria-hidden="true" ></span>
                        </button>
                    </div>
               </h4>
          </div>
          <div id="collapse$info[0]" class="panel-collapse collapse homework_content_concrete" role="tabpanel" aria-labelledby="heading$info[0]">
               <div class="panel-body">
                    <a href="#"><span class="glyphicon glyphicon-remove pull-right" style="font-size: larger;color:orangered"></span></a>
                    <a href="#"><span class="glyphicon glyphicon-edit pull-right" style="font-size: larger;color:darkgreen">&nbsp</span></a><br>
                    Content:
                    <br><lable><b>$info[2]</b></lable><br><br>

                    Deadline:
                    <br><lable><b>$info[3]</b></lable><br>
                </div>
          </div>
EOF;
        echo '</div>';
    }


    echo <<<EOF

<script type="text/javascript">
  function submit() {
      var ar = $json;
      var num = $i;
      var hmLogIdValue = [];

      for (var i = 0; i < num; i++) {
          if ($('#check' + ar[i]).is(':checked') == false)
              hmLogIdValue[i] = 0;
          else
              hmLogIdValue[i] = 1;
      }

      xmlhttp = new XMLHttpRequest();

      var dataSent = [];
      var finalSent = "";
      for (var i = 0; i < hmLogIdValue.length; i++) {
          if (i != 0) finalSent = finalSent + '&';

          dataSent[i] = ar[i] + '=' + hmLogIdValue[i];
          //alert(dataSent[i]);
          finalSent = finalSent + dataSent[i];
      }
      alert(finalSent);

      xmlhttp.open("GET", "tick.php/?" + finalSent, true);
      xmlhttp.send();
      alert("functionAddedNow!");
  }
</script>
<br><div class="wrapper"><button class="btn btn-info" id="submitChange" onclick="submit()">Submit Modification</button></div>

EOF;
//    echo $json;
//    echo json_encode($i);
}










