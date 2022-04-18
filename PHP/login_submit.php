<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Snake Game</title>
  <link href="../CSS/style.css" rel="stylesheet">

</head>
<body>
  <h1>Snake Game</h1>
</body>
</html>
<?php
require "../DB/database_connect.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM players WHERE username = '$username' and password = '$password'";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
if (!$num) {
    echo "<script>
    alert('The Email or Password you provided does not matches with our records');
    window.location.href='../index.html';
    </script>";
    return;
}

  $row = mysqli_fetch_array($result);
  $_SESSION['player_id'] = $row['player_id'];
  $_SESSION['full_name'] = $row['full_name'];
  $_SESSION['username'] = $row['username'];
  $_SESSION['high_score'] = $row['high_score'];
  // print_r($_SESSION);
  // exit;

echo "<script>
    window.location.href='../game.php';
    </script>";


// $row = mysqli_fetch_assoc($result);
// $username = $row['username'];
// $full_name = $row['full_name'];

// print_r($row);

?>