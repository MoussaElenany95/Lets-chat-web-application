<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Messenger</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,900" rel="stylesheet">
    <link rel="icon"  href="../assets/images/favicon.png">
    <style>
        span{
            color: red;
            display: block;
        }
    </style>
</head>
<body>
    <div class="signup-container">
            <div class="signup-left">
                <div class="title">
                    <h1>Lets Chat</h1>
                    <p>
                        Now you can chat with your friends and make new friends simultaneously.
                    </p>

                </div>

            </div>
            <div class="signup-right">
                <div class="form-area">

                    <form id="signup-form" method="post"  action="" enctype="multipart/form-data" >
                        <div class="group">
                            <h1 class="form-heading">CREATE NEW ACCOUNT</h1>
                        </div>
                        <div class="group">
                            <label for="img" id="img-label">
                                <img src="../assets/images/profile.png" id="preview-img">
                            </label>
                            <input  type="file" name="profile_img" id="img" class="file">
                            <span id="image_feedback"></span>
                        </div>
                        <div class="group">
                            <label for="full_name" id="full-name-label">Full name</label>
                            <input required type="text" name="full_name" id="full_name" class="control" placeholder="Enter Full Name ...">
                            <span id="name_feedback"></span>
                        </div>
                        <div class="group">
                            <label for="email" id="email-label">Email</label>
                            <input  required type="email" name="email" id="email" class="control" placeholder="Enter Email ...">
                            <span id="email_feedback"></span>
                        </div>

                        <div class="group">
                            <label for="password" id="password-label">Password</label>
                            <input required type="password" name="password" id="password" class="control" placeholder="Enter Password ...">
                            <span id="password_feedback"></span>
                        </div>
                        <div class="group">
                            <input type="submit" name="signup_submit" id="signup_submit" class="btn signup-btn control" value="Create account">
                        </div>
                        <div class="group">
                            <h6  id="login-link"  class="login-link">Already have an account<br> <b>login</b></h6>
                        </div>
                    </form>

                    <form id="login-form" method="post" action="" enctype="multipart/form-data">
                            <div class="group">
                                <h1 class="form-heading">Login</h1>
                            </div>
                            <div class="group">
                                <label for="email" id="email-label">Email</label>
                                <input type="email" name="email" id="login-email" class="control" placeholder="Enter Email ...">
                            </div>

                            <div class="group">
                                <label for="password" id="password-label">Password</label>
                                <input type="password" name="password" id="login-password" class="control" placeholder="Enter Password ...">
                            </div>
                            <div class="group">
                                <input type="submit" name="login_submit" id="login_submit" class="btn signup-btn control" value="Login">
                            </div>
                        <div class="group">
                            <h6 id="signup-link" class="login-link">Don't have an account<br><b> Signup now</b> </h6>
                        </div>
                    </form>
                </div>
            </div>

    </div>
    <script src="../assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="../assets/js/index.js" type="text/javascript"></script>
    <script src="../assets/js/signup.js" type="text/javascript"></script>

</body>
</html>