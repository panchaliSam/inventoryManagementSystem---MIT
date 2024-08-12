<!-- Panchali -->
<!-- Search bar component -->

<form method="post" action="">
    <input type="text" name="searchTerm" placeholder="Search Category Name" value="<?php echo isset($_POST['searchTerm']) ? $_POST['searchTerm'] : ''; ?>" style="padding: 0.5rem; margin-bottom: 1rem;">
    <input type="submit" value="Search" style="padding: 0.5rem 1rem;">
</form>
