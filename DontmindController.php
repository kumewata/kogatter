<?php
/**
 * Created by PhpStorm.
 * User: watarukume
 * Date: 2017/08/30
 * Time: 8:33
 */
session_start();

// 設定ファイルを読み込み
include('./Define.php');

// 関数ファイルを読み込み
include('./DontmindModel.php');

// 変数を用事
$account_name = ""; // アカウント名

// セッション変数：アカウント名
if (isset($_SESSION["account_name"])) {
    $account_name = $_SESSION["account_name"];
}

// DB接続
$db = getDbConnect();

// DBから取得する連想キーを小文字に統一する
$db -> setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);

// セッションがもつユーザー名からuser_idを取得する。
$user_id = getUserIdFromAccountName($db, $account_name);

// GETからidとdoを取得
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($_GET['do'])) {
    $do = $_GET['do'];
}

if (!empty($do) and !empty($id)) {
    switch ($do){
        case "dontmind":
            dontmind_post($db, $id, $user_id);
            $msg = "You have dontminded a user!";
            break;

        case "undontmind":
            undontmind_post($db, $id, $user_id);
            $msg = "You have undontminded a user!";
            break;

    }
}
//$_SESSION['message'] = $msg;

header("Location:TopController.php");