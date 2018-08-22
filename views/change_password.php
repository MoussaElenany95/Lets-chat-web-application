<?php session_start();
if (!isset($_SESSION['user_id'])) {
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
    <link rel="icon" href="../assets/images/favicon.png">
    <style>
        span {
            color: red;
        }
    </style>
</head>
<body>
<div id="perview_photo_area"><img src="" alt="" class="preview-img">
    <button class="btn signup-btn" onclick="location.href='/change/photo'">Change Photo</button>
</div>
<nav id="nav">
    <nav id="nav">

        <span class="custom-bar-icon"><img src="../assets/images/menu-icon.png" class="menu-icon"></span>

    </nav>
</nav>
<div class="chat-container">
    <section id="chat-left-area">

        <div class="profile-info">
            <ul>
                <li><span class="profile-img-span"><img src="../uploads/<?php echo $_SESSION['img']; ?>"
                                                        alt="Profile image" class="profile-img"></span></li>
                <li><?php echo $_SESSION['user_name']; ?></li>
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
            <form method="POST" action="/update" class="change-form" id="change_password_form">

                <?php if (isset($_SESSION['password_success'])): ?>
                    <div class="alert success-alert">
                        <?php echo $_SESSION['password_success']; ?>
                        <?php unset($_SESSION['password_success']) ?>
                    </div>
                <?php endif; ?>
                <div class="group">
                    <h1 class="form-heading">Change Password</h1>
                </div>
                <input type="hidden" name="id" id="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                <div class="group">
                    <label for="current_password" id="password-label">Current password</label>
                    <input type="password" name="password" id="current_password" class="control"
                           placeholder="Enter Current Password ...">
                    <span id="current_error" class=""></span>
                </div>

                <div class="group">
                    <label for="new_password" id="password-label">New password</label>
                    <input type="password" name="new_password" id="new_password" class="control"
                           placeholder="Enter New Password ...">
                    <span id="new_password_error" class=""></span>

                </div>

                <div class="group">
                    <label for="confirm_password" id="password-label">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="control"
                           placeholder="Confirm  Password ...">
                    <span id="confirm_password_error" class=""></span>

                </div>
                <input type="hidden" name="change_password" value="change_pass">
                <div class="group">
                    <input type="submit" name="change_password" id="signup_submit" class="btn signup-btn control"
                           value="Save Changes">
                </div>
            </form>
        </div>
    </section>


</div>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/index.js"></script>
</body>
</html>