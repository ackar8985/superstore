<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Inventory Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="startpage.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="row">
        <div id="left-pane" class="col-sm-4">
            <button type="button" class="btn" id="signInButton">Sign In</button>
            <button type="button" class="btn" id="signUpButton">Sign Up</button>
        </div>
        <div id="right-pane" class="col-sm-8">
            <div id="myTitle">
                <h1 style="display: block; position: relative; text-align: center; margin-top: calc(30% - 100px);">Inventory management</h1>
                <h4 style="display: block; position: relative; text-align: center;">Duc Minh Nguyen</h4>
                <h4 style="display: block; position: relative; text-align: center;">T00707077</h4>
            </div>
            

            <div class="modalContainer" id="signin_modal">
                <form method="POST" action="controller.php" class="modal_form">
                    <input type="hidden" name="Page" value="StartPage">
                    <input type="hidden" name="Command" value="SignIn">

                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="" class="form-control" name="username" id="username">
                      </div>
                      
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" id="password_signin">
                    </div>

                    <div id="signInMessage">
                        <p style='color: #8b0300;'>Incorrect Username or Password</p>
                    </div>

                    <button type="button" class="btn" id="cancelSignIn">Cancel</button>
                    <button type="submit" class="btn" id="submitSignIn">Submit</button>
                </form>
            </div>
            <div class="modalContainer" id="signup_modal">
                <form method="post" action="controller.php" class="modal_form">
                    <input type="hidden" name="Page" value="StartPage">
                    <input type="hidden" name="Command" value="SignUp">

                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="" class="form-control" name="username" id="username_signup">
                    </div>

                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                      
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" id="password_signup">
                    </div>

                    <input type = "hidden" name="AccType" value="Customer">

                    <div id="signUpMessage">
                    </div>

                    <button type="button" class="btn" id="cancelSignUp">Cancel</button>
                    <button type="submit" class="btn" id="submitSignUp">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

<script>
    $('#signInButton').click(function() {
        $('#myTitle').css("display", "none");
        $('#signup_modal').css("display", "none");
        $('#right-pane').css("background-color", "darkgoldenrod");
        $('#signin_modal').css("display", "block");
    })
    $('#signUpButton').click(function() {
        $('#right-pane').css("background-color", "rgb(230, 185, 73)");
        $('#myTitle').css("display", "none");
        $('#signin_modal').css("display", "none");
        $('#signup_modal').css("display", "block");
    })
    $('#cancelSignIn').click(function() {
        $('#right-pane').css("background-color", "white");
        $('#myTitle').css("display", "block");
        $('#signin_modal').css("display", "none");
        $('#signup_modal').css("display", "none");
    })

    $('#cancelSignUp').click(function() {
        $('#right-pane').css("background-color", "white");
        $('#myTitle').css("display", "block");
        $('#signin_modal').css("display", "none");
        $('#signup_modal').css("display", "none");
    })

    function showSignInFailed() {
        $('#myTitle').css("display", "none");
        $('#signup_modal').css("display", "none");
        $('#right-pane').css("background-color", "darkgoldenrod");
        $('#signin_modal').css("display", "block");
        $('#signInMessage').css("display", "block");
    }

    function showSignUpSuccess() {
        $('#right-pane').css("background-color", "darkgoldenrod");
        $('#myTitle').css("display", "none");
        $('#signin_modal').css("display", "block");
        $('#signup_modal').css("display", "none");
        $('#signInMessage').html("<p style='color: lime'>Registration successful. Please log in.</p>");
        $('#signInMessage').css("display", "block");
    }

    function showSignUpFailed() {
        $('#right-pane').css("background-color", "rgb(230, 185, 73)");
        $('#myTitle').css("display", "none");
        $('#signin_modal').css("display", "none");
        $('#signup_modal').css("display", "block");
        $('#signUpMessage').html("<p style='color: #8b0300'>Registration failed. Username already exists.</p>");
        $('#signUpMessage').css("display", "block");
    }

    <?php 
        if (!isset($validLogin) or $validLogin) {
        } 
        elseif (!$validLogin) {
            echo("showSignInFailed();");
        }

        if (isset($signUpFailed)) {
            if ($signUpFailed) {
                echo("showSignUpFailed();");
            } else {
                echo("showSignUpSucess();");
            }
        }
    ?>

    //Submitting forms

</script>

</html>