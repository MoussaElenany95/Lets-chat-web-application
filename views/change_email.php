<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Home</title>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,900" rel="stylesheet">
        <link rel="icon"  href="../assets/images/favicon.png">

    </head>
    <body>
        <nav id="nav">
            <nav id="nav">

                <span class="custom-bar-icon"><img src="../assets/images/menu-icon.png" class="menu-icon"></span>

            </nav>
        </nav>
        <div class="chat-container">
            <section id="chat-left-area">

                <div class="profile-info">
                    <ul>
                        <li><span class="profile-img-span"><img src="../uploads/<?php echo $_SESSION['img'];?>" alt="Profile image" class="profile-img"></span></li>
                        <li><?php echo $_SESSION['user_name'];?></li>
                    </ul>
                </div>
                <div class="profile-settings">
                    <h1 id="show-settings">Settings</h1>
                    <ul class="ul-settings">
                        <li><a href="change_name.php">Change Name<span class="back-hover"></span></a></li>
                        <li><a href="change_email.php">Change Email<span class="back-hover"></span></a></li>
                        <li><a href="change_password.php">Change Password<span class="back-hover"></span></a></li>
                        <li><a href="../route/route.php?logout=1">Logout</a></li>
                    </ul>
                </div>
                <div class="chats">

                </div>
            </section>
            <section id="chat-right-area">
                <div class="change-form-area">
                    <form action="" class="change-form">
                        <div class="group">
                            <h1 class="form-heading">Change Email</h1>
                        </div>

                        <div class="group">
                            <label for="name" id="name-label">Email</label>
                            <input type="email" name="email" id="name" class="control" placeholder="Enter New Email" >
                        </div>

                        <div class="group">
                            <input type="submit" name="change_Email_submit" id="change_Email_submit" class="btn signup-btn control" value="Save Changes">
                        </div>
                    </form>
                </div>
            </section>


        </div>
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/index.js"></script>
    </body>
</html>