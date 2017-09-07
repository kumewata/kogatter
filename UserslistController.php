<?php
// セッション開始
session_start();

// 設定ファイルを読み込み
include('./Define.php');

// 関数ファイルを読み込み
include('./UserslistModel.php');

// 変数を用事
$account_name = ""; // アカウント名

// ログイン状態を擬似的に作るため、ここでセッション変数を設定。後で消す
//$_SESSION["account_name"] = "kume";

// セッション変数：アカウント名
if (isset($_SESSION["account_name"])) {
    $account_name = $_SESSION["account_name"];
}

// DB接続
$db = getDbConnect();

// DBから取得する連想キーを小文字に統一する
$db -> setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);

// ユーザー情報をテーブルから取得する
$users_info = getUsersInfo($db);

// セッションがもつユーザー名からuser_idを取得する。
$user_id = getUserIdFromAccountName($db, $account_name);

// ログインユーザーがフォローしているユーザーのidリストを取得
$following_list = following($db, $user_id);

// 全ユーザーのIDリストを取得
$all_users = getAllUserIds($db);
//print_r($users);

// 新規登録のViewファイルを読み込み
include('./UserslistView.php');

