<?php
/**
 * Created by PhpStorm.
 * User: kogamitsuhiro
 * Date: 2017/08/23
 * Time: 12:38
 */
//セッションの色々
session_start();
session_regenerate_id(true);

$_SESSION["account_name"]  = "";
$_SESSION["login_flg"]     = 0;


// 設定ファイルを読み込み
include('./Define.php');

// 関数ファイルを読み込み
include('./RegisterModel.php');

// 変数を用意
$err_msg = []; // エラーメッセージ
$account_name = ""; // ユーザー名
$email = ""; // メールアドレス
$password = ""; // パスワード
$sm_type = ""; // S or M

// POSTで受け取った時の処理
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // DB接続
    $db = getDbConnect();

    // DBから取得する連想キーを小文字に統一する
    $db -> setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);

    // POSTの変数を取得
    $account_name = $_POST['account_name']; // ユーザー名
    $email = $_POST['email']; // メールアドレス
    $password = $_POST['password']; // パスワード
    $sm_type = $_POST['sm_type']; // S or M


    // ユーザー名重複チェック
    duplicateConfirmation ($db, $account_name, "account_name", "そのユーザー名は既に使用されています。");
    // メールアドレス重複チェック
    duplicateConfirmation ($db, $email, "email", "そのメールアドレスは既に使用されています。");


    // エラーメッセージ無し -> ユーザー情報をDBに登録、ユーザー固有のテーブル作成（user_#）
    if (empty($err_msg)) {
        // ユーザー名をセッションに保存
        $_SESSION['account_name'] = $account_name;

        // ユーザー情報をDBに登録
        addUserTable ($db, $account_name, $email, $password, $sm_type);

        header("Location:MypageController.php");
        exit;
    }
}



// 新規登録のViewファイルを読み込み
include('./RegisterView.php');
