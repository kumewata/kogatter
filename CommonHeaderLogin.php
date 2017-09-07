<!--/**-->
<!-- * Created by PhpStorm.-->
<!-- * User: watarukume-->
<!-- * Date: 2017/08/29-->
<!-- * Time: 16:28-->
<!-- */-->

<header>
    <ul class="header_top">
        <li><a href="./TopController.php"><img src="./images/home.png" alt=""></a></li>
        <?php
            if(!empty($_SESSION["account_name"])){
                echo $_SESSION["account_name"], "さん、こんにちは";
            }
        ?>
        <li><img src="./images/icon.png" alt="icon"></li>
        <li><a href="./MypageController.php" alt="">マイページ</a></li>
        <li><a href="./UserslistController.php" alt="users_list">仲間を探す</a></li>
        <li><a href="./LogoutController.php">ログアウト</a></li>
    </ul>
</header>

