<?php session_start();
    if (!isset($_SESSION['user_id'])){
        header("location:index.php");
    }
?>
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
                        <li><a href="/change/name">Change Name<span class="back-hover"></span></a></li>
                        <li><a href="/change/email">Change Email<span class="back-hover"></span></a></li>
                        <li><a href="/change/password">Change Password<span class="back-hover"></span></a></li>
                        <li><a href="/logout?logout=1">Logout</a></li>
                    </ul>
                </div>
                <div class="chats">

                </div>
            </section>
            <section id="chat-right-area">
                <div class="change-form-area">
                    <form method="post" action="/update" class="change-form" id="change_name_form">

                        <?php if (isset($_SESSION['name_success'])):?>
                            <div class="alert success-alert">
                                <?php echo $_SESSION['name_success'];?>
                                <?php unset($_SESSION['name_success'])?>
                            </div>
                        <?php endif; ?>

                        <div class="group">
                            <h1 class="form-heading">Change Name</h1>
                        </div>

                        <div class="group">
                            <label for="name" id="name-label">Full Name</label>
                            <input type="text" name="name" id="name" class="control"  placeholder="Enter New name" value="<?php echo $_SESSION['user_name'];?>">
                            <span id="name_error" style="color: red"></span>
                        </div>

                        <div class="group">
                            <input type="submit" name="change_name_submit" id="change_name_submit" class="btn signup-btn control" value="Save Changes">
                        </div>
                    </form>
                </div>
            </section>


        </div>
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/index.js"></script>
    </body>
</html>