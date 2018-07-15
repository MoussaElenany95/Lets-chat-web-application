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

    </head>
    <body>
        <nav id="nav">

        </nav>
        <div class="chat-container">
            <section id="chat-left-area">

                    <div class="profile-info">
                        <ul>
                            <li><span class="profile-img-span"><img src="../assets/images/signup-bg.jpg" alt="Profile image" class="profile-img"></span></li>
                            <li>Username</li>
                        </ul>
                    </div>
                    <div class="profile-settings">
                        <h1 id="show-settings">Settings</h1>
                        <ul class="ul-settings">
                            <li><a href="">Change Name<span class="back-hover"></span></a></li>
                            <li><a href="">Change Email<span class="back-hover"></span></a></li>
                            <li><a href="">Change Password<span class="back-hover"></span></a></li>
                        </ul>
                    </div>
                    <div class="chats">

                    </div>
            </section>
            <section id="chat-right-area">
                <div class="chat-messages">
                    <div class="left-message-area">
                        <div class="sender-img-block">
                            <img src="../assets/images/profile.png"  class="sender-img">
                            <span class="online-icon"></span>
                        </div>
                        <div class="left-message">

                            <div class="sender-name-date">
                                <span class="sender-name">Moussa Elenany</span>
                                <span class="message-time">1 day ago</span>
                            </div>
                            <div class="left-message-content">
                                <p>بسم الله الرحمن الرحيم وبه نستعين والصلاة والسلام على أشرف المرسلين سيدنا ونبينا محمد وعلى اله وصحبه وسلم اللهم صل على سيدنا ونبينا محمد وعلى آله وصحبه وسلم اللهم يا مثبت القلوب ثبت قلوبنا على طاعتك</p>
                            </div>

                        </div>
                    </div>
                    <div class="left-message-area">
                        <div class="sender-img-block">
                            <img src="../assets/images/profile.png"  class="sender-img">
                            <span class="offline-icon"></span>
                        </div>
                        <div class="left-message">

                            <div class="sender-name-date">
                                <span class="sender-name">Moussa Elenany</span>
                                <span class="message-time">1 day ago</span>
                            </div>
                            <div class="left-message-content">
                                <p>Lorem ipsum dolor sit
                                    amet, consectetur adipisicing elit. A,
                                    accusantium aliquid assumenda atque
                                    blanditiis cupiditate et, expedita, fugiat harum incidunt laudantium magnam maxime
                                    minus nulla obcaecati quas quia quos reiciendis.

                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="right-message-area">
                        <div class="right-message">

                            <div class="right-sender-name-date">

                                <span class="message-time">1 day ago</span>
                            </div>
                            <div class="right-message-content">
                                <p>
                                    بسم الله الرحمن الرحيم وبه نستعين والصلاة والسلام على أشرف المرسلين سيدنا ونبينا محمد وعلى اله وصحبه وسلم اللهم صل على سيدنا ونبينا محمد وعلى آله وصحبه وسلم اللهم يا مثبت القلوب ثبت قلوبنا على طاعتك


                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="right-message-area">
                        <div class="right-message">

                            <div class="right-sender-name-date">

                                <span class="message-time">1 day ago</span>
                            </div>
                            <div class="right-message-content">
                                <p>
                                    اللهم يا مثبت القلوب ثبت قلوبنا على طاعتك
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="chat-form-area">
                    <form class="chat-form-container">

                            <div class="text-area-controller">
                                <textarea name="" id=""  class="message-textarea" placeholder="Enter message here"></textarea>
                            </div>
                            <div class="chat-file-upload">
                                <label for="chat-file-upload" class="file-upload-label">
                                    <img class="file-upload-icon" src="../assets/images/img-upload.png">
                                    <img class="file-upload-icon" src="../assets/images/file-upload.png">
                                </label>
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