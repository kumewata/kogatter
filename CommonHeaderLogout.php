<!--/**-->
<!-- * Created by PhpStorm.-->
<!-- * User: watarukume-->
<!-- * Date: 2017/08/29-->
<!-- * Time: 16:28-->
<!-- */-->

<header>
    <ul class="header_top">
        <?php
            if(!empty($_SESSION["account_name"])){
                echo $_SESSION["account_name"], "さん、こんにちは";
            }
        ?>
        <li><img src="./images/icon.png" alt="icon"></li>
        <li><a href="./LoginController.php">アカウントをお持ちの場合ログイン</a></li>
        <li><a href="./RegiserController.php" alt="">新規登録</a></li>
    </ul>
</header>

