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
        <div id="main_register">
            <?php
                foreach ($err_msg as $value) {
                    echo $value, "<br>";
                }
            ?>
            <h1>新規登録</h1>
            <form action="<?php $_SERVER["SCRIPT_NAME"] ?>" method="post">
                <div><input type="text" name="account_name" placeholder="ユーザー名"></div>
                <div><input type="email" name="email" placeholder="メールアドレス"></div>
                <div><input type="password" name="password" placeholder="パスワード"></div>
                <p>あなたは攻めるのが好き？攻められるのが好き？</p>
                <div><input type="radio" name="sm_type" value="type_s" checked="checked">攻めたい</div>
                <div><input type="radio" name="sm_type" value="type_m">攻められたい</div>
                <div><input type="submit" value="アカウント作成" class="btn_green"></div>
            </form>
        </div>
    </section>
    <!-- メインコンテンツエンド -->

<!-- フッタースタート -->
<?php include('./CommonFooter.php'); ?>
<!-- フッターエンド -->

</body>
</html>