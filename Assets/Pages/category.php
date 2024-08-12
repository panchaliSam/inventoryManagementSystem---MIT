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

    <!--CSS imporsts-->
    <link rel="stylesheet" href="../CSS/category.css"/>
    <link rel="stylesheet" href="../CSS/navbar.css"/>
    <link rel="stylesheet" href="../CSS/index.css"/>

  </head>
  <body>

    <!--Componet imports-->
    <!--Include navbar component-->
    <?php
        include_once "../Components/admin-navbar.php"
    ?>

    <div class="afterNavContent" style="padding-top: 40px; margin-top: 50px;">

      <!-- Include searchbar for category name search -->
       <?php
        include_once "../Components/search-bar.php"
       ?>

      <!-- Include category view cards -->
      <?php
          include_once "../PHP/categoryView.php"
      ?>
    </div>

  </body>
</html>
