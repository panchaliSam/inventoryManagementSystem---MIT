// Navbar logout logic
document
    .getElementById("imageButton")
    .addEventListener("click", function () {
        var logoutButton = document.getElementById("logoutButton");
        if (logoutButton.style.display === "none") {
            logoutButton.style.display = "block";
        } else {
            logoutButton.style.display = "none";
        }
    });
