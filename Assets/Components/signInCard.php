<!-- SignIn Card Implementation -->
<!-- Developer - Panchali -->

<!-- This signIn card is used by both Admin and Employee -->

<head>
    <!-- Add FontAwesome for the eye icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<div class="signInFormContainer">
    <div class="signInCard">
        <div class="signInCardHeading">
            <h2>Sign In</h2>
        </div>
        <div class="signInForm">
            <form action="./Assets/PHP/signInLogic.php" method="post">
                <div class="signInUserName">
                    <label for="username">Username:</label><br>
                    <input type="text" id="username" name="username" placeholder="Your UserName">
                </div>
                <div class="signInPassword">
                    <label for="pwd">Password:</label><br>
                    <div class="passwordWrapper">
                        <input type="password" id="pwd" name="pwd" placeholder="Password">
                        <i class="fas fa-eye" id="togglePassword"></i>
                    </div>
                </div>
                <div class="signInBtn">
                    <input type="submit" id="submitBtn" value="Sign In">
                </div>
            </form>
        </div>   
    </div>
</div>
