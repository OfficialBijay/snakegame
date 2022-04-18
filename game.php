<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <title>Snake Game</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="./CSS/bootstrap/css/bootstrap.min.css" />
  <link href="./CSS/style.css" rel="stylesheet" />
</head>

<body>
  <h1>Snake Game</h1>
  <div class="row">
    <div class="col-lg-4">
      <div class="wrapper1">
        <div class="greet">Welcome <?php
                                    if ($_SESSION) {
                                      $array = explode(' ', $_SESSION['full_name'], 3);
                                      echo $array[0];
                                    } else echo "Player" ?>!</div>
        <div class="controls">
          <!-- <button id="newgame">New Game</button><br /><br /> -->
          <button id="start">Start</button><br /><br />
          <button id="pause">Pause</button>
          <a href="./index.html" style="text-decoration: none;"><span class="cust_btn login">Login</span></a>
        <a href="./PHP/logout.php" style="text-decoration: none;"><span class="cust_btn logout">Logout</span></a>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="wrapper2">
        <div id="gameover">Game Over!</div>
        <canvas class="canvas" height="300px" width="300px"> </canvas>
        <form method="post" action="./PHP/submit_score.php">
          <input type="number" class="score" id="score" name="curr_score" readonly>
          <input type="submit" value="Submit" id="submit">

        </form>
        
      </div>
    </div>
    <div class="col-lg-4">
      <div class="wrapper3">
        <div class="high-score">
          <h2>Score Board</h2>
          <hr />
          <table class="score-board">
            <tr>
              <th>Username</th>
              <th>High Score</th>
            </tr>
            <?php
            if($_SESSION){
            require "./DB/database_connect.php";
            $sql = "SELECT username,high_score FROM players;";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
              echo "Something went wrong!";
              return;
            }
            $array = mysqli_fetch_all($result);
            $scores = array();
            foreach ($array as $key => $row) {
              $scores[$key] = $row[1];
            }
            array_multisort($scores, SORT_DESC, $array);
            foreach ($array as $r) {
            ?>
              <tr>
                <td><?php
                    if ($_SESSION) {
                      if($_SESSION['username']==$r[0])  echo '*'.$r[0];
                      else echo $r[0];
                    } else echo "Guest" ?></td>
                <td><?php
                    if ($_SESSION) {
                      echo $r[1];
                    } else echo "<i class='fa fa-info'></i>" ?></td>
              </tr>
            <?php
            }
          }
          else {
            ?>
            <tr>
                <td>Guest</td>
                <td><i class='fa fa-info'></i></td>
              </tr>
            <?php
            }
            ?>

          </table>
        </div>
        <div class="info">Please register yourself to save your progress</div>
      </div>
    </div>
  </div>
</body>
<?php
if ($_SESSION) {
  echo "<script>
          submit = document.getElementById('submit');
          login = document.querySelector('.login');
          logout = document.querySelector('.logout');
          info = document.querySelector('.info');
          submit.style.display = 'block';
          login.style.display = 'none';
          logout.style.display = 'block';
          info.style.display = 'none';
        </script>";
}
else {
  echo "<script>
          submit = document.getElementById('submit');
          login = document.querySelector('.login');
          logout = document.querySelector('.logout');
          info = document.querySelector('.info');
          submit.style.display = 'none';
          login.style.display = 'block';
          logout.style.display = 'none';
          info.style.display = 'block';
        </script>";
}
?>
<script type="text/javascript" src="js/controls.js"></script>
<script type="text/javascript" src="js/fruit.js"></script>
<script type="text/javascript" src="js/snake.js"></script>
<script type="text/javascript" src="js/draw.js"></script>

</html>