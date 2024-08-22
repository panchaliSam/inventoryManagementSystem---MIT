
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>ByteForce - Login</title>
</head>
<body>

    <!----------------------- Main Container -------------------------->
    <div class="Container d-flex justify-content-center align-items-center min-vh-100">


    <!----------------------- Login Container -------------------------->

        <div class="row border rounder-5 p-3 bg-white shadow box-area">

    <!--------------------------- Left Box ----------------------------->
                <div class="col-md-6 rounder-4 d-flex justify-content-center align-items-center flex-column left-box" style="background:#332e39;">
                        <div class="featured-image mb-3">
                            <img src="images/inventory.svg" class="img-fluid" style="width: 250px;">
                        </div>
                        <p class="text-white fs-2" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">ByteForce Inventory</p>
                        <small class="text-white text-wrap text-center" style="width: 17rem; font-family: 'Courier New', Courier, monospace;"></small>
                </div>


    <!-------------------- ------ Right Box ---------------------------->
                <div class="col-md-6 right-box " id="Login">
                    <div class="row align-items-center">
                        <div class="header-text mb-4">
                                <p>Hello, Again</p>
                                <p>Login to the system .</p>
                        </div>

                <!-- Cookie -->
                        <?php

                            $email = "";
                            $password = "";

                            if (isset($_COOKIE["email"])) {
                                $email = $_COOKIE["email"];
                            }

                            if (isset($_COOKIE["password"])) {
                                $password = $_COOKIE["password"];
                            }

                            ?>
                        <div class="col-12 d-none" id="msgdiv">
                                <div class="alert alert-danger" role="alert" id="msg">
                                    
                                </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" id="email" class="form-control form-control-lg bg-light fs-6" value="<?php echo $email; ?>" placeholder="Email address">
                        </div>

                        <div class="input-group mb-1">
                            <input type="password" id="password" class="form-control form-control-lg bg-light fs-6" value="<?php echo $password; ?>" placeholder="password">
                        </div>

                        <div class="input-group mb-5 d-flex justify-content-between">
                            <div class="from-check">
                                <input type="checkbox" class="from-check-input" value="" id="rememberme">
                                <label for="formCheck" class="form-check-label text-secondaray"><small>Remember Me</small></label>
                            </div>
                            <div class="fogot">
                                <small> <a href="#" onclick="changeSignIn();" >Forgot Password?</a></small>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <!-- <button class="btn btn-lg btn-primary w-100 fs-6">Login</button> -->
                            <a href="#" class="btnlogin w-100 fs-6" onclick="login();">Login</a>
                        </div>

                       

                    </div>

                </div>

                 
         <!--Forgot password design-->
                <div class="col-md-6 right-box d-none" id="forgotpass">
                    <div class="row align-items-center">
                        <div class="header-text mb-4">
                                <p>Forgot Password</p>
                               
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" id="email2" class="form-control form-control-lg bg-light fs-6" placeholder="Email address">
                        </div>
                        <div class="input-group mb-3" style="justify-content: right;">
                            <!-- <button class="btn btn-lg btn-primary w-100 fs-6">Login</button> -->
                            <a href="#" onclick="forgotPassword();" class="btnSendCode w-50 ">Send Code</a>
                        </div>
                        <div class="input-group mb-3" >
                            <input type="password" id="np" class="form-control form-control-lg bg-light fs-6" placeholder="New Password">
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" id="rnp" class="form-control form-control-lg bg-light fs-6" placeholder="Confirm Password">
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" id="vc" class="form-control form-control-lg bg-light fs-6" placeholder="Verification code">
                        </div>

                        <div class="input-group mb-5 d-flex justify-content-between">
                            <div class="fogot">
                                <small> <a href="#" onclick="changeSignIn();" >Back to login</a></small>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <!-- <button class="btn btn-lg btn-primary w-100 fs-6">Login</button> -->
                            <a href="#" onclick="resetPassword();" class="btnlogin w-100 fs-6">Change Password</a>
                        </div>

                    </div>

                </div>

        </div> 
    
    </div>

    <script src="script.js" ></script>
</body>
</html>