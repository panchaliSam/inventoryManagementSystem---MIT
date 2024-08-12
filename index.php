<?php
  //Start the session
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Inventory</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Linking the Bootstrap styles -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />

    <!-- Including jQuery library from Google CDN for easier JavaScript programming -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <!-- Including Bootstrap's JavaScript for interactive components like modals, dropdowns, etc. -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- CSS imports -->
    <link rel="stylesheet" href="./Assets/CSS/index.css"/>
    <link rel="stylesheet" href="./Assets/CSS/navbar.css"/>
    <link rel="stylesheet" href="./Assets/CSS/signInCard.css"/>
    <link rel="stylesheet" href="./Assets/CSS/alert.css"/>

    <!--JS imporsts-->

  </head>
  <body>

    <?php
      if (isset($_SESSION['show_login_alert']) && $_SESSION['show_login_alert'] === true) {

          if (isset($_GET['status']) and $_GET['status'] == 'success') {

              $alertClass = 'alert alert-success'; // CSS class for the alert (success, danger, etc.)
              $iconClass = 'fa fa-check'; // CSS class for the icon (font-awesome classes)
              $alertTitle = 'Login Success!'; // Title for the alert
              $alertMessage = 'You have successfully logged in!'; // Message for the alert

              include './Assets/Components/alert.php'; // Include the alert component

              // Unset the session variable
              unset($_SESSION['show_login_alert']);
          }
      }
    ?>

    <!--Componet imports-->
    <!--Include navbar component-->
    <?php
        include_once "./Assets/Components/navbar.php"
    ?>

    <!--Include signIn Card-->
    <?php
      include_once "./Assets/Components/signInCard.php"
    ?>

    <!--JS imporsts-->
    <!--navbar.js-->
    <script src="./Assets/JS/navbar.js"></script>
    <script src="./Assets/JS/signInPwd.js"></script>

  </body>
</html>
