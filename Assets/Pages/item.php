<!-- Panchali -->
<!-- Category section content -->

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
        // include_once "../Components/admin-navbar.php"
        include_once "../Components/sideNavBar.php"
    ?>

    <div class="afterNavContent" style="padding-top: 50px; margin-top: 20px; padding-left: 50px; margin-left: 20px;">
      <div class="row" style="margin-left: 0; margin-right: 0;">
          <!-- Manage Inventory button aligned to the left -->
          <div class="col-xs-6 text-left">
            <a href="../PHP/itemDownload.php" class="btn btn-success">Download CSV</a>
          </div>
          
          <!-- Add Category button aligned to the right -->
          <div class="col-xs-6 text-right">
            <button type="button" class="btn btn-primary" style="padding: 1rem 2rem; border: none; color: white; border-radius: 1rem;" onclick="window.location.href='../PHP/itemAdd.php';">
              Add Item
            </button>
          </div>
        </div>

      <br><br>

      <!-- Include searchbar for category name search -->
      <?php
        echo '<center>';
        include_once "../Components/search-bar.php";
        echo '</center>';
      ?>

      <!-- Include category view cards -->
      <?php
          include_once "../PHP/itemView.php"
      ?>
    </div>
   
  </body>
</html>
