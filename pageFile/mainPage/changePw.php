<!DOCTYPE HTML> 
<html>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<body align="center">

<?php
error_reporting(0);
session_start();

$con = mysql_connect("hdm-139.hichina.com","hdm1390571","lcx411370939");
if (!$con) {
  die('Error connecting: ' . mysql_error());
}
mysql_select_db("hdm1390571_db", $con);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(!mysql_num_rows(mysql_query("SELECT * FROM user WHERE acc='$_POST[acc]' AND email='$_POST[email]' "))) {
    echo "<script>alert('Wrong Account or Wrong Email'); history.go(-1);</script>";
  }

  else if (strlen($_POST["pw"])<6 | strlen($_POST["pw"])>15) {
    echo "<script>alert('Password lengh must NOT be less than 6 or more than 15'); history.go(-1);</script>";
  } else if (!preg_match("/^[a-zA-Z0-9_]*$/",$_POST["pw"])) {
    echo "<script>alert('Only letters, numbers and _ are available'); history.go(-1);</script>";
  }

  else if($_POST["pw"]!=$_POST["repw"]) {
    echo "<script>alert('Passwords do NOT match'); history.go(-1);</script>";
  }

  else {
    mysql_query("UPDATE user  SET pw='$_POST[pw]' WHERE acc='$_POST[acc]' ");
    echo "<script> alert('Success'); history.go(-1); </script>"; 
  }
}

?>

<h2>忘记密码</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  注册邮箱: <input type="text" name="email">
  <br><br>
  账号: <input type="text" name="acc">
  <br><br>
  新密码: <input type="password" name="pw">
  <br><br>
  新密码: <input type="password" name="repw">
  <br><br>
  <input type="submit" name="submit" value="Done">
</form>

</body>
</html>