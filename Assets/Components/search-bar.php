<!-- Panchali -->
<!-- Search bar component -->

<div class="searchbar">
<form method="post" action="">
    <input type="text" style="padding: 1rem 2rem; border-radius: 1rem;" name="searchTerm" placeholder="Search Category Name" value="<?php echo isset($_POST['searchTerm']) ? $_POST['searchTerm'] : ''; ?>" style="padding: 0.5rem; margin-bottom: 1rem;">
    <input type="submit" value="Search" style="padding: 1rem 2rem; background-color: #F2613F; border: none; color: white; border-radius: 1rem;">
</form>
</div>

