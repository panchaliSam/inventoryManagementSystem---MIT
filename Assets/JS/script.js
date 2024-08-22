function changeSignIn() {

    var Login = document.getElementById("Login");
    var forgotpass = document.getElementById("forgotpass");

    Login.classList.toggle("d-none");
    forgotpass.classList.toggle("d-none");


}

function login() {
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var rememberme = document.getElementById("rememberme");

    var f = new FormData();
    f.append("e", email.value);
    f.append("p", password.value);
    f.append("r", rememberme.checked);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var t = request.responseText;
            if (t == "success") {
                alert("Successfully Logged");
                window.location.href = "./Assets/Pages/category.php";
            } else {
                document.getElementById("msg").innerHTML = this.response;
                document.getElementById("msgdiv").className = "d-block";
            }
        }
    };

    request.open("POST", "loginProcess.php", true);
    request.send(f);
}



function forgotPassword() {

    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {

                alert("Verification code has sent to your Email. Please check your inbox");

            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();

}
function resetPassword() {

    var email = document.getElementById("email2");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vcode = document.getElementById("vc");

    var f = new FormData();
    f.append("e", email.value);
    f.append("n", np.value);
    f.append("r", rnp.value);
    f.append("v", vcode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                alert("Your Password Updated");

            } else {
                alert(t);
            }
        }
    };

    r.open("POST", "resetPasswordProcess.php", true);
    r.send(f);

}

