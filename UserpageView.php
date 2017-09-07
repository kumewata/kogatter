<!--/**-->
<!-- * Created by PhpStorm.-->
<!-- * User: watarukume-->
<!-- * Date: 2017/08/29-->
<!-- * Time: 20:09-->
<!-- */-->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="./scss/stylesheets/style.css">
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

<!-- wrapperスタート -->
<div id="wrapper_mypage">
    <!-- 背景 -->
    <div class="profile-background-image-mypage">
    </div>
    <!-- サ¬イドプロフィールスタート -->
    <div id="profile_side_mypage">
        <div class="user-profile">
            <p>アイコン画像を入れる</p>
            <!--<a class="user-image" href=""><img src="./images/icon.png" alt="#"></a>-->
            <div class="account-name">
                <p>アカウント名</p>
                <p><?php echo $user_name ?></p>
            </div>
            <div class="user-type"><img src="./images/<?php echo $sm_category; ?>.png" alt="" width="50px"></div>
        </div>
        <div class="user-count">
            <div>
                <p>こがり数</p>
                <div><?= $tweet_count; ?></div>
            </div>
            <div>
                <p>どんまい数</p>
                <div><?= $dontmind_receive_all; ?></div>
            </div>
            <div>
                <p>フォロー数</p>
                <div><?= $following_num; ?></div>
            </div>
            <div>
                <p>フォロワー数</p>
                <div><?= $followed_num; ?></div>
            </div>
        </div>
        <p>自己紹介自己紹介自己紹介自己紹介</p>
        <p>####年#月に登録</p>

    </div>
    <!-- サイドプロフィールエンド -->

    <div id="main_top">

        <!-- こがり投稿スタート -->
        <div id="post_field">

        </div>
        <!-- こがり投稿エンド -->

        <!-- タイムラインスタート -->
        <!-- 下記、基本投稿の繰り返し -->
        <div class="kogari-post">
            <?php
            foreach ($kogari_tweets as $kogari_tweet) {
                echo "投稿内容：", $kogari_tweet['contents'], "<br>";
                echo "投稿日時：", $kogari_tweet['kogari_time'], "<br>";

                echo "ドンマイ数：", dontmind_count($db, $kogari_tweet['kogari_id']), "<br>";
            }
            ?>
<!--            <button type="submit" name="" value="">どんまい</button>-->
        </div>

        <!-- ドンマイメッセージ -->
<!--        <div class="dontmind-message">-->
<!--            <p>ドンマイドンマイ！</p>-->
<!--        </div>-->

        <!-- タイムラインエンド -->
    </div>
    <!-- 右側の広告スタート -->
    <div id="right_space">
        <p>広告など</p>
    </div>
</div>
<!-- wrapperエンド -->


<!-- フッタースタート -->
<?php include('./CommonFooter.php'); ?>
<!-- フッターエンド -->

</body>
</html>