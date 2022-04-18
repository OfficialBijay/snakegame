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

$full_name = $_POST['full_name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM players where email='$email' or username='$username'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    echo "<script>
    alert('The email or username you provided is already exist , try different one');
    window.location.href='../index.html';
    </script>";
    return;
}
$sql1 = "INSERT INTO players(full_name, email, username, password,high_score) VALUES ('$full_name','$email','$username','$password',0)";
$result1 = mysqli_query($conn, $sql1);
if (!$result1) {
    echo "<script>
    alert('Something went wrong');
    window.location.href='../index.html';
    </script>";
    return;
}

echo "<script>
    window.location.href='../index.html';
    </script>";

?>