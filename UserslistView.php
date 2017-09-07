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
    <h1>ユーザー一覧</h1>
    <div id="main_users_list">
        <!--        <p>ユーザー名</p>-->
        <!--        <p>フォローボタン</p>-->
        <?php
            foreach ($all_users as $id => $user_name) {
                if ($id !== $user_id) {
                    echo "<div><a href='./UserpageController.php?user_name=${user_name}'><img src='./images/icon.png' width=100px alt=''><br>";
                    echo $user_name, "<br>";

                    // 自分以外のユーザーにフォロー/アンフォロー表示する
                    if (in_array($id,$following_list)){
                        echo "<a href='ActionController.php?id=${id}&do=unfollow'>フォローをやめる</a>";
                    } else {
                        echo "<a href='ActionController.php?id=${id}&do=follow'>フォローする</a>";
                    }
                } else { // 自分を選択した場合は、マイページへ飛ばす
                    echo "<div><a href='./MypageController.php'><img src='./images/icon.png' width=100px alt=''><br>";
                    echo $user_name, "<br>";
                }

                echo "<br><br></a></div>";

            }
        ?>
    </div>
</section>
<!-- メインコンテンツエンド -->

<!-- フッタースタート -->
<?php include('./CommonFooter.php'); ?>
<!-- フッターエンド -->

</body>
</html>