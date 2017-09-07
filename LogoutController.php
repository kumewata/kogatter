<?php
/**
 * Created by PhpStorm.
 * User: kogamitsuhiro
 * Date: 2017/08/29
 * Time: 23:36
 */

session_start();

session_regenerate_id(true);

// セッション変数を全て解除
$_SESSION = [];

// セッションクッキーを削除
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// セッションを全て破棄
session_destroy();

//var_dump(session_status());

include('./LogoutView.php');