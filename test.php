<?php
    $conn = mysqli_connect("localhost","root","","test");
    $conn->set_charset("utf8mb4");
    $sql  = "SELECT * FROM users";

    $users = mysqli_query($conn,$sql);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .profile{
            height: 200px;
            width: 200px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
        <?php while ($user = mysqli_fetch_assoc($users)):?>
            <img class="profile" src="uploads/<?php echo $user['img']?>">
        <?php endwhile;?>
</body>
</html>
