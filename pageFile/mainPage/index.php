<!DOCTYPE html>
<html lang="zh-cn" class=" js csstransforms3d"><head>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Sidebar Transitions</title>
		<link href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
        <link href="square/_all.css" rel="stylesheet">
        <link href="flat/red.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<script src="js/modernizr.custom.js"></script>
        <script src="js/sidebarEffects.js"></script>
        <script>
            function hoCoSubmit()
            {

                //var data=JSON.stringify($("#homeworkContent").serializeArray()));
                var info=$("#homeworkContent").serializeArray();

                var data='{' +
                    '"CourseName":"'+info[0].value+'",' +
                    '"Content":"'+info[1].value+'",' +
                    '"User":"'+ '<?php error_reporting(0); session_start(); echo $_SESSION["acc"]?>'+'",' +
                    '"Deadline":"'+info[2].value+'"}';

                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("InfoShow").innerHTML = xmlhttp.responseText;

                    }
                }

                xmlhttp.open("GET","upload.php?data="+data,true);
                xmlhttp.send();
                alert("Insertion Done!");
            }

            function showInfo()
            {
                xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("InfoShow").innerHTML = xmlhttp.responseText;
                        addStunt();
                    }
                }
                xmlhttp.open("GET","query.php?q=info&user=<?php error_reporting(0); session_start(); echo $_SESSION["acc"]?>",true);
                xmlhttp.send();
            }

            function submit() {
                var ar ;
                var num;
                var hmLogIdValue = [];
                var con = 0;
                while(con == 0)
                {
                    xmlhttp2 = new XMLHttpRequest();
                    xmlhttp2.onreadystatechange=function()
                    {
                        if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
                        {
                            ar = xmlhttp2.responseText;
                            ar = eval(ar);
                            num = ar.length;
                            //alert(num);
                            for (var i = 0; i < num; i++)
                            {
                                if ($('#check' + ar[i]).is(':checked') == false)
                                    hmLogIdValue[i] = 0;
                                else
                                    hmLogIdValue[i] = 1;
                                //alert(hmLogIdValue[i]);
                            }

                            xmlhttp = new XMLHttpRequest();
                            var dataSent = [];
                            //alert(num);
                            var finalSent = "";
                            for (var i = 0; i < hmLogIdValue.length; i++) {
                                if (i != 0) finalSent = finalSent + '&';

                                dataSent[i] = ar[i] + '=' + hmLogIdValue[i];
                                //alert(dataSent[i]);
                                finalSent = finalSent + dataSent[i];
                            }
                            //alert(ar[0]);
                            //alert(hmLogIdValue[0]);
                            xmlhttp.open("GET", "tick.php/?" + finalSent, true);
                            xmlhttp.send();
                            //alert(finalSent);
                            alert("Modify done!");

                        }
                    }
                    xmlhttp2.open("GET","query.php/?q=getParaA&user=<?php error_reporting(0); session_start(); echo $_SESSION["acc"]?>");
                    xmlhttp2.send();
                    con = con + 1 ;
                }
            }



        </script>
        <style>
            .wrapper
            {
                text-align: center;
            }

            .homework_content_brief{
                width: 88%;
            }

            .homework_content_concrete{
                margin-left: 4%;
                margin-right:4%;
            }
        </style>
    </head>
    <body>
		<div id="st-container" class="st-container">
			<!-- content push wrapper -->
			<div class="st-pusher">
                        <nav class="st-menu st-effect-3" id="menu-3">
                            <h2 class="icon icon-lab">Nav Bar</h2>
                            <ul>
                                <li><a class="icon" onclick="showInfo()">Homework</a></li>
                                <li><a class="icon" data-toggle="modal" data-target="#myModal">New Homework</a></li>
                                <li><a class="icon" data-toggle="modal" data-target="#myModal2" href="#">Change Password</a></li>
                                <li><a class="icon" href="../logIn/Login.html">Logout</a></li>
                            </ul>
                        </nav>

                        <div class="st-content"><!-- this is the wrapper for the content -->
                                <div class="st-content-inner"><!-- extra div for emulating position:fixed of the menu -->
                                   <div class="pinned">
                                        <ol class="breadcrumb" style="font-size: 25px">
                                            <li>
                                                <div id="st-trigger-effects">
                                                <a data-effect="st-effect-3" >
                                                    <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>  HomeworkPlanner
                                                </a>
                                                </div>
                                            </li>
                                            <div class="pull-right"><a id="searchButton" onclick="alert('Hey!')" href="#"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></div>
                                       </ol>
                                   </div>

                                </div><!-- /st-content-inner -->
                            <div id="InfoShow">
                                <label style="font-size: larger;margin-left: 10%;margin-top: 10%" ><?php session_start(); echo "Welcome, ".$_SESSION["acc"]."! <br>Click 'Homework' To check Your Homework!!"?></label>
                            </div>
                            <div id="resultShow"></div>

                        </div><!-- /st-content -->
            </div><!-- /st-pusher -->

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Task</h4>
                    </div>
                    <div class="modal-body">
                        <form id="homeworkContent" name="homeworkContent">
                            <div class="form-group">
                                <label>CourseName</label>
                                <input type="text" class="form-control" id="CourseName" name="CourseName" placeholder="Enter name of course">
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <input type="text" class="form-control" id="Content" name="Content" placeholder="Enter content">
                            </div>
                            <div class="form-group">
                                <label>Deadline</label>
                                <input type="text" class="form-control" id="Deadline" name="Deadline" placeholder="Enter deadline">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button"   class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" id="hoCoSubmit" onclick="hoCoSubmit()" data-dismiss="modal" class="btn btn-success">Create Item</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel2">Add Task</h4>
                    </div>
                    <div class="modal-body">
                        <form id="PasswordChange" name="PasswordChange" method="post" action="changePw.php">
                            <div class="form-group">
                                <label>Your Former Password:</label>
                                <input type="text" class="form-control" id="formerPassword" name="oldpw" placeholder="Former password">
                            </div>
                            <div class="form-group">
                                <label>New Password:</label>
                                <input type="text" class="form-control" id="newPassword" name="pw" placeholder="New Password">
                            </div>
                            <div class="form-group">
                                <label>New Password Again:</label>
                                <input type="text" class="form-control" id="newPassword2" name="repw" placeholder="New Password Again">
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" id="hoCoSubmit2"   data-dismiss="modal" class="btn btn-success">Change Password</button>
                    </div>
                </div>
            </div>
        </div>
        </div><!-- /st-container -->
        <script src="http://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
        <script src="http://cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="js/jquery.pin.min.js"></script>
        <script src="js/stickUp.js"></script>
        <script src="js/classie.js"></script>
        <script src="js/icheck.js"></script>
        <script src="js/function.js"></script>
        <script src="js/sidebarEffects.js"></script>

        <script type="text/javascript">
            $(".pinned").pin();


        </script>

    </body>
</html>

