<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="./scss/stylesheets/style.css">
</head>
<body>
<div id="wrapper">
    <!-- ヘッダースタート -->
    <?php
        if (!empty($_SESSION['account_name'])) {
            include('./CommonHeaderLogin.php');
        } else {
            include('./CommonHeaderLogout.php');
        }
    ?>
    <!-- ヘッダーエンド -->
    <section class="main">
        <div id="main_login">
            <h1>kogatterにログイン</h1>
            <?php

            if ($err_flg == 1) {
                echo 'IDかパスワードが間違っています<br>';
            }
            ?>
            <form action="<?php $_SERVER["SCRIPT_NAME"] ?>" method="post">
                <input type="text" name="account_name" placeholder="ユーザー名"><br>
                <input type="password" name="password" placeholder="パスワード"><br>
                <input type="submit" value="ログイン" class="btn_green">
                <input type="checkbox">保存する
            </form>
            <a href="#">パスワードを忘れた場合はこちら</a>
        </div>
    </section>

<!-- フッタースタート -->
<?php include('./CommonFooter.php'); ?>
<!-- フッターエンド -->
</div>
</body>