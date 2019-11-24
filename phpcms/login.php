<?php require_once 'includes/init.php';
if (isset($_SESSION['Admin'])){
    header('Location:admin/');
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
<div class="contanier" style="width:40%;background: #fff;padding: 50px;margin: 120px auto;box-shadow: 0 0 3px #ccc;">
    <?php LoginCheck(); ?>
    <form action="" method="post">
        <input type="text" class="textbox" name="admin_username" placeholder="نام کاربری">
        <input type="text" class="textbox" name="admin_password" placeholder="رمز عبور">
        <br>
        <input type="submit" class="btn btn-success" name="Login" value="ورود به پنل مدیریت">
        <input type="submit" class="btn btn-error" name="Login" value="انصراف">
    </form>
    <?php
        if (isset($_GET['Login'])){
        echo '<p class="alert alert-error">رمز عبور یا نام کاربری اشتباه است</p>';
        }
    ?>

</div>
</body>
</html>