<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="./scss/stylesheets/pc.css">
</head>
<body>
<!-- ヘッダースタート -->
<?php
    if (!empty($_SESSION['account_name'])) {
        include('./CommonHeaderLogin.php');
    } else {
        include('./CommonHeaderLogout.php');
    }
?>
<!-- ヘッダーエンド -->

<!-- メインコンテンツスタート -->
<section class="main">
    <div id="main_password_change">
        <h1>パスワードの変更</h1>
        <form action="<?php $_SERVER["SCRIPT_NAME"] ?>" method="post">
            <div><input type="password" name="current_password" placeholder="現在のパスワード"></div>
            <div><input type="password" name="new_password" placeholder="新しいパスワード"></div>
            <div><input type="password" name="confirm_password" placeholder="新しいパスワード（確認）"></div>
            <div><input type="submit" value="パスワードを変更する" class="btn_green"></div>
        </form>
    </div>
</section>
<!-- メインコンテンツエンド -->

<!-- フッタースタート -->
<?php include('./CommonFooter.php'); ?>
<!-- フッターエンド -->

</body>
</html>