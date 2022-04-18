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

$player_id = isset($_SESSION['player_id']) ? $_SESSION['player_id'] : NULL;
$sql1 = "SELECT * FROM players WHERE player_id = '$player_id'";
$result = mysqli_query($conn, $sql1);
if (!$result) {
  echo "Something went wrong!";
  return;
}
$row = mysqli_fetch_assoc($result);
$username = $row['username'];
$full_name = $row['full_name'];
$new_score = $_POST['curr_score'];
$high_score = $_SESSION['high_score'];
// $score = strip_tags( trim( (int)$_POST['player_score']) );
if ($new_score > $high_score) {
  $sql = "UPDATE players SET high_score='$new_score' WHERE username='$username'";
  $result = mysqli_query($conn, $sql);
  $result = mysqli_query($conn, $sql1);
  $row = mysqli_fetch_assoc($result);
  $_SESSION['high_score'] = $row['high_score'];
  echo "<script>
    alert('Congratulations! You have achieved new High Score! Now please Restart the game to play again');
    window.location.href='../game.php';
    </script>";
}
echo "<script>
    alert('Better Luck next time! Because you did not beat your high score. Now please Restart the game to play again');
    window.location.href='../game.php';
    </script>";
?>