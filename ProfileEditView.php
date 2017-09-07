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
        <div id="main_profile_edit">
            <h1>プロフィール編集</h1>

            <a href=""><img src="./images/icon.png" alt="icon"></a>
<!--            <div>-->
<!--                <div><button>プロフィール画像を変更</button></div>-->
<!--                <div><button>背景画像を変更</button></div>-->
<!--            </div>-->
            <div><p> <?php echo $account_name; ?>さん</p></div>

            <form action="<?php $_SERVER["SCRIPT_NAME"] ?>" method="post" enctype="multipart/form-data">
                <div>アイコン画像変更<input type="file" name="user_icon"></div>
                <div>カバー画像変更<input type="file" name="cover_pic"></div>
                <div><textarea name="introduction" cols="30" rows="5" placeholder="自己紹介"></textarea></div>
                <a href="./PasswordChangeController.php">パスワードの変更はこちら</a>
                <div><input type="submit" value="変更を保存" class="btn_green"></div>
            </form>
        </div>
    </section>
    <!-- メインコンテンツエンド -->

<!-- フッタースタート -->
<?php include('./CommonFooter.php'); ?>
<!-- フッターエンド -->

</body>
</html>