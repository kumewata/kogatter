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
        <div id="main_password_reset">
            <h1>パスワードをリセットする</h1>
            <form action="">
                <p>メールアドレスを入力してください</p>
                <div><input type="email" placeholder=""></div>
                <div><input type="submit" value="パスワードリセットメールを送信する" class="btn_green"></div>
            </form>
        </div>
    </section>
    <!-- メインコンテンツエンド -->

<!-- フッタースタート -->
<?php include('./CommonFooter.php'); ?>
<!-- フッターエンド -->

</body>
</html>