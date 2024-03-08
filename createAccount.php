<?php
  session_start();
  include "connection.php";

  if (isset($_SESSION['error']) && $_SESSION['error'] == true) {
    echo '<script>window.onload = function() { $("#modalMessage").html("Username already existed! Please change your username."); $("#messageModal").modal("show"); }</script>';
    session_unset();
    session_destroy();
  }

  if(isset($_POST['createBtn'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $num = 0;
        $query = "SELECT COUNT(*) AS num FROM users WHERE username = '$username'";
        $query_run = mysqli_query($con, $query);
        foreach ($query_run as $row) {
            $num = $row["num"];
        }

        if ($num == 0) {
          $query = "INSERT INTO users (username, password) VALUES ('$username', '$password') ";
          $query_run = mysqli_query($con, $query);

          $_SESSION['accountCreated'] = true;
          header("Location: login.php"); 
          exit();
        } else {
            $_SESSION['error'] = true;
        }
    }

  
?>


<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christian Isorena</title>
    <link rel="stylesheet" href="design.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Puritan:wght@400;700&display=swap" rel="stylesheet">
    <style>
      .logIn {
        background-color: #222831; 
        border: 3px solid #E69600;
        width: 434px;
        height: 617px;
        margin-top: 50px;
        border-radius: 15px;
        color: white;
      }

      .button {
        font-weight: 700;
        font-size: 20px;
        width: 403px;
        border: 2px solid #E69600;
     }
      
    </style>
  </head>

  <body class="body">
    <div class="container logIn">
      <form method='post'>
        <h3 class="text-center" style="font-weight: 700; margin-top: 50px;">CREATE ACCOUNT</h3>
        <p class="text-center">Create an account.</p>
        <div style="margin-top: 20px;" class="mb-3">
          <label for="username" class="form-label text">Username</label>
          <input style="border: 1px solid #E69600;" type="text" name="username" class="form-control" id="username" aria-describedby="username" required>
        </div>

        <div style="margin-top: 10px;" class="mb-3">
          <label for="pass" class="form-label text">Password</label>
          <input style="border: 1px solid #E69600;" type="password" name="password" class="form-control" id="pass" required>
        </div>

        <div>
          <button style="margin-top: 40px;" type="submit" name="createBtn" class="btn btn-outline-warning button">CREATE ACCOUNT</button>
        </div>

        <div>
          <button style="margin-top: 20px;" type="button" onclick="location.href = 'login.php';" class="btn btn-outline-warning button">LOG - IN</button>
        </div>
      </form>

    </div>

    <!-- MESSAGE MODAL -->
    <div class="modal fade" id="messageModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="background-color: #222831; border: 3px solid #E69600;">
                <div class="bg-color modal-header" style="border: none;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center" style="color: #000000">
                    <div class="justify-content-end">
                        <div class="text-center">
                        <h2 id="modalMessage" style="font-weight: 600; color: white"></h2>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
      var timeLimit = 3000; // 5 seconds

        // Close the modal after the specified time limit
        setTimeout(function() {
            $('#messageModal').modal('hide');
        }, timeLimit);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  </body>
</html>