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
        include_once "../Components/admin-navbar.php"
    ?>

    <div class="afterNavContent" style="padding-top: 80px; margin-top: 50px;">

      <div class="row" style="margin-left: 0; margin-right: 0;">
        <!-- Manage Inventory button aligned to the left -->
        <div class="col-xs-6 text-left">
          <button type="button" class="btn btn-primary" style="padding: 1rem 2rem; border: none; color: white; border-radius: 1rem;" data-toggle="modal" data-target="#manageInventoryModal">
            Manage Inventory
          </button>
        </div>
        
        <!-- Add Category button aligned to the right -->
        <div class="col-xs-6 text-right">
          <button type="button" class="btn btn-primary" style="padding: 1rem 2rem; border: none; color: white; border-radius: 1rem;" onclick="window.location.href='../PHP/categoryAdd.php';">
            Add Category
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
          include_once "../PHP/categoryView.php"
      ?>
    </div>
    <!-- Modal for Managing Inventory -->
    <div id="manageInventoryModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Manage Inventory</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Category ID</th>
                                <th>Category Name</th>
                                <th>Quantity</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch categories from the database
                            include_once "../PHP/categoryViewDeleteEdit.php"; // Assuming this script fetches the categories

                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['category_id'] . "</td>";
                                echo "<td>" . $row['category_name'] . "</td>";
                                echo "<td>" . $row['quantity'] . "</td>";
                                echo "<td>" . $row['description'] . "</td>";
                                echo "<td>
                                        <a href='editCategory.php?id=" . $row['category_id'] . "' class='btn btn-primary btn-sm'>
                                            <span class='glyphicon glyphicon-edit'></span>
                                        </a>
                                        <a href='deleteCategory.php?id=" . $row['category_id'] . "' class='btn btn-danger btn-sm'>
                                            <span class='glyphicon glyphicon-trash'></span>
                                        </a>
                                      </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="../PHP/categoryDownload.php" class="btn btn-success">Download CSV</a>
                </div>
            </div>

        </div>
    </div>


  </body>
</html>
