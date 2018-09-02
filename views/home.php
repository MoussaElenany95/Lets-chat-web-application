<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:/");
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

</head>
<body>
<div id="perview_photo_area">
    <img src="" alt="" class="preview-img">
    <button class="btn signup-btn" onclick="location.href='/change/photo'">Change Photo</button>
</div>
<nav id="nav">

    <span class="custom-bar-icon"><img src="../assets/images/menu-icon.png" class="menu-icon"></span>

</nav>
<div class="chat-container">
    <section id="chat-left-area">

        <div class="profile-info">
            <ul>
                <li>
                    <div class="change_photo">
                        <span id="change_photo_shadow">Preview</span>
                        <span class="profile-img-span">
                                        <img src="../uploads/<?php echo $_SESSION['img'] ?>" alt="Profile image"
                                             class="profile-img">
                        </span>
                    </div>

                </li>
                <li><?php echo $_SESSION['user_name'] ?></li>
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
        <div class="chat-messages">
            <div class="chat-old-messages">

            </div>
            <div class="new-waiting-message"></div>
        </div>

        <div class="chat-form-area">

            <form class="chat-form-container" enctype="multipart/form-data">
                <div class="send-file-error">
                    <span class="cross-icon">&#x2715</span>
                    <span class="send-file-error-text"></span>
                </div>
                <div class="send-message-container">
                    <textarea name="send_message" id="send_message" class="message-textarea" placeholder="Enter message here"></textarea>
                    <div class="send-mssage">
                        <img src="../assets/images/send_message.png" class="send-mssage-icon">
                    </div>
                </div>
                <div class="chat-file-upload">
                    <label for="chat-file-upload" class="file-upload-label">
                        <img class="file-upload-icon" src="../assets/images/img-upload.png">
                        <img class="file-upload-icon" src="../assets/images/file-upload.png">
                    </label>
                    <span class='wait-file-upload'></span>
                    <input type="file" name="chat-upload-file" id="chat-file-upload">
                </div>
            </form>
        </div>

    </section>

</div>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/index.js"></script>
</body>
</html>