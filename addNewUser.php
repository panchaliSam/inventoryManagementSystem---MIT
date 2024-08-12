<?php
  // Start the session
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Add New User</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Linking the Bootstrap styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />

    <!-- Including jQuery library from Google CDN for easier JavaScript programming -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <!-- Including Bootstrap's JavaScript for interactive components like modals, dropdowns, etc. -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- CSS imports -->
    <link rel="stylesheet" href="./Assets/CSS/index.css"/>
    <link rel="stylesheet" href="./Assets/CSS/navbar.css"/>
    <link rel="stylesheet" href="./Assets/CSS/signInCard.css"/>
    <link rel="stylesheet" href="./Assets/CSS/alert.css"/>
  </head>
  <body>

    <!-- Include navbar component -->


    <div class="container">
      <h2 class="mt-5">Add New User</h2>

      <?php
        if (isset($_GET['status']) && $_GET['status'] == 'success') {
          echo '<div class="alert alert-success">User added successfully!</div>';
        }
      ?>


      <form action="add_user.php" method="post">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="telephone">Telephone:</label>
          <input type="text" class="form-control" id="telephone" name="telephone" required>
        </div>
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
          <label for="isAdmin">Admin:</label>
          <select class="form-control" id="isAdmin" name="isAdmin" required>
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Add User</button>
      </form>
    </div>

    <!-- JS imports -->
    <script src="./Assets/JS/navbar.js"></script>
  </body>
</html>
