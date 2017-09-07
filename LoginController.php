<?php
/**
 * Created by PhpStorm.
 * User: kogamitsuhiro
 * Date: 2017/08/23
 * Time: 12:44
 */

//セッション開始
session_start();

session_regenerate_id(true);

// Modelをインクルード
include('./LoginModel.php');

// 変数を用意
$err_flg    = 0;             // エラーフラグ
$login_flg      = 0;             // ログインフラグ
$account_name     = "";      // アカウント名
$password   = "";            // パスワード

// セッション変数：メールアドレス
if (isset($_SESSION['account_name'])) {
    $account_name = $_SESSION['account_name'];
}
// セッション変数：パスワード
if (isset($_SESSION['password'])) {
    $password = $_SESSION['password'];
}

//===== ポスト：リクエスト処理  =====
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //--- ログイン処理 ---

    // ユーザーID：HTML特殊文字変換
    $account_name = htmlspecialchars($_POST["account_name"], ENT_QUOTES);

    // ユーザー名をセッションに保存
    storeVariableToSession($account_name,"account_name");


    // パスワード：HTML特殊文字変換
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES);

    // パスワードをセッションに保存
    storeVariableToSession($password,"password");

    $db = new PDO("mysql:host=localhost;dbname=kogatter", 'root', 'root');

    $result = $db->query("SELECT account_name, password FROM users WHERE account_name = '$account_name' AND password = '$password'");

    $rows = $result -> fetchAll(PDO::FETCH_ASSOC);

    if (empty($rows)) {
        $err_flg = 1;
    }
    else {
        header("Location:TopController.php");
        exit;
    }
}

// Viewをインクルード
include('./LoginView.php');

?>