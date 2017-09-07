<?php
/**
 * Created by PhpStorm.
 * User: kogamitsuhiro
 * Date: 2017/08/23
 * Time: 12:40
 */

session_start();
session_regenerate_id(true);

// 関数ファイルを読み込み
include('./PasswordChangeModel.php');

//変数用意
$err_msg = []; // エラーメッセージ
//$account_name     = $_SESSION["$account_name"] ;
$account_name     = "aaa";
$current_password = "";
$new_password     = "";
$confirm_password = "";

//ポストリクスト処理
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //ポストの変数取得
    $current_password = $_POST['current_password']; // 現在のパスワード
    $new_password = $_POST['new_password']; // 新しいパスワード
    $confirm_password = $_POST['confirm_password']; // 確認用のパスワード

    echo $account_name."<br>",$current_password."<br>",$new_password."<br>",$confirm_password."<br>";

    // DB接続
    $db = getDbConnect();

    //現在のパスワードが合ってるか
    passConfirm($db,$current_password,$account_name);

    //新しいパスワードと確認用パワスワードが等しいか
    passSame($new_password,$confirm_password);


    // エラーメッセージ無し -> パスワードを書き換える。
    if (empty($err_msg)) {
        // エラーメッセージがなかったら、パスワード書き換え。
        passChange($db,$new_password,$account_name);
    }else{
        //エラーメッセージあったら、それを表示。
        echo $err_msg;
    }

}





// 新規登録のViewファイルを読み込み
include('./PasswordChangeView.php');